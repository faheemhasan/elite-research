/*
  Input component
*/


(function() {
  Cetabo.Input = Cetabo.AbstractComponent.extend({
    create: function() {
      var _component;
      _component = this;
      this._instance = jQuery(this.state.el).change(function() {
        var value;
        value = jQuery(this).val();
        _component.onUpdateValue(value);
      });
      this._instance.val(this.state.value);
    },
    onChangeValue: function() {
      jQuery(this.state.el).val(this.value);
    },
    setEnabled: function(enabled) {},
    onUpdateValue: function(value) {
      this.setValue(value);
      if (this.state.onChange != null) {
        this.state.onChange(value);
      }
    }
  });

}).call(this);
