(function() {
  Cetabo.SearchView = Cetabo.BaseView.extend({
    events: {
      "click .cmap-search-submit": "toggleSearch"
    },
    searchOpen: false,
    initialize: function(config) {
      var channel, searchButton, searchInput, uiAutoData;
      this.config = config;
      this.model = config.model;
      this.channel = config.channel;
      channel = this.getChannel();
      searchButton = this.find(".cmap-search-submit");
      searchInput = this.find(".cmap-search-input");
      this.searchAddresSearchPicker = searchInput.addresspicker({
        updateCallback: function(geocodeResult, parsedGeocodeResult) {
          Cetabo.EventDistpatcher.use(channel).trigger("map.updatecenter", parsedGeocodeResult.lat, parsedGeocodeResult.lng);
          Cetabo.EventDistpatcher.use(channel).trigger("map.updatezoom", 10);
        }
      });
      uiAutoData = searchInput.data("ui-autocomplete");
      if (uiAutoData != null) {
        jQuery("#" + uiAutoData.menu.activeMenu.context.id).addClass("cmap-autocompleate-result");
      }
    },
    openSearch: function() {
      this.$el.addClass('cmap-show-search');
    },
    closeSearch: function() {
      this.$el.removeClass('cmap-show-search');
    },
    toggleSearch: function() {
      this.searchOpen = !this.searchOpen;
      if (this.searchOpen) {
        this.openSearch();
      } else {
        this.closeSearch();
      }
    }
  });

}).call(this);
