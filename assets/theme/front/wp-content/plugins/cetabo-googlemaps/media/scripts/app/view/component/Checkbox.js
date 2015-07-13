/*
  Input component
*/


(function() {
  Cetabo.Checkbox = Cetabo.AbstractComponent.extend({
    create: function() {
      var _component;
      _component = this;
      this._instance = jQuery(this.state.el).iCheck({
        checkboxClass: "icheckbox_minimal",
        radioClass: "iradio_minimal"
      }).on("ifChanged", function() {
        _component.onUpdateValue(this.checked);
      });
    },
    onChangeValue: function() {
      jQuery(this.state.el).iCheck(this.value ? 'check' : 'uncheck');
    },
    setEnabled: function(enabled) {
      if (enabled) {
        jQuery(this.state.el).iCheck("enable");
      } else {
        jQuery(this.state.el).iCheck("disable");
      }
    },
    onUpdateValue: function(value) {
      this.setValue(value);
      if (this.state.onChange != null) {
        this.state.onChange(value);
      }
    }
  });

}).call(this);
