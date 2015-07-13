/*
Provide global notification system
*/


(function() {
  Cetabo.NotificationsManager = Cetabo.BaseManager.extend({
    constructor: function(config) {
      var channel;
      channel = config.channel;
      this.config = jQuery.extend({
        el: "#notification"
      }, config);
      Cetabo.EventDistpatcher.use(channel).on("notification.show", this.show, this);
    },
    show: function(message) {
      jQuery(this.config.el).html(message).fadeIn(500).delay(4000).fadeOut();
    }
  });

}).call(this);
