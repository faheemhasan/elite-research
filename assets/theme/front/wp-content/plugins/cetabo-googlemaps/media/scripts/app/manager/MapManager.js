/*
Provide all opperations required to manipute the map
@type @exp;BaseManager@call;extend
*/


(function() {
  Cetabo.MapManager = Cetabo.MarkerManager.extend({
    initialize: function(config) {
      var channel;
      Cetabo.MapManager.__super__.initialize.apply(this, arguments);
      this.config = config;
      this.initMap();
      channel = this.get("channel");
      Cetabo.EventDistpatcher.use(channel).on("map.updatecenter", this.onChangeMapPosition, this);
      Cetabo.EventDistpatcher.use(channel).on("map.updatezoom", this.onChangeMapZoom, this);
      Cetabo.EventDistpatcher.use(channel).on("map.updatezoomrange", this.onChangeMapZoomRange, this);
      Cetabo.EventDistpatcher.use(channel).on("map.updatetype", this.onChangeMapType, this);
      Cetabo.EventDistpatcher.use(channel).on("map.updatesize", this.onUpdateSize, this);
      Cetabo.EventDistpatcher.use(channel).on("map.updatemode", this.onChangeMode, this);
      Cetabo.EventDistpatcher.use(channel).on("map.updatedragging", this.onChangeMapDragging, this);
      Cetabo.EventDistpatcher.use(channel).on("map.updatedoubleclickzoom", this.onChangeMapDoubleClickZoom, this);
      Cetabo.EventDistpatcher.use(channel).on("map.updatescrollwellzoom", this.onChangeMapScrollWellZoom, this);
      Cetabo.EventDistpatcher.use(channel).on("map.updatezoomcontrol", this.onUpdateZoomControl, this);
      Cetabo.EventDistpatcher.use(channel).on("map.updatezoomcontrolposition", this.onUpdateZoomControlPosition, this);
      Cetabo.EventDistpatcher.use(channel).on("map.updatestreetviewcontrol", this.onUpdateStreetViewControl, this);
      Cetabo.EventDistpatcher.use(channel).on("map.updatestreetviewcontrolposition", this.onUpdateStreetViewControlPosition, this);
      Cetabo.EventDistpatcher.use(channel).on("map.updatepancontrol", this.onUpdatePanControl, this);
      Cetabo.EventDistpatcher.use(channel).on("map.updatepancontrolposition", this.onUpdatePanControlPosition, this);
      Cetabo.EventDistpatcher.use(channel).on("map.updatemaptypecontrol", this.onUpdateMapTypeControl, this);
      Cetabo.EventDistpatcher.use(channel).on("map.updatemaptypecontrolposition", this.onUpdateMapTypeControlPosition, this);
      Cetabo.EventDistpatcher.use(channel).on("map.updatescalecontrol", this.onUpdateScaleControl, this);
      Cetabo.EventDistpatcher.use(channel).on("place.add", this.onAddPlaces, this);
      Cetabo.EventDistpatcher.use(channel).on("place.remove", this.onRemovePlace, this);
      Cetabo.EventDistpatcher.use(channel).on("place.update", this.onUpdatePlace, this);
      Cetabo.EventDistpatcher.use(channel).on("styler.update", this.onUpdateStyle, this);
      Cetabo.EventDistpatcher.use(channel).on("screen.updatesize", this.onUpdateScreenSize, this);
      Cetabo.EventDistpatcher.use(channel).on("screen.resized", this.onScreenResolutionChanged, this);
    },
    /*
    Prepare map
    */

    initMap: function(options) {
      var channel, mapCanvas, mapOptions, _parent;
      google.maps.visualRefresh = true;
      mapCanvas = this.config.el;
      channel = this.get("channel");
      _parent = this;
      mapOptions = jQuery.extend({
        zoom: 3,
        center: new google.maps.LatLng(39.5312, -102.6502),
        panControlOptions: {
          position: google.maps.ControlPosition.TOP_RIGHT
        },
        zoomControlOptions: {
          style: google.maps.ZoomControlStyle.SMALL,
          position: google.maps.ControlPosition.TOP_RIGHT
        },
        scaleControlOptions: {
          position: google.maps.ControlPosition.TOP_RIGHT
        },
        streetViewControlOptions: {
          position: google.maps.ControlPosition.TOP_RIGHT
        }
      }, options);
      this.map = new google.maps.Map(document.getElementById(mapCanvas), mapOptions);
      Cetabo.EventDistpatcher.use(channel).trigger("map.updatecenter", this.map.getCenter().lat(), this.map.getCenter().lng());
      google.maps.event.addListener(this.map, "dragend", function() {
        Cetabo.EventDistpatcher.use(channel).trigger("map.updatecenter", this.getCenter().lat(), this.getCenter().lng());
      });
      google.maps.event.addListener(this.map, "zoom_changed", function() {
        var normalizedZoom, zoom;
        zoom = this.getZoom();
        normalizedZoom = parseInt(_parent.normalizeZoom(zoom));
        if ((normalizedZoom != null) && normalizedZoom !== zoom) {
          this.setZoom(normalizedZoom);
          return;
        }
        Cetabo.EventDistpatcher.use(channel).trigger("map.updatezoom", this.getZoom());
      });
      Cetabo.EventDistpatcher.use(channel).trigger("map.created", this.map);
    },
    normalizeZoom: function(zoomLevel) {
      var max, min;
      if (this.zoomRange == null) {
        return zoomLevel;
      }
      min = this.zoomRange.min;
      max = this.zoomRange.max;
      if (zoomLevel < max && zoomLevel > min) {
        return zoomLevel;
      }
      if (Math.abs(max - zoomLevel) < Math.abs(min - zoomLevel)) {
        return max;
      } else {
        return min;
      }
    },
    onChangeMapPosition: function(lat, lng) {
      var center;
      if (lat === undefined || lng === undefined) {
        return;
      }
      center = new google.maps.LatLng(lat, lng);
      this.map.panTo(center);
      this.map.setCenter(center);
    },
    onChangeMapType: function(type) {
      this.map.setMapTypeId(type);
    },
    onChangeMode: function(mode) {
      var instance, maxHeight, maxWidth;
      this.mode = mode;
      switch (mode) {
        case google.maps.MapMode.STREET:
        case google.maps.MapMode.HYPERLAPSE:
          instance = this;
          maxHeight = jQuery("#" + this.config.el).height();
          maxWidth = jQuery("#" + this.config.el).width();
          this.set("oldWidth", jQuery("#" + this.get("el")).width());
          this.set("oldHeight", jQuery("#" + this.get("el")).height());
          this.onUpdateSize(300, 300);
          jQuery("#" + this.config.el).addClass("street-mode");
          jQuery("#" + this.config.el).resizable({
            animate: false,
            maxHeight: maxHeight,
            maxWidth: maxWidth,
            handles: 'n, e, s, w, se',
            resize: function(event, ui) {
              instance.onUpdateSize(ui.size.width, ui.size.height);
            }
          });
          this.removeCustomControll();
          break;
        case google.maps.MapMode.MAP:
          this.set("width", this.get("oldWidth"));
          this.set("height", this.get("oldHeight"));
          if (jQuery("#" + this.config.el).hasClass("street-mode")) {
            jQuery("#" + this.config.el).resizable("destroy");
          }
          jQuery("#" + this.config.el).removeClass("street-mode");
          jQuery("#" + this.config.el).css({
            position: "relative"
          });
          this.onUpdateSize(this.get("width"), this.get("height"));
          this.addCustomControll(this.map);
      }
    },
    isMasterView: function() {
      return google.maps.MapMode.MAP === this.mode;
    },
    onUpdateScreenSize: function(width, height) {
      if (this.isMasterView()) {
        this.onUpdateSize(width, height);
      }
    },
    onScreenResolutionChanged: function() {
      var center;
      center = this.map.getCenter();
      google.maps.event.trigger(this.map, "resize");
      this.map.panTo(center);
    },
    onChangeMapZoomRange: function(zoomRange) {
      this.zoomRange = zoomRange;
    },
    onChangeMapZoom: function(zoomLevel) {
      if (zoomLevel === this.map.getZoom() || (isNaN(zoomLevel)) || zoomLevel === undefined) {
        return;
      }
      this.map.setZoom(zoomLevel);
    },
    onUpdateStyle: function(stylers) {
      if (stylers === undefined) {
        return;
      }
      this.map.setOptions({
        styles: stylers
      });
    },
    onUpdateSize: function(width, height) {
      var center;
      if (width === undefined || height === undefined) {
        return;
      }
      jQuery("#" + this.get("el")).width(width).height(height);
      this.set("width", width);
      this.set("height", height);
      center = this.map.getCenter();
      google.maps.event.trigger(this.map, "resize");
      this.map.panTo(center);
      this.map.setCenter(center);
    },
    onAddPlaces: function(place) {
      if (place.get("renderedOnMap") === true) {
        return;
      }
      this.addMarker(place, this.map);
      place.set("renderedOnMap", true);
    },
    getNewMarlerReference: function() {
      return this.map.getCenter();
    },
    isNewMarkerReferenceProvider: function() {
      return google.maps.MapMode.STREET !== this.mode;
    },
    onUpdatePlace: function(place) {
      this.updateMarker(place);
    },
    onRemovePlace: function(place) {
      this.removeMarker(place);
    },
    getContainer: function() {
      return this.map;
    },
    onChangeMapDragging: function(dragging) {
      this.map.setOptions({
        draggable: dragging
      });
    },
    onChangeMapDoubleClickZoom: function(clickZoom) {
      this.map.setOptions({
        disableDoubleClickZoom: !clickZoom
      });
    },
    onChangeMapScrollWellZoom: function(wellZoom) {
      this.map.setOptions({
        scrollwheel: wellZoom
      });
    },
    onUpdateZoomControl: function(enabled) {
      this.map.setOptions({
        zoomControl: enabled
      });
    },
    onUpdateZoomControlPosition: function(position) {
      this.map.setOptions({
        zoomControlOptions: {
          style: google.maps.ZoomControlStyle.SMALL,
          position: position
        }
      });
    },
    onUpdateStreetViewControl: function(enabled) {
      this.map.setOptions({
        streetViewControl: enabled
      });
    },
    onUpdateStreetViewControlPosition: function(position) {
      this.map.setOptions({
        streetViewControlOptions: {
          style: google.maps.ZoomControlStyle.SMALL,
          position: position
        }
      });
    },
    onUpdatePanControl: function(enabled) {
      this.map.setOptions({
        panControl: enabled
      });
    },
    onUpdatePanControlPosition: function(position) {
      this.map.setOptions({
        panControlOptions: {
          style: google.maps.ZoomControlStyle.SMALL,
          position: position
        }
      });
    },
    onUpdateMapTypeControl: function(enabled) {
      this.map.setOptions({
        mapTypeControl: enabled
      });
    },
    onUpdateMapTypeControlPosition: function(position) {
      this.map.setOptions({
        mapTypeControlOptions: {
          style: google.maps.ZoomControlStyle.SMALL,
          position: position
        }
      });
    },
    onUpdateScaleControl: function(enabled) {
      this.map.setOptions({
        scaleControl: enabled
      });
    }
  });

}).call(this);
