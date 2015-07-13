/*
  Input component
*/


(function() {
  Cetabo.Slider = Cetabo.AbstractComponent.extend({
    create: function() {
      var _component;
      _component = this;
      this._instance = jQuery(this.state.el).slider({
        range: this.state.range,
        min: this.state.min,
        max: this.state.max,
        value: this.state.value,
        slide: function(event, ui) {
          var val;
          val = ui.value;
          _component.onUpdateValue(val);
        }
      });
    },
    onChangeValue: function() {
      if (this.created) {
        jQuery(this.state.el).slider("value", this.value);
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
