(function() {
  Cetabo.SidebarType = {
    NONE: 0,
    TAGS: 1,
    PLACES: 2,
    DIRECTION: 3
  };

  Cetabo.SidebarTypeProviderModel = Cetabo.BaseProvider.extend({
    initialize: function() {
      var data;
      data = [
        {
          text: "NONE",
          id: 0,
          description: "Noting is opened"
        }, {
          text: "TAGS",
          id: 1,
          description: "Show tags tab opened"
        }, {
          text: "PLACES",
          id: 2,
          description: "Show places tab opened"
        }, {
          text: "DIRECTION",
          id: 3,
          description: "Show direction tab opened"
        }
      ];
      this.setData(data);
    }
  });

}).call(this);
