/*
  Base component
*/


(function() {
  Cetabo.AbstractComponent = Cetabo.BaseView.extend({
    initialize: function(state) {
      this.state = state;
      if (this.state.value) {
        this.setValue(this.state.value);
      }
      this.create();
      this.setEnabled(this.isEnabled());
      this.created = true;
    },
    setValue: function(value) {
      var isSameValue;
      isSameValue = this.value === value;
      this.value = value;
      if (!isSameValue) {
        this.onChangeValue();
      }
    },
    isEnabled: function() {
      var isDisabled, isParentDisabled;
      isDisabled = jQuery(this.state.el).hasClass('c_DUMMY_AAA123AAA');
      isParentDisabled = jQuery(this.state.el).closest('.c_DUMMY_AAA123AAA').length > 0;
      return !(isDisabled || isParentDisabled);
    },
    onChangeValue: function() {},
    getValue: function() {
      return this.value;
    }
  });

}).call(this);
