(function() {
  Cetabo.MapVisibilityProviderModel = Cetabo.BaseProvider.extend({
    initialize: function() {
      var featureTypes;
      featureTypes = [
        {
          id: "on",
          text: "On",
          description: "Show feature"
        }, {
          id: "off",
          text: "Off",
          description: "Hide feature"
        }, {
          id: "simplified ",
          text: "Simplified",
          description: "Removes some style features from the affected features"
        }
      ];
      this.setData(featureTypes);
    },
    getDefault: function() {
      return "on";
    }
  });

}).call(this);
