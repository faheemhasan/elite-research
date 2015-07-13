(function() {
  Cetabo.HyperlapseView = Cetabo.AbstractAccordionView.extend({
    events: function() {
      return _.extend({}, Cetabo.AbstractAccordionView.prototype.events, {});
    },
    initialize: function(config) {
      var channel;
      this.initAccordionControl();
      this.model = config.model;
      this.channel = config.channel;
      this.initHyperlapseCheckbox();
      channel = this.getChannel();
      Cetabo.EventDistpatcher.use(channel).on("map.load", this.onLoadMap, this);
    },
    onLoadMap: function(model) {
      var key, place, places;
      places = model.getPlacesByAttribute("type", "hyperlapse");
      for (key in places) {
        place = places[key];
        this.bindModel(key, place);
      }
    },
    initHyperlapseCheckbox: function() {
      var channel, instance;
      instance = this;
      channel = this.getChannel();
      this.find(".hyperlapse").iCheck({
        checkboxClass: "icheckbox_minimal",
        radioClass: "iradio_minimal"
      }).on("ifChanged", function() {
        instance.enableHyperlapse(this.checked);
      });
    },
    enableHyperlapse: function(enabled) {
      var mode;
      this.model.set("hyperlapse", enabled);
      mode = enabled ? google.maps.MapMode.HYPERLAPSE : google.maps.MapMode.MAP;
      Cetabo.EventDistpatcher.use(this.channel).trigger("map.updatemode", mode);
      this.updateControlPlaces(enabled);
    },
    updateControlPlaces: function(enabled) {
      var isHyperplasePlacesPresent, places;
      places = this.model.getPlacesByAttribute("type", "hyperlapse");
      if (enabled) {
        isHyperplasePlacesPresent = places.length === !0;
        if (!isHyperplasePlacesPresent) {
          this.createControlPlaces();
        }
      } else {
        this.removeControlPlaces();
      }
    },
    createControlPlaces: function() {
      var i, key, place, placeNames;
      placeNames = ['Start point', 'End point', 'Look at'];
      i = 0;
      while (i < placeNames.length) {
        key = this.buildAccordionElementIdentifier();
        place = this.createAccordionElementDataModel(key);
        place.set("name", placeNames[i]);
        this.bindModel(key, place);
        i++;
      }
    },
    removeControlPlaces: function() {
      var key, places;
      places = this.model.getPlacesByAttribute("type", "hyperlapse");
      for (key in places) {
        Cetabo.EventDistpatcher.use(this.channel).trigger("place.remove", places[key]);
      }
    },
    getPlaceById: function(id) {
      return this.model.getPlaceById(id);
    },
    afterElementCreation: function(id) {
      var channel, place;
      place = this.getPlaceById(id);
      this.initNameInput(place);
      this.initLocationInput(place);
      channel = this.getChannel();
      Cetabo.EventDistpatcher.use(channel).trigger("place.add", place);
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
    /*
    Provide concrete implementation for creation of nre accordionElement
    */

    createAccordionElement: function(id) {
      var template;
      template = Cetabo.TemplateManager.getTemplateByName("#template-place-hyperlapse");
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
        type: "hyperlapse"
      });
      this.model.addPlace(id, placeDataModel);
      return placeDataModel;
    }
  });

}).call(this);
