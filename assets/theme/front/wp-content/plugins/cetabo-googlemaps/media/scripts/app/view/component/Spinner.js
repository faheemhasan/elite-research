/*
  Input component
*/


(function() {
  Cetabo.Spinner = Cetabo.AbstractComponent.extend({
    create: function() {
      var _component;
      _component = this;
      this._instance = jQuery(this.state.el).spinner({
        step: this.state.step,
        numberFormat: this.state.format,
        min: this.state.min,
        max: this.state.max,
        change: function() {
          var val;
          val = jQuery(this).val();
          _component.onUpdateValue(val);
        },
        stop: function() {
          var val;
          val = jQuery(this).val();
          _component.onUpdateValue(val);
        }
      });
    },
    onChangeValue: function() {
      jQuery(this.state.el).val(this.value);
    },
    setEnabled: function(enabled) {
      if (enabled) {
        jQuery(this.state.el).spinner("enable");
      } else {
        jQuery(this.state.el).spinner("disable");
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
