(function() {
  Cetabo.MapControlPostionProviderModel = Cetabo.BaseProvider.extend({
    initialize: function() {
      var data;
      data = [
        {
          id: google.maps.ControlPosition.BOTTOM_CENTER,
          description: "Elements are positioned in the center of the bottom row",
          text: "BOTTOM CENTER"
        }, {
          id: google.maps.ControlPosition.BOTTOM_LEFT,
          description: "Elements are positioned in the bottom left and flow towards the middle. Elements are positioned to the right of the Google logo",
          text: "BOTTOM LEFT"
        }, {
          id: google.maps.ControlPosition.BOTTOM_RIGHT,
          description: "Elements are positioned in the bottom right and flow towards the middle. Elements are positioned to the left of the copyrights",
          text: "BOTTOM RIGHT"
        }, {
          id: google.maps.ControlPosition.LEFT_BOTTOM,
          description: "Elements are positioned on the left, above bottom-left elements, and flow upwards",
          text: "LEFT BOTTOM"
        }, {
          id: google.maps.ControlPosition.LEFT_CENTER,
          description: "Elements are positioned in the center of the left side",
          text: "LEFT CENTER"
        }, {
          id: google.maps.ControlPosition.LEFT_TOP,
          description: "Elements are positioned on the left, below top-left elements, and flow downwards",
          text: "LEFT TOP"
        }, {
          id: google.maps.ControlPosition.RIGHT_BOTTOM,
          description: "Elements are positioned on the right, above bottom-right elements, and flow upwards",
          text: "RIGHT BOTTOM"
        }, {
          id: google.maps.ControlPosition.RIGHT_CENTER,
          description: "Elements are positioned in the center of the right side",
          text: "RIGHT CENTER"
        }, {
          id: google.maps.ControlPosition.RIGHT_TOP,
          description: "Elements are positioned on the right, below top-right elements, and flow downwards",
          text: "RIGHT TOP"
        }, {
          id: google.maps.ControlPosition.TOP_CENTER,
          description: "Elements are positioned in the center of the top row",
          text: "TOP_CENTER"
        }, {
          id: google.maps.ControlPosition.TOP_LEFT,
          description: "Elements are positioned in the top left and flow towards the middle",
          text: "TOP LEFT"
        }, {
          id: google.maps.ControlPosition.TOP_RIGHT,
          description: "Elements are positioned in the top right and flow towards the middle",
          text: "TOP RIGHT"
        }
      ];
      this.setData(data);
    }
  });

}).call(this);
