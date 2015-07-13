(function() {
  Cetabo.MapModel = Backbone.Model.extend({
    initialize: function() {
      this.on("change:name", function(model) {
        var name;
        if (model === undefined) {
          return;
        }
        name = model.get("name");
        jQuery("#" + model.get("el") + " .name").val(name);
      });
      this.set("places", {});
      this.set("stylers", {});
    },
    toJSON: function() {
      return {
        id: this.get("id"),
        name: this.get("name"),
        lat: this.get("lat"),
        lng: this.get("lng"),
        zoom: this.get("zoom"),
        zoomrange: this.get("zoomrange"),
        width: this.get("width"),
        height: this.get("height"),
        type: this.get("type"),
        mode: this.get("mode"),
        dragging: this.get("dragging"),
        doubleclickzoom: this.get("doubleclickzoom"),
        scrollwellzoom: this.get("scrollwellzoom"),
        zoomcontrol: this.get("zoomcontrol"),
        zoomcontrolposition: this.get("zoomcontrolposition"),
        streetviewcontrol: this.get("streetviewcontrol"),
        streetviewcontrolposition: this.get("streetviewcontrolposition"),
        maptypecontrol: this.get("maptypecontrol"),
        maptypecontrolposition: this.get("maptypecontrolposition"),
        pancontrol: this.get("pancontrol"),
        pancontrolposition: this.get("pancontrolposition"),
        scalecontrol: this.get("scalecontrol"),
        streetlng: this.get("streetlng"),
        streetlat: this.get("streetlat"),
        heading: this.get("heading"),
        pitch: this.get("pitch"),
        enablefullscreen: this.get("enablefullscreen"),
        startfullscreen: this.get("startfullscreen"),
        enableaddressearch: this.get("enableaddressearch"),
        defaultsidebartab: this.get("defaultsidebartab"),
        enabledirection: this.get("enabledirection"),
        enabletags: this.get("enabletags"),
        enableplaces: this.get("enableplaces"),
        showsteps: this.get("showsteps"),
        overlayenable: this.get("overlayenable"),
        overlaymultiple: this.get("overlaymultiple"),
        places: this.collectionToJSON(this.get("places"), function(place) {
          return place.get("transient") !== true;
        }),
        stylers: this.collectionToJSON(this.get("stylers")),
        clustering: this.get("clustering")
      };
    },
    validate: function() {
      var fields, key, messages, placeValidation, places, stylerValidation, stylers;
      messages = [];
      fields = [];
      if (!this.get("name")) {
        messages.push("You must provide a name for map");
        fields.push(".top .name");
      }
      if (!this.get("width") || !/([0-9]+)(px|em|ex|%|in|cm|mm|pt|pc)/.test(this.get("width"))) {
        messages.push("Settings > Invalid map width, must be a valid width value in px or %.");
        fields.push(".width");
      }
      if (!this.get("height") || !/([0-9]+)(px|em|ex|%|in|cm|mm|pt|pc)/.test(this.get("height"))) {
        messages.push("Settings > Invalid map height, must be a valid width value in px or %.");
        fields.push(".height");
      }
      if (!this.get("lat") || isNaN(this.get("lat"))) {
        messages.push("Settings > Invalid map center lat, must be a valid coordonate.");
        fields.push(".lat");
      }
      if (!this.get("lng") || isNaN(this.get("lng"))) {
        messages.push("Settings > Invalid map center lng, must be a valid coordonate.");
        fields.push(".lng");
      }
      if (!this.get("type")) {
        messages.push("Settings > Invalid map type specified.");
        fields.push(".type");
      }
      places = this.get("places");
      for (key in places) {
        placeValidation = places[key].validate();
        if (places[key].get("transient") !== true && placeValidation.hasError) {
          messages = messages.concat(placeValidation.messages);
          fields = fields.concat(placeValidation.fields);
        }
      }
      stylers = this.get("stylers");
      for (key in stylers) {
        stylerValidation = stylers[key].validate();
        if (stylerValidation.hasError) {
          messages = messages.concat(stylerValidation.messages);
          fields = fields.concat(stylerValidation.fields);
        }
      }
      return {
        messages: messages,
        fields: fields,
        hasError: messages.length !== 0
      };
    },
    collectionToJSON: function(collection, callbackFilter) {
      var key, result;
      result = [];
      for (key in collection) {
        if (callbackFilter !== undefined && !callbackFilter(collection[key])) {
          continue;
        }
        result.push(collection[key].toJSON());
      }
      return result;
    },
    collectionToArray: function(collection, callbackFilter) {
      var key, result;
      result = [];
      for (key in collection) {
        if (callbackFilter !== undefined && !callbackFilter(collection[key])) {
          continue;
        }
        result.push(collection[key]);
      }
      return result;
    },
    addPlace: function(key, placeModel) {
      var places;
      places = this.get("places");
      places[key] = placeModel;
    },
    removePlace: function(key) {
      var places;
      places = this.get("places");
      delete places[key];
    },
    getPlaceById: function(key) {
      var places;
      places = this.get("places");
      return places[key];
    },
    /*
      Get place by specified attribute value
    */

    getPlaceKeysByAttribute: function(attribute, value) {
      var i, key, keys, place, places;
      keys = [];
      places = this.get("places");
      for (key in places) {
        place = places[key];
        if (!(value instanceof Array)) {
          if (place.get(attribute) === value) {
            keys.push(key);
          }
        } else {
          i = 0;
          while (i < value.length) {
            if (place.get(attribute) === value[i]) {
              keys.push(key);
            }
            i++;
          }
        }
      }
      return keys;
    },
    /*
     Get place by specified attribute value
    */

    getPlacesByAttribute: function(attribute, value) {
      var i, key, keys, places;
      places = {};
      keys = this.getPlaceKeysByAttribute(attribute, value);
      i = 0;
      while (i < keys.length) {
        key = keys[i];
        places[key] = this.getPlaceById(key);
        i++;
      }
      return places;
    },
    /*
      Get first place
    */

    getPlaceByAttribute: function(attribute, value) {
      var key, places;
      places = this.getPlacesByAttribute(attribute, value);
      for (key in places) {
        return places[key];
      }
      return undefined;
    },
    /*
      Remove place by attribute
    */

    removePlaceByAttribute: function(attribute, value) {
      var key;
      key = this.getPlaceKeysByAttribute(attribute, value);
      this.removePlace(key);
    },
    addStyler: function(key, syleModel) {
      var stylers;
      stylers = this.get("stylers");
      stylers[key] = syleModel;
    },
    removeStyler: function(key) {
      var stylers;
      stylers = this.get("stylers");
      delete stylers[key];
    },
    getStylerById: function(key) {
      var stylers;
      stylers = this.get("stylers");
      return stylers[key];
    },
    buildMapStyler: function() {
      var key, result, styler, stylers;
      result = [];
      stylers = this.get("stylers");
      for (key in stylers) {
        styler = stylers[key];
        if (!styler.isValid()) {
          continue;
        }
        result.push(styler.toJSON());
      }
      return result;
    },
    prepareModelState: function(data) {
      var map;
      map = data.map.configuration;
      map.id = data.map.id;
      return map;
    },
    load: function(data) {
      var key, modelState, value;
      modelState = this.prepareModelState(data);
      for (key in modelState) {
        value = modelState[key];
        if (Object.prototype.toString.call(value) === "[object Array]") {
          this.fillFromCollection(key, value);
        } else {
          this.set(key, this.convertValue(value));
        }
      }
    },
    convertValue: function(value) {
      if ("true" === value) {
        return true;
      }
      if ("false" === value) {
        return false;
      }
      return value;
    },
    fillFromCollection: function(type, collection) {
      var ident, key, place, styler, subModelState;
      this.set(type, {});
      for (key in collection) {
        subModelState = collection[key];
        if (Object.prototype.toString.call(subModelState) !== "[object Object]") {
          continue;
        }
        subModelState["channel"] = this.get("channel");
        ident = "ident" + Math.floor(Math.random() * 100000);
        switch (type) {
          case "places":
            if (subModelState["details"] !== undefined) {
              subModelState["details"] = subModelState["details"].replace(/\\/g, "");
            }
            place = new Cetabo.PlaceModel(subModelState);
            place.set("id", ident);
            this.addPlace(ident, place);
            break;
          case "stylers":
            styler = new Cetabo.StylerModel(subModelState);
            styler.set("id", ident);
            this.addStyler(ident, styler);
        }
      }
    },
    /*
    Fill stylers from theme
    @param theme
    */

    fillStylerModelFromTheme: function(theme) {
      var i, ident, styler, themeEntry;
      this.set("stylers", {});
      i = 0;
      while (i < theme.length) {
        themeEntry = theme[i];
        if (Object.prototype.toString.call(themeEntry) !== "[object Object]") {
          continue;
        }
        themeEntry["channel"] = this.get("channel");
        themeEntry["elementType"] = (themeEntry["elementType"] !== undefined ? themeEntry["elementType"] : "all");
        ident = "ident" + Math.floor(Math.random() * 100000);
        styler = new Cetabo.StylerModel(themeEntry);
        styler.set("id", ident);
        this.addStyler(ident, styler);
        i++;
      }
    },
    getStylersAsTheme: function() {
      return this.collectionToJSON(this.get("stylers"));
    },
    getMapTags: function() {
      var places, tags, _i, _len, _place, _ref;
      tags = [];
      places = this.get("places");
      if (places == null) {
        return [];
      }
      _ref = this.collectionToArray(places);
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        _place = _ref[_i];
        if ((_place.get("tags") != null) && _place.get("tags") !== '') {
          Cetabo.ArrayUtil.pushArray(tags, _place.get("tags").split(','));
        }
      }
      return Cetabo.ArrayUtil.asSet(tags);
    },
    getMapPlaces: function() {
      var places;
      places = this.get("places");
      return this.collectionToArray(places, function(place) {
        return place.get("transient") !== true;
      });
    }
  });

}).call(this);
