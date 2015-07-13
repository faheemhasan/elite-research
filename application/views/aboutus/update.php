<!-- TinyMCE -->

<script type="text/javascript" src="<?php echo base_url() ?>assets/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript">



  tinyMCE.init({

    mode : "textareas",
    editor_selector : "mceEditor",

    theme : "advanced",  

    // plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks,openmanager",

    // theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,|,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,image,code,|,forecolor|,removeformat|,fullscreen",   

    plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks,openmanager,jbimages",   

    theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,|,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,code,|,forecolor|,removeformat|,fullscreen,jbimages",   

    

    file_browser_callback: "openmanager",

    open_manager_upload_path: '../../../uploads/'

     }); 

</script>



<section id='content'>
<section class='vbox'>
<?php $this->load->view('admin/subheader'); ?>
<section id='content'>
<section class='wrapper'>
<div class='row'>
<div class='col-lg-12'>
<?php alert(); ?>
<section class='panel'>
<header class='panel-heading'>
About Us Page
</header>
<div class='panel-body'>
<div class=' form'>
<?php echo form_open_multipart(cms_current_url(),array('class'=>'cmxform form-horizontal form-example')) ?>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Title</label>
<div class='col-lg-10'>
<input type='text' class='form-control' name='title' value='<?php echo $rows->title; ?>'> 
<span class='error'><?php echo form_error('title'); ?></span>
</div>
</div>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Top Line</label>
<div class='col-lg-10'>
<textarea class='form-control' rows='5' name='top_heading'><?php echo $rows->top_heading; ?></textarea>
<span class='error'><?php echo form_error('top_heading'); ?></span>
</div>
</div>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Bottom Line</label>
<div class='col-lg-10'>
<textarea class='form-control mceEditor ' rows='15' name='bottom_heading'><?php echo $rows->bottom_heading; ?></textarea>
<span class='error'><?php echo form_error('bottom_heading'); ?></span>
</div>
</div>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Our Vision</label>
<div class='col-lg-10'>
<textarea class='form-control ' rows='5' name='our_vision'><?php echo $rows->our_vision; ?></textarea>
<span class='error'><?php echo form_error('our_vision'); ?></span>
</div>
</div>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Our Team</label>
<div class='col-lg-10'>
<textarea class='form-control ' rows='5' name='our_team'><?php echo $rows->our_team; ?></textarea>
<span class='error'><?php echo form_error('our_team'); ?></span>
</div>
</div>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Our Values</label>
<div class='col-lg-10'>
<textarea class='form-control ' rows='5' name='our_values'><?php echo $rows->our_values; ?></textarea>
<span class='error'><?php echo form_error('our_values'); ?></span>
</div>
</div>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Background Image</label>
<div class='col-lg-10'>
<input type='file' name='image'>
<br><br><img style='width:50%;' src='<?php echo base_url(); ?>assets/uploads/aboutus/<?php echo $rows->image; ?>'>
<span class='error'><?php echo form_error('image'); ?></span>
</div>
</div>
<div class='form-group'>
<div class='col-lg-offset-2 col-lg-10'>
<input type='submit' class='btn btn-primary' value='Update'>
</div>
</div>
<?php echo form_open(); ?>
</div>
</div>
</section>
</div>
</div>
</section>
</section>
</section>
</section>
