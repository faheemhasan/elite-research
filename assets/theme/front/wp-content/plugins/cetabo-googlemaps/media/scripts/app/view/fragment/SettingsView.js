(function() {
  Cetabo.SettingsView = Cetabo.BaseView.extend({
    events: {},
    initialize: function(config) {
      this.model = config.model;
      this.channel = config.channel;
      this.componentFactory = new Cetabo.ComponentFactory();
      this.initUIModel();
      Cetabo.EventDistpatcher.use(this.channel).on("street.updateposition", this.onChangePagmanPosition, this);
      Cetabo.EventDistpatcher.use(this.channel).on("street.updatepov", this.onChangePagmanPov, this);
      Cetabo.EventDistpatcher.use(this.channel).on("map.updatecenter", this.onChangeMapPosition, this);
      Cetabo.EventDistpatcher.use(this.channel).on("map.updatezoom", this.onChangeMapZoom, this);
      Cetabo.EventDistpatcher.use(this.channel).on("map.load", this.onLoadMap, this);
      Cetabo.EventDistpatcher.use(this.channel).on("map.updatemode", this.onChangeMode, this);
    },
    /* Initalization of view components
    */

    initUIModel: function() {
      var zoomrange, _parent;
      _parent = this;
      this.componentFactory.create('spinner', 'lng', {
        el: this.findIdent(".lng"),
        step: 0.0001,
        value: this.model.get("lng"),
        numberFormat: "n",
        onChange: function(value) {
          _parent.model.set("lng", value);
          _parent.changedMapCenter();
        }
      });
      this.componentFactory.create('spinner', 'lat', {
        el: this.findIdent(".lat"),
        step: 0.0001,
        value: this.model.get("lat"),
        numberFormat: "n",
        onChange: function(value) {
          _parent.model.set("lat", value);
          _parent.changedMapCenter();
        }
      });
      this.componentFactory.create('slider', 'zoom', {
        el: this.findIdent(".zoom"),
        range: "max",
        min: 0,
        max: 21,
        value: this.model.get("zoom"),
        onChange: function(value) {
          _parent.model.set("zoom", value);
          _parent.changeMapZoom();
        }
      });
      zoomrange = this.model.get("zoomrange");
      this.componentFactory.create('rangeslider', 'zoomrange', {
        el: this.findIdent(".zoomrange"),
        range: true,
        values: [zoomrange.min, zoomrange.max],
        min: 0,
        max: 21,
        onChange: function(value) {
          

          _parent.model.set("zoomrange", value);
          _parent.changeMapZoomRange();
          

        }
      });
      this.componentFactory.create('input', 'width', {
        el: this.findIdent(".width"),
        value: this.model.get("width"),
        onChange: function(value) {
          _parent.model.set("width", value);
          _parent.changeMapWidth();
        }
      });
      this.componentFactory.create('input', 'height', {
        el: this.findIdent(".height"),
        value: this.model.get("height"),
        onChange: function(value) {
          _parent.model.set("height", value);
          _parent.changeMapHeight();
        }
      });
      this.componentFactory.create('select', 'type', {
        el: this.findIdent(".maptype"),
        provider: new Cetabo.MapTypeProviderModel(),
        value: this.model.get("type"),
        onChange: function(value) {
          _parent.model.set("type", value);
          _parent.changeMapType();
        }
      });
      this.componentFactory.create('select', 'mode', {
        el: this.findIdent(".mapmode"),
        provider: new Cetabo.MapModeProvierModel(),
        value: this.model.get("mode"),
        onChange: function(value) {
          

          _parent.model.set("mode", value);
          _parent.changeMapMode();
          

        }
      });
      this.componentFactory.create('spinner', 'heading', {
        el: this.findIdent(".heading"),
        step: 0.0001,
        numberFormat: "n",
        min: -180,
        max: 180,
        onChange: function(value) {
          

          _parent.model.set("heading", value);
          _parent.changePagmantPov();
          

        }
      });
      this.componentFactory.create('spinner', 'pitch', {
        el: this.findIdent(".pitch"),
        step: 0.0001,
        numberFormat: "n",
        min: -90,
        max: 90,
        onChange: function(value) {
          

          _parent.model.set("pitch", value);
          _parent.changePagmantPov();
          

        }
      });
      this.componentFactory.create('spinner', 'plng', {
        el: this.findIdent(".plng"),
        step: 0.0001,
        numberFormat: "n",
        onChange: function(value) {
          

          _parent.model.set("plng", value);
          _parent.changePagmanPosition();
          

        }
      });
      this.componentFactory.create('spinner', 'plat', {
        el: this.findIdent(".plat"),
        step: 0.0001,
        numberFormat: "n",
        onChange: function(value) {
          

          _parent.model.set("plat", value);
          _parent.changePagmanPosition();
          

        }
      });
      this.componentFactory.create('checkbox', 'overlayenable', {
        el: this.findIdent(".enable-custom-overlay"),
        onChange: function(value) {
          

          _parent.model.set("overlayenable", value);
          _parent.updateOverlay();
          

        }
      });
      this.componentFactory.create('checkbox', 'clustering', {
        el: this.findIdent(".clustering"),
        onChange: function(value) {
          

          _parent.model.set("clustering", value);
          _parent.updateClustering();
          

        }
      });
      this.componentFactory.create('checkbox', 'dragging', {
        el: this.findIdent(".dragging"),
        onChange: function(value) {
          

          _parent.model.set("dragging", value);
          _parent.updateDragging();
          

        }
      });
      this.componentFactory.create('checkbox', 'doubleclickzoom', {
        el: this.findIdent(".doubleclickzoom"),
        onChange: function(value) {
          

          _parent.model.set("doubleclickzoom", value);
          _parent.updateDoubleClickZoom();
          

        }
      });
      this.componentFactory.create('checkbox', 'scrollwellzoom', {
        el: this.findIdent(".scrollwellzoom"),
        onChange: function(value) {
          

          _parent.model.set("scrollwellzoom", value);
          _parent.updateScrollWellZoom();
          

        }
      });
      this.componentFactory.create('checkbox', 'zoomcontrol', {
        el: this.findIdent(".zoomcontrol-enabled"),
        onChange: function(value) {
          _parent.model.set("zoomcontrol", value);
          _parent.updateZoomControl();
        }
      });
      this.componentFactory.create('select', 'zoomcontrolposition', {
        el: this.findIdent(".zoomcontrol-position"),
        provider: new Cetabo.MapControlPostionProviderModel(),
        value: this.model.get("zoomcontrolposition"),
        onChange: function(value) {
          

          _parent.model.set("zoomcontrolposition", value);
          _parent.updateZoomControlPosition();
          

        }
      });
      this.componentFactory.create('checkbox', 'streetviewcontrol', {
        el: this.findIdent(".streetviewcontrol-enabled"),
        onChange: function(value) {
          _parent.model.set("streetviewcontrol", value);
          _parent.updateStreetViewControl();
        }
      });
      this.componentFactory.create('select', 'streetviewcontrolposition', {
        el: this.findIdent(".streetviewcontrol-position"),
        provider: new Cetabo.MapControlPostionProviderModel(),
        value: this.model.get("streetviewcontrolposition"),
        onChange: function(value) {
          

          _parent.model.set("streetviewcontrolposition", value);
          _parent.updateStreetViewControlPosition();
          

        }
      });
      this.componentFactory.create('checkbox', 'pancontrol', {
        el: this.findIdent(".pancontrol-enabled"),
        onChange: function(value) {
          _parent.model.set("pancontrol", value);
          _parent.updatePanControl();
        }
      });
      this.componentFactory.create('select', 'pancontrolposition', {
        el: this.findIdent(".pancontrol-position"),
        provider: new Cetabo.MapControlPostionProviderModel(),
        value: this.model.get("pancontrolposition"),
        onChange: function(value) {
          

          _parent.model.set("pancontrolposition", value);
          _parent.updatePanControlPosition();
          

        }
      });
      this.componentFactory.create('checkbox', 'maptypecontrol', {
        el: this.findIdent(".maptypecontrol-enabled"),
        onChange: function(value) {
          

          _parent.model.set("maptypecontrol", value);
          _parent.updateMapTypeControl();
          

        }
      });
      this.componentFactory.create('select', 'maptypecontrolposition', {
        el: this.findIdent(".maptypecontrol-position"),
        provider: new Cetabo.MapControlPostionProviderModel(),
        value: this.model.get("maptypecontrolposition"),
        onChange: function(value) {
          

          _parent.model.set("maptypecontrolposition", value);
          _parent.updateMapTypeControlPosition();
          

        }
      });
      this.componentFactory.create('checkbox', 'scalecontrol', {
        el: this.findIdent(".scalecontrol-enabled"),
        onChange: function(value) {
          

          _parent.model.set("scalecontrol", value);
          _parent.updateScaleControl();
          

        }
      });
      this.componentFactory.create('checkbox', 'overlaymultiple', {
        el: this.findIdent(".overlaymultiple"),
        onChange: function(value) {
          

          _parent.model.set("overlaymultiple", value);
          _parent.updateOveralyMultiple();
          

        }
      });
      this.componentFactory.create('checkbox', 'enabledirection', {
        el: this.findIdent(".enable-direction"),
        onChange: function(value) {
          

          _parent.model.set("enabledirection", value);
          _parent.updateDirection();
          

        }
      });
      this.componentFactory.create('checkbox', 'showsteps', {
        el: this.findIdent(".show-direction-steps"),
        onChange: function(value) {
          

          _parent.model.set("showsteps", value);
          _parent.updateDirection();
          

        }
      });
      this.componentFactory.create('checkbox', 'enabletags', {
        el: this.findIdent(".enable-tags"),
        onChange: function(value) {
          _parent.model.set("enabletags", value);
          _parent.updateTags();
        }
      });
      this.componentFactory.create('checkbox', 'enableplaces', {
        el: this.findIdent(".enable-places"),
        onChange: function(value) {
          

          _parent.model.set("enableplaces", value);
          _parent.updatePlaces();
          

        }
      });
      this.componentFactory.create('checkbox', 'enablefullscreen', {
        el: this.findIdent(".enable-fullscreen"),
        onChange: function(value) {
          

          _parent.model.set("enablefullscreen", value);
          _parent.updateFullscreenMode();
          

        }
      });
      this.componentFactory.create('checkbox', 'startfullscreen', {
        el: this.findIdent(".start-fullscreen"),
        onChange: function(value) {
          

          _parent.model.set("startfullscreen", value);
          

        }
      });
      this.componentFactory.create('checkbox', 'enableaddressearch', {
        el: this.findIdent(".enable-addres-search"),
        onChange: function(value) {
          

          _parent.model.set("enableaddressearch", value);
          _parent.updateSearch();
          

        }
      });
      this.componentFactory.create('select', 'defaultsidebartab', {
        el: this.findIdent(".default-sidebar-tab"),
        provider: new Cetabo.SidebarTypeProviderModel(),
        value: this.model.get("defaultsidebartab"),
        onChange: function(value) {
          

          _parent.model.set("defaultsidebartab", value);
          

        }
      });
    },
    /*  UI triggered events
    */

    changedMapCenter: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("map.updatecenter", this.model.get('lat'), this.model.get('lng'));
    },
    updateFullscreenMode: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("view.updatefullscreen", this.model.get('enablefullscreen'));
    },
    updateSearch: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("view.updatesearch", this.model.get('enableaddressearch'));
    },
    changeMapWidth: function() {},
    changeMapHeight: function() {},
    changeMapType: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("map.updatetype", this.model.get("type"));
    },
    changeMapMode: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("map.updatemode", this.model.get("mode"));
    },
    changeMapZoom: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("map.updatezoom", parseInt(this.model.get("zoom")));
    },
    changeMapZoomRange: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("map.updatezoomrange", this.model.get("zoomrange"));
    },
    changePagmanPosition: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("street.updateposition", this.model.get('plat'), this.model.get('plng'));
    },
    changePagmantPov: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("street.updatepov", {
        heading: this.model.get('heading'),
        pitch: this.model.get('pitch')
      });
    },
    updateOverlay: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("overlay.updated", this.model);
    },
    updateOveralyMultiple: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("overlay.updated", this.model);
    },
    updateClustering: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("place.cluster", this.model.get("clustering"));
    },
    updateDragging: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("map.updatedragging", this.model.get("dragging"));
    },
    updateDoubleClickZoom: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("map.updatedoubleclickzoom", this.model.get("doubleclickzoom"));
    },
    updateScrollWellZoom: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("map.updatescrollwellzoom", this.model.get("scrollwellzoom"));
    },
    /*
      ZOOM control
    */

    updateZoomControl: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("map.updatezoomcontrol", this.model.get("zoomcontrol"));
    },
    updateZoomControlPosition: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("map.updatezoomcontrolposition", this.model.get("zoomcontrolposition"));
    },
    /*
       Street view control
    */

    updateStreetViewControl: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("map.updatestreetviewcontrol", this.model.get("streetviewcontrol"));
    },
    updateStreetViewControlPosition: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("map.updatestreetviewcontrolposition", this.model.get("streetviewcontrolposition"));
    },
    /*
      Pan control
    */

    updatePanControl: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("map.updatepancontrol", this.model.get("pancontrol"));
    },
    updatePanControlPosition: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("map.updatepancontrolposition", this.model.get("pancontrolposition"));
    },
    /*
     Map type control
    */

    updateMapTypeControl: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("map.updatemaptypecontrol", this.model.get("maptypecontrol"));
    },
    updateMapTypeControlPosition: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("map.updatemaptypecontrolposition", this.model.get("maptypecontrolposition"));
    },
    updateScaleControl: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("map.updatescalecontrol", this.model.get("scalecontrol"));
    },
    updateDirection: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("direction.stateupdate", this.model.get("enabledirection"));
    },
    updateTags: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("tags.stateupdate", this.model.get("enabletags"));
    },
    updatePlaces: function() {
      Cetabo.EventDistpatcher.use(this.channel).trigger("places.stateupdate", this.model.get("enableplaces"));
    },
    /*  Messages bus events
    */

    onChangeMapPosition: function(lat, lng) {
      this.model.set("lng", lng);
      this.model.set("lat", lat);
      this.componentFactory.setValue('lat', lat);
      this.componentFactory.setValue('lng', lng);
    },
    onChangePagmanPosition: function(lat, lng) {
      this.model.set("streetlng", lng);
      this.model.set("streetlat", lat);
      this.componentFactory.setValue('plat', lat);
      this.componentFactory.setValue('plng', lng);
    },
    onChangePagmanPov: function(pov) {
      if (pov === undefined) {
        return;
      }
      this.model.set("heading", pov.heading);
      this.model.set("pitch", pov.pitch);
      this.componentFactory.setValue('heading', pov.heading);
      this.componentFactory.setValue('pitch', pov.pitch);
    },
    onChangeMapZoom: function(zoomLevel) {
      this.model.set("zoom", zoomLevel);
      this.componentFactory.setValue('zoom', zoomLevel);
    },
    onChangeMode: function(mode) {
      if (google.maps.MapMode.STREET === mode) {
        this.find("#pov-details").show();
        this.find("#pegman-details").show();
      } else {
        this.find("#pov-details").hide();
        this.find("#pegman-details").hide();
      }
    },
    onLoadMap: function(model) {
      this.componentFactory.setValue('type', model.get("type"));
      this.componentFactory.setValue('mode', model.get("mode"));
      this.componentFactory.setValue('width', model.get("width"));
      this.componentFactory.setValue('height', model.get("height"));
      this.componentFactory.setValue('overlayenable', model.get("overlayenable"));
      this.componentFactory.setValue('overlaymultiple', model.get("overlaymultiple"));
      this.componentFactory.setValue('clustering', model.get("clustering"));
      this.componentFactory.setValue('enabledirection', model.get("enabledirection"));
      this.componentFactory.setValue('enabletags', model.get("enabletags"));
      this.componentFactory.setValue('enableplaces', model.get("enableplaces"));
      this.componentFactory.setValue('showsteps', model.get("showsteps"));
      this.componentFactory.setValue('zoom', model.get("zoom"));
      this.componentFactory.setValue('zoomrange', model.get("zoomrange"));
      this.componentFactory.setValue('lat', model.get("lat"));
      this.componentFactory.setValue('lng', model.get("lng"));
      this.componentFactory.setValue('plat', model.get("streetlng"));
      this.componentFactory.setValue('plng', model.get("streetlat"));
      this.componentFactory.setValue('dragging', model.get("dragging"));
      this.componentFactory.setValue('doubleclickzoom', model.get("doubleclickzoom"));
      this.componentFactory.setValue('scrollwellzoom', model.get("scrollwellzoom"));
      this.componentFactory.setValue('zoomcontrol', model.get("zoomcontrol"));
      this.componentFactory.setValue('zoomcontrolposition', model.get("zoomcontrolposition"));
      this.componentFactory.setValue('streetviewcontrol', model.get("streetviewcontrol"));
      this.componentFactory.setValue('streetviewcontrolposition', model.get("streetviewcontrolposition"));
      this.componentFactory.setValue('pancontrol', model.get("pancontrol"));
      this.componentFactory.setValue('pancontrolposition', model.get("pancontrolposition"));
      this.componentFactory.setValue('maptypecontrol', model.get("maptypecontrol"));
      this.componentFactory.setValue('maptypecontrolposition', model.get("maptypecontrolposition"));
      this.componentFactory.setValue('scalecontrol', model.get("scalecontrol"));
      this.componentFactory.setValue('enablefullscreen', model.get("enablefullscreen"));
      this.componentFactory.setValue('startfullscreen', model.get("startfullscreen"));
      this.componentFactory.setValue('enableaddressearch', model.get("enableaddressearch"));
      this.componentFactory.setValue('defaultsidebartab', model.get("defaultsidebartab"));
    }
  });

}).call(this);
