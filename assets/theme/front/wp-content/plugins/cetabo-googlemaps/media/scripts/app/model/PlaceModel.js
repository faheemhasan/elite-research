(function() {
  Cetabo.PlaceModel = Backbone.Model.extend({
    initialize: function() {
      var channel;
      channel = this.get("channel");
      this.on("change:lat", function(model) {
        var lat;
        if (model === undefined) {
          return;
        }
        lat = model.get("lat");
        jQuery("#" + model.get("id") + " .lat").val(lat);
      });
      this.on("change:lng", function(model) {
        var lat;
        if (model === undefined) {
          return;
        }
        lat = model.get("lng");
        jQuery("#" + model.get("id") + " .lng").val(lat);
      });
      this.on("change:name", function(model) {
        if (model === undefined) {
          return;
        }
        Cetabo.EventDistpatcher.use(channel).trigger("place.update", this);
      });
      this.on("change:details", function(model) {
        if (model === undefined) {
          return;
        }
        Cetabo.EventDistpatcher.use(channel).trigger("place.update", this);
      });
    },
    toJSON: function() {
      return {
        id: this.get("_id"),
        name: this.get("name"),
        tags: this.get("tags"),
        lat: this.get("lat"),
        lng: this.get("lng"),
        icon: this.get("icon"),
        iconCustomName: this.get("iconCustomName"),
        iconCustomId: this.get("iconCustomId"),
        details: this.get("details"),
        animation: this.get("animation"),
        type: this.get("type")
      };
    },
    hasTag: function(tag) {
      var tags, _i, _len, _tag;
      if (this.get("tags") === undefined) {
        return false;
      }
      tags = (this.get("tags")).split(',');
      for (_i = 0, _len = tags.length; _i < _len; _i++) {
        _tag = tags[_i];
        if (String(_tag) === String(tag)) {
          return true;
        }
      }
      return false;
    },
    hasAnyOfTags: function(tags) {
      var _i, _len, _tag;
      for (_i = 0, _len = tags.length; _i < _len; _i++) {
        _tag = tags[_i];
        if (this.hasTag(_tag)) {
          return true;
        }
      }
      return false;
    },
    toGoogleMapsPoint: function() {
      return new google.maps.LatLng(this.get("lat"), this.get("lng"));
    },
    validate: function() {
      var fields, messages;
      messages = [];
      fields = [];
      if (!this.get("name")) {
        messages.push("Places > You must provide a name for place");
        fields.push("#" + this.get("id") + " .name");
      }
      if (!this.get("lat") || isNaN(this.get("lat"))) {
        messages.push("Places > Invalid place lat, must be a valid coordonate.");
        fields.push("#" + this.get("id") + " .lat");
      }
      if (!this.get("lng") || isNaN(this.get("lng"))) {
        messages.push("Places > Invalid place lng, must be a valid coordonate.");
        fields.push("#" + this.get("id") + " .lng");
      }
      if (messages.length !== 0) {
        fields.push(".header-" + this.get("id"));
      }
      return {
        messages: messages,
        fields: fields,
        hasError: messages.length !== 0
      };
    },
    isPassingCriteriaCheck: function(criteria) {
      var isPassing;
      isPassing = true;
      if ((criteria.tags != null) && criteria.tags.length > 0) {
        isPassing = isPassing && this.hasAnyOfTags(criteria.tags);
      }
      return isPassing;
    }
  });

}).call(this);
