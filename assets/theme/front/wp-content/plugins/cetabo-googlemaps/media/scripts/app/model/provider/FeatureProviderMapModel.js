(function() {
  Cetabo.FeatureProviderMapModel = Cetabo.BaseProvider.extend({
    initialize: function() {
      var featureTypes;
      featureTypes = [
        {
          id: "administrative",
          text: "administrative",
          description: "Apply the rule to administrative areas."
        }, {
          id: "administrative.country",
          text: "administrative.country",
          description: "Apply the rule to countries."
        }, {
          id: "administrative.land_parcel",
          text: "administrative.land_parcel",
          description: "Apply the rule to land parcels."
        }, {
          id: "administrative.locality",
          text: "administrative.locality",
          description: "Apply the rule to localities."
        }, {
          id: "administrative.neighborhood",
          text: "administrative.neighborhood",
          description: "Apply the rule to neighborhoods."
        }, {
          id: "administrative.province",
          text: "administrative.province",
          description: "Apply the rule to provinces."
        }, {
          id: "all",
          text: "all",
          description: "Apply the rule to all selector types."
        }, {
          id: "landscap",
          text: "landscap",
          description: "Apply the rule to landscapes."
        }, {
          id: "landscape.man_made",
          text: "landscape.man_made",
          description: "Apply the rule to man made structures."
        }, {
          id: "landscape.natural",
          text: "landscape.natural",
          description: "Apply the rule to natural features."
        }, {
          id: "landscape.natural.landcover",
          text: "landscape.natural.landcover",
          description: "Apply the rule to landcover."
        }, {
          id: "landscape.natural.terrain\t",
          text: "landscape.natural.terrain\t",
          description: "Apply the rule to terrain."
        }, {
          id: "poi",
          text: "poi",
          description: "Apply the rule to points of interest."
        }, {
          id: "poi.attraction",
          text: "poi.attraction",
          description: "Apply the rule to attractions for tourist"
        }, {
          id: "poi.business",
          text: "poi.business",
          description: "Apply the rule to businesses."
        }, {
          id: "poi.government",
          text: "poi.government",
          description: "Apply the rule to government buildings."
        }, {
          id: "poi.medical",
          text: "poi.medical",
          description: "Apply the rule to emergency services (hospi"
        }, {
          id: "poi.park",
          text: "poi.park",
          description: "Apply the rule to parks."
        }, {
          id: "poi.place_of_worship",
          text: "poi.place_of_worship",
          description: "Apply the rule to places of worship, such as church, temple, or mosque."
        }, {
          id: "poi.school",
          text: "poi.school",
          description: "Apply the rule to schools."
        }, {
          id: "poi.sports_complex",
          text: "poi.sports_complex",
          description: "Apply the rule to sports complexes."
        }, {
          id: "road",
          text: "road",
          description: "Apply the rule to all roads."
        }, {
          id: "road.arterial",
          text: "road.arterial",
          description: "Apply the rule to arterial roads."
        }, {
          id: "road.highway",
          text: "road.highway",
          description: "Apply the rule to highways."
        }, {
          id: "road.highway.controlled_access",
          text: "road.highway.controlled_access",
          description: "Apply the rule to controlled-access highways."
        }, {
          id: "road.local",
          text: "road.local",
          description: "Apply the rule to local roads."
        }, {
          id: "transit",
          text: "transit",
          description: "Apply the rule to all transit stations and lines."
        }, {
          id: "transit.line",
          text: "transit.line",
          description: "Apply the rule to transit lines."
        }, {
          id: "transit.station",
          text: "transit.station",
          description: "Apply the rule to all transit stations."
        }, {
          id: "transit.station.airport",
          text: "transit.station.airport",
          description: "Apply the rule to airports."
        }, {
          id: "transit.station.bus",
          text: "transit.station.bus",
          description: "Apply the rule to bus stops."
        }, {
          id: "transit.station.rail",
          text: "transit.station.rail",
          description: "Apply the rule to rail stations."
        }, {
          id: "water",
          text: "water",
          description: "Apply the rule to bodies of water."
        }
      ];
      this.setData(featureTypes);
    },
    getDefault: function() {
      return undefined;
    }
  });

}).call(this);
