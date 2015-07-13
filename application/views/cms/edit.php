<script type="text/javascript" src="http://localhost/elite/assets/tiny_mce/tiny_mce.js"></script>

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
Edit
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
<label for='ccomment' class='control-label col-lg-2'>Content</label>
<div class='col-lg-10'>
<textarea class='form-control mceEditor' rows='20' name='content'><?php echo $rows->content; ?></textarea>
<span class='error'><?php echo form_error('content'); ?></span>
</div>
</div>

<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Backgroung Image</label>
<div class='col-lg-10'>
<input type='file' name='image'>
<br><br><img style='width:100%; border-radius:3px; height:200px;' src='<?php echo base_url(); ?>assets/uploads/cms/<?php echo $rows->image; ?>'>
<span class='error'><?php echo form_error('image'); ?></span>
</div>
</div>


<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'> Icon </label>
<div class='col-lg-10'>
<div style="overflow:hidden">
<a data-toggle="modal" href="#icon_modal" style="float:left;margin-right:5%" href="javascript:void()" class="btn btn-info">Select Icon</a>
<div style="float:left" id="icon_show">
<?php if($rows->icon): ?>
<a href="javascript:void()" class="btn btn-success">
<i class="<?php echo $rows->icon ?>"></i>
</a>
<?php endif; ?>
</div>
</div>
<input type="hidden" name="icon" value="<?php if($rows->icon) echo $rows->icon ?>">
<span class='error'><?php echo form_error('icon'); ?></span>
</div>
</div>





<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Link Show In Header</label>
<div class='col-lg-10'>
<select class='form-control' name='in_header'>
<option value='0' <?php if($rows->in_header == 0){ echo 'selected'; } ?> >No</option>
<option value='1' <?php if($rows->in_header == 1){ echo 'selected'; } ?> >Yes</option>
</select>
<span class='error'><?php echo form_error('in_header'); ?></span>
</div>
</div>

<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Link Show In Footer</label>
<div class='col-lg-10'>
<select class='form-control' name='in_footer'>
<option value='0'  <?php if($rows->in_footer == 0){ echo 'selected'; } ?> >No</option>
<option value='1'  <?php if($rows->in_footer == 1){ echo 'selected'; } ?> >Yes</option>
</select>
<span class='error'><?php echo form_error('in_footer'); ?></span>
</div>
</div>

<div class='form-group'>
<div class='col-lg-offset-2 col-lg-10'>
<input type='submit' class='btn btn-primary' value='Edit'>
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



<div class="modal fade" id="icon_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Select Icons</h4>
      </div>
      <div class="modal-body" style="width:500px">


           <?php $a = $this->load->view('service_packages/icons',TRUE) ; echo $a ?>


      </div>

      <div class="modal-footer">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
