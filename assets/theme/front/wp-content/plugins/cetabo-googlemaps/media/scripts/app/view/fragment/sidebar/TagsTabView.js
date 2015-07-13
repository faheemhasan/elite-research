(function() {
  Cetabo.TagsTabView = Cetabo.BaseView.extend({
    events: {
      "click .place-tag": "filterPlaces"
    },
    initialize: function(config) {
      this.config = config;
      this.model = config.model;
      this.channel = config.channel;
      this.tags = [];
      Cetabo.EventDistpatcher.use(this.channel).on("map.load", this.onLoadMapCallback, this);
      Cetabo.EventDistpatcher.use(this.channel).on("place.updateTag", this.onUpdatePlaceTag, this);
    },
    onUpdatePlaceTag: function(place) {
      this.resetTagSelection();
      this.onLoadMapCallback(this.model);
    },
    resetTagSelection: function() {
      this.tags = [];
      this.find('.place-tag').removeClass('active');
      Cetabo.EventDistpatcher.use(this.channel).trigger("place.filter", {
        tags: this.tags
      });
    },
    onLoadMapCallback: function(model) {
      var html, tags, template;
      tags = model.getMapTags();
      template = Cetabo.TemplateManager.getTemplateByName("#template-tags");
      html = template({
        'tags': tags
      });
      this.find('').html(html);
      this.delegateEvents();
    },
    filterPlaces: function(event) {
      var target;
      target = event.currentTarget;
      this.fillCriteria(target);
      this.setActiveTag(target);
      Cetabo.EventDistpatcher.use(this.channel).trigger("place.filter", {
        tags: this.tags
      });
      return false;
    },
    fillCriteria: function(target) {
      var active, index, tagName;
      tagName = jQuery(target).data('tag');
      active = this.isActiveTag(target);
      if (!active) {
        this.tags.push(tagName);
      } else {
        index = this.tags.indexOf(tagName);
        if (index > -1) {
          this.tags.splice(index, 1);
        }
      }
    },
    isActiveTag: function(target) {
      return jQuery(target).hasClass('active-tag');
    },
    setActiveTag: function(target) {
      if (this.isActiveTag(target)) {
        jQuery(target).removeClass('active-tag');
      } else {
        jQuery(target).addClass('active-tag');
      }
    }
  });

}).call(this);
