(function() {
  Cetabo.DirectionTypeProviderModel = Cetabo.BaseProvider.extend({
    initialize: function() {
      var data;
      data = [
        {
          text: "DRIVING",
          id: google.maps.TravelMode.DRIVING,
          description: "Indicates standard driving directions using the road network."
        }, {
          text: "BICYCLING",
          id: google.maps.TravelMode.BICYCLING,
          description: "Requests bicycling directions via bicycle paths & preferred streets."
        }, {
          text: "TRANSIT",
          id: google.maps.TravelMode.TRANSIT,
          description: "Requests directions via public transit routes"
        }, {
          text: "WALKING",
          id: google.maps.TravelMode.WALKING,
          description: "Requests walking directions via pedestrian paths & sidewalks"
        }
      ];
      this.setData(data);
    }
  });

}).call(this);
