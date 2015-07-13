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
Pricing Page
</header>
<div class='panel-body'>
<div class=' form'>
<?php echo form_open_multipart(cms_current_url(),array('class'=>'cmxform form-horizontal form-example')) ?>

<div class='form-group ' style="display:none">
<label for='ccomment' class='control-label col-lg-2'>Page Title</label>
<div class='col-lg-10'>
<input type='text' class='form-control' name='page_title' value='<?php echo $rows->page_title; ?>'> 
<span class='error'><?php echo form_error('page_title'); ?></span>
</div>
</div>




<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Background Image</label>
<div class='col-lg-10'>
<input type='file' name='bg_image'>
<br><br><img style='width:400px;height:200px' src='<?php echo base_url(); ?>assets/uploads/pricing/home/<?php echo $rows->bg_image; ?>'>
<span class='error'><?php echo form_error('bg_image'); ?></span>
</div>
</div>



<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Header Description</label>
<div class='col-lg-10'>
<textarea class='form-control ' rows='5' name='header_description'><?php echo $rows->header_description; ?></textarea>
<span class='error'><?php echo form_error('header_description'); ?></span>
</div>
</div>



<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Header Image</label>
<div class='col-lg-10'>
<input type='file' name='header_image'>
<br><br><img style='width:100px;height:100px' src='<?php echo base_url(); ?>assets/uploads/pricing/home/<?php echo $rows->header_image; ?>'>
<span class='error'><?php echo form_error('header_image'); ?></span>
</div>
</div>


<div class='form-group'>
<div class='col-lg-offset-2 col-lg-10'>
<input type='submit' class='btn btn-primary' value='Update'>
</div>
</div>



<?php echo form_close(); ?>
</div>
</div>
</section>
</div>
</div>
</section>
</section>
</section>
</section>
