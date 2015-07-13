(function() {
  Cetabo.ThemeProvierModel = Cetabo.BaseProvider.extend({
    initialize: function(config) {
      this.channel = config.channel;
      this.url = config.url;
    },
    invoke: function(callback) {
      var instance;
      instance = this;
      Cetabo.EventDistpatcher.use(this.channel).trigger("backend.send", {
        url: this.url,
        callback: {
          success: function(data) {
            instance.setData(data.themes);
            callback();
          }
        }
      });
    }
  });

}).call(this);
