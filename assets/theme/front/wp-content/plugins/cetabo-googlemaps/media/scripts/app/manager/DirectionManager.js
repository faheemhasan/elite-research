(function() {
  Cetabo.DirectionManager = Cetabo.BaseManager.extend({
    trackingHandler: [],
    placeReference: [],
    MAX_ALLOWED_DIRECTION_PINS: 30,
    initialize: function(config) {
      this.config = config;
      this.canvas = config.canvas;
      this.channel = this.get("channel");
      Cetabo.EventDistpatcher.use(this.channel).on("map.created", this.onMapCreated, this);
      Cetabo.EventDistpatcher.use(this.channel).on("direction.show", this.calcRoute, this);
      Cetabo.EventDistpatcher.use(this.channel).on("direction.clean", this.cleanRoute, this);
      Cetabo.EventDistpatcher.use(this.channel).on("direction.track", this.trackCurrentLocation, this);
      Cetabo.EventDistpatcher.use(this.channel).on("direction.untrack", this.untrackCurrentLocation, this);
    },
    onMapCreated: function(map) {
      var rendererOptions;
      this.map = map;
      rendererOptions = {
        map: map,
        draggable: false
      };
      this.directionsService = new google.maps.DirectionsService();
      this.directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
    },
    isValidRequest: function(routeArgs) {
      if (routeArgs === undefined || this.routeArgs === routeArgs || routeArgs.request === undefined || routeArgs.request.origin === "") {
        return false;
      }
      this.routeArgs = routeArgs;
      return true;
    },
    calcRoute: function(routeArgs) {
      var channel, instance;
      if (!this.isValidRequest(routeArgs)) {
        return;
      }
      instance = this;
      channel = this.channel;
      this.cleanMarkers();
      this.directionsService.route(routeArgs.request, function(response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
          instance.directionsDisplay.setDirections(response);
          if (routeArgs.showSteps) {
            instance.showSteps(response);
          }
          if (response.routes[0].warnings.length !== 0) {
            Cetabo.EventDistpatcher.use(channel).trigger("direction.message", response.routes[0].warnings);
          }
        } else {
          Cetabo.EventDistpatcher.use(channel).trigger("direction.message", "There was a problem in computing the route.");
        }
      });
    },
    cleanRoute: function() {
      this.directionsDisplay.setDirections(response);
      this.showSteps([]);
    },
    cleanMarkers: function() {
      var channel, i, place;
      channel = this.channel;
      i = 0;
      while (i < this.placeReference.length) {
        place = this.placeReference[i];
        Cetabo.EventDistpatcher.use(channel).trigger("place.remove", place);
        i++;
      }
      this.markerArray = [];
    },
    showSteps: function(directionResult) {
      var MAX_ALLOWED_DIRECTION_PINS, channel, i, ident, myRoute, place, position, step, total;
      myRoute = directionResult.routes[0].legs[0];
      channel = this.channel;
      total = myRoute.steps.length;
      MAX_ALLOWED_DIRECTION_PINS = this.MAX_ALLOWED_DIRECTION_PINS;
      step = Math.floor((total < MAX_ALLOWED_DIRECTION_PINS ? 1 : total / MAX_ALLOWED_DIRECTION_PINS));
      i = 0;
      while (i < myRoute.steps.length) {
        if (i % step !== 0) {
          continue;
        }
        position = myRoute.steps[i].start_point;
        ident = "_dir" + Math.floor(Math.random() * 100000);
        place = new Cetabo.PlaceModel({
          id: ident,
          name: "",
          channel: channel,
          icon: this.config.baseURL + "media/images/cetabo_icons/pin_default_purple.png",
          lat: position.lat(),
          lng: position.lng(),
          details: myRoute.steps[i].instructions,
          locked: true,
          transient: true
        });
        Cetabo.EventDistpatcher.use(channel).trigger("place.add", place);
        Cetabo.EventDistpatcher.use(channel).trigger("place.update", place);
        this.placeReference.push(place);
        i++;
      }
    },
    isGeolocationSupportAvailable: function() {
      return navigator.geolocation;
    },
    trackCurrentLocation: function(interval) {
      if (!this.isGeolocationSupportAvailable()) {
        this.handleNoGeolocation();
        return;
      }
      this.refreshCurrentGeolocation(interval);
    },
    untrackCurrentLocation: function() {
      var i;
      i = 0;
      while (i < this.trackingHandler.length) {
        clearInterval(this.trackingHandler[i]);
        i++;
      }
      this.trackingHandler = [];
      if (this.currentLocationMarker !== undefined) {
        this.currentLocationMarker.setMap(null);
        this.currentLocationMarker = undefined;
      }
      if (this.currentLocationAccuracy !== undefined) {
        this.currentLocationAccuracy.setMap(null);
        this.currentLocationAccuracy = undefined;
      }
    },
    refreshCurrentGeolocation: function(interval) {
      var handler, instance;
      instance = this;
      handler = setInterval(function() {
        navigator.geolocation.getCurrentPosition((function(position) {
          instance.currentLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
          instance.coords = position.coords;
          instance.updateCurrentLocationMarker();
        }), function() {
          instance.handleNoGeolocation();
          instance.untrackCurrentLocation();
        });
      }, interval);
      this.trackingHandler.push(handler);
    },
    updateCurrentLocationMarker: function() {
      if (this.currentLocationMarker === undefined) {
        this.currentLocationAccuracy = new google.maps.Circle({
          strokeColor: "#5278F2",
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: "#52CCF2",
          fillOpacity: 0.35,
          map: this.map,
          center: this.currentLocation,
          radius: this.coords.accuracy
        });
        this.currentLocationMarker = new google.maps.Marker({
          position: this.currentLocation,
          map: this.map,
          icon: this.config.baseURL + "media/images/current_location.png"
        });
      } else {
        this.currentLocationMarker.setPosition(this.currentLocation);
        this.currentLocationAccuracy.setCenter(this.currentLocation);
        this.currentLocationAccuracy.setRadius(this.coords.accuracy);
      }
    },
    handleNoGeolocation: function() {
      var channel;
      channel = this.channel;
      Cetabo.EventDistpatcher.use(channel).trigger("direction.message", "Your browser doesn't support geolocation.");
    }
  });

}).call(this);
