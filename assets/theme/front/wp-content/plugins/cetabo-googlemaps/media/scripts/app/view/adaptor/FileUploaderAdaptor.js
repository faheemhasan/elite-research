(function() {
  Cetabo.FileUploaderAdaptor = Cetabo.BaseView.extend({
    initialize: function(config) {
      var mediaFileController, wp_media_post_id;
      mediaFileController = void 0;
      wp_media_post_id = wp.media.model.settings.post.id;
      jQuery(config.el).live("click", function(event) {
        event.preventDefault();
        if (mediaFileController) {
          mediaFileController.open();
          return;
        }
        mediaFileController = wp.media.frames.file_frame = wp.media({
          title: jQuery(this).data("uploader_title"),
          library: {
            type: "image"
          },
          button: {
            text: jQuery(this).data("uploader_button_text")
          },
          multiple: false
        });
        mediaFileController.on("select", function() {
          var attachment;
          attachment = mediaFileController.state().get("selection").first().toJSON();
          config.onSelectAttachment(attachment);
          wp.media.model.settings.post.id = wp_media_post_id;
        });
        mediaFileController.open();
      });
      jQuery("a.add_media").on("click", function() {
        wp.media.model.settings.post.id = wp_media_post_id;
      });
    }
  });

}).call(this);
