/*
Provide functionality to toggle full screen
*/


(function() {
  Cetabo.FullscreenView = Cetabo.BaseView.extend({
    events: {
      "click .cmap-fullscreen": "toggleFullscreen"
    },
    isFullscreen: false,
    bodyState: [],
    tempPlaceHolder: jQuery("<div class=\"__tempPlaceHolder\"></div>"),
    $win: jQuery(window),
    initialize: function(config) {
      this.config = config;
      this.initFullscreenObserver();
    },
    resizeFullscreen: function() {
      var $html, containerId, size;
      containerId = "#" + this.getElId();
      $html = jQuery("html");
      $html.css({
        overflow: "hidden"
      });
      size = this.getFullscreenSize();
      jQuery(containerId).addClass("cmap-container-fullscreen");
      jQuery(containerId).css({
        position: "fixed",
        width: size.width,
        height: size.height,
        top: 0,
        left: 0,
        bottom: 0,
        zIndex: 1000010
      });
      this.tempPlaceHolder.insertBefore(containerId);
      jQuery(containerId).appendTo("body");
      jQuery("html").css("overflow", "hidden");
      jQuery("body").css("overflow", "hidden");
      this.onResizeFullscreen(size.width, size.height);
    },
    getFullscreenSize: function() {
      var isiOS, result, winHeight, winWidth;
      winWidth = this.$win.width();
      winHeight = this.$win.height();
      isiOS = /(iPad|iPhone|iPod)/g.test(navigator.userAgent);
      if (isiOS) {
        winHeight = this.getIOSWindowHeight();
      }
      result = {
        width: winWidth,
        height: winHeight
      };
      return result;
    },
    getIOSWindowHeight: function() {
      var zoomLevel;
      zoomLevel = document.documentElement.clientWidth / window.innerWidth;
      return window.innerHeight * zoomLevel;
    },
    getHeightOfIOSToolbars: function() {
      var tH;
      tH = (window.orientation === 0 ? screen.height : screen.width) - this.getIOSWindowHeight();
      return (tH > 1 ? tH : 0);
    },
    initOnResize: function() {
      var containerId, size;
      size = this.getFullscreenSize();
      containerId = "#" + this.getElId();
      jQuery(containerId).css({
        width: size.width,
        height: size.height
      });
      this.onResizeFullscreen(size.width, size.height);
    },
    resizeToDefault: function() {
      var containerId, size, tempHolder;
      containerId = "#" + this.getElId();
      size = this.getOriginalSize();
      tempHolder = jQuery(".__tempPlaceHolder");
      jQuery("html").removeAttr("style");
      jQuery(containerId).removeClass("cmap-container-fullscreen");
      jQuery(containerId).css({
        position: "relative",
        width: size.width,
        height: size.height,
        zIndex: 10
      });
      this.onResizeOriginalSize(size.width, size.height);
      tempHolder.replaceWith(jQuery(containerId));
    },
    initFullscreenObserver: function() {
      var instance;
      instance = this;
      jQuery(window).resize(function() {
        if (instance.isFullscreen) {
          instance.initOnResize();
        }
      });
    },
    toggleFullscreen: function() {
      this.setFullscreen(!this.isFullscreen);
    },
    setFullscreen: function(fullscreen) {
      this.isFullscreen = fullscreen;
      if (fullscreen) {
        this.resizeFullscreen();
        this.find('.cmap-fullscreen').addClass("cmap-is-fullscreen");
      } else {
        this.resizeToDefault();
        this.find('.cmap-fullscreen').removeClass("cmap-is-fullscreen");
      }
    },
    onResizeOriginalSize: function() {},
    onResizeFullscreen: function() {}
  });

}).call(this);
