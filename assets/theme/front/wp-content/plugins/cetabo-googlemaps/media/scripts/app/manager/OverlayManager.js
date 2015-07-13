/*
Provide global overlay system
*/


(function() {
  Cetabo.OverlayManager = Cetabo.BaseManager.extend({
    constructor: function(config) {
      var channel;
      channel = config.channel;
      this.config = jQuery.extend({
        el: "#cmap-overlay"
      }, config);
      Cetabo.EventDistpatcher.use(channel).on("overlay.show", this.show, this);
      Cetabo.EventDistpatcher.use(channel).on("overlay.hide", this.hide, this);
    },
    show: function(message) {
      jQuery(this.config.el).modal('show');
    },
    hide: function() {
      jQuery(this.config.el).modal('hide');
    }
  });

}).call(this);
