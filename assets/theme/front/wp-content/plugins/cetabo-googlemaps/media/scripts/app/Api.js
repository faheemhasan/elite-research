(function() {
  window.Cetabo || (window.Cetabo = {});

  window.google || (window.google = {});

  google.maps || (google.maps = {});

  Cetabo.Api = {
    maps: [],
    create: function(options, alias) {
      var map;
      if (alias != null) {
        alias = "map" + Math.floor(Math.random() * 100000);
      }
      map = new Cetabo.MapView(options);
      this.maps[alias] = map;
      map.loadModel(options.id);
      return map;
    }
  };

}).call(this);
