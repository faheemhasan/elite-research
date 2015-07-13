(function() {
  Cetabo.ContentManager = Cetabo.BaseManager.extend({
    initialize: function(config) {
      var channel;
      this.config = config;
      channel = this.get("channel");
      this.initEditor();
      Cetabo.EventDistpatcher.use(channel).on("content.change", this.onContentChange, this);
      Cetabo.EventDistpatcher.use(channel).on("content.persist", this.onContentPersit, this);
      Cetabo.EventDistpatcher.use(channel).on("content.hide", this.hideEditor, this);
      Cetabo.EventDistpatcher.use(channel).on("content.show", this.showEditor, this);
    },
    onContentChange: function(content, callback) {
      this.showEditor();
      this.setContent((content !== undefined ? content : ""));
      this.setUpdateCallback(callback);
      this.rebindEvents(this);
    },
    setUpdateCallback: function(callback) {
      this.updateCallback = callback;
    },
    onContentPersit: function(persistCallback) {
      persistCallback(this.getContent());
    },
    initEditor: function() {
      this.hideEditor();
      this.rebindEvents(this);
    },
    rebindEvents: function(instance) {
      this.getHtmlEditor().keyup(function() {
        if (instance.updateCallback === undefined) {
          return;
        }
        instance.updateCallback(instance.getContent());
      });
      if (this.getRichEditor() !== null) {
        this.getRichEditor().onKeyUp.add(function(ed, l) {
          if (instance.updateCallback === undefined) {
            return;
          }
          instance.updateCallback(instance.getContent());
        });
        this.getRichEditor().onChange.add(function(ed, l) {
          if (instance.updateCallback === undefined) {
            return;
          }
          instance.updateCallback(instance.getContent());
        });
      }
    },
    showEditor: function() {
      this.getEditorContainer().show();
    },
    hideEditor: function() {
      this.getEditorContainer().hide();
    },
    getEditorContainer: function() {
      return jQuery("#wp-" + this.config.el + "-wrap");
    },
    /*
    Get content
    */

    getContent: function() {
      var editor;
      editor = this.getEditor();
      if (this.isRichEditorActive()) {
        return editor.getContent();
      } else {
        return editor.val();
      }
    },
    /*
    Set content
    */

    setContent: function(content) {
      var editor;
      editor = this.getEditor();
      if (editor === undefined || (editor == null)) {
        return;
      }
      if (this.isRichEditorActive()) {
        editor.setContent(content);
      } else {
        editor.val(content);
      }
    },
    isRichEditorActive: function() {
      return jQuery("#wp-" + this.config.el + "-wrap").hasClass("tmce-active");
    },
    getRichEditor: function() {
      return tinyMCE.activeEditor;
    },
    getHtmlEditor: function() {
      return jQuery("#" + this.config.el);
    },
    getEditor: function() {
      if (this.isRichEditorActive()) {
        return this.getRichEditor();
      } else {
        return this.getHtmlEditor();
      }
    }
  });

}).call(this);
