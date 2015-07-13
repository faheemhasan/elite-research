(function() {
  Cetabo.EditableMapView = Cetabo.MapView.extend({
    events: function() {
      return _.extend({}, Cetabo.MapView.prototype.events, {
        "click .save": "save",
        "click .edit": "edit",
        "click .clone": "clone",
        "click .tab-place": "switchOnPlace",
        "click .tab-settings": "switchOnSettings",
        "click .tab-style": "switchOnStyle",
        "click .tab-direction": "switchOnDirection",
        "click .export": "export"
      });
    },
    initialize: function(config) {
      Cetabo.EditableMapView.__super__.initialize.apply(this, arguments);
      this.initMapNameInput();
      if (!config.readonly) {
        this.initSubViews();
        this.initNotificationManager();
        this.initOverlayManager();
        this.initTabControl();
        this.initAddressPicker();
        this.initContentManager();
        Cetabo.EventDistpatcher.use(this.getChannel()).on("map.loaded", this.onMapLoaded, this);
        Cetabo.EventDistpatcher.use(this.getChannel()).trigger("map.load", this.model);
      }
    },
    initSubViews: function() {
      this.placesView = new Cetabo.PlacesView({
        el: "#controll-place",
        model: this.model,
        channel: this.getChannel(),
        baseURL: this.config.baseURL
      });
      this.settingsView = new Cetabo.SettingsView({
        el: "#controll-settings",
        model: this.model,
        channel: this.getChannel()
      });
      this.stylerView = new Cetabo.StylerView({
        el: "#controll-style",
        model: this.model,
        url: this.getConfiguration().url,
        channel: this.getChannel()
      });
      this.find(".fullscreen").hide();
    },
    switchOnPlace: function() {
      this.placesView.refresh();
      Cetabo.EventDistpatcher.use(this.getChannel()).trigger("content.show");
    },
    switchOnSettings: function() {
      Cetabo.EventDistpatcher.use(this.getChannel()).trigger("content.hide");
    },
    switchOnStyle: function() {
      this.stylerView.refresh();
      Cetabo.EventDistpatcher.use(this.getChannel()).trigger("content.hide");
    },
    switchOnDirection: function() {
      Cetabo.EventDistpatcher.use(this.getChannel()).trigger("content.hide");
    },
    getDefaultModelState: function() {
      var channel;
      channel = this.getChannel();
      return {
        readonly: this.isReadOnly(),
        channel: channel,
        zoom: 2,
        zoomrange: {
          min: 2,
          max: 18
        },
        width: "800px",
        height: "600px",
        lat: 41.552409812870664,
        lng: 12.88751972656244,
        type: google.maps.MapTypeId.ROADMAP,
        mode: google.maps.MapMode.MAP,
        dragging: true,
        doubleclickzoom: true,
        scrollwellzoom: true,
        maptypecontrol: false,
        maptypecontrolposition: google.maps.ControlPosition.TOP_RIGHT,
        pancontrol: false,
        pancontrolposition: google.maps.ControlPosition.TOP_RIGHT,
        scalecontrol: true,
        streetviewcontrol: true,
        streetviewcontrolposition: google.maps.ControlPosition.TOP_RIGHT,
        zoomcontrol: true,
        zoomcontrolposition: google.maps.ControlPosition.TOP_RIGHT,
        defaultsidebartab: 0,
        heading: 34,
        pitch: 10,
        enablefullscreen: false,
        startfullscreen: false,
        enableaddressearch: false,
        enabledirection: false,
        enabletags: false,
        enableplaces: false,
        travelmode: false,
        showsteps: true,
        tracking: false,
        trackinginterval: 1000,
        overalyenable: false,
        overlaymultiple: true,
        overlay_arrowshahowstyle: 0,
        overlay_padding: 10,
        overlay_borderradius: 10,
        overlay_borderwidth: 1,
        overlay_bordercolor: "#CCC",
        overlay_backgroundcolor: "#FFF",
        overlay_minwidth: 0,
        overlay_maxwidth: 300,
        overlay_minheight: 0,
        overlay_maxheight: 0,
        overlay_arrowsize: 15,
        overlay_arrowposition: 50,
        overlay_arrowstyle: 0,
        clustering: false
      };
    },
    initNotificationManager: function() {
      var channel;
      channel = this.getChannel();
      this.notificationsManager = new Cetabo.NotificationsManager({
        channel: channel
      });
    },
    initContentManager: function() {
      var channel;
      channel = this.getChannel();
      this.contentManger = new Cetabo.ContentManager({
        channel: channel,
        el: "___hiddenEditor___"
      });
    },
    initOverlayManager: function() {
      var channel;
      channel = this.getChannel();
      this.overlayManager = new Cetabo.OverlayManager({
        channel: channel
      });
    },
    getMapConfiguration: function() {
      var mapCanvas;
      mapCanvas = this.enforceELId(this.find(".map-canvas"));
      return {
        el: mapCanvas,
        readonly: this.isReadOnly(),
        channel: this.getChannel(),
        baseURL: this.config.baseURL
      };
    },
    initTabControl: function() {
      this.find("#cmap-tabs-container").tabs({
        active: -1
      });
      if (this.isReadOnly()) {
        this.find("#cmap-tabs-container").hide();
      }
    },
    initMapNameInput: function() {
      var model;
      model = this.model;
      this.find(".name").change(function() {
        var value;
        value = jQuery(this).val();
        model.set("name", value);
      });
      this.find(".name").prop("disabled", this.isReadOnly());
    },
    initAddressPicker: function() {
      var channel, instance;
      channel = this.getChannel();
      instance = this;
      this.addresspicker = this.find(".addresspicker").addresspicker({
        updateCallback: function(geocodeResult, parsedGeocodeResult) {
          var place, placeId;
          Cetabo.EventDistpatcher.use(channel).trigger("map.updatecenter", parsedGeocodeResult.lat, parsedGeocodeResult.lng);
          Cetabo.EventDistpatcher.use(channel).trigger("map.updatezoom", 15);
          placeId = instance.placesView.addNew();
          place = instance.model.getPlaceById(placeId);
          place.set("lat", parsedGeocodeResult.lat);
          place.set("lng", parsedGeocodeResult.lng);
          place.set("name", geocodeResult.label);
          instance.placesView.initNameInput(place);
        }
      });
    },
    onLoadMapCallback: function(model) {
      Cetabo.EditableMapView.__super__.onLoadMapCallback.apply(this, arguments);
      this.find(".name").val(model.get("name"));
    },
    /*
    Persist map
    */

    save: function() {
      var parent;
      parent = this;
      this.persist(this.getSaveURL(), function() {
        return parent.getSaveCallbacks();
      });
    },
    clone: function() {
      

      var parent;
      parent = this;
      this.persist(this.getCloneURL(), function() {
        return parent.getSaveCallbacks();
      });
      

    },
    persist: function(url, callback) {
      var channel, i, validation;
      channel = this.getChannel();
      validation = this.model.validate();
      if (validation.hasError) {
        Cetabo.EventDistpatcher.use(channel).trigger("notification.show", validation.messages.join(" <br/>"));
        i = 0;
        while (i < validation.fields.length) {
          this.highlightField(validation.fields[i]);
          i++;
        }
        return;
      }
      Cetabo.EventDistpatcher.use(channel).trigger("overlay.show");
      Cetabo.EventDistpatcher.use(channel).trigger("backend.send", {
        url: url,
        content: this.model.toJSON(),
        callback: callback()
      });
    },
    highlightField: function(name) {
      this.find("" + name).addClass("invalid").delay(8000).queue(function(next) {
        jQuery(this).removeClass("invalid");
        next();
      });
    },
    getSaveURL: function() {
      return this.getConfiguration().url.save;
    },
    getCloneURL: function() {
      return this.getConfiguration().url.clone;
    },
    getBackURL: function() {
      return this.getConfiguration().url.back;
    },
    getExportURL: function() {
      return this.getConfiguration().url["export"];
    },
    isReadOnly: function() {
      return this.getConfiguration().readonly;
    },
    getSaveCallbacks: function() {
      var callback, channel, instance;
      channel = this.getChannel();
      instance = this;
      callback = {
        success: function(object) {
          instance.onSaveSuccess(object, channel);
        },
        error: function(error) {
          instance.onSaveError(error, channel);
        }
      };
      return callback;
    },
    getExportCallbaks: function() {
      var callback, channel, instance;
      channel = this.getChannel();
      instance = this;
      callback = {
        success: function(object) {
          instance.onExportSuccess(object, channel);
        },
        error: function(error) {
          instance.onSaveError(error, channel);
        }
      };
      return callback;
    },
    onSaveSuccess: function(object, channel) {
      var returnURL;
      if (object.success) {
        Cetabo.EventDistpatcher.use(channel).trigger("notification.show", "Map successfully saved");
        returnURL = this.getConfiguration().url.back;
        setInterval((function() {
          window.location.replace(returnURL);
        }), 2000);
      } else {
        Cetabo.EventDistpatcher.use(channel).trigger("notification.show", "An error has occurred");
      }
    },
    onExportSuccess: function(object, channel) {
      var returnURL;
      if (object.success) {
        returnURL = this.getConfiguration().url["export"];
        setInterval((function() {
          window.location.replace(returnURL);
        }), 2000);
      } else {
        Cetabo.EventDistpatcher.use(channel).trigger("notification.show", "An error has occurred");
      }
    },
    onSaveError: function(error, channel) {
      Cetabo.EventDistpatcher.use(channel).trigger("notification.show", "An critical error has occurred");
    },
    edit: function() {
      window.location.replace(this.getConfiguration().url.edit);
    },
    onUpdateMapSize: function(width, height) {
      if (this.isReadOnly()) {
        this.find(".cmap-container").width(width).height(height);
      }
    },
    loadModel: function(id) {
      Cetabo.EditableMapView.__super__.loadModel.apply(this, arguments);
      Cetabo.EventDistpatcher.use(this.getChannel()).trigger("overlay.show");
    },
    onMapLoaded: function() {
      var channel;
      channel = this.getChannel();
      setTimeout(function() {
        return Cetabo.EventDistpatcher.use(channel).trigger("overlay.hide");
      }, 2000);
    },
    "export": function() {
      

      var parent;
      parent = this;
      this.persist(this.getSaveURL(), function() {
        return parent.getExportCallbaks();
      });
      

    }
  });

}).call(this);
