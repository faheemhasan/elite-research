(function() {
  Cetabo.MapModeProvierModel = Cetabo.BaseProvider.extend({
    initialize: function() {
      var data;
      data = [
        {
          text: "MAP",
          id: google.maps.MapMode.MAP,
          description: "Displays the default map mode"
        }, {
          text: "STREET",
          id: google.maps.MapMode.STREET,
          description: "Displays street view mode"
        }
      ];
      this.setData(data);
    }
  });

}).call(this);
