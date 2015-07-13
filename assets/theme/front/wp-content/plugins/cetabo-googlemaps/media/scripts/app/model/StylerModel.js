(function() {
  Cetabo.StylerModel = Backbone.Model.extend({
    initialize: function() {
      if (this.get("visibility") == null) {
        this.set("visibility", "on");
      }
      if (this.get("stylers") == null) {
        this.set("stylers", []);
      }
    },
    isValid: function() {
      if (!this.isValidProperty("featureType")) {
        return false;
      }
      if (!this.isValidProperty("elementType")) {
        return false;
      }
      if (this.get("visibility") !== "off" && !this.isValidProperty("visibility")) {
        return false;
      }
      return true;
    },
    isValidProperty: function(attr) {
      var property;
      property = this.get(attr);
      return property !== undefined && !Cetabo.StringUtil.isEmpty(property);
    },
    toJSON: function() {
      return {
        featureType: this.get("featureType"),
        elementType: this.get("elementType"),
        stylers: this.get("stylers")
      };
    },
    getStyler: function(name) {
      var i, styler, stylers;
      stylers = this.get("stylers");
      i = 0;
      while (i < stylers.length) {
        styler = stylers[i];
        if (styler[name] !== undefined) {
          return styler[name];
        }
        i++;
      }
      return null;
    },
    setStyler: function(name, value) {
      var found, i, obj, styler, stylers;
      stylers = this.get("stylers");
      found = false;
      i = 0;
      while (i < stylers.length) {
        styler = stylers[i];
        if (styler[name] !== undefined) {
          styler[name] = value;
          found = true;
        }
        i++;
      }
      if (!found) {
        obj = {};
        obj[name] = value;
        stylers.push(obj);
      }
      this.set("stylers", stylers);
    },
    validate: function() {
      var fields, messages;
      messages = [];
      fields = [];
      if (!this.get("featureType")) {
        messages.push("Style > You must select feature");
        fields.push("#" + this.get("id") + " .feature-type");
      }
      if (!this.get("elementType")) {
        messages.push("Style > You must select element");
        fields.push("#" + this.get("id") + " .element-type");
      }
      if (messages.length !== 0) {
        fields.push(".header-" + this.get("id"));
      }
      return {
        messages: messages,
        fields: fields,
        hasError: messages.length !== 0
      };
    }
  });

}).call(this);
