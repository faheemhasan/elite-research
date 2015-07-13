/*
  Base component
*/


(function() {
  Cetabo.ComponentFactory = Cetabo.BaseView.extend({
    components: {},
    /*
      Create component instance
    */

    create: function(type, name, options) {
      switch (type) {
        case 'input':
          this.components[name] = new Cetabo.Input(options);
          break;
        case 'checkbox':
          this.components[name] = new Cetabo.Checkbox(options);
          break;
        case 'rangeslider':
          this.components[name] = new Cetabo.RangeSlider(options);
          break;
        case 'select':
          this.components[name] = new Cetabo.Select(options);
          break;
        case 'slider':
          this.components[name] = new Cetabo.Slider(options);
          break;
        case 'spinner':
          this.components[name] = new Cetabo.Spinner(options);
      }
    },
    /*
      Get component instance by name
    */

    instance: function(name) {
      return this.components[name];
    },
    /*
      Set value of field
    */

    setValue: function(name, value) {
      this.components[name].setValue(value);
    },
    /*
      Get value of field
    */

    getValue: function(name) {
      return this.components[name].getValue();
    }
  });

}).call(this);
