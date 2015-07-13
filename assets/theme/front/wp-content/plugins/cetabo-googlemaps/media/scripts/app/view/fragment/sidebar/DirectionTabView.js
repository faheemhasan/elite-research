(function() {
  Cetabo.DirectionTabView = Cetabo.PlacesTabView.extend({
    events: function() {
      return _.extend({}, Cetabo.PlacesTabView.prototype.events, {
        "click .calculate-route": "calculateRoute",
        "click .direction-type": "selectDirectionType"
      });
    },
    initialize: function(config) {
      var channel;
      this.config = config;
      this.model = config.model;
      this.channel = config.channel;
      this.travelMode = "DRIVING";
      this.initUIControll();
      channel = this.getChannel();
      Cetabo.EventDistpatcher.use(channel).on("place.add", this.onAddPlaces, this);
      Cetabo.EventDistpatcher.use(channel).on("place.remove", this.onRemovePlace, this);
      Cetabo.EventDistpatcher.use(channel).on("place.update", this.onUpdatePlace, this);
      Cetabo.EventDistpatcher.use(channel).on("direction.message", this.onDirectionMessage, this);
      Cetabo.EventDistpatcher.use(channel).on("direction.stateupdate", this.onDirectionButtonStateUpdate, this);
      Cetabo.EventDistpatcher.use(channel).on("map.load", this.onLoadMap, this);
      Cetabo.EventDistpatcher.use(channel).on("map.updatemode", this.onChangeMode, this);
    },
    initUIControll: function() {
      this.initAddressPicker();
      this.initPlaceSelector();
      this.initTravelModeSelector();
      this.initNotificationManager();
    },
    initNotificationManager: function() {
      var channel;
      channel = this.getChannel();
      this.notificationsManager = new Cetabo.NotificationsManager({
        channel: channel + "_private",
        el: this.find('.message')
      });
    },
    initPlaceSelector: function() {
      var instance;
      instance = this;
      this.find(' .destination').change(function() {
        instance.calculateRoute();
      });
    },
    initTravelModeSelector: function() {
      var instance;
      instance = this;
      this.find(".travel-bar input[name='travel_mode']").change(function() {
        instance.calculateRoute();
      });
    },
    initAddressPicker: function() {
      var instance, uiAutoData;
      instance = this;
      this.addresspicker = this.find('.origin').addresspicker({
        updateCallback: function(geocodeResult, parsedGeocodeResult) {
          instance.calculateRoute();
        }
      });
      uiAutoData = this.find('.origin').data("ui-autocomplete");
      if (uiAutoData != null) {
        jQuery("#" + uiAutoData.menu.activeMenu.context.id).addClass("cmap-autocompleate-result");
      }
    },
    calculateRoute: function() {
      var channel, destination, directionConfig, origin, token;
      channel = this.getChannel();
      if (this.find('.destination').val() === null) {
        return;
      }
      token = this.find('.destination').val().split("|");
      destination = new google.maps.LatLng(token[0], token[1]);
      origin = this.find('.origin').val();
      directionConfig = {
        request: {
          origin: origin,
          destination: destination,
          travelMode: this.travelMode
        },
        showSteps: this.model.get("showsteps")
      };
      Cetabo.EventDistpatcher.use(channel).trigger("direction.show", directionConfig);
    },
    selectDirectionType: function(event) {
      var target;
      target = event.currentTarget;
      this.travelMode = jQuery(target).data('type');
      this.find('.active').removeClass('active');
      jQuery(target).addClass('active');
    },
    updatePlaceSelector: function(model) {
      var contentHTML, key, place, places;
      contentHTML = "";
      places = model.get("places");
      for (key in places) {
        place = places[key];
        if (this.isStepPlace(place)) {
          continue;
        }
        contentHTML += "<option value='" + place.get("lat") + "|" + place.get("lng") + "'>" + place.get("name") + "</option>";
      }
      this.find('.destination').html(contentHTML);
    },
    isStepPlace: function(place) {
      return place.get("transient") === true;
    },
    onAddPlaces: function(place) {
      this.model.addPlace(place.get("id"), place);
      this.onModelUpdate();
    },
    onRemovePlace: function(place) {
      this.model.removePlace(place.get("id"));
      this.onModelUpdate();
    },
    onUpdatePlace: function(place) {
      this.onModelUpdate();
      if (!this.isStepPlace(place)) {
        this.calculateRoute();
      }
    },
    onModelUpdate: function() {
      var model;
      model = this.model;
      this.updatePlaceSelector(model);
      this.updateStepPlaceList(model);
    },
    onDirectionMessage: function(message) {
      Cetabo.EventDistpatcher.use(this.getChannel() + "_private").trigger("notification.show", message);
    },
    onLoadMap: function(model) {
      if (model.get("tracking") === true) {
        Cetabo.EventDistpatcher.use(this.channel).trigger("direction.track", model.get("trackinginterval"));
      } else {
        Cetabo.EventDistpatcher.use(this.channel).trigger("direction.untrack");
      }
    },
    onDirectionStateUpdate: function() {
      var model;
      model = this.model;
      this.onLoadMap(model);
      this.calculateRoute();
    },
    updateStepPlaceList: function(model) {
      var contentHTML, directionPlaces, html, key, place, places, template;
      contentHTML = "";
      places = model.get("places");
      directionPlaces = [];
      for (key in places) {
        place = places[key];
        if (!this.isStepPlace(place)) {
          continue;
        }
        directionPlaces.push(place);
      }
      template = Cetabo.TemplateManager.getTemplateByName("#template-steps");
      html = template({
        'places': directionPlaces
      });
      this.find('.steps').html(html);
    }
  });

}).call(this);
