(function() {
  Cetabo.StreetManager = Cetabo.MarkerManager.extend({
    initialize: function(config) {
      var channel;
      Cetabo.StreetManager.__super__.initialize.apply(this, arguments);
      this.config = config;
      channel = this.get("channel");
      Cetabo.EventDistpatcher.use(channel).on("place.add", this.onAddPlaces, this);
      Cetabo.EventDistpatcher.use(channel).on("place.remove", this.onRemovePlace, this);
      Cetabo.EventDistpatcher.use(channel).on("place.update", this.onUpdatePlace, this);
      Cetabo.EventDistpatcher.use(channel).on("map.created", this.onMapCreated, this);
      Cetabo.EventDistpatcher.use(channel).on("map.updatesize", this.onUpdateSize, this);
      Cetabo.EventDistpatcher.use(channel).on("map.updatemode", this.onChangeMode, this);
      Cetabo.EventDistpatcher.use(channel).on("street.updateposition", this.onChangePosition, this);
      Cetabo.EventDistpatcher.use(channel).on("street.updatepov", this.onChangePov, this);
      Cetabo.EventDistpatcher.use(channel).on("screen.updatesize", this.onUpdateScreenSize, this);
      Cetabo.EventDistpatcher.use(channel).on("screen.resized", this.onScreenResolutionChanged, this);
    },
    initStreet: function(streetCanvas) {
      var channel;
      this.streetViewService = new google.maps.StreetViewService();
      this.panorama = new google.maps.StreetViewPanorama(document.getElementById(streetCanvas), this.preparePanoramaOptions());
      this.panorama.getDiv = function() {
        return streetCanvas;
      };
      this.panorama.getCenter = function() {
        return this.getPosition();
      };
      channel = this.get("channel");
      google.maps.event.addListener(this.panorama, "position_changed", function() {
        var position;
        position = this.getPosition();
        if (position === undefined) {
          return;
        }
        Cetabo.EventDistpatcher.use(channel).trigger("street.updateposition", position.lat(), position.lng());
      });
      google.maps.event.addListener(this.panorama, "pov_changed", function() {
        Cetabo.EventDistpatcher.use(channel).trigger("street.updatepov", this.getPov());
      });
    },
    preparePanoramaOptions: function() {
      return {
        pov: {
          heading: 34,
          pitch: 10
        },
        addressControl: true,
        addressControlOptions: {
          style: {
            backgroundColor: "grey",
            color: "yellow"
          },
          position: google.maps.ControlPosition.LEFT_BOTTOM
        },
        panControlOptions: {
          position: google.maps.ControlPosition.RIGHT_TOP
        },
        zoomControlOptions: {
          position: google.maps.ControlPosition.RIGHT_TOP
        }
      };
    },
    onChangeMode: function(mode) {
      var container, position;
      this.mode = mode;
      container = jQuery("#" + this.config.el);
      if (google.maps.MapMode.STREET === mode) {
        container.show();
        position = this.panorama.getPosition();
        this.verifyStreetViewAvailable(position);
        this.map.setStreetView(this.panorama);
        this.panorama.setVisible(true);
        this.onChangePosition(this.get("lat"), this.get("lng"));
        this.addCustomControll(this.panorama);
        this.focusToNearestStreetPositionIfRequired();
      } else {
        container.hide();
        jQuery("#" + this.config.errorEl).hide();
        this.map.setStreetView(null);
        this.map.getStreetView().setVisible(false);
        this.removeCustomControll();
      }
    },
    focusToNearestStreetPositionIfRequired: function() {
      var directionsService, homeLatlng, _parent;
      if (this.panorama.getPosition() !== undefined) {
        return;
      }
      _parent = this;
      homeLatlng = this.map.getCenter();
      directionsService = new google.maps.DirectionsService();
      return directionsService.route({
        origin: homeLatlng,
        destination: homeLatlng,
        travelMode: google.maps.DirectionsTravelMode.DRIVING
      }, function(response, status) {
        var location;
        if (status !== google.maps.DirectionsStatus.OK) {
          return;
        }
        if (response === undefined || response.routes === undefined || response.routes[0] === undefined) {
          return;
        }
        if (response.routes[0] === undefined || response.routes[0].legs[0] === undefined || response.routes[0].legs[0].start_location === undefined) {
          return;
        }
        location = response.routes[0].legs[0].start_location;
        _parent.onChangePosition(location.lat(), location.lng());
      });
    },
    isMasterView: function() {
      return google.maps.MapMode.STREET === this.mode;
    },
    onUpdateScreenSize: function(width, height) {
      if (this.isMasterView()) {
        this.onUpdateSize(width, height);
      }
    },
    onScreenResolutionChanged: function() {
      google.maps.event.trigger(this.panorama, "resize");
    },
    verifyStreetViewAvailable: function(position) {
      var instance;
      instance = this;
      if (!this.isMasterView()) {
        return;
      }
      if (position === undefined) {
        jQuery("#" + instance.config.errorEl).show();
        return;
      }
      this.streetViewService.getPanoramaByLocation(position, 50, function(data, status) {
        if (status === google.maps.StreetViewStatus.OK) {
          jQuery("#" + instance.config.errorEl).hide();
          return;
        }
        jQuery("#" + instance.config.errorEl).show();
      });
    },
    /*
    On change pegman position
    */

    onChangePosition: function(lat, lng) {
      var currentPosition, isSameValue, position;
      currentPosition = this.panorama.getPosition();
      isSameValue = currentPosition !== undefined && currentPosition.lat() === lat && currentPosition.lng() === lng;
      if (!(lat === undefined || lng === undefined || isSameValue)) {
        position = new google.maps.LatLng(lat, lng);
        this.panorama.setPosition(position);
      }
      this.verifyStreetViewAvailable(this.panorama.getPosition());
      this.set("lat", lat);
      this.set("lng", lng);
    },
    onChangePov: function(pov) {
      var currentPov, isSameValue;
      if (pov === undefined || pov.heading === undefined || pov.pitch === undefined) {
        return;
      }
      currentPov = this.panorama.getPov();
      isSameValue = currentPov !== undefined && currentPov.heading === pov.heading && currentPov.pitch === pov.pitch;
      if (isSameValue) {
        return;
      }
      currentPov.heading = parseFloat(pov.heading);
      currentPov.pitch = parseFloat(pov.pitch);
      this.panorama.setPov(currentPov);
      this.set("pov", currentPov);
    },
    onMapCreated: function(map) {
      this.map = map;
      this.initStreet(this.config.el);
    },
    onUpdateSize: function(width, height) {
      if (width === undefined || height === undefined) {
        return;
      }
      jQuery("#" + this.get("el")).width(width).height(height);
      google.maps.event.trigger(this.panorama, "resize");
    },
    onAddPlaces: function(place) {
      if (place.get("renderedOnStreet") === true) {
        return;
      }
      this.addMarker(place, this.panorama);
      place.set("renderedOnStreet", true);
    },
    getNewMarlerReference: function() {
      var refrence;
      refrence = this.panorama.getPosition();
      return google.maps.geometry.spherical.computeOffset(refrence, 10, this.panorama.getPov().heading);
    },
    isNewMarkerReferenceProvider: function() {
      return google.maps.MapMode.STREET === this.mode;
    },
    onUpdatePlace: function(place) {
      this.updateMarker(place);
    },
    onRemovePlace: function(place) {
      this.removeMarker(place);
    },
    getContainer: function() {
      return this.panorama;
    },
    isAllowingClustering: function() {
      return false;
    }
  });

}).call(this);
