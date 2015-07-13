<footer id="dslc-content" class="site-footer dslc-content dslc-clearfix"><div id="dslc-footer" class="dslc-content dslc-clearfix">
	

<!-- testimonials -->
<!-- testimonials -->
<!-- testimonials -->
<?php $testimonials = get_result('testimonials'); ?>
<div id="" class="dslc-modules-section " style="border-style:solid; border-right-style: hidden; border-left-style: hidden; background-color:rgba(255, 255, 255, 0); background-image: url('<?php echo base_url() ?>assets/theme/front/wp-content/uploads/2014/10/images.jpg'); background-repeat:no-repeat; background-position:center center; background-attachment:scroll; background-size:cover; padding-top:10px; padding-bottom:10px; ">
	<?php if($testimonials): ?>
	<div class="dslc-modules-section-wrapper dslc-clearfix"> 
		<div class="dslc-modules-area dslc-col dslc-12-col dslc-last-col" data-size="12"> 
			<div id="dslc-module-232" class="dslc-module-front dslc-module-DSLC_Testimonials dslc-in-viewport-check dslc-in-viewport-anim-none" data-module-id="232" data-dslc-module-id="DSLC_Testimonials" data-dslc-module-size="12" data-dslc-anim="none" data-dslc-anim-delay="0" data-dslc-anim-easing="ease">
				<div class="dslc-posts dslc-testimonials dslc-clearfix ">
					<div class="dslc-loader"></div>
					<div class="dslc-carousel" data-columns="1" data-pagination="true">
						
						
					<?php foreach($testimonials as $row): ?>
						<div class="dslc-post dslc-testimonial dslc-carousel-item dslc-col dslc-12-col  dslc-last-col" data-cats="">
							<div class="dslc-testimonial-inner">	
								<div class="dslc-testimonial-author dslc-testimonial-author-pos-outside-right dslc-clearfix">
									<div class="dslc-testimonial-author-avatar">
										<img width="400" height="400" src="<?php echo base_url() ?>assets/uploads/testimonials/<?php echo $row->image; ?>" class="attachment-full wp-post-image" alt="avatar-1 copy" />									
									</div>
									<div class="dslc-testimonial-author-main">
										<div class="dslc-testimonial-author-name">
											<?php echo ucwords($row->name); ?>								
										</div>
										<div class="dslc-testimonial-author-position">
											<?php echo ucwords($row->position); ?>								
										</div>
									</div>
								</div>
								<div class="dslc-testimonial-main">
									<div class="dslc-testimonial-quote">
										<?php echo ucfirst($row->quote); ?>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>


					</div>
				</div>
			</div>
	 	</div> 
 	</div>
	<?php endif; ?>
</div> 
<!-- testimonials -->
<!-- testimonials -->
<!-- testimonials -->



	<div id="" class="dslc-modules-section " style="border-style:solid; border-right-style: hidden; border-left-style: hidden; background-color:rgb(255, 255, 255); background-image: url('<?php echo base_url() ?>assets/theme/front/wp-content/uploads/2014/10/dotted-mapcopy-copy.png'); background-repeat:no-repeat; background-position:right bottom; background-attachment:scroll; background-size:auto; padding-top:20px; padding-bottom:20px; ">
		<div class="dslc-bg-video dslc-force-show">
			<div class="dslc-bg-video-inner"></div>
			<div class="dslc-bg-video-overlay" style="background-color:rgb(27, 80, 131); ">
			</div>
		</div>
		<div class="dslc-modules-section-wrapper dslc-clearfix"> 
			<div class="dslc-modules-area dslc-col dslc-1-col dslc-first-col" data-size="1">
				&nbsp;
			</div> 
			<div class="dslc-modules-area dslc-col dslc-2-col " data-size="2"> 
				<div id="dslc-module-481" class="dslc-module-front dslc-module-DSLC_Text_Simple dslc-in-viewport-check dslc-in-viewport-anim-none" data-module-id="481" data-dslc-module-id="DSLC_Text_Simple" data-dslc-module-size="12" data-dslc-anim="none" data-dslc-anim-delay="0" data-dslc-anim-easing="ease">

			
			
		<div class="dslc-text-module-content">
		   <h1>About</h1>
		      <ul>
			      <li><a href="<?php echo base_url() ?>aboutus">About Us</a></li>
			      <li><a href="<?php echo base_url() ?>payment">Payment</a></li>
			      <li><a href="<?php echo base_url() ?>tracksheets">Tracksheets</a></li>
			      <li><a href="javascript:void(0)">KYC Form</a></li>
			      <li><a href="<?php echo base_url() ?>blog">Blog</a></li>
		      </ul>
		      </div>
			
			
		</div><!-- .dslc-module -->
		 </div> <div class="dslc-modules-area dslc-col dslc-2-col " data-size="2"> 
		<div id="dslc-module-480" class="dslc-module-front dslc-module-DSLC_Text_Simple dslc-in-viewport-check dslc-in-viewport-anim-none" data-module-id="480" data-dslc-module-id="DSLC_Text_Simple" data-dslc-module-size="12" data-dslc-anim="none" data-dslc-anim-delay="0" data-dslc-anim-easing="ease">
			
		<div class="dslc-text-module-content">
		    <h1>Services</h1>
		      
		       <ul>
		       <?php $footer_services = get_result('services',array('footer_featured'=>'yes')); ?>
		    <?php if($footer_services): ?>   
		       <?php foreach($footer_services as $row): ?>
		       <li>
		         <?php $sservices = get_row('services',array('id'=>$row->id)); ?>
		         <?php $package_s = get_row('service_packages',array('id'=>$sservices->package_id)); ?>
		          <a href="<?php echo base_url() ?>services/detail/<?php echo $package_s->slug ?>/<?php echo $row->slug ?>"><?php echo ucwords(trim($row->title)) ?></a>
		       </li>
		    <?php endforeach; ?>
		<?php endif; ?>
		       </ul>
		      </div>
			
			
		</div><!-- .dslc-module -->
		 </div> <div class="dslc-modules-area dslc-col dslc-3-col " data-size="3"> 
		<div id="dslc-module-211" class="dslc-module-front dslc-module-DSLC_Text_Simple dslc-in-viewport-check dslc-in-viewport-anim-none" data-module-id="211" data-dslc-module-id="DSLC_Text_Simple" data-dslc-module-size="12" data-dslc-anim="none" data-dslc-anim-delay="0" data-dslc-anim-easing="ease">

			
			
		<div class="dslc-text-module-content"><h1>Contact Us</h1></div>
			
			
		</div><!-- .dslc-module -->


<?php $contact_page = get_row('update_contactus',array('slug'=>'contactus')); ?>
		
<?php if(!empty($contact_page->email)): ?>
	<?php $array = explode(',',$contact_page->email) ?>
<?php foreach($array as $email): ?>
<div id="dslc-module-34" class="dslc-module-front dslc-module-DSLC_Button dslc-in-viewport-check dslc-in-viewport-anim-none" data-module-id="34" data-dslc-module-id="DSLC_Button" data-dslc-module-size="12" data-dslc-anim="none" data-dslc-anim-delay="0" data-dslc-anim-easing="ease">
<div class="dslc-button">
<a href="mailto:info@eliteresearch.co" target="_self">
<span class="dslc-icon dslc-icon-ext-mail2"></span>
<span class="dslca-editable-content" data-id="button_text"  data-type="simple" >
 <?php echo $email ?>
</span>
</a>
</div>
</div>
<?php endforeach; ?>
<?php endif; ?>

<?php if(!empty($contact_page->contact)): ?>
	<?php $array = explode(',',$contact_page->contact) ?>
