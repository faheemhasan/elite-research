/*
  Provide global access to cached templates
*/


(function() {
  Cetabo.TemplateManager = {
    template: {},
    registerHelpersIfRequired: function() {
      if (this.inited != null) {
        return;
      }
      this.inited = true;
      return Handlebars.registerHelper("list", function(items, options) {
        var i, out;
        out = "";
        i = 0;
        while (i < items.length) {
          out = out + options.fn(items[i]);
          i++;
        }
        return out;
      });
    },
    /*
      Get template by name
    */

    getTemplateByName: function(name) {
      this.registerHelpersIfRequired();
      if (this.template[name] === undefined) {
        this.template[name] = Handlebars.compile(jQuery(name).html());
      }
      return this.template[name];
    }
  };

}).call(this);
