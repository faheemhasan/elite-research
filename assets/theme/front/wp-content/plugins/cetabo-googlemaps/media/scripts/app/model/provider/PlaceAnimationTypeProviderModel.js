(function() {
  Cetabo.PlaceAnimationTypeProviderModel = Cetabo.BaseProvider.extend({
    initialize: function() {
      var data;
      data = [
        {
          text: "NONE",
          id: 0,
          description: "No animantion"
        }, {
          text: "BOUNCE",
          id: google.maps.Animation.BOUNCE,
          description: "Repeated bouncing animation"
        }, {
          text: "DROP",
          id: google.maps.Animation.DROP,
          description: "Dropping from sky animation"
        }
      ];
      this.setData(data);
    }
  });

}).call(this);
