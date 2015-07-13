/*
  Input component
*/


(function() {
  Cetabo.Select = Cetabo.AbstractComponent.extend({
    create: function() {
      var _component;
      _component = this;
      this._instance = new Cetabo.Select2Adaptor({
        el: this.state.el,
        provider: this.state.provider,
        onMatchSelection: function(obj) {
          return obj !== undefined && obj.id === _component.getValue();
        },
        onFormatResult: function(item) {
          return "<div class='c-selector'>" + item.text + "<div class='description'>" + item.description + "</div></div>";
        },
        onFormatSelection: function(item) {
          return item.text;
        },
        onSelect: function(item) {
          _component.onUpdateValue(item.id, item);
        }
      });
    },
    setEnabled: function(enabled) {
      this._instance.setEnabled(enabled);
    },
    onChangeValue: function() {
      jQuery(this.state.el).select2("val", this.value);
    },
    onUpdateValue: function(value, item) {
      this.setValue(value);
      if (this.state.onChange != null) {
        this.state.onChange(value, item);
      }
    }
  });

}).call(this);
