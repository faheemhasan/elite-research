(function() {
  Cetabo.StylerView = Cetabo.AbstractAccordionView.extend({
    events: function() {
      return _.extend({}, Cetabo.AbstractAccordionView.prototype.events, {
        "click .apply": "apply",
        "click .save-theme": "saveTheme"
      });
    },
    initialize: function(config) {
      this.initAccordionControl();
      this.model = config.model;
      this.channel = config.channel;
      this.config = config;
      this.elementProviderModel = new Cetabo.ElementProviderMapModel();
      this.featureProviderModel = new Cetabo.FeatureProviderMapModel();
      this.mapVisibilityProviderModel = new Cetabo.MapVisibilityProviderModel();
      this.componentFactory = new Cetabo.ComponentFactory();
      Cetabo.EventDistpatcher.use(this.channel).on("map.load", this.onLoadMap, this);
      this.initThemeSelector(config);
    },
    onLoadMap: function(model) {
      this.updateAccordionFromModel(model);
    },
    updateAccordionFromModel: function(model) {
      var key, stylers;
      stylers = model.get("stylers");
      for (key in stylers) {
        this.bindModel(key, stylers[key]);
        this.updateStylerHeader(stylers[key]);
      }
    },
    afterElementCreation: function(id) {
      var style;
      style = this.getStylerById(id);
      this.initStylerElementSelector(style);
      this.initStylerFeatureSelector(style);
      this.initStylerVisiblitySelector(style);
      this.initStylerColorPicker(style);
      this.initStylerSaturationSelector(style);
      this.initStylerLightnessSelector(style);
      this.initStylerGammaSelector(style);
    },
    initStylerGammaSelector: function(styler) {
      var instance;
      instance = this;
      jQuery("#" + styler.get("id") + " .gamma").val(styler.getStyler("gamma"));
      jQuery("#" + styler.get("id") + " .gamma").spinner({
        step: 0.01,
        min: 0.01,
        max: 10,
        numberFormat: "n",
        change: function() {
          var value;
          value = this.value;
          styler.setStyler("gamma", value);
          instance.apply();
        },
        stop: function() {
          var value;
          value = this.value;
          styler.setStyler("gamma", value);
          instance.apply();
        }
      });
    },
    initStylerLightnessSelector: function(styler) {
      var instance;
      jQuery("#" + styler.get("id") + " .lightness").val(styler.getStyler("lightness"));
      instance = this;
      jQuery("#" + styler.get("id") + " .lightness").spinner({
        step: 1,
        min: -100,
        max: 100,
        numberFormat: "n",
        change: function() {
          var value;
          value = this.value;
          styler.setStyler("lightness", value);
          instance.apply();
        },
        stop: function() {
          var value;
          value = this.value;
          styler.setStyler("lightness", value);
          instance.apply();
        }
      });
    },
    initStylerSaturationSelector: function(styler) {
      var instance;
      jQuery("#" + styler.get("id") + " .saturation").val(styler.getStyler("saturation"));
      instance = this;
      jQuery("#" + styler.get("id") + " .saturation").spinner({
        step: 1,
        min: -100,
        max: 100,
        numberFormat: "n",
        change: function() {
          var value;
          value = this.value;
          styler.setStyler("saturation", value);
          instance.apply();
        },
        stop: function() {
          var value;
          value = this.value;
          styler.setStyler("saturation", value);
          instance.apply();
        }
      });
    },
    /*
    Handle feature visibility
    @param styler
    */

    initStylerVisiblitySelector: function(styler) {
      var instance;
      if (styler.getStyler("visibility") == null) {
        styler.setStyler("visibility", "on");
      }
      instance = this;
      instance.changeStylerVisiblity(styler, styler.getStyler("visibility"));
      new Cetabo.Select2Adaptor({
        el: "#" + styler.get("id") + " .visibility",
        provider: this.mapVisibilityProviderModel,
        onMatchSelection: function(obj) {
          return obj !== undefined && obj.id === styler.getStyler("visibility");
        },
        onFormatResult: function(item) {
          return "<div class='place-icon-selector'>" + item.text + "<div class='description'>" + item.description + "</div></div>";
        },
        onFormatSelection: function(item) {
          return item.text;
        },
        onSelect: function(item) {
          styler.setStyler("visibility", item.id);
          instance.changeStylerVisiblity(styler, item.id);
          instance.apply();
        }
      });
    },
    /*
    Theam selector
    */

    initThemeSelector: function(config) {
      var channel, instance;
      instance = this;
      channel = this.channel;
      this.componentFactory.create('select', 'theme', {
        el: this.findIdent(".theme"),
        provider: new Cetabo.ThemeProvierModel({
          url: config.url.themes,
          channel: this.channel
        }),
        onChange: function(id, item) {
          

          Cetabo.EventDistpatcher.use(channel).trigger("backend.send", {
            url: item.url,
            callback: {
              success: function(theme) {
                instance.removeAll();
                instance.model.fillStylerModelFromTheme(theme);
                instance.updateAccordionFromModel(instance.model);
                instance.apply();
              }
            }
          });
          

        }
      });
    },
    /*
    Change visibility of styler
    @param styler
    @param visibility
    */

    changeStylerVisiblity: function(styler, visibility) {
      if (visibility === "off") {
        jQuery("#" + styler.get("id") + " .visibility-bound").hide();
      } else {
        jQuery("#" + styler.get("id") + " .visibility-bound").show();
      }
    },
    initStylerCheckBoxes: function(styler) {
      var instance;
      instance = this;
      jQuery("#" + styler.get("id") + " .visibility").change(function() {
        var value;
        value = jQuery(this).is(":checked");
        styler.setStyler("visibility", (value ? "on" : "off"));
        instance.apply();
      });
      jQuery("#" + styler.get("id") + " .inverse-lightness").change(function() {
        var value;
        value = jQuery(this).is(":checked");
        styler.setStyler("inverse", value);
        instance.apply();
      });
    },
    initStylerColorPicker: function(styler) {
      var color, instance;
      instance = this;
      color = jQuery("#" + styler.get("id") + " .color");
      color.val(styler.getStyler("color"));
      color.change(function() {
        var value;
        value = jQuery(this).val();
        styler.setStyler("color", "#" + value);
        instance.apply();
      });
      jscolor.bind();
    },
    initStylerElementSelector: function(styler) {
      var instance;
      instance = this;
      new Cetabo.Select2Adaptor({
        el: "#" + styler.get("id") + " .element-type",
        provider: this.elementProviderModel,
        onMatchSelection: function(obj) {
          return obj !== undefined && obj.id === styler.get("elementType");
        },
        onFormatResult: function(item) {
          return "<div class='place-icon-selector'>" + item.text + "<div class='description'>" + item.description + "</div></div>";
        },
        onFormatSelection: function(item) {
          return item.text;
        },
        onSelect: function(item) {
          styler.set("elementType", item.id);
          instance.apply();
        }
      });
    },
    initStylerFeatureSelector: function(styler) {
      var instance;
      instance = this;
      new Cetabo.Select2Adaptor({
        el: "#" + styler.get("id") + " .feature-type",
        provider: this.featureProviderModel,
        onMatchSelection: function(obj) {
          return obj !== undefined && obj.id === styler.get("featureType");
        },
        onFormatResult: function(item) {
          return "<div class='place-icon-selector'>" + item.text + "<div class='description'>" + item.description + "</div></div>";
        },
        onFormatSelection: function(item) {
          return item.text;
        },
        onSelect: function(item) {
          styler.set("featureType", item.id);
          instance.apply();
          instance.updateStylerHeader(styler);
        }
      });
    },
    updateStylerHeader: function(styler) {
      var feature, id;
      id = styler.get("id");
      feature = styler.get("featureType");
      if (feature === undefined) {
        return;
      }
      jQuery("#name-lable-" + id).html(styler.get("featureType"));
    },
    getStylerById: function(id) {
      return this.model.getStylerById(id);
    },
    createAccordionElement: function(id) {
      var template;
      template = Cetabo.TemplateManager.getTemplateByName("#template-style");
      return template({
        'id': id
      });
    },
    createAccordionElementDataModel: function(id) {
      var model;
      model = new Cetabo.StylerModel({
        id: id,
        channel: this.getChannel()
      });
      this.model.addStyler(id, model);
    },
    afterElementRemoval: function(id) {
      this.model.removeStyler(id);
      this.apply();
    },
    apply: function() {
      var channel;
      channel = this.getChannel();
      Cetabo.EventDistpatcher.use(channel).trigger("styler.update", this.model.buildMapStyler());
    },
    saveTheme: function() {
      

      var channel, instance;
      channel = this.channel;
      instance = this;
      Cetabo.EventDistpatcher.use(channel).trigger("backend.send", {
        url: this.config.url.persist_theme,
        content: {
          theme: this.model.getStylersAsTheme()
        },
        callback: {
          success: function(data) {
            if (data === undefined || data.success !== true) {
              Cetabo.EventDistpatcher.use(channel).trigger("notification.show", "Theme was not saved, an error has occurred");
            } else {
              Cetabo.EventDistpatcher.use(channel).trigger("notification.show", "Theme " + data.theme_name + " was successfully saved");
              instance.initThemeSelector();
            }
          }
        }
      });
      

    }
  });

}).call(this);
