(function() {
  Cetabo.BaseView = Backbone.View.extend({
    /*
    Get container DOM element id
    */

    getElId: function() {
      return this.enforceELId(this.$el);
    },
    enforceELId: function($expr) {
      if ($expr.attr("id") === undefined) {
        $expr.attr("id", "_elm_" + Math.floor(Math.random() * 100000));
      }
      return $expr.attr("id");
    },
    getChannel: function() {
      if (this.channel === undefined) {
        this.channel = "chn" + Math.floor(Math.random() * 100000);
      }
      return this.channel;
    },
    find: function(selector) {
      return jQuery(this.findIdent(selector));
    },
    findParent: function(selector) {
      return jQuery("#" + this.getElId()).closest(selector);
    },
    findIdent: function(selector) {
      return "#" + this.getElId() + " " + selector;
    }
  });

}).call(this);
