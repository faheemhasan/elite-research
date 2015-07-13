/*
Provide global communication system to backend
*/


(function() {
  Cetabo.ConnectionManager = Cetabo.BaseManager.extend({
    /*
      Initializate the connection manager
    */

    constructor: function(config) {
      var channel;
      channel = config.channel;
      Cetabo.EventDistpatcher.use(channel).on("backend.send", this.send, this);
      this.config = config;
    },
    /*
      Send AJAX backend message
    */

    send: function(message) {
      var options, url;
      options = message.callback;
      url = message.url;
      jQuery.ajax({
        url: message.url,
        type: "POST",
        dataType: "json",
        data: message.content,
        /*
          Success callback
        */

        success: function(object, status) {
          if (options !== undefined && options.success) {
            options.success(object);
          }
        },
        /*
          Error callback
        */

        error: function(xhr, status, error) {
          if (options !== undefined && options.error) {
            options.error(error);
          }
        }
      });
    }
  });

}).call(this);
