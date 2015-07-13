/*
  Input component
*/


(function() {
  Cetabo.RangeSlider = Cetabo.AbstractComponent.extend({
    create: function() {
      var _component;
      _component = this;
      this._instance = jQuery(this.state.el).slider({
        range: this.state.range,
        min: this.state.min,
        max: this.state.max,
        values: this.state.values,
        slide: function(event, ui) {
          var maxval, minval;
          minval = ui.values[0];
          maxval = ui.values[1];
          _component.onUpdateValue({
            min: minval,
            max: maxval
          });
        }
      });
    },
    onChangeValue: function() {
      if (this.created) {
        jQuery(this.state.el).slider("values", [this.value.min, this.value.max]);
      }
    },
    setEnabled: function(enabled) {
      if (enabled) {
        jQuery(this.state.el).slider("enable");
      } else {
        jQuery(this.state.el).slider("disable");
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
