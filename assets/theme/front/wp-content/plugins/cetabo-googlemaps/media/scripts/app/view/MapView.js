/*
Provide functionality to load and display map
*/


(function() {
  Cetabo.MapView = Cetabo.FullscreenView.extend({
    initialize: function(config) {
      var channel;
      Cetabo.MapView.__super__.initialize.apply(this, arguments);
      this.config = config;
      channel = this.getChannel();
      Cetabo.EventDistpatcher.use(channel).on("map.load", this.onLoadMapCallback, this);
      Cetabo.EventDistpatcher.use(channel).on("map.updatesize", this.onUpdateMapSize, this);
      Cetabo.EventDistpatcher.use(channel).on("map.updatemode", this.onChangeMode, this);
      Cetabo.EventDistpatcher.use(channel).on("screen.resized", this.onScreenResolutionChanged, this);
      Cetabo.EventDistpatcher.use(channel).on("screen.stateupdate", this.onUpdateFullscreen, this);
      Cetabo.EventDistpatcher.use(channel).on("view.updatefullscreen", this.onEnableFullscreen, this);
      Cetabo.EventDistpatcher.use(channel).on("view.updatesearch", this.onEnableSearch, this);
      this.initConnection(config.url.load);
      this.initModel();
      this.initDirectionManager();
      this.initStreetManager();
      this.initMapManager();
      this.initSidebarView();
      this.initSearchView();
      this.initScreenResizeEvent();
    },
    initScreenResizeEvent: function() {
      var channel;
      channel = this.getChannel();
      jQuery(window).resize(function() {
        Cetabo.EventDistpatcher.use(channel).trigger("screen.resized");
      });
    },
    /*
    Create ajax connector
    */

    initConnection: function() {
      var channel;
      channel = this.getChannel();
      this.connectionManager = new Cetabo.ConnectionManager({
        channel: channel
      });
    },
    initSidebarView: function() {
      this.sidebarView = new Cetabo.SidebarView(this.getSidebarConfiguration());
    },
    getSidebarConfiguration: function() {
      return {
        el: "#" + this.enforceELId(this.find(".cmap-sidebar")),
        sidebarTrigger: this.find('.cmap-sidebar-trigger'),
        channel: this.getChannel(),
        model: this.model
      };
    },
    initSearchView: function() {
      this.sidebarView = new Cetabo.SearchView(this.getSearchConfiguration());
    },
    getSearchConfiguration: function() {
      return {
        el: "#" + this.enforceELId(this.find(".cmap-search")),
        channel: this.getChannel(),
        model: this.model
      };
    },
    /*
    Init model
    */

    initModel: function() {
      this.model = new Cetabo.MapModel(this.getDefaultModelState());
    },
    getDefaultModelState: function() {
      var channel;
      channel = this.getChannel();
      return {
        readonly: this.isReadOnly(),
        channel: channel
      };
    },
    /*
    Init map manager
    */

    initMapManager: function() {
      var configuration;
      configuration = this.getMapConfiguration();
      this.mapManager = new Cetabo.MapManager(configuration);
    },
    /*
    Holds the map configuration, override this for custom configurations in
    descendent classes
    */

    getMapConfiguration: function() {
      var mapCanvas;
      mapCanvas = this.enforceELId(this.find(".map-canvas"));
      return {
        el: mapCanvas,
        readonly: this.isReadOnly(),
        channel: this.getChannel(),
        baseURL: this.config.baseURL,
        scaleControl: this.model.get("scalecontrol")
      };
    },
    initStreetManager: function() {
      var configuration;
      configuration = this.getStreetConfiguration();
      this.streetManager = new Cetabo.StreetManager(configuration);
    },
    getStreetConfiguration: function() {
      var errorCanvas, streetCanvas;
      streetCanvas = this.enforceELId(this.find(".street-canvas"));
      errorCanvas = this.enforceELId(this.find(".street-canvas-error"));
      return {
        el: streetCanvas,
        errorEl: errorCanvas,
        readonly: this.isReadOnly(),
        channel: this.getChannel(),
        baseURL: this.config.baseURL
      };
    },
    /*
    Init map manager
    */

    initDirectionManager: function() {
      var configuration;
      configuration = this.getDirectionConfiguration();
      this.directionManger = new Cetabo.DirectionManager(configuration);
    },
    /*
    Holds the map configuration, override this for custom configurations in
    descendent classes
    */

    getDirectionConfiguration: function() {
      return {
        canvas: this.getElId(),
        readonly: this.isReadOnly(),
        channel: this.getChannel(),
        baseURL: this.config.baseURL
      };
    },
    getConfiguration: function() {
      return this.config;
    },
    isReadOnly: function() {
      return true;
    },
    /*
    Load map with specified id
    */

    loadModel: function(id) {
      var channel, instance;
      instance = this;
      channel = this.getChannel();
      Cetabo.EventDistpatcher.use(channel).trigger("backend.send", {
        content: {
          id: id
        },
        url: this.getLoadURL(),
        callback: {
          success: function(data) {
            instance.model.load(data);
            Cetabo.EventDistpatcher.use(channel).trigger("map.load", instance.model);
          }
        }
      });
    },
    getLoadURL: function() {
      return this.getConfiguration().url.load;
    },
    onLoadMapCallback: function(model) {
      var channel, key, places;
      channel = this.getChannel();
      places = model.get("places");
      for (key in places) {
        Cetabo.EventDistpatcher.use(channel).trigger("place.add", places[key]);
        Cetabo.EventDistpatcher.use(channel).trigger("place.update", places[key]);
      }
      Cetabo.EventDistpatcher.use(channel).trigger("styler.update", model.buildMapStyler());
      if (this.isReadOnly()) {
        Cetabo.EventDistpatcher.use(channel).trigger("map.updatesize", model.get("width"), model.get("height"));
      }
      Cetabo.EventDistpatcher.use(channel).trigger("map.updatezoom", parseInt(model.get("zoom")));
      Cetabo.EventDistpatcher.use(channel).trigger("map.updatedragging", model.get("dragging"));
      Cetabo.EventDistpatcher.use(channel).trigger("map.updatedoubleclickzoom", model.get("doubleclickzoom"));
      Cetabo.EventDistpatcher.use(channel).trigger("map.updatescrollwellzoom", model.get("scrollwellzoom"));
      Cetabo.EventDistpatcher.use(channel).trigger("map.updatezoomcontrol", model.get("zoomcontrol"));
      Cetabo.EventDistpatcher.use(channel).trigger("map.updatezoomcontrolposition", model.get("zoomcontrolposition"));
      Cetabo.EventDistpatcher.use(channel).trigger("map.updatestreetviewcontrol", model.get("streetviewcontrol"));
      Cetabo.EventDistpatcher.use(channel).trigger("map.updatestreetviewcontrolposition", model.get("streetviewcontrolposition"));
      Cetabo.EventDistpatcher.use(channel).trigger("map.updatepancontrol", model.get("pancontrol"));
      Cetabo.EventDistpatcher.use(channel).trigger("map.updatepancontrolposition", model.get("pancontrolposition"));
      Cetabo.EventDistpatcher.use(channel).trigger("map.updatemaptypecontrol", model.get("maptypecontrol"));
      Cetabo.EventDistpatcher.use(channel).trigger("map.updatemaptypecontrolposition", model.get("maptypecontrolposition"));
      Cetabo.EventDistpatcher.use(channel).trigger("map.updatescalecontrol", model.get("scalecontrol"));
      Cetabo.EventDistpatcher.use(channel).trigger("direction.stateupdate", model.get("enabledirection"));
      Cetabo.EventDistpatcher.use(channel).trigger("tags.stateupdate", model.get("enabletags"));
      Cetabo.EventDistpatcher.use(channel).trigger("places.stateupdate", model.get("enableplaces"));
      Cetabo.EventDistpatcher.use(channel).trigger("map.updatezoomrange", model.get("zoomrange"));
      Cetabo.EventDistpatcher.use(channel).trigger("map.updatecenter", model.get("lat"), model.get("lng"));
      Cetabo.EventDistpatcher.use(channel).trigger("map.updatetype", model.get("type"));
      Cetabo.EventDistpatcher.use(channel).trigger("street.updateposition", model.get("streetlat"), model.get("streetlng"));
      Cetabo.EventDistpatcher.use(channel).trigger("street.updatepov", {
        heading: model.get("heading"),
        pitch: model.get("pitch")
      });
      Cetabo.EventDistpatcher.use(channel).trigger("map.updatemode", model.get("mode"));
      Cetabo.EventDistpatcher.use(channel).trigger("place.cluster", model.get("clustering"));
      Cetabo.EventDistpatcher.use(channel).trigger("overlay.updated", model);
      if (this.isReadOnly()) {
        Cetabo.EventDistpatcher.use(channel).trigger("screen.stateupdate", model.get('startfullscreen'));
      }
      Cetabo.EventDistpatcher.use(channel).trigger("view.updatefullscreen", model.get('enablefullscreen'));
      Cetabo.EventDistpatcher.use(channel).trigger("view.updatesearch", model.get('enableaddressearch'));
      Cetabo.EventDistpatcher.use(channel).trigger("map.loaded");
    },
    onResizeFullscreen: function(width, height) {
      var channel;
      channel = this.getChannel();
      Cetabo.EventDistpatcher.use(channel).trigger("screen.updatesize", width, height);
    },
    getOriginalSize: function() {
      return {
        width: this.model.get("width"),
        height: this.model.get("height")
      };
    },
    onResizeOriginalSize: function(width, height) {
      var channel;
      channel = this.getChannel();
      Cetabo.EventDistpatcher.use(channel).trigger("screen.updatesize", width, height);
    },
    onUpdateMapSize: function(width, height) {
      if (this.isReadOnly()) {
        jQuery("#" + this.getElId()).width(width).height(height);
      }
    },
    onScreenResolutionChanged: function() {
      this.toggleSidebarMode();
    },
    onChangeMode: function() {
      this.toggleSidebarMode();
    },
    toggleSidebarMode: function() {
      var canvas, isStreetMode, width;
      canvas = (this.isReadOnly() ? this.findParent(".cmap-container") : this.find(".cmap-container"));
      isStreetMode = this.model.get('mode') === google.maps.MapMode.STREET;
      width = this.find(".map-canvas").width();
      if (width < 480 || isStreetMode) {
        canvas.addClass("cmap-mob-wrap");
      } else {
        canvas.removeClass("cmap-mob-wrap");
      }
    },
    onUpdateFullscreen: function(fullscreen) {
      this.setFullscreen(fullscreen);
    },
    onEnableFullscreen: function(enabled) {
      if (enabled) {
        this.find('.cmap-fullscreen').show();
      } else {
        this.find('.cmap-fullscreen').hide();
      }
    },
    onEnableSearch: function(enabled) {
      if (enabled) {
        this.find('.cmap-search').show();
      } else {
        this.find('.cmap-search').hide();
      }
    },
    setFullscreen: function(fullscreen) {
      if (this.isReadOnly()) {
        Cetabo.MapView.__super__.setFullscreen.apply(this, arguments);
      }
    }
  });

}).call(this);