<?php foreach($array as $contact): ?>
<div id="dslc-module-482" class="dslc-module-front dslc-module-DSLC_Button dslc-in-viewport-check dslc-in-viewport-anim-none" data-module-id="482" data-dslc-module-id="DSLC_Button" data-dslc-module-size="12" data-dslc-anim="none" data-dslc-anim-delay="0" data-dslc-anim-easing="ease">
<div class="dslc-button">
<a href="#" target="_self">
<span class="dslc-icon dslc-icon-ext-phone4"></span>
<span class="dslca-editable-content" data-id="button_text"  data-type="simple" >
<?php echo $contact ?>
</span>
</a>
</div><!-- .dslc-notification-box -->
</div><!-- .dslc-module -->
<?php endforeach; ?>
<?php endif; ?>



		 </div> <div class="dslc-modules-area dslc-col dslc-3-col " data-size="3"> 
		<div id="dslc-module-212" class="dslc-module-front dslc-module-DSLC_Text_Simple dslc-in-viewport-check dslc-in-viewport-anim-none" data-module-id="212" data-dslc-module-id="DSLC_Text_Simple" data-dslc-module-size="12" data-dslc-anim="none" data-dslc-anim-delay="0" data-dslc-anim-easing="ease">

			
			
		<div class="dslc-text-module-content"><h1>Support</h1></div>
			
			
		</div><!-- .dslc-module -->
		 
		<div id="dslc-module-36" class="dslc-module-front dslc-module-DSLC_Button dslc-in-viewport-check dslc-in-viewport-anim-none" data-module-id="36" data-dslc-module-id="DSLC_Button" data-dslc-module-size="12" data-dslc-anim="none" data-dslc-anim-delay="0" data-dslc-anim-easing="ease">

			
			
		
			<div class="dslc-button">
				<a href="<?php echo base_url() ?>free_trial" target="_self">
											<span class="dslc-icon dslc-icon-ext-bell"></span>
										<span class="dslca-editable-content" data-id="button_text"  data-type="simple" >request a free trial</span>
				</a>
			</div><!-- .dslc-notification-box -->

			
			
			
		</div><!-- .dslc-module -->
		 
		<div id="dslc-module-213" class="dslc-module-front dslc-module-DSLC_Button dslc-in-viewport-check dslc-in-viewport-anim-none" data-module-id="213" data-dslc-module-id="DSLC_Button" data-dslc-module-size="12" data-dslc-anim="none" data-dslc-anim-delay="0" data-dslc-anim-easing="ease">

			
			
		
			<div class="dslc-button">
				<a href="mailto:support@eliteresearch.co" target="_self">
											<span class="dslc-icon dslc-icon-ext-mail2"></span>
										<span class="dslca-editable-content" data-id="button_text"  data-type="simple" >complaint@eliteresearch.co</span>
				</a>
			</div><!-- .dslc-notification-box -->

			
			
			
		</div><!-- .dslc-module -->
		 </div> </div></div> 
		<div id="" class="dslc-modules-section " style="border-style:solid; border-right-style: hidden; border-left-style: hidden; background-color:rgb(112, 112, 112); background-image: url('<?php echo base_url() ?>assets/theme/front/wp-content/uploads/2014/10/images.jpg'); background-repeat:no-repeat; background-position:center center; background-attachment:scroll; background-size:cover; padding-top:10px; padding-bottom:10px; ">

				<div class="dslc-bg-video dslc-force-show"><div class="dslc-bg-video-inner"></div><div class="dslc-bg-video-overlay" style="background-color:#000000; "></div></div>

				<div class="dslc-modules-section-wrapper dslc-clearfix"> <div class="dslc-modules-area dslc-col dslc-8-col dslc-first-col" data-size="8"> 
		<div id="dslc-module-38" class="dslc-module-front dslc-module-DSLC_Social dslc-in-viewport-check dslc-in-viewport-anim-none" data-module-id="38" data-dslc-module-id="DSLC_Social" data-dslc-module-size="12" data-dslc-anim="none" data-dslc-anim-delay="0" data-dslc-anim-easing="ease">

			
			
		
			<div class="dslc-social-wrap">


  <?php $social_links = get_row('social_links',array('id'=>1)); ?>
			<ul class="dslc-social">
			<li><a target="_blank" href="<?php echo $social_links->twitter ?>"><span class="dslc-icon dslc-init-center dslc-icon-twitter"></span></a></li>
			<li><a target="_blank" href="<?php echo $social_links->facebook ?>"><span class="dslc-icon dslc-init-center dslc-icon-facebook"></span></a></li>
			<li><a target="_blank" href="<?php echo $social_links->youtube ?>"><span class="dslc-icon dslc-init-center dslc-icon-youtube-play"></span></a></li>
			<li><a target="_blank" href="<?php echo $social_links->pinterest ?>"><span class="dslc-icon dslc-init-center dslc-icon-pinterest"></span></a></li>
			<li><a target="_blank" href="<?php echo $social_links->linkedin ?>"><span class="dslc-icon dslc-init-center dslc-icon-linkedin"></span></a></li>
			<li><a target="_blank" href="<?php echo $social_links->instagram ?>"><span class="dslc-icon dslc-init-center dslc-icon-instagram"></span></a></li>
			<li><a target="_blank" href="<?php echo $social_links->github ?>"><span class="dslc-icon dslc-init-center dslc-icon-github-alt"></span></a></li>
			<li><a target="_blank" href="<?php echo $social_links->flickr ?>"><span class="dslc-icon dslc-init-center dslc-icon-flickr"></span></a></li>
			</ul>

			</div><!-- .dslc-social-wrap -->

			
			
			
		</div><!-- .dslc-module -->
		 
		<div id="dslc-module-368" class="dslc-module-front dslc-module-DSLC_Html dslc-in-viewport-check dslc-in-viewport-anim-none" data-module-id="368" data-dslc-module-id="DSLC_Html" data-dslc-module-size="12" data-dslc-anim="none" data-dslc-anim-delay="0" data-dslc-anim-easing="ease">

			
			
<div class="dslc-html-module-content">
<ul>
<?php $footer_link = get_result('cms',array('in_footer' => 1)); ?>
<?php if($footer_link): ?>
<?php foreach($footer_link as $row): ?>
<li style='display:inline;' ><a href='<?php echo base_url()._INDEX ?>cms/page/<?php echo $row->slug; ?>'><?php echo ucwords($row->title); ?></a></li>
 |
<?php endforeach; ?>   
<?php endif; ?>   
<li style='display:inline;' >
   <a href='<?php echo base_url() ?>contactus'>Contact Us</a></li>
</ul>
</div>			
			
		</div><!-- .dslc-module -->
		 </div> <div class="dslc-modules-area dslc-col dslc-4-col dslc-last-col" data-size="4"> 
		<div id="dslc-module-39" class="dslc-module-front dslc-module-DSLC_Button dslc-in-viewport-check dslc-in-viewport-anim-none" data-module-id="39" data-dslc-module-id="DSLC_Button" data-dslc-module-size="12" data-dslc-anim="none" data-dslc-anim-delay="0" data-dslc-anim-easing="ease">

			
			
		
			<div class="dslc-button">
				<a href="#" target="_self">
											<span class="dslc-icon dslc-icon-ext-arrow-up7"></span>
										<span class="dslca-editable-content" data-id="button_text"  data-type="simple" ></span>
				</a>
			</div><!-- .dslc-notification-box -->

			
			
			
		</div><!-- .dslc-module -->
		 
		<div id="dslc-module-40" class="dslc-module-front dslc-module-DSLC_Text_Simple dslc-in-viewport-check dslc-in-viewport-anim-none" data-module-id="40" data-dslc-module-id="DSLC_Text_Simple" data-dslc-module-size="12" data-dslc-anim="none" data-dslc-anim-delay="0" data-dslc-anim-easing="ease">

			
			
		<div class="dslc-text-module-content"><p>Copyright 2014. All Rights Reserved.</p></div>
			
			
		</div><!-- .dslc-module -->
		 </div> </div></div> </div></footer>






		</div><!--  .global-wrapper -->
	</div><!-- .global-container -->
</div><!-- .off-canvas-wrap -->

    <div class="w3eden">
        <div id="wpdm-popup-link" class="modal hide fade">
            <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                <h3>Download</h3>
            </div>
            <div class="w3eden modal-body" id='wpdm-modal-body'>

            </div>
            <div class="w3eden modal-footer">
                <a href="#" data-dismiss="modal" class="btn">Close</a>
            </div>
        </div>
    </div>
    <script language="JavaScript">
        <!--
        jQuery(function () {
            jQuery('#wpdm-popup-link').modal('hide');
            jQuery('.popup-link').click(function (e) {
                e.preventDefault();
                jQuery('#wpdm-modal-body').html('<i class="icon"><img align="left" style="margin-top: -1px" src="<?php echo base_url() ?>assets/theme/front/wp-content/plugins/download-manager/images/loading-new.gif" /></i>&nbsp;Please Wait...');
                jQuery('#wpdm-popup-link').modal('show');
                jQuery('#wpdm-modal-body').load(this.href);
            });
        });
        //-->
    </script>
    <style type="text/css">
        #wpdm-modal-body img {
            max-width: 100% !important;
        }
    </style>
