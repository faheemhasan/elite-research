(function() {
  Cetabo.HyperlapseManager = Cetabo.MarkerManager.extend({
    initialize: function(config) {
      var channel;
      Cetabo.StreetManager.__super__.initialize.apply(this, arguments);
      this.config = config;
      channel = this.get("channel");
      Cetabo.EventDistpatcher.use(channel).on("map.updatemode", this.onChangeMode, this);
      Cetabo.EventDistpatcher.use(channel).on("map.created", this.onMapCreated, this);
      Cetabo.EventDistpatcher.use(channel).on("map.load", this.onLoadMap, this);
      Cetabo.EventDistpatcher.use(channel).on("hyperlase.start", this.onStartAnimation, this);
    },
    onLoadMap: function(model) {
      var endPlace, instance, lookAt, route, startPlace;
      startPlace = model.getPlaceByAttribute("name", "Start point");
      endPlace = model.getPlaceByAttribute("name", "End point");
      lookAt = model.getPlaceByAttribute("name", "Look at");
      instance = this;
      this.directionsService = new google.maps.DirectionsService();
      route = {
        request: {
          origin: startPlace.toGoogleMapsPoint(),
          destination: endPlace.toGoogleMapsPoint(),
          travelMode: google.maps.DirectionsTravelMode.DRIVING
        }
      };
      this.directionsService.route(route.request, function(response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
          instance.hyperlapse.generate({
            route: response
          });
        } else {
          console.log(status);
        }
      });
    },
    /*
      Start animation
    */

    onStartAnimation: function() {
      return this.hyperlapse.play();
    },
    onMapCreated: function(map) {
      this.map = map;
      this.initHyperlase(this.config.el);
    },
    initHyperlase: function(canvas) {
      var channel, instance;
      channel = this.get("channel");
      instance = this;
      this.hyperlapse = new Hyperlapse(document.getElementById(canvas), {
        lookat: new google.maps.LatLng(37.81409525128964, -122.4775045005249),
        zoom: 1,
        use_lookat: true,
        elevation: 50
      });
      this.hyperlapse.onError = function(e) {
        console.log(e);
        instance.set("hasError", true);
      };
      this.hyperlapse.onRouteComplete = function(e) {
        instance.hyperlapse.load();
        instance.set("hasRoute", true);
      };
      this.hyperlapse.onLoadComplete = function(e) {
        instance.hyperlapse.play();
        return instance.set("hasLoaded", true);
      };
    },
    onChangeMode: function(mode) {
      var container;
      this.mode = mode;
      container = jQuery("#" + this.config.el);
      if (google.maps.MapMode.HYPERLAPSE === mode) {
        container.show();
      } else {
        container.hide();
      }
    },
    isMasterView: function() {
      return google.maps.MapMode.HYPERLAPSE === this.mode;
    }
  });

}).call(this);
