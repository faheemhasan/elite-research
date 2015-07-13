(function() {
  Cetabo.PlacesView = Cetabo.AbstractAccordionView.extend({
    events: function() {
      return _.extend({}, Cetabo.AbstractAccordionView.prototype.events, {});
    },
    initialize: function(config) {
      var channel;
      this.initAccordionControl();
      this.model = config.model;
      this.channel = config.channel;
      this.iconProviderModel = new Cetabo.IconProviderModel(config.baseURL);
      this.placeAnimationTypeProviderModel = new Cetabo.PlaceAnimationTypeProviderModel();
      this.iconSelectors = [];
      this.animationSelectors = [];
      channel = this.getChannel();
      this.componentFactory = new Cetabo.ComponentFactory();
      Cetabo.EventDistpatcher.use(channel).on("place.select", this.onFocusPlace, this);
      Cetabo.EventDistpatcher.use(channel).on("map.load", this.onLoadMap, this);
    },
    onFocusPlace: function(place) {
      var id;
      id = place.get("id");
      this.expand(id);
    },
    onLoadMap: function(model) {
      var key, place, places;
      places = model.getPlacesByAttribute("type", [undefined, "default"]);
      place = undefined;
      for (key in places) {
        if (place === undefined) {
          place = places[key];
        }
        this.bindModel(key, places[key]);
      }
      this.updateContentEditor(place);
    },
    getPlaceById: function(id) {
      return this.model.getPlaceById(id);
    },
    afterElementCreation: function(id) {
      var channel, place;
      place = this.getPlaceById(id);
      this.initIconSelector(place);
      this.initAnimationSelector(place);
      this.initNameInput(place);
      this.initLocationInput(place);
      this.initFileUploader(place);
      this.initTagsInput(place);
      channel = this.getChannel();
      Cetabo.EventDistpatcher.use(channel).trigger("place.add", place);
    },
    afterElementAdded: function(id) {
      var place;
      place = this.getPlaceById(id);
      this.onFocusPlace(place);
      this.updateContentEditor(place);
    },
    initNameInput: function(place) {
      var name;
      name = jQuery("#" + place.get("id") + " .name");
      name.val(place.get("name"));
      jQuery("#name-lable-" + place.get("id")).html(place.get("name"));
      name.change(function() {
        var value;
        value = jQuery(this).val();
        place.set("name", value);
        jQuery("#name-lable-" + place.get("id")).html(value);
      });
    },
    initTagsInput: function(place) {
      var channel, tags;
      channel = this.getChannel();
      tags = jQuery("#" + place.get("id") + " .tags");
      tags.val(place.get("tags"));
      tags.tagsInput({
        onChange: function() {
          

          var value;
          value = jQuery(this).val();
          place.set("tags", value);
          Cetabo.EventDistpatcher.use(channel).trigger("place.updateTag", place);
          

        }
      });
    },
    initLocationInput: function(place) {
      var lat, lng;
      lng = jQuery("#" + place.get("id") + " .lng");
      lng.val(place.get("lng"));
      lng.change(function() {
        var value;
        value = jQuery(this).val();
        place.set("lng", value);
      });
      lat = jQuery("#" + place.get("id") + " .lat");
      lat.val(place.get("lat"));
      lat.change(function() {
        var value;
        value = jQuery(this).val();
        place.set("lat", value);
      });
    },
    initFileUploader: function(place) {
      

      var channel, iconProviderModel;
      channel = this.getChannel();
      iconProviderModel = this.iconProviderModel;
      this.fileUploader = new Cetabo.FileUploaderAdaptor({
        el: "#" + place.get("id") + " .custom",
        onSelectAttachment: function(attachment) {
          var item;
          if (attachment === undefined) {
            return;
          }
          item = {
            id: attachment.id,
            imageSrc: attachment.url,
            description: attachment.description,
            text: attachment.title
          };
          iconProviderModel.getData().push(item);
          Cetabo.EventDistpatcher.use(channel).trigger("select2.update", attachment);
          jQuery("#" + place.get("id") + " .icon").select2("val", attachment.id);
          place.set("icon", item.imageSrc);
          place.set("iconCustomName", item.text);
          place.set("iconCustomId", item.id);
          Cetabo.EventDistpatcher.use(channel).trigger("place.update", place);
        }
      });
      

    },
    initIconSelector: function(place) {
      var channel;
      this.updatePlaceIconIfEmpty(place);
      this.updateIconProviderModelIfRequired(place);
      channel = this.getChannel();
      this.iconSelectors[place.get("id")] = new Cetabo.Select2Adaptor({
        el: "#" + place.get("id") + " .icon",
        provider: this.iconProviderModel,
        channel: channel,
        onMatchSelection: function(obj) {
          return obj !== undefined && obj.imageSrc === place.get("icon");
        },
        onFormatResult: function(item) {
          return "<div class='place-icon-selector'><img class='icon' src='" + item.imageSrc + "'/>" + item.text + "<div class='description'>" + item.description + "</div></div>";
        },
        onFormatSelection: function(item) {
          return item.text;
        },
        onSelect: function(item) {
          place.set("icon", item.imageSrc);
          place.set("iconCustomName", item.text);
          place.set("iconCustomId", item.id);
          Cetabo.EventDistpatcher.use(channel).trigger("place.update", place);
        }
      });
    },
    updatePlaceIconIfEmpty: function(place) {
      var channel, item;
      if (place.get('icon') !== '') {
        return;
      }
      item = this.iconProviderModel.getById(place.get("iconCustomId"));
      if (item != null) {
        channel = this.getChannel();
        place.set("icon", item.imageSrc);
        Cetabo.EventDistpatcher.use(channel).trigger("place.update", place);
      } else {
        item = this.iconProviderModel.getById(0);
        place.set("icon", item.imageSrc);
        place.set("iconCustomName", item.text);
        place.set("iconCustomId", item.id);
      }
    },
    initAnimationSelector: function(place) {
      var channel;
      channel = this.getChannel();
      this.componentFactory.create('select', place.get("id"), {
        el: jQuery("#" + place.get("id") + " .animation"),
        provider: this.placeAnimationTypeProviderModel,
        value: parseInt(place.get("animation")),
        onChange: function(value, item) {
          

          place.set("animation", value);
          Cetabo.EventDistpatcher.use(channel).trigger("place.update", place);
          

        }
      });
    },
    updateIconProviderModelIfRequired: function(place) {
      var channel, customIcon, selectedItem;
      selectedItem = this.iconProviderModel.valueOf(function(obj) {
        return obj !== undefined && obj.imageSrc === place.get("icon");
      });
      if (selectedItem === undefined) {
        channel = this.getChannel();
        customIcon = {
          id: place.get("iconCustomId"),
          imageSrc: place.get("icon"),
          description: "Icon " + place.get("iconCustomName"),
          text: place.get("iconCustomName")
        };
        this.iconProviderModel.getData().push(customIcon);
        Cetabo.EventDistpatcher.use(channel).trigger("select2.update", customIcon);
      }
    },
    /*
    Provice concrete implementation for creation of nre accordionElement
    */

    createAccordionElement: function(id) {
      var template;
      template = Cetabo.TemplateManager.getTemplateByName("#template-place");
      return template({
        'id': id
      });
    },
    createAccordionElementDataModel: function(id) {
      var placeDataModel;
      placeDataModel = new Cetabo.PlaceModel({
        id: id,
        name: "",
        channel: this.getChannel(),
        details: "",
        type: "default",
        animation: "0"
      });
      this.model.addPlace(id, placeDataModel);
      return placeDataModel;
    },
    afterElementRemoval: function(id) {
      var channel, place;
      place = this.model.getPlaceById(id);
      channel = this.getChannel();
      Cetabo.EventDistpatcher.use(channel).trigger("place.remove", place);
      this.model.removePlace(id);
    },
    onExpand: function(index) {
      var id, place;
      id = this.resolveAccordionIdByIndex(index);
      place = this.getPlaceById(id);
      this.updateContentEditor(place);
    },
    onPreexpand: function(index) {
      var channel, id, place;
      id = this.resolveAccordionIdByIndex(index);
      place = this.getPlaceById(id);
      if (place === undefined) {
        return;
      }
      channel = this.getChannel();
      Cetabo.EventDistpatcher.use(channel).trigger("content.change", place.get("details"), function(content) {});
    },
    onClear: function() {
      var channel;
      channel = this.getChannel();
      Cetabo.EventDistpatcher.use(channel).trigger("content.hide");
    },
    updateContentEditor: function(place) {
      var channel;
      if (place === undefined) {
        return;
      }
      channel = this.getChannel();
      Cetabo.EventDistpatcher.use(channel).trigger("content.change", place.get("details"), function(content) {
        place.set("details", content);
      });
    }
  });

}).call(this);
