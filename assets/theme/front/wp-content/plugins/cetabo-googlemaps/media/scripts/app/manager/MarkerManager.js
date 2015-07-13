/*
Provide logic for place management
*/


(function() {
  Cetabo.MarkerManager = Cetabo.BaseManager.extend({
    initialize: function(config) {
      var channel;
      channel = this.get("channel");
      this.set("state", {
        markers: {},
        infoViews: {}
      });
      this.set("clustering", false);
      Cetabo.EventDistpatcher.use(channel).on("overlay.updated", this.onOverlayStateUpdated, this);
      Cetabo.EventDistpatcher.use(channel).on("place.cluster", this.onClusteringStateUpdated, this);
      Cetabo.EventDistpatcher.use(channel).on("place.add", this.onPlaceStateUpdated, this);
      Cetabo.EventDistpatcher.use(channel).on("place.remove", this.onPlaceStateUpdated, this);
      Cetabo.EventDistpatcher.use(channel).on("place.update", this.onPlaceStateUpdated, this);
      Cetabo.EventDistpatcher.use(channel).on("place.filter", this.onPlaceFilter, this);
      Cetabo.EventDistpatcher.use(channel).on("place.focus", this.onPlaceFocus, this);
      this.set("defaultoverlay", true);
      this.set("overlaymultiple", true);
    },
    /*
    Add new place on map
    */

    addMarker: function(place, container) {
      this.placeNewMarkerOnContainer(place);
      this.attachToContainer(place, container);
      this.bindEvents(place, container);
    },
    /*
      Add new place marker on map/ street canvas
    */

    placeNewMarkerOnContainer: function(place) {
      var reference;
      if ((place.get("lat") === undefined || place.get("lng") === undefined) && this.isNewMarkerReferenceProvider()) {
        reference = this.getNewMarlerReference();
        place.set("lat", reference.lat());
        place.set("lng", reference.lng());
      }
    },
    getNewMarlerReference: function() {},
    isNewMarkerReferenceProvider: function() {},
    getContainer: function() {},
    isAllowingClustering: function() {
      return true;
    },
    /*
    Create map marker and info view
    */

    attachToContainer: function(place, container) {
      var locked, marker, _parent;
      locked = place.get("locked") === true;
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(place.get("lat"), place.get("lng")),
        map: container,
        draggable: !this.get("readonly") && !locked,
        title: place.get("name"),
        _refplace: place
      });
      _parent = this;
      google.maps.event.addListener(marker, "click", function() {
        var content, viewGroup;
        viewGroup = _parent.getPlaceInfoViewGroup(place, container);
        if ((_parent.infoViewToOpen != null) && !_parent.get("overlaymultiple")) {
          _parent.infoViewToOpen.close();
        }
        _parent.infoViewToOpen = _parent.selectInfoView(viewGroup);
        content = place.get("details");
        if (!content || 0 === content.length || /^\s*$/.test(content)) {
          return;
        }
        _parent.infoViewToOpen.open(container, marker);
      });
      this.get("state").markers[place.get("id")] = marker;
      return marker;
    },
    selectInfoView: function(infoViewGroup) {
      var customInfoView, defaultInfoView, view;
      defaultInfoView = infoViewGroup.google;
      customInfoView = infoViewGroup.custom;
      view = (this.get("defaultoverlay") === true ? defaultInfoView : customInfoView);
      return view;
    },
    /*
    Get marker associated info view
    */

    getPlaceInfoViewGroup: function(place) {
      var customInfoView, googleInfoView, infoViewContainer;
      infoViewContainer = this.get("state").infoViews[place.get("id")];
      if (infoViewContainer === undefined) {
        googleInfoView = new google.maps.InfoWindow({
          content: place.get("details")
        });
        customInfoView = new InfoBox({
          map: this.getContainer(),
          content: "<div class='ccontent'>" + place.get("details") + "</div>",
          disableAutoPan: false,
          pixelOffset: new google.maps.Size(-250, 0),
          boxClass: "cinfobox",
          boxStyle: {
            opacity: 0.90,
            width: "500px"
          },
          closeBoxMargin: "0",
          closeBoxURL: this.config.baseURL + "media/images/close_icon.png",
          infoBoxClearance: new google.maps.Size(1, 1)
        });
        infoViewContainer = {
          google: googleInfoView,
          custom: customInfoView
        };
        this.get("state").infoViews[place.get("id")] = infoViewContainer;
      }
      return infoViewContainer;
    },
    /*
    On change the overlay type
    @param model
    */

    onOverlayStateUpdated: function(model) {
      this.set("defaultoverlay", model.get("overlayenable") === undefined || model.get("overlayenable") === false);
      this.set("overlaymultiple", model.get("overlaymultiple"));
    },
    /*
    On filter places
    */

    onPlaceFilter: function(criteria) {
      var key, marker, place, visible;
      for (key in this.get("state").markers) {
        marker = this.get("state").markers[key];
        place = marker._refplace;
        visible = place.isPassingCriteriaCheck(criteria);
        marker.setVisible(visible);
      }
      if (this.get("clustering")) {
        this.resetClustering();
      }
    },
    resetClustering: function() {
      var map;
      if (this.markerClusterer == null) {
        return;
      }
      this.markerClusterer.repaint();
      map = this.getContainer();
      google.maps.event.trigger(map, 'resize');
      map.setZoom(map.getZoom() - 1);
      map.setZoom(map.getZoom() + 1);
    },
    onPlaceFocus: function(place) {
      var animation, channel, lat, lng, marker;
      channel = this.get("channel");
      lat = place.get("lat");
      lng = place.get("lng");
      Cetabo.EventDistpatcher.use(channel).trigger("map.updatecenter", lat, lng);
      Cetabo.EventDistpatcher.use(channel).trigger("map.updatezoom", 10);
      marker = this.getMarkerByPlace(place);
      if (marker !== null) {
        animation = marker.getAnimation;
        marker.setAnimation(google.maps.Animation.BOUNCE);
        setTimeout((function() {
          marker.setAnimation(animation);
        }), 2000);
      }
    },
    getMarkerByPlace: function(place) {
      var key, marker, _place;
      for (key in this.get("state").markers) {
        marker = this.get("state").markers[key];
        _place = marker._refplace;
        if (place.id === _place.id) {
          return marker;
        }
      }
      return null;
    },
    /*
    On change the clustering state
    @param model
    */

    onClusteringStateUpdated: function(isClusteringEnabled) {
      if (!this.isAllowingClustering()) {
        return;
      }
      if (isClusteringEnabled) {
        this.enableClustering();
      } else {
        this.disableClustering();
      }
    },
    enableClustering: function() {
      var markers;
      this.set("clustering", true);
      markers = this.getVisibleMarkers();
      if (markers == null) {
        return;
      }
      if (this.markerClusterer === undefined) {
        this.markerClusterer = new MarkerClusterer(this.getContainer(), markers, {
          ignoreHidden: true
        });
      } else {
        this.markerClusterer.clearMarkers();
        this.markerClusterer.addMarkers(markers);
        this.markerClusterer.repaint();
      }
    },
    disableClustering: function() {
      var markers;
      this.set("clustering", false);
      if (this.markerClusterer === undefined) {
        return;
      }
      this.markerClusterer.clearMarkers();
      this.markerClusterer.repaint();
      markers = this.getVisibleMarkers();
      this.reatachToContainer(markers, this.getContainer());
    },
    reatachToContainer: function(markers, container) {
      var key, _results;
      _results = [];
      for (key in markers) {
        _results.push(markers[key].setMap(container));
      }
      return _results;
    },
    onPlaceStateUpdated: function(place) {
      var i, markers;
      markers = this.getVisibleMarkers();
      if ((this.markerClusterer == null) || (markers == null)) {
        return;
      }
      i = 0;
      while (i < markers.length) {
        this.markerClusterer.addMarker(markers[i]);
        i++;
      }
    },
    getVisibleMarkers: function() {
      var i, key, marker, markers, place;
      markers = [];
      if (this.get("state") != null) {
        i = 0;
        for (key in this.get("state").markers) {
          marker = this.get("state").markers[key];
          place = marker._refplace;
          if (place.get("type") !== "hyperlapse") {
            markers[key] = marker;
          }
        }
      }
      return markers;
    },
    /*
    Rebind clustering
    */

    refreshClustering: function() {},
    /*
    Add events on marker
    */

    bindEvents: function(place) {
      var channel, marker;
      marker = this.get("state").markers[place.get("id")];
      channel = this.get("channel");
      google.maps.event.addListener(marker, "dragend", function() {
        var point;
        point = marker.getPosition();
        place.set("lat", point.lat());
        place.set("lng", point.lng());
        Cetabo.EventDistpatcher.use(channel).trigger("place.update", place);
      });
      google.maps.event.addListener(marker, "mousedown", function() {
        Cetabo.EventDistpatcher.use(channel).trigger("place.select", place);
      });
    },
    /*
    Update marker
    */

    updateMarker: function(place) {
      var id, placeMarker, viewGroup;
      id = place.get("id");
      placeMarker = this.get("state").markers[id];
      if (placeMarker === undefined) {
        return;
      }
      placeMarker.setTitle(place.get("name"));
      placeMarker.setIcon(place.get("icon"));
      placeMarker.setAnimation(place.get("animation"));
      placeMarker.setPosition(new google.maps.LatLng(place.get("lat"), place.get("lng")));
      viewGroup = this.getPlaceInfoViewGroup(place);
      viewGroup.google.setContent(place.get("details"));
      viewGroup.custom.setContent("<div class='ccontent'>" + place.get("details") + "</div>");
    },
    /*
    Remove marker
    */

    removeMarker: function(place) {
      var id, marker;
      id = place.get("id");
      marker = this.get("state").markers[id];
      if (marker !== undefined) {
        marker.setMap(null);
      }
    },
    addCustomControll: function(container) {},
    removeCustomControll: function() {
      var customControll;
      customControll = this.get("customcontroll");
      if (customControll !== undefined && customControll !== null) {
        jQuery(customControll).hide();
      }
    }
  });

}).call(this);
