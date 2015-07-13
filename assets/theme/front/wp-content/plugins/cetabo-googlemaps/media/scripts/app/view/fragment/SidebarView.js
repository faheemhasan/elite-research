(function() {
  Cetabo.SidebarView = Cetabo.BaseView.extend({
    events: {
      "click .cmap-close-sidebar": "closeSidebar",
      "click .tabs-left a": "openSidebar"
    },
    initialize: function(config) {
      this.config = config;
      this.model = config.model;
      this.channel = config.channel;
      this.visibleTabs = [];
      this.tabs = [];
      Cetabo.EventDistpatcher.use(this.channel).on("screen.resized", this.onScreenResolutionChanged, this);
      Cetabo.EventDistpatcher.use(this.channel).on("screen.updatesize", this.onScreenResolutionChanged, this);
      Cetabo.EventDistpatcher.use(this.channel).on("map.loaded", this.onScreenResolutionChanged, this);
      Cetabo.EventDistpatcher.use(this.channel).on("map.load", this.onLoadMap, this);
      Cetabo.EventDistpatcher.use(this.channel).on("direction.stateupdate", this.onDirectionButtonStateUpdate, this);
      Cetabo.EventDistpatcher.use(this.channel).on("tags.stateupdate", this.onTagsButtonStateUpdate, this);
      Cetabo.EventDistpatcher.use(this.channel).on("places.stateupdate", this.onPlacesButtonStateUpdate, this);
      this.initUIControll();
    },
    initUIControll: function() {
      this.inintTagsTab();
      this.initSidebarMenuAction();
      this.inintPlacesTab();
      this.initDirectionTab();
      this.initSlimScroll();
    },
    onLoadMap: function(model) {
      var defaultOpendTab;
      defaultOpendTab = parseInt(model.get('defaultsidebartab'));
      switch (defaultOpendTab) {
        case Cetabo.SidebarType.DIRECTION:
          this.openSidebarMenu();
          this.openSidebarTab('direction');
          this.onDirectionButtonStateUpdate(true);
          break;
        case Cetabo.SidebarType.PLACES:
          this.openSidebarMenu();
          this.openSidebarTab('places');
          this.onPlacesButtonStateUpdate(true);
          break;
        case Cetabo.SidebarType.TAGS:
          this.openSidebarMenu();
          this.openSidebarTab('tags');
          this.onTagsButtonStateUpdate(true);
      }
    },
    onDirectionButtonStateUpdate: function(enabled) {
      var element;
      element = this.find('.c-direction');
      this.visibleTabs['.c-direction'] = enabled;
      this.updateTabButtonState(element, enabled);
      this.updateMenuButtonState();
    },
    onTagsButtonStateUpdate: function(enabled) {
      var element;
      element = this.find('.c-tags').show();
      this.visibleTabs['.c-tags'] = enabled;
      this.updateTabButtonState(element, enabled);
      this.updateMenuButtonState();
    },
    onPlacesButtonStateUpdate: function(enabled) {
      var element;
      element = this.find('.c-places').show();
      this.visibleTabs['.c-places'] = enabled;
      this.updateTabButtonState(element, enabled);
      this.updateMenuButtonState();
    },
    updateTabButtonState: function(element, state) {
      var boundedTab;
      boundedTab = jQuery('#' + (element.data('bound')));
      if (state) {
        element.show();
      } else {
        element.hide();
        boundedTab.removeClass('active');
      }
    },
    updateMenuButtonState: function() {
      if (!this.isAnyTabVisible()) {
        jQuery(this.config.sidebarTrigger).hide();
      } else {
        jQuery(this.config.sidebarTrigger).show();
      }
    },
    isAnyTabVisible: function() {
      var key, visible;
      visible = false;
      for (key in this.visibleTabs) {
        if (typeof this.visibleTabs[key] !== 'function') {
          visible = visible || this.visibleTabs[key];
        }
      }
      return visible;
    },
    onScreenResolutionChanged: function() {
      this.updateSlimScroll(this.findParent('.cmap-container').height() - 90);
    },
    initSlimScroll: function() {
      this.find('.cmap-sidebar-content-inside').each(function() {
        jQuery(this).niceScroll();
      });
      this.onScreenResolutionChanged();
    },
    updateSlimScroll: function(containerHeight) {
      this.find('.cmap-sidebar-content-inside').each(function() {
        jQuery(this).height(containerHeight);
      });
    },
    initSidebarMenuAction: function() {
      var sidebarMenuButton, _parent;
      _parent = this;
      sidebarMenuButton = jQuery(this.config.sidebarTrigger);
      sidebarMenuButton.on('click', function() {
        _parent.togleSidebar();
      });
    },
    togleSidebar: function() {
      var isOpened;
      isOpened = this.$el.hasClass("cmap-sidebar-open");
      if (isOpened) {
        this.closeSidebar();
      } else {
        this.openSidebarMenu();
      }
    },
    closeSidebar: function() {
      this.closeSidebarMenu();
      this.closeSidebarContent();
    },
    closeSidebarMenu: function() {
      var sidebarMenuButton;
      this.find('').removeClass("cmap-sidebar-open");
      this.find('.nav-tabs .active').removeClass("active");
      sidebarMenuButton = jQuery(this.config.sidebarTrigger);
      sidebarMenuButton.removeClass("cmap-trigger-active");
    },
    closeSidebarContent: function() {
      if (this.find(".cmap-sidebar-content") != null) {
        this.find(".cmap-sidebar-content").hide();
      }
      this.find('.active').removeClass('active');
    },
    openSidebarMenu: function() {
      var sidebarMenuButton;
      this.find('').addClass("cmap-sidebar-open");
      this.find('.nav-tabs .active').addClass("active");
      sidebarMenuButton = jQuery(this.config.sidebarTrigger);
      sidebarMenuButton.addClass("cmap-trigger-active");
    },
    openSidebarTab: function(tab) {
      this.openSidebar();
      if (tab != null) {
        this.find('.ctab-' + tab).addClass('active');
      }
      if (tab != null) {
        this.find('.c-' + tab).addClass('active');
      }
    },
    openSidebar: function() {
      this.find('.cmap-sidebar-content').show();
    },
    inintPlacesTab: function() {
      this.tabs['places'] = new Cetabo.PlacesTabView(this.getSidebarConfiguration('.pins'));
    },
    inintTagsTab: function() {
      this.tabs['tags'] = new Cetabo.TagsTabView(this.getSidebarConfiguration('.tags'));
    },
    initDirectionTab: function() {
      this.tabs['direction'] = new Cetabo.DirectionTabView(this.getSidebarConfiguration('.mapdirection'));
    },
    getSidebarConfiguration: function(tab) {
      return {
        el: "#" + this.enforceELId(this.find(tab)),
        channel: this.getChannel(),
        model: this.model
      };
    }
  });

}).call(this);