<!-- easy-inline-scripts-ver-1.3.9.8.2--><script type="text/javascript">
		var essb_love_data = {
		'ajax_url': '<?php echo base_url() ?>assets/theme/front/wp-admin/admin-ajax.php'
		};
		jQuery(document).bind('essb_love_action', function (e, service, post_id) {
		
		jQuery.post(essb_love_data.ajax_url, {
		'action': 'essb_love_action',
		'post_id': post_id,
		'service': service,
		'nonce': '0df4756d98'
		}, function (data) {
		if (data && data.error) {
		alert(data.error);
		}
		},
		'json'
		);
		});
		var essb_love_you_clicked = false;
		var essb_love_you_message_thanks = 'Thank you for loving this.';
		var essb_love_you_message_loved = 'You already love this today.';
		function essb_handle_loveyou(service, post_id, sender) {
		if (service == '1') { alert(essb_love_you_message_loved); return; }
		if (essb_love_you_clicked) { alert(essb_love_you_message_loved); return; }
		 
		jQuery(document).trigger('essb_love_action',[service, post_id]);
		essb_love_you_clicked = true;
		if (typeof(sender) != 'undefined') {
		var parent = jQuery(sender).parent();
			
		if (parent.length) {
		var counter_r = jQuery(parent).find('.essb_counter_right');
		var counter_l = jQuery(parent).find('.essb_counter');
		var counter_i = jQuery(parent).find('.essb_counter_inside');
		if (counter_r.length) {
		var current = parseInt(counter_r.attr('cnt'));
		current++;
			
		counter_r.attr('cnt', current);
		counter_r.text(current);
		}
		if (counter_l.length) {
		var current = parseInt(counter_l.attr('cnt'));
		current++;
			
		counter_l.attr('cnt', current);
		counter_l.text(current);
		}
		if (counter_i.length) {
		var current = parseInt(counter_i.attr('cnt'));
		current++;
			
		counter_i.attr('cnt', current);
		counter_i.text(current);
		}
		}
		}
		
		alert(essb_love_you_message_thanks);
		}
		
		var essb_loveyou_post_id = 1252;		
		
		var essb_postcount_data = {
		'ajax_url': '<?php echo base_url() ?>assets/theme/front/wp-admin/admin-ajax.php',
		'post_id': '1252'
	};
	jQuery(document).bind('essb_selfpostcount_action', function (e, service, post_id) {		
		post_id = String(post_id);
	jQuery.post(essb_postcount_data.ajax_url, {
	'action': 'essb_self_postcount',
	'post_id': post_id,
	'service': service,
	'nonce': '0df4756d98'
	}, function (data) { if (data) {
		//alert(data);
	}},'json');});
	function essb_self_postcount(service, post_id) {

	jQuery(document).trigger('essb_selfpostcount_action',[service, post_id]);
	};
	</script>	<!--[if lte IE 8]>
	<style>
		.attachment:focus {
			outline: #1e8cbe solid;
		}
		.selected.attachment {
			outline: #1e8cbe solid;
		}
	</style>
	<![endif]-->
	<script type="text/html" id="tmpl-media-frame">
		<div class="media-frame-menu"></div>
		<div class="media-frame-title"></div>
		<div class="media-frame-router"></div>
		<div class="media-frame-content"></div>
		<div class="media-frame-toolbar"></div>
		<div class="media-frame-uploader"></div>
	</script>

	<script type="text/html" id="tmpl-media-modal">
		<div class="media-modal wp-core-ui">
			<a class="media-modal-close" href="#"><span class="media-modal-icon"><span class="screen-reader-text">Close media panel</span></span></a>
			<div class="media-modal-content"></div>
		</div>
		<div class="media-modal-backdrop"></div>
	</script>

	<script type="text/html" id="tmpl-uploader-window">
		<div class="uploader-window-content">
			<h3>Drop files to upload</h3>
		</div>
	</script>

	<script type="text/html" id="tmpl-uploader-editor">
		<div class="uploader-editor-content">
			<div class="uploader-editor-title">Drop files to upload</div>
		</div>
	</script>

	<script type="text/html" id="tmpl-uploader-inline">
		<# var messageClass = data.message ? 'has-upload-message' : 'no-upload-message'; #>
		<# if ( data.canClose ) { #>
		<button class="close dashicons dashicons-no"><span class="screen-reader-text">Close uploader</span></button>
		<# } #>
		<div class="uploader-inline-content {{ messageClass }}">
		<# if ( data.message ) { #>
			<h3 class="upload-message">{{ data.message }}</h3>
		<# } #>
					<div class="upload-ui">
				<h3 class="upload-instructions drop-instructions">Drop files anywhere to upload</h3>
				<p class="upload-instructions drop-instructions">or</p>
				<a href="#" class="browser button button-hero">Select Files</a>
			</div>

			<div class="upload-inline-status"></div>

			<div class="post-upload-ui">
				
				<p class="max-upload-size">Maximum upload file size: 2 MB.</p>

				<# if ( data.suggestedWidth && data.suggestedHeight ) { #>
					<p class="suggested-dimensions">
						Suggested image dimensions: {{data.suggestedWidth}} &times; {{data.suggestedHeight}}
					</p>
				<# } #>

							</div>
				</div>
	</script>

	<script type="text/html" id="tmpl-media-library-view-switcher">
		<a href="/services/equity-packages/?mode=list" class="view-list">
			<span class="screen-reader-text">List View</span>
		</a>
		<a href="/services/equity-packages/?mode=grid" class="view-grid current">
			<span class="screen-reader-text">Grid View</span>
		</a>
	</script>

	<script type="text/html" id="tmpl-uploader-status">
		<h3>Uploading</h3>
		<a class="upload-dismiss-errors" href="#">Dismiss Errors</a>

		<div class="media-progress-bar"><div></div></div>
		<div class="upload-details">
			<span class="upload-count">
				<span class="upload-index"></span> / <span class="upload-total"></span>
			</span>
			<span class="upload-detail-separator">&ndash;</span>
			<span class="upload-filename"></span>
		</div>
		<div class="upload-errors"></div>
	</script>

	<script type="text/html" id="tmpl-uploader-status-error">
		<span class="upload-error-label">Error</span>
		<span class="upload-error-filename">{{{ data.filename }}}</span>
		<span class="upload-error-message">{{ data.message }}</span>
	</script>

	<script type="text/html" id="tmpl-edit-attachment-frame">
		<div class="edit-media-header">
			<button class="left dashicons <# if ( ! data.hasPrevious ) { #> disabled <# } #>"><span class="screen-reader-text">Edit previous media item</span></button>
			<button class="right dashicons <# if ( ! data.hasNext ) { #> disabled <# } #>"><span class="screen-reader-text">Edit next media item</span></button>
		</div>
		<div class="media-frame-title"></div>
		<div class="media-frame-content"></div>
	</script>

	<script type="text/html" id="tmpl-attachment-details-two-column">
		<div class="attachment-media-view {{ data.orientation }}">
			<div class="thumbnail thumbnail-{{ data.type }}">
				<# if ( data.uploading ) { #>
					<div class="media-progress-bar"><div></div></div>
				<# } else if ( 'image' === data.type && data.sizes && data.sizes.large ) { #>
					<img class="details-image" src="{{ data.sizes.large.url }}" draggable="false" />
				<# } else if ( 'image' === data.type && data.sizes && data.sizes.full ) { #>
					<img class="details-image" src="{{ data.sizes.full.url }}" draggable="false" />
				<# } else if ( -1 === jQuery.inArray( data.type, [ 'audio', 'video' ] ) ) { #>
					<img class="details-image" src="{{ data.icon }}" class="icon" draggable="false" />
				<# } #>

				<# if ( 'audio' === data.type ) { #>
				<div class="wp-media-wrapper">
					<audio style="visibility: hidden" controls class="wp-audio-shortcode" width="100%" preload="none">
						<source type="{{ data.mime }}" src="{{ data.url }}"/>
					</audio>
				</div>
				<# } else if ( 'video' === data.type ) {
					var w_rule = h_rule = '';
					if ( data.width ) {
						w_rule = 'width: ' + data.width + 'px;';
					} else if ( wp.media.view.settings.contentWidth ) {
						w_rule = 'width: ' + wp.media.view.settings.contentWidth + 'px;';
					}
					if ( data.height ) {
						h_rule = 'height: ' + data.height + 'px;';
					}
				#>
				<div style="{{ w_rule }}{{ h_rule }}" class="wp-media-wrapper wp-video">
					<video controls="controls" class="wp-video-shortcode" preload="metadata"
						<# if ( data.width ) { #>width="{{ data.width }}"<# } #>
						<# if ( data.height ) { #>height="{{ data.height }}"<# } #>
						<# if ( data.image && data.image.src !== data.icon ) { #>poster="{{ data.image.src }}"<# } #>>
						<source type="{{ data.mime }}" src="{{ data.url }}"/>
					</video>
				</div>
				<# } #>

				<div class="attachment-actions">
					<# if ( 'image' === data.type && ! data.uploading && data.sizes ) { #>
						<a class="button edit-attachment" href="#">Edit Image</a>
					<# } #>
				</div>
			</div>
		</div>
		<div class="attachment-info">
			<span class="settings-save-status">
				<span class="spinner"></span>
				<span class="saved">Saved.</span>
			</span>
			<div class="details">
				<div class="filename"><strong>File name:</strong> {{ data.filename }}</div>
				<div class="filename"><strong>File type:</strong> {{ data.mime }}</div>
				<div class="uploaded"><strong>Uploaded on:</strong> {{ data.dateFormatted }}</div>

				<div class="file-size"><strong>File size:</strong> {{ data.filesizeHumanReadable }}</div>
				<# if ( 'image' === data.type && ! data.uploading ) { #>
					<# if ( data.width && data.height ) { #>
						<div class="dimensions"><strong>Dimensions:</strong> {{ data.width }} &times; {{ data.height }}</div>
					<# } #>
				<# } #>

				<# if ( data.fileLength ) { #>
					<div class="file-length"><strong>Length:</strong> {{ data.fileLength }}</div>
				<# } #>

				<# if ( 'audio' === data.type && data.meta.bitrate ) { #>
					<div class="bitrate">
						<strong>Bitrate:</strong> {{ Math.round( data.meta.bitrate / 1000 ) }}kb/s
						<# if ( data.meta.bitrate_mode ) { #>
						{{ ' ' + data.meta.bitrate_mode.toUpperCase() }}
						<# } #>
					</div>
				<# } #>

				<div class="compat-meta">
					<# if ( data.compat && data.compat.meta ) { #>
						{{{ data.compat.meta }}}
					<# } #>
				</div>
			</div>

			<div class="settings">
				<label class="setting" data-setting="url">
					<span class="name">URL</span>
					<input type="text" value="{{ data.url }}" readonly />
				</label>
				<# var maybeReadOnly = data.can.save || data.allowLocalEdits ? '' : 'readonly'; #>
				<label class="setting" data-setting="title">
					<span class="name">Title</span>
					<input type="text" value="{{ data.title }}" {{ maybeReadOnly }} />
				</label>
				<# if ( 'audio' === data.type ) { #>
								<label class="setting" data-setting="artist">
					<span class="name">Artist</span>
					<input type="text" value="{{ data.artist || data.meta.artist || '' }}" />
				</label>
								<label class="setting" data-setting="album">
					<span class="name">Album</span>
					<input type="text" value="{{ data.album || data.meta.album || '' }}" />
				</label>
								<# } #>
				<label class="setting" data-setting="caption">
					<span class="name">Caption</span>
					<textarea {{ maybeReadOnly }}>{{ data.caption }}</textarea>
				</label>
				<# if ( 'image' === data.type ) { #>
					<label class="setting" data-setting="alt">
						<span class="name">Alt Text</span>
						<input type="text" value="{{ data.alt }}" {{ maybeReadOnly }} />
					</label>
				<# } #>
				<label class="setting" data-setting="description">
					<span class="name">Description</span>
					<textarea {{ maybeReadOnly }}>{{ data.description }}</textarea>
				</label>
				<label class="setting">
					<span class="name">Uploaded By</span>
					<span class="value">{{ data.authorName }}</span>
				</label>
				<# if ( data.uploadedTo ) { #>
					<label class="setting">
						<span class="name">Uploaded To</span>
						<# if ( data.uploadedToLink ) { #>
							<span class="value"><a href="{{ data.uploadedToLink }}">{{ data.uploadedToTitle }}</a></span>
						<# } else { #>
							<span class="value">{{ data.uploadedToTitle }}</span>
						<# } #>
					</label>
				<# } #>
				<div class="attachment-compat"></div>
			</div>

			<div class="actions">
				<a class="view-attachment" href="{{ data.link }}">View attachment page</a> |
				<a href="post.php?post={{ data.id }}&action=edit">Edit more details</a>
				<# if ( ! data.uploading && data.can.remove ) { #> |
													<a class="delete-attachment" href="#">Delete Permanently</a>
											<# } #>
			</div>

		</div>
	</script>

	<script type="text/html" id="tmpl-attachment">
		<div class="attachment-preview js--select-attachment type-{{ data.type }} subtype-{{ data.subtype }} {{ data.orientation }}">
			<div class="thumbnail">
				<# if ( data.uploading ) { #>
					<div class="media-progress-bar"><div style="width: {{ data.percent }}%"></div></div>
				<# } else if ( 'image' === data.type && data.sizes ) { #>
					<div class="centered">
						<img src="{{ data.size.url }}" draggable="false" alt="" />
					</div>
				<# } else { #>
					<div class="centered">
						<# if ( data.image && data.image.src && data.image.src !== data.icon ) { #>
							<img src="{{ data.image.src }}" class="thumbnail" draggable="false" />
						<# } else { #>
							<img src="{{ data.icon }}" class="icon" draggable="false" />
						<# } #>
					</div>
					<div class="filename">
						<div>{{ data.filename }}</div>
					</div>
				<# } #>
			</div>
			<# if ( data.buttons.close ) { #>
				<a class="close media-modal-icon" href="#" title="Remove"></a>
			<# } #>
		</div>
		<# if ( data.buttons.check ) { #>
			<a class="check" href="#" title="Deselect" tabindex="-1"><div class="media-modal-icon"></div></a>
		<# } #>
		<#
		var maybeReadOnly = data.can.save || data.allowLocalEdits ? '' : 'readonly';
		if ( data.describe ) {
			if ( 'image' === data.type ) { #>
				<input type="text" value="{{ data.caption }}" class="describe" data-setting="caption"
					placeholder="Caption this image&hellip;" {{ maybeReadOnly }} />
			<# } else { #>
				<input type="text" value="{{ data.title }}" class="describe" data-setting="title"
					<# if ( 'video' === data.type ) { #>
						placeholder="Describe this video&hellip;"
					<# } else if ( 'audio' === data.type ) { #>
						placeholder="Describe this audio file&hellip;"
					<# } else { #>
						placeholder="Describe this media file&hellip;"
					<# } #> {{ maybeReadOnly }} />
			<# }
		} #>
	</script>

	<script type="text/html" id="tmpl-attachment-details">
		<h3>
			Attachment Details
			<span class="settings-save-status">
				<span class="spinner"></span>
				<span class="saved">Saved.</span>
			</span>
		</h3>
		<div class="attachment-info">
			<div class="thumbnail thumbnail-{{ data.type }}">
				<# if ( data.uploading ) { #>
					<div class="media-progress-bar"><div></div></div>
				<# } else if ( 'image' === data.type && data.sizes ) { #>
					<img src="{{ data.size.url }}" draggable="false" />
				<# } else { #>
					<img src="{{ data.icon }}" class="icon" draggable="false" />
				<# } #>
			</div>
			<div class="details">
				<div class="filename">{{ data.filename }}</div>
				<div class="uploaded">{{ data.dateFormatted }}</div>

				<div class="file-size">{{ data.filesizeHumanReadable }}</div>
				<# if ( 'image' === data.type && ! data.uploading ) { #>
					<# if ( data.width && data.height ) { #>
						<div class="dimensions">{{ data.width }} &times; {{ data.height }}</div>
					<# } #>

					<# if ( data.can.save && data.sizes ) { #>
						<a class="edit-attachment" href="{{ data.editLink }}&amp;image-editor" target="_blank">Edit Image</a>
						<a class="refresh-attachment" href="#">Refresh</a>
					<# } #>
				<# } #>

				<# if ( data.fileLength ) { #>
					<div class="file-length">Length: {{ data.fileLength }}</div>
				<# } #>

				<# if ( ! data.uploading && data.can.remove ) { #>
											<a class="delete-attachment" href="#">Delete Permanently</a>
									<# } #>

				<div class="compat-meta">
					<# if ( data.compat && data.compat.meta ) { #>
						{{{ data.compat.meta }}}
					<# } #>
				</div>
			</div>
		</div>

		<label class="setting" data-setting="url">
			<span class="name">URL</span>
			<input type="text" value="{{ data.url }}" readonly />
		</label>
		<# var maybeReadOnly = data.can.save || data.allowLocalEdits ? '' : 'readonly'; #>
		<label class="setting" data-setting="title">
			<span class="name">Title</span>
			<input type="text" value="{{ data.title }}" {{ maybeReadOnly }} />
		</label>
		<# if ( 'audio' === data.type ) { #>
				<label class="setting" data-setting="artist">
			<span class="name">Artist</span>
			<input type="text" value="{{ data.artist || data.meta.artist || '' }}" />
		</label>
				<label class="setting" data-setting="album">
			<span class="name">Album</span>
			<input type="text" value="{{ data.album || data.meta.album || '' }}" />
		</label>
				<# } #>
		<label class="setting" data-setting="caption">
			<span class="name">Caption</span>
			<textarea {{ maybeReadOnly }}>{{ data.caption }}</textarea>
		</label>
		<# if ( 'image' === data.type ) { #>
			<label class="setting" data-setting="alt">
				<span class="name">Alt Text</span>
				<input type="text" value="{{ data.alt }}" {{ maybeReadOnly }} />
			</label>
		<# } #>
		<label class="setting" data-setting="description">
			<span class="name">Description</span>
			<textarea {{ maybeReadOnly }}>{{ data.description }}</textarea>
		</label>
	</script>

	<script type="text/html" id="tmpl-media-selection">
		<div class="selection-info">
			<span class="count"></span>
			<# if ( data.editable ) { #>
				<a class="edit-selection" href="#">Edit</a>
			<# } #>
			<# if ( data.clearable ) { #>
				<a class="clear-selection" href="#">Clear</a>
			<# } #>
		</div>
		<div class="selection-view"></div>
	</script>

	<script type="text/html" id="tmpl-attachment-display-settings">
		<h3>Attachment Display Settings</h3>

		<# if ( 'image' === data.type ) { #>
			<label class="setting">
				<span>Alignment</span>
				<select class="alignment"
					data-setting="align"
					<# if ( data.userSettings ) { #>
						data-user-setting="align"
					<# } #>>

					<option value="left">
						Left					</option>
					<option value="center">
						Center					</option>
					<option value="right">
						Right					</option>
					<option value="none" selected>
						None					</option>
				</select>
			</label>
		<# } #>

		<div class="setting">
			<label>
				<# if ( data.model.canEmbed ) { #>
					<span>Embed or Link</span>
				<# } else { #>
					<span>Link To</span>
				<# } #>

				<select class="link-to"
					data-setting="link"
					<# if ( data.userSettings && ! data.model.canEmbed ) { #>
						data-user-setting="urlbutton"
					<# } #>>

				<# if ( data.model.canEmbed ) { #>
					<option value="embed" selected>
						Embed Media Player					</option>
					<option value="file">
				<# } else { #>
					<option value="file" selected>
				<# } #>
					<# if ( data.model.canEmbed ) { #>
						Link to Media File					<# } else { #>
						Media File					<# } #>
					</option>
					<option value="post">
					<# if ( data.model.canEmbed ) { #>
						Link to Attachment Page					<# } else { #>
						Attachment Page					<# } #>
					</option>
				<# if ( 'image' === data.type ) { #>
					<option value="custom">
						Custom URL					</option>
					<option value="none">
						None					</option>
				<# } #>
				</select>
			</label>
			<input type="text" class="link-to-custom" data-setting="linkUrl" />
		</div>

		<# if ( 'undefined' !== typeof data.sizes ) { #>
			<label class="setting">
				<span>Size</span>
				<select class="size" name="size"
					data-setting="size"
					<# if ( data.userSettings ) { #>
						data-user-setting="imgsize"
					<# } #>>
											<#
						var size = data.sizes['thumbnail'];
						if ( size ) { #>
							<option value="thumbnail" >
								Thumbnail &ndash; {{ size.width }} &times; {{ size.height }}
							</option>
						<# } #>
											<#
						var size = data.sizes['medium'];
						if ( size ) { #>
							<option value="medium" >
								Medium &ndash; {{ size.width }} &times; {{ size.height }}
							</option>
						<# } #>
											<#
						var size = data.sizes['large'];
						if ( size ) { #>
							<option value="large" >
								Large &ndash; {{ size.width }} &times; {{ size.height }}
							</option>
						<# } #>
											<#
						var size = data.sizes['full'];
						if ( size ) { #>
							<option value="full"  selected='selected'>
								Full Size &ndash; {{ size.width }} &times; {{ size.height }}
							</option>
						<# } #>
									</select>
			</label>
		<# } #>
	</script>

	<script type="text/html" id="tmpl-gallery-settings">
		<h3>Gallery Settings</h3>

		<label class="setting">
			<span>Link To</span>
			<select class="link-to"
				data-setting="link"
				<# if ( data.userSettings ) { #>
					data-user-setting="urlbutton"
				<# } #>>

				<option value="post" <# if ( ! wp.media.galleryDefaults.link || 'post' == wp.media.galleryDefaults.link ) {
					#>selected="selected"<# }
				#>>
					Attachment Page				</option>
				<option value="file" <# if ( 'file' == wp.media.galleryDefaults.link ) { #>selected="selected"<# } #>>
					Media File				</option>
				<option value="none" <# if ( 'none' == wp.media.galleryDefaults.link ) { #>selected="selected"<# } #>>
					None				</option>
			</select>
		</label>

		<label class="setting">
			<span>Columns</span>
			<select class="columns" name="columns"
				data-setting="columns">
									<option value="1" <#
						if ( 1 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
					#>>
						1					</option>
									<option value="2" <#
						if ( 2 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
					#>>
						2					</option>
									<option value="3" <#
						if ( 3 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
					#>>
						3					</option>
									<option value="4" <#
						if ( 4 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
					#>>
						4					</option>
									<option value="5" <#
						if ( 5 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
					#>>
						5					</option>
									<option value="6" <#
						if ( 6 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
					#>>
						6					</option>
									<option value="7" <#
						if ( 7 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
					#>>
						7					</option>
									<option value="8" <#
						if ( 8 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
					#>>
						8					</option>
									<option value="9" <#
						if ( 9 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
					#>>
						9					</option>
							</select>
		</label>

		<label class="setting">
			<span>Random Order</span>
			<input type="checkbox" data-setting="_orderbyRandom" />
		</label>
	</script>

	<script type="text/html" id="tmpl-playlist-settings">
		<h3>Playlist Settings</h3>

		<# var emptyModel = _.isEmpty( data.model ),
			isVideo = 'video' === data.controller.get('library').props.get('type'); #>

		<label class="setting">
			<input type="checkbox" data-setting="tracklist" <# if ( emptyModel ) { #>
				checked="checked"
			<# } #> />
			<# if ( isVideo ) { #>
			<span>Show Video List</span>
			<# } else { #>
			<span>Show Tracklist</span>
			<# } #>
		</label>

		<# if ( ! isVideo ) { #>
		<label class="setting">
			<input type="checkbox" data-setting="artists" <# if ( emptyModel ) { #>
				checked="checked"
			<# } #> />
			<span>Show Artist Name in Tracklist</span>
		</label>
		<# } #>

		<label class="setting">
			<input type="checkbox" data-setting="images" <# if ( emptyModel ) { #>
				checked="checked"
			<# } #> />
			<span>Show Images</span>
		</label>
	</script>

	<script type="text/html" id="tmpl-embed-link-settings">
		<label class="setting title">
			<span>Title</span>
			<input type="text" class="alignment" data-setting="title" />
		</label>
		<div class="embed-container" style="display: none;">
			<div class="embed-preview"></div>
		</div>
	</script>

	<script type="text/html" id="tmpl-embed-image-settings">
		<div class="thumbnail">
			<img src="{{ data.model.url }}" draggable="false" />
		</div>

					<label class="setting caption">
				<span>Caption</span>
				<textarea data-setting="caption" />
			</label>
		
		<label class="setting alt-text">
			<span>Alt Text</span>
			<input type="text" data-setting="alt" />
		</label>

		<div class="setting align">
			<span>Align</span>
			<div class="button-group button-large" data-setting="align">
				<button class="button" value="left">
					Left				</button>
				<button class="button" value="center">
					Center				</button>
				<button class="button" value="right">
					Right				</button>
				<button class="button active" value="none">
					None				</button>
			</div>
		</div>

		<div class="setting link-to">
			<span>Link To</span>
			<div class="button-group button-large" data-setting="link">
				<button class="button" value="file">
					Image URL				</button>
				<button class="button" value="custom">
					Custom URL				</button>
				<button class="button active" value="none">
					None				</button>
			</div>
			<input type="text" class="link-to-custom" data-setting="linkUrl" />
		</div>
	</script>

	<script type="text/html" id="tmpl-image-details">
		<div class="media-embed">
			<div class="embed-media-settings">
				<div class="column-image">
					<div class="image">
						<img src="{{ data.model.url }}" draggable="false" />

						<# if ( data.attachment && window.imageEdit ) { #>
							<div class="actions">
								<input type="button" class="edit-attachment button" value="Edit Original" />
								<input type="button" class="replace-attachment button" value="Replace" />
							</div>
						<# } #>
					</div>
				</div>
				<div class="column-settings">
											<label class="setting caption">
							<span>Caption</span>
							<textarea data-setting="caption">{{ data.model.caption }}</textarea>
						</label>
					
					<label class="setting alt-text">
						<span>Alternative Text</span>
						<input type="text" data-setting="alt" value="{{ data.model.alt }}" />
					</label>

					<h3>Display Settings</h3>
					<div class="setting align">
						<span>Align</span>
						<div class="button-group button-large" data-setting="align">
							<button class="button" value="left">
								Left							</button>
							<button class="button" value="center">
								Center							</button>
							<button class="button" value="right">
								Right							</button>
							<button class="button active" value="none">
								None							</button>
						</div>
					</div>

					<# if ( data.attachment ) { #>
						<# if ( 'undefined' !== typeof data.attachment.sizes ) { #>
							<label class="setting size">
								<span>Size</span>
								<select class="size" name="size"
									data-setting="size"
									<# if ( data.userSettings ) { #>
										data-user-setting="imgsize"
									<# } #>>
																			<#
										var size = data.sizes['thumbnail'];
										if ( size ) { #>
											<option value="thumbnail">
												Thumbnail &ndash; {{ size.width }} &times; {{ size.height }}
											</option>
										<# } #>
																			<#
										var size = data.sizes['medium'];
										if ( size ) { #>
											<option value="medium">
												Medium &ndash; {{ size.width }} &times; {{ size.height }}
											</option>
										<# } #>
																			<#
										var size = data.sizes['large'];
										if ( size ) { #>
											<option value="large">
												Large &ndash; {{ size.width }} &times; {{ size.height }}
											</option>
										<# } #>
																			<#
										var size = data.sizes['full'];
										if ( size ) { #>
											<option value="full">
												Full Size &ndash; {{ size.width }} &times; {{ size.height }}
											</option>
										<# } #>
																		<option value="custom">
										Custom Size									</option>
								</select>
							</label>
						<# } #>
							<div class="custom-size<# if ( data.model.size !== 'custom' ) { #> hidden<# } #>">
								<label><span>Width <small>(px)</small></span> <input data-setting="customWidth" type="number" step="1" value="{{ data.model.customWidth }}" /></label><span class="sep">&times;</span><label><span>Height <small>(px)</small></span><input data-setting="customHeight" type="number" step="1" value="{{ data.model.customHeight }}" /></label>
							</div>
					<# } #>

					<div class="setting link-to">
						<span>Link To</span>
						<select data-setting="link">
						<# if ( data.attachment ) { #>
							<option value="file">
								Media File							</option>
							<option value="post">
								Attachment Page							</option>
						<# } else { #>
							<option value="file">
								Image URL							</option>
						<# } #>
							<option value="custom">
								Custom URL							</option>
							<option value="none">
								None							</option>
						</select>
						<input type="text" class="link-to-custom" data-setting="linkUrl" />
					</div>
					<div class="advanced-section">
						<h3><a class="advanced-toggle" href="#">Advanced Options</a></h3>
						<div class="advanced-settings hidden">
							<div class="advanced-image">
								<label class="setting title-text">
									<span>Image Title Attribute</span>
									<input type="text" data-setting="title" value="{{ data.model.title }}" />
								</label>
								<label class="setting extra-classes">
									<span>Image CSS Class</span>
									<input type="text" data-setting="extraClasses" value="{{ data.model.extraClasses }}" />
								</label>
							</div>
							<div class="advanced-link">
								<div class="setting link-target">
									<label><input type="checkbox" data-setting="linkTargetBlank" value="_blank" <# if ( data.model.linkTargetBlank ) { #>checked="checked"<# } #>>Open link in a new window/tab</label>
								</div>
								<label class="setting link-rel">
									<span>Link Rel</span>
									<input type="text" data-setting="linkRel" value="{{ data.model.linkClassName }}" />
								</label>
								<label class="setting link-class-name">
									<span>Link CSS Class</span>
									<input type="text" data-setting="linkClassName" value="{{ data.model.linkClassName }}" />
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</script>

	<script type="text/html" id="tmpl-image-editor">
		<div id="media-head-{{ data.id }}"></div>
		<div id="image-editor-{{ data.id }}"></div>
	</script>

	<script type="text/html" id="tmpl-audio-details">
		<# var ext, html5types = {
			mp3: wp.media.view.settings.embedMimes.mp3,
			ogg: wp.media.view.settings.embedMimes.ogg
		}; #>

				<div class="media-embed media-embed-details">
			<div class="embed-media-settings embed-audio-settings">
				<audio style="visibility: hidden"
	controls
	class="wp-audio-shortcode"
	width="{{ _.isUndefined( data.model.width ) ? 400 : data.model.width }}"
	preload="{{ _.isUndefined( data.model.preload ) ? 'none' : data.model.preload }}"
	<#
	if ( ! _.isUndefined( data.model.autoplay ) && data.model.autoplay ) {
		#> autoplay<#
	}
	if ( ! _.isUndefined( data.model.loop ) && data.model.loop ) {
		#> loop<#
	}
	#>
>
	<# if ( ! _.isEmpty( data.model.src ) ) { #>
	<source src="{{ data.model.src }}" type="{{ wp.media.view.settings.embedMimes[ data.model.src.split('.').pop() ] }}" />
	<# } #>

	<# if ( ! _.isEmpty( data.model.mp3 ) ) { #>
	<source src="{{ data.model.mp3 }}" type="{{ wp.media.view.settings.embedMimes[ 'mp3' ] }}" />
	<# } #>
	<# if ( ! _.isEmpty( data.model.ogg ) ) { #>
	<source src="{{ data.model.ogg }}" type="{{ wp.media.view.settings.embedMimes[ 'ogg' ] }}" />
	<# } #>
	<# if ( ! _.isEmpty( data.model.wma ) ) { #>
	<source src="{{ data.model.wma }}" type="{{ wp.media.view.settings.embedMimes[ 'wma' ] }}" />
	<# } #>
	<# if ( ! _.isEmpty( data.model.m4a ) ) { #>
	<source src="{{ data.model.m4a }}" type="{{ wp.media.view.settings.embedMimes[ 'm4a' ] }}" />
	<# } #>
	<# if ( ! _.isEmpty( data.model.wav ) ) { #>
	<source src="{{ data.model.wav }}" type="{{ wp.media.view.settings.embedMimes[ 'wav' ] }}" />
	<# } #>
	</audio>

				<# if ( ! _.isEmpty( data.model.src ) ) {
					ext = data.model.src.split('.').pop();
					if ( html5types[ ext ] ) {
						delete html5types[ ext ];
					}
				#>
				<label class="setting">
					<span>SRC</span>
					<input type="text" disabled="disabled" data-setting="src" value="{{ data.model.src }}" />
					<a class="remove-setting">Remove</a>
				</label>
				<# } #>
				<# if ( ! _.isEmpty( data.model.mp3 ) ) {
					if ( ! _.isUndefined( html5types.mp3 ) ) {
						delete html5types.mp3;
					}
				#>
				<label class="setting">
					<span>MP3</span>
					<input type="text" disabled="disabled" data-setting="mp3" value="{{ data.model.mp3 }}" />
					<a class="remove-setting">Remove</a>
				</label>
				<# } #>
				<# if ( ! _.isEmpty( data.model.ogg ) ) {
					if ( ! _.isUndefined( html5types.ogg ) ) {
						delete html5types.ogg;
					}
				#>
				<label class="setting">
					<span>OGG</span>
					<input type="text" disabled="disabled" data-setting="ogg" value="{{ data.model.ogg }}" />
					<a class="remove-setting">Remove</a>
				</label>
				<# } #>
				<# if ( ! _.isEmpty( data.model.wma ) ) {
					if ( ! _.isUndefined( html5types.wma ) ) {
						delete html5types.wma;
					}
				#>
				<label class="setting">
					<span>WMA</span>
					<input type="text" disabled="disabled" data-setting="wma" value="{{ data.model.wma }}" />
					<a class="remove-setting">Remove</a>
				</label>
				<# } #>
				<# if ( ! _.isEmpty( data.model.m4a ) ) {
					if ( ! _.isUndefined( html5types.m4a ) ) {
						delete html5types.m4a;
					}
				#>
				<label class="setting">
					<span>M4A</span>
					<input type="text" disabled="disabled" data-setting="m4a" value="{{ data.model.m4a }}" />
					<a class="remove-setting">Remove</a>
				</label>
				<# } #>
				<# if ( ! _.isEmpty( data.model.wav ) ) {
					if ( ! _.isUndefined( html5types.wav ) ) {
						delete html5types.wav;
					}
				#>
				<label class="setting">
					<span>WAV</span>
					<input type="text" disabled="disabled" data-setting="wav" value="{{ data.model.wav }}" />
					<a class="remove-setting">Remove</a>
				</label>
				<# } #>
				
				<# if ( ! _.isEmpty( html5types ) ) { #>
				<div class="setting">
					<span>Add alternate sources for maximum HTML5 playback:</span>
					<div class="button-large">
					<# _.each( html5types, function (mime, type) { #>
					<button class="button add-media-source" data-mime="{{ mime }}">{{ type }}</button>
					<# } ) #>
					</div>
				</div>
				<# } #>

				<div class="setting preload">
					<span>Preload</span>
					<div class="button-group button-large" data-setting="preload">
						<button class="button" value="auto">Auto</button>
						<button class="button" value="metadata">Metadata</button>
						<button class="button active" value="none">None</button>
					</div>
				</div>

				<label class="setting checkbox-setting">
					<input type="checkbox" data-setting="autoplay" />
					<span>Autoplay</span>
				</label>

				<label class="setting checkbox-setting">
					<input type="checkbox" data-setting="loop" />
					<span>Loop</span>
				</label>
			</div>
		</div>
	</script>

	<script type="text/html" id="tmpl-video-details">
		<# var ext, html5types = {
			mp4: wp.media.view.settings.embedMimes.mp4,
			ogv: wp.media.view.settings.embedMimes.ogv,
			webm: wp.media.view.settings.embedMimes.webm
		}; #>

				<div class="media-embed media-embed-details">
			<div class="embed-media-settings embed-video-settings">
				<div class="wp-video-holder">
				<#
				var isYouTube = ! _.isEmpty( data.model.src ) && data.model.src.match(/youtube|youtu\.be/);
					w = ! data.model.width || data.model.width > 640 ? 640 : data.model.width,
					h = ! data.model.height ? 360 : data.model.height;

				if ( data.model.width && w !== data.model.width ) {
					h = Math.ceil( ( h * w ) / data.model.width );
				}
				#>

				<#  var w_rule = h_rule = '',
		w, h, settings = wp.media.view.settings,
		isYouTube = ! _.isEmpty( data.model.src ) && data.model.src.match(/youtube|youtu\.be/);

	if ( settings.contentWidth && data.model.width >= settings.contentWidth ) {
		w = settings.contentWidth;
	} else {
		w = data.model.width;
	}

	if ( w !== data.model.width ) {
		h = Math.ceil( ( data.model.height * w ) / data.model.width );
	} else {
		h = data.model.height;
	}

	if ( w ) {
		w_rule = 'width: ' + w + 'px; ';
	}
	if ( h ) {
		h_rule = 'height: ' + h + 'px;';
	}
#>
<div style="{{ w_rule }}{{ h_rule }}" class="wp-video">
<video controls
	class="wp-video-shortcode{{ isYouTube ? ' youtube-video' : '' }}"
	<# if ( w ) { #>width="{{ w }}"<# } #>
	<# if ( h ) { #>height="{{ h }}"<# } #>
	<#
		if ( ! _.isUndefined( data.model.poster ) && data.model.poster ) {
			#> poster="{{ data.model.poster }}"<#
		} #>
		preload="{{ _.isUndefined( data.model.preload ) ? 'metadata' : data.model.preload }}"<#
	 if ( ! _.isUndefined( data.model.autoplay ) && data.model.autoplay ) {
		#> autoplay<#
	}
	 if ( ! _.isUndefined( data.model.loop ) && data.model.loop ) {
		#> loop<#
	}
	#>
>
	<# if ( ! _.isEmpty( data.model.src ) ) {
		if ( isYouTube ) { #>
		<source src="{{ data.model.src }}" type="video/youtube" />
		<# } else { #>
		<source src="{{ data.model.src }}" type="{{ settings.embedMimes[ data.model.src.split('.').pop() ] }}" />
		<# }
	} #>

	<# if ( data.model.mp4 ) { #>
	<source src="{{ data.model.mp4 }}" type="{{ settings.embedMimes[ 'mp4' ] }}" />
	<# } #>
	<# if ( data.model.m4v ) { #>
	<source src="{{ data.model.m4v }}" type="{{ settings.embedMimes[ 'm4v' ] }}" />
	<# } #>
	<# if ( data.model.webm ) { #>
	<source src="{{ data.model.webm }}" type="{{ settings.embedMimes[ 'webm' ] }}" />
	<# } #>
	<# if ( data.model.ogv ) { #>
	<source src="{{ data.model.ogv }}" type="{{ settings.embedMimes[ 'ogv' ] }}" />
	<# } #>
	<# if ( data.model.wmv ) { #>
	<source src="{{ data.model.wmv }}" type="{{ settings.embedMimes[ 'wmv' ] }}" />
	<# } #>
	<# if ( data.model.flv ) { #>
	<source src="{{ data.model.flv }}" type="{{ settings.embedMimes[ 'flv' ] }}" />
	<# } #>
		{{{ data.model.content }}}
</video>
</div>

				<# if ( ! _.isEmpty( data.model.src ) ) {
					ext = data.model.src.split('.').pop();
					if ( html5types[ ext ] ) {
						delete html5types[ ext ];
					}
				#>
				<label class="setting">
					<span>SRC</span>
					<input type="text" disabled="disabled" data-setting="src" value="{{ data.model.src }}" />
					<a class="remove-setting">Remove</a>
				</label>
				<# } #>
				<# if ( ! _.isEmpty( data.model.mp4 ) ) {
					if ( ! _.isUndefined( html5types.mp4 ) ) {
						delete html5types.mp4;
					}
				#>
				<label class="setting">
					<span>MP4</span>
					<input type="text" disabled="disabled" data-setting="mp4" value="{{ data.model.mp4 }}" />
					<a class="remove-setting">Remove</a>
				</label>
				<# } #>
				<# if ( ! _.isEmpty( data.model.m4v ) ) {
					if ( ! _.isUndefined( html5types.m4v ) ) {
						delete html5types.m4v;
					}
				#>
				<label class="setting">
					<span>M4V</span>
					<input type="text" disabled="disabled" data-setting="m4v" value="{{ data.model.m4v }}" />
					<a class="remove-setting">Remove</a>
				</label>
				<# } #>
				<# if ( ! _.isEmpty( data.model.webm ) ) {
					if ( ! _.isUndefined( html5types.webm ) ) {
						delete html5types.webm;
					}
				#>
				<label class="setting">
					<span>WEBM</span>
					<input type="text" disabled="disabled" data-setting="webm" value="{{ data.model.webm }}" />
					<a class="remove-setting">Remove</a>
				</label>
				<# } #>
				<# if ( ! _.isEmpty( data.model.ogv ) ) {
					if ( ! _.isUndefined( html5types.ogv ) ) {
						delete html5types.ogv;
					}
				#>
				<label class="setting">
					<span>OGV</span>
					<input type="text" disabled="disabled" data-setting="ogv" value="{{ data.model.ogv }}" />
					<a class="remove-setting">Remove</a>
				</label>
				<# } #>
				<# if ( ! _.isEmpty( data.model.wmv ) ) {
					if ( ! _.isUndefined( html5types.wmv ) ) {
						delete html5types.wmv;
					}
				#>
				<label class="setting">
					<span>WMV</span>
					<input type="text" disabled="disabled" data-setting="wmv" value="{{ data.model.wmv }}" />
					<a class="remove-setting">Remove</a>
				</label>
				<# } #>
				<# if ( ! _.isEmpty( data.model.flv ) ) {
					if ( ! _.isUndefined( html5types.flv ) ) {
						delete html5types.flv;
					}
				#>
				<label class="setting">
					<span>FLV</span>
					<input type="text" disabled="disabled" data-setting="flv" value="{{ data.model.flv }}" />
					<a class="remove-setting">Remove</a>
				</label>
				<# } #>
								</div>

				<# if ( ! _.isEmpty( html5types ) ) { #>
				<div class="setting">
					<span>Add alternate sources for maximum HTML5 playback:</span>
					<div class="button-large">
					<# _.each( html5types, function (mime, type) { #>
					<button class="button add-media-source" data-mime="{{ mime }}">{{ type }}</button>
					<# } ) #>
					</div>
				</div>
				<# } #>

				<# if ( ! _.isEmpty( data.model.poster ) ) { #>
				<label class="setting">
					<span>Poster Image</span>
					<input type="text" disabled="disabled" data-setting="poster" value="{{ data.model.poster }}" />
					<a class="remove-setting">Remove</a>
				</label>
				<# } #>
				<div class="setting preload">
					<span>Preload</span>
					<div class="button-group button-large" data-setting="preload">
						<button class="button" value="auto">Auto</button>
						<button class="button" value="metadata">Metadata</button>
						<button class="button active" value="none">None</button>
					</div>
				</div>

				<label class="setting checkbox-setting">
					<input type="checkbox" data-setting="autoplay" />
					<span>Autoplay</span>
				</label>

				<label class="setting checkbox-setting">
					<input type="checkbox" data-setting="loop" />
					<span>Loop</span>
				</label>

				<label class="setting" data-setting="content">
					<span>Tracks (subtitles, captions, descriptions, chapters, or metadata)</span>
					<#
					var content = '';
					if ( ! _.isEmpty( data.model.content ) ) {
						var tracks = jQuery( data.model.content ).filter( 'track' );
						_.each( tracks.toArray(), function (track) {
							content += track.outerHTML; #>
						<p>
							<input class="content-track" type="text" value="{{ track.outerHTML }}" />
							<a class="remove-setting remove-track">Remove</a>
						</p>
						<# } ); #>
					<# } else { #>
					<em>There are no associated subtitles.</em>
					<# } #>
					<textarea class="hidden content-setting">{{ content }}</textarea>
				</label>
			</div>
		</div>
	</script>

	<script type="text/html" id="tmpl-editor-gallery">
		<# if ( data.attachments ) { #>
			<div class="gallery gallery-columns-{{ data.columns }}">
				<# _.each( data.attachments, function( attachment, index ) { #>
					<dl class="gallery-item">
						<dt class="gallery-icon">
							<# if ( attachment.thumbnail ) { #>
								<img src="{{ attachment.thumbnail.url }}" width="{{ attachment.thumbnail.width }}" height="{{ attachment.thumbnail.height }}" />
							<# } else { #>
								<img src="{{ attachment.url }}" />
							<# } #>
						</dt>
						<# if ( attachment.caption ) { #>
							<dd class="wp-caption-text gallery-caption">
								{{ attachment.caption }}
							</dd>
						<# } #>
					</dl>
					<# if ( index % data.columns === data.columns - 1 ) { #>
						<br style="clear: both;">
					<# } #>
				<# } ); #>
			</div>
		<# } else { #>
			<div class="wpview-error">
				<div class="dashicons dashicons-format-gallery"></div><p>No items found.</p>
			</div>
		<# } #>
	</script>

	<script type="text/html" id="tmpl-crop-content">
		<img class="crop-image" src="{{ data.url }}">
		<div class="upload-errors"></div>
	</script>

<link rel='stylesheet' id='essb-fans-count-style-css'  href='<?php echo base_url() ?>assets/theme/front/wp-content/plugins/easy-social-share-buttons/assets/css/essb-fanscount.min.css?ver=1.3.9.8.21.1.0' type='text/css' media='all' />
<script type='text/javascript' src='<?php echo base_url() ?>assets/theme/front/wp-content/plugins/rotatingtweets/js/jquery.cycle.all.min.js?ver=4.0'></script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/theme/front/wp-content/plugins/rotatingtweets/js/rotating_tweet.js?ver=1.7.4'></script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/theme/front/wp-content/plugins/easy-social-share-buttons/assets/js/easy-social-share-buttons.js?ver=1.3.9.8.2'></script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/theme/front/wp-includes/js/jquery/jquery.form.min.js?ver=3.37.0'></script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/theme/front/wp-includes/js/jquery/ui/jquery.ui.datepicker.min.js?ver=1.10.4'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var thickboxL10n = {"next":"Next >","prev":"< Prev","image":"Image","of":"of","close":"Close","noiframes":"This feature requires inline frames. You have iframes disabled or your browser does not support them.","loadingAnimation":"<?php echo base_url() ?>assets\/theme\/front\/wp-includes\/js\/thickbox\/loadingAnimation.gif"};
/* ]]> */
</script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/theme/front/wp-includes/js/thickbox/thickbox.js?ver=3.1-20121105'></script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/theme/front/wp-includes/js/underscore.min.js?ver=1.6.0'></script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/theme/front/wp-includes/js/shortcode.min.js?ver=4.0'></script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/theme/front/wp-includes/js/backbone.min.js?ver=1.1.2'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var _wpUtilSettings = {"ajax":{"url":"\/wp-admin\/admin-ajax.php"}};
/* ]]> */
</script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/theme/front/wp-includes/js/wp-util.min.js?ver=4.0'></script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/theme/front/wp-includes/js/wp-backbone.min.js?ver=4.0'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var _wpMediaModelsL10n = {"settings":{"ajaxurl":"\/wp-admin\/admin-ajax.php","post":{"id":0}}};
/* ]]> */
</script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/theme/front/wp-includes/js/media-models.min.js?ver=4.0'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var pluploadL10n = {"queue_limit_exceeded":"You have attempted to queue too many files.","file_exceeds_size_limit":"%s exceeds the maximum upload size for this site.","zero_byte_file":"This file is empty. Please try another.","invalid_filetype":"This file type is not allowed. Please try another.","not_an_image":"This file is not an image. Please try another.","image_memory_exceeded":"Memory exceeded. Please try another smaller file.","image_dimensions_exceeded":"This is larger than the maximum size. Please try another.","default_error":"An error occurred in the upload. Please try again later.","missing_upload_url":"There was a configuration error. Please contact the server administrator.","upload_limit_exceeded":"You may only upload 1 file.","http_error":"HTTP error.","upload_failed":"Upload failed.","big_upload_failed":"Please try uploading this file with the %1$sbrowser uploader%2$s.","big_upload_queued":"%s exceeds the maximum upload size for the multi-file uploader when used in your browser.","io_error":"IO error.","security_error":"Security error.","file_cancelled":"File canceled.","upload_stopped":"Upload stopped.","dismiss":"Dismiss","crunching":"Crunching\u2026","deleted":"moved to the trash.","error_uploading":"\u201c%s\u201d has failed to upload."};
var _wpPluploadSettings = {"defaults":{"runtimes":"html5,flash,silverlight,html4","file_data_name":"async-upload","url":"\/wp-admin\/async-upload.php","flash_swf_url":"<?php echo base_url() ?>assets\/theme\/front\/wp-includes\/js\/plupload\/plupload.flash.swf","silverlight_xap_url":"<?php echo base_url() ?>assets\/theme\/front\/wp-includes\/js\/plupload\/plupload.silverlight.xap","filters":{"max_file_size":"2097152b"},"multipart_params":{"action":"upload-attachment","_wpnonce":"957e76aabd"}},"browser":{"mobile":false,"supported":true},"limitExceeded":false};
/* ]]> */
</script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/theme/front/wp-includes/js/plupload/wp-plupload.min.js?ver=4.0'></script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/theme/front/wp-includes/js/jquery/ui/jquery.ui.sortable.min.js?ver=1.10.4'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var mejsL10n = {"language":"en","strings":{"Close":"Close","Fullscreen":"Fullscreen","Download File":"Download File","Download Video":"Download Video","Play\/Pause":"Play\/Pause","Mute Toggle":"Mute Toggle","None":"None","Turn off Fullscreen":"Turn off Fullscreen","Go Fullscreen":"Go Fullscreen","Unmute":"Unmute","Mute":"Mute","Captions\/Subtitles":"Captions\/Subtitles"}};
var _wpmejsSettings = {"pluginPath":"\/wp-includes\/js\/mediaelement\/"};
/* ]]> */
</script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/theme/front/wp-includes/js/mediaelement/mediaelement-and-player.min.js?ver=2.15.0'></script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/theme/front/wp-includes/js/mediaelement/wp-mediaelement.js?ver=4.0'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var _wpMediaViewsL10n = {"url":"URL","addMedia":"Add Media","search":"Search","select":"Select","cancel":"Cancel","update":"Update","replace":"Replace","remove":"Remove","back":"Back","selected":"%d selected","dragInfo":"Drag and drop to reorder images.","uploadFilesTitle":"Upload Files","uploadImagesTitle":"Upload Images","mediaLibraryTitle":"Media Library","insertMediaTitle":"Insert Media","createNewGallery":"Create a new gallery","createNewPlaylist":"Create a new playlist","createNewVideoPlaylist":"Create a new video playlist","returnToLibrary":"\u2190 Return to library","allMediaItems":"All media items","allMediaTypes":"All media types","allDates":"All dates","noItemsFound":"No items found.","insertIntoPost":"Insert into post","unattached":"Unattached","trash":"Trash","uploadedToThisPost":"Uploaded to this post","warnDelete":"You are about to permanently delete this item.\n  'Cancel' to stop, 'OK' to delete.","warnBulkDelete":"You are about to permanently delete these items.\n  'Cancel' to stop, 'OK' to delete.","warnBulkTrash":"You are about to trash these items.\n  'Cancel' to stop, 'OK' to delete.","bulkSelect":"Bulk Select","cancelSelection":"Cancel Selection","trashSelected":"Trash Selected","untrashSelected":"Untrash Selected","deleteSelected":"Delete Selected","deletePermanently":"Delete Permanently","apply":"Apply","filterByDate":"Filter by date","filterByType":"Filter by type","searchMediaLabel":"Search Media","attachmentDetails":"Attachment Details","insertFromUrlTitle":"Insert from URL","setFeaturedImageTitle":"Set Featured Image","setFeaturedImage":"Set featured image","createGalleryTitle":"Create Gallery","editGalleryTitle":"Edit Gallery","cancelGalleryTitle":"\u2190 Cancel Gallery","insertGallery":"Insert gallery","updateGallery":"Update gallery","addToGallery":"Add to gallery","addToGalleryTitle":"Add to Gallery","reverseOrder":"Reverse order","imageDetailsTitle":"Image Details","imageReplaceTitle":"Replace Image","imageDetailsCancel":"Cancel Edit","editImage":"Edit Image","chooseImage":"Choose Image","selectAndCrop":"Select and Crop","skipCropping":"Skip Cropping","cropImage":"Crop Image","cropYourImage":"Crop your image","cropping":"Cropping\u2026","suggestedDimensions":"Suggested image dimensions:","cropError":"There has been an error cropping your image.","audioDetailsTitle":"Audio Details","audioReplaceTitle":"Replace Audio","audioAddSourceTitle":"Add Audio Source","audioDetailsCancel":"Cancel Edit","videoDetailsTitle":"Video Details","videoReplaceTitle":"Replace Video","videoAddSourceTitle":"Add Video Source","videoDetailsCancel":"Cancel Edit","videoSelectPosterImageTitle":"Select Poster Image","videoAddTrackTitle":"Add Subtitles","playlistDragInfo":"Drag and drop to reorder tracks.","createPlaylistTitle":"Create Audio Playlist","editPlaylistTitle":"Edit Audio Playlist","cancelPlaylistTitle":"\u2190 Cancel Audio Playlist","insertPlaylist":"Insert audio playlist","updatePlaylist":"Update audio playlist","addToPlaylist":"Add to audio playlist","addToPlaylistTitle":"Add to Audio Playlist","videoPlaylistDragInfo":"Drag and drop to reorder videos.","createVideoPlaylistTitle":"Create Video Playlist","editVideoPlaylistTitle":"Edit Video Playlist","cancelVideoPlaylistTitle":"\u2190 Cancel Video Playlist","insertVideoPlaylist":"Insert video playlist","updateVideoPlaylist":"Update video playlist","addToVideoPlaylist":"Add to video playlist","addToVideoPlaylistTitle":"Add to Video Playlist","editMetadata":"Edit Metadata","noMedia":"No media attachments found.","settings":{"tabs":[],"tabUrl":"<?php echo base_url() ?>assets\/theme\/front\/wp-admin\/media-upload.php?chromeless=1","mimeTypes":{"image":"Images","audio":"Audio","video":"Video"},"captions":true,"nonce":{"sendToEditor":"50bb5eb025"},"post":{"id":0},"defaultProps":{"link":"file","align":"","size":""},"attachmentCounts":{"audio":0,"video":0},"embedExts":["mp3","ogg","wma","m4a","wav","mp4","m4v","webm","ogv","wmv","flv"],"embedMimes":{"mp3":"audio\/mpeg","ogg":"audio\/ogg","wma":"audio\/x-ms-wma","m4a":"audio\/mpeg","wav":"audio\/wav","mp4":"video\/mp4","m4v":"video\/mp4","webm":"video\/webm","ogv":"video\/ogg","wmv":"video\/x-ms-wmv","flv":"video\/x-flv"},"contentWidth":1200,"months":[{"year":"2014","month":"10","text":"October 2014"},{"year":"2014","month":"8","text":"August 2014"},{"year":"2014","month":"6","text":"June 2014"}],"mediaTrash":0}};
/* ]]> */
</script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/theme/front/wp-includes/js/media-views.min.js?ver=4.0'></script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/theme/front/wp-includes/js/media-editor.min.js?ver=4.0'></script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/theme/front/wp-includes/js/media-audiovideo.min.js?ver=4.0'></script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/theme/front/wp-content/plugins/mega_main_menu/src/js/frontend/menu_functions.js?ver=4.0'></script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/theme/front/wp-content/themes/seowp/javascripts/scripts.js?ver=20140518'></script>

<script type='text/javascript' src='<?php echo base_url() ?>assets/theme/front/wp-content/plugins/masterslider/public/assets/js/jquery.easing.min.js?ver=2.5.2'></script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/theme/front/wp-content/plugins/masterslider/public/assets/js/masterslider.min.js?ver=2.5.2'></script>

</body>
</html>




