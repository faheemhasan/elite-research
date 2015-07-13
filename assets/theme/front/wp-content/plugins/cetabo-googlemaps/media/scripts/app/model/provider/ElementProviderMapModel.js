(function() {
  Cetabo.ElementProviderMapModel = Cetabo.BaseProvider.extend({
    initialize: function() {
      var elementTypes;
      elementTypes = [
        {
          text: "all",
          id: "all",
          description: "Apply the rule to all elements of the specified feature."
        }, {
          text: "geometry",
          id: "geometry",
          description: "Apply the rule to the feature's geometry."
        }, {
          text: "geometry.fill",
          id: "geometry.fill",
          description: "Apply the rule to the fill of the feature's geometry."
        }, {
          text: "geometry.stroke",
          id: "geometry.stroke",
          description: "Apply the rule to the stroke of the feature's geometry."
        }, {
          text: "labels",
          id: "labels",
          description: "Apply the rule to the feature's labels."
        }, {
          text: "labels.icon",
          id: "labels.icon",
          description: "Apply the rule to icons within the feature's lab"
        }, {
          text: "labels.text",
          id: "labels.text",
          description: "Apply the rule to the text in the feature's labe"
        }, {
          text: "labels.text.fill",
          id: "labels.text.fill",
          description: "Apply the rule to the fill of the text in the feature's labels."
        }, {
          text: "labels.text.stroke",
          id: "labels.text.stroke",
          description: "Apply the rule to the stroke of the text in the feature"
        }
      ];
      this.setData(elementTypes);
    },
    getDefault: function() {
      return undefined;
    }
  });

}).call(this);
