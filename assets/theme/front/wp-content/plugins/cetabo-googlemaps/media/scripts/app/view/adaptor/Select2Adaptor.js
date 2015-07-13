(function() {
  Cetabo.Select2Adaptor = Cetabo.BaseView.extend({
    initialize: function(config) {
      var instance;
      this.config = config;
      instance = this;
      config.provider.invoke(function() {
        instance.fill();
      });
      Cetabo.EventDistpatcher.use(config.channel).on("select2.update", this.onDataUpdate, this);
    },
    fill: function() {
      var config, selectedItem, selector;
      config = this.config;
      selectedItem = config.provider.valueOf(function(obj) {
        return config.onMatchSelection(obj);
      });
      selector = jQuery(config.el);
      this.refreshSelect2(selector);
      if (selectedItem !== undefined) {
        if (selectedItem.id !== undefined) {
          selector.select2("val", selectedItem.id);
        } else {
          selector.select2("val", config.provider.getDefault());
        }
      }
      selector.on("select2-selecting", function(event) {
        config.onSelect(event.object);
      });
    },
    refreshSelect2: function(selector) {
      var config;
      config = this.config;
      selector.select2("destroy");
      selector.select2({
        data: config.provider.getDataModel(),
        formatResult: function(item) {
          return config.onFormatResult(item);
        },
        formatSelection: function(item) {
          return config.onFormatSelection(item);
        },
        escapeMarkup: function(item) {
          return item;
        }
      }, true);
      this.updateEnabledState();
    },
    setEnabled: function(enabled) {
      this.enabled = enabled;
      this.updateEnabledState();
    },
    updateEnabledState: function() {
      var selector;
      selector = jQuery(this.config.el);
      selector.select2("enable", this.enabled);
    },
    onDataUpdate: function(attachment) {
      var selector;
      selector = jQuery(this.config.el);
      if (attachment !== undefined) {
        this.refreshSelect2(selector);
        selector.select2("val", attachment.id);
      }
    }
  });

}).call(this);
