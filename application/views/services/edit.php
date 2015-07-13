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





<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/colorpicker/css/colorpicker.css">

<script type="text/javascript" src="<?php echo base_url() ?>assets/colorpicker/js/colorpicker.js"></script>

<script type="text/javascript">

$('#bg_color').colpick({
  layout:'hex',
  submit:0,
  colorScheme:'dark',
  onChange:function(hsb,hex,rgb,el,bySetColor) {
    $(el).css('border-color','#'+hex);
    // Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
    if(!bySetColor) $(el).val(hex);
  }
}).keyup(function(){
  $(this).colpickSetColor(this.value);
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
<label for='ccomment' class='control-label col-lg-2'>Description</label>
<div class='col-lg-10'>
<textarea class='mceEditor form-control' rows='5' name='description'><?php echo $rows->description; ?></textarea>
<span class='error'><?php echo form_error('description'); ?></span>
</div>
</div>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Monthly</label>
<div class='col-lg-10'>
<input type='text' class='form-control' name='monthly' value='<?php echo $rows->monthly; ?>'> 
<span class='error'><?php echo form_error('monthly'); ?></span>
</div>
</div>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Quarterly</label>
<div class='col-lg-10'>
<input type='text' class='form-control' name='quarterly' value='<?php echo $rows->quarterly; ?>'> 
<span class='error'><?php echo form_error('quarterly'); ?></span>
</div>
</div>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Half-Yearly</label>
<div class='col-lg-10'>
<input type='text' class='form-control' name='half_yearly' value='<?php echo $rows->half_yearly; ?>'> 
<span class='error'><?php echo form_error('half_yearly'); ?></span>
</div>
</div>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Yearly</label>
<div class='col-lg-10'>
<input type='text' class='form-control' name='yearly' value='<?php echo $rows->yearly; ?>'> 
<span class='error'><?php echo form_error('yearly'); ?></span>
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


<?php $packages = get_packages() ?>
<?php if($packages): ?>

<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Service Package</label>
<div class='col-lg-10'>

<select class="form-control" name="package_id">
<?php foreach($packages as $row): ?>
  <option <?php  if($rows->package_id==$row->id) echo "selected"?> value="<?php echo $row->id ?>"><?php echo $row->title ?></option>
<?php endforeach; ?>
</select>

<span class='error'></span>
</div>
</div>

<?php endif; ?>


<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Background-color</label>
<div class='col-lg-10'>
<input type='text' class='form-control' name='bg_color' value='<?php echo $rows->bg_color; ?>'> 
<span class='error'><?php echo form_error('bg_color'); ?></span>
</div>
</div>

<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Home Featured</label>
<div class='col-lg-10'>
 <select class="form-control" name="home_featured" >
   <option <?php if($rows->home_featured=="no") echo "selected" ?> value="no">No</option>
   <option <?php if($rows->home_featured=="yes") echo "selected" ?>  value="yes">Yes</option>
 </select>
<span class='error'></span>
</div>
</div>


<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>About us Featured</label>
<div class='col-lg-10'>
 <select class="form-control" name="about_us_featured" >
   <option <?php if($rows->about_us_featured=="no") echo "selected" ?> value="no">No</option>
   <option <?php if($rows->about_us_featured=="yes") echo "selected" ?> value="yes">Yes</option>
 </select>
<span class='error'></span>
</div>
</div>


<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Footer Featured</label>
<div class='col-lg-10'>
 <select class="form-control" name="footer_featured">
   <option <?php if($rows->footer_featured=="no") echo "selected" ?>value="no">No</option>
   <option <?php if($rows->footer_featured=="yes") echo "selected" ?> value="yes">Yes</option>
 </select>
<span class='error'></span>
</div>
</div>

<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Free Trail</label>
<div class='col-lg-10'>
 <select class="form-control" name="free_trial">
   <option <?php if($rows->free_trial=="no") echo "selected" ?>value="no">No</option>
   <option <?php if($rows->free_trial=="yes") echo "selected" ?> value="yes">Yes</option>
 </select>
<span class='error'></span>
</div>
</div>





<div class='form-group'>
<div class='col-lg-offset-2 col-lg-10'>
<input type='submit' class='btn btn-primary' value='Edit'>
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


<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/colorpicker/css/colorpicker.css">
<script type="text/javascript" src="<?php echo base_url() ?>assets/colorpicker/js/colorpicker.js"></script>

<script type="text/javascript">

$('input[name=bg_color]').colpick({
  layout:'hex',
  submit:0,
  colorScheme:'dark',
  onChange:function(hsb,hex,rgb,el,bySetColor) {
    $(el).css('border-color','#'+hex);
    // Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
    if(!bySetColor) $(el).val(hex);
  }
}).keyup(function(){
  $(this).colpickSetColor(this.value);
});

</script>


<style type="text/css">

#icons_table tr td
{
  padding : 10px 0px;
}

#icons_table tr td a i:hover
{
  color: green !important;
    font-size: 14px;
}

</style>

<script type="text/javascript">
  
  $(document).on('click','#icons_table tr td a',function()
  {
      icon_name = $(this).find('i').attr('class');
      icon_tag = $(this).html();

     icon_html = '<a href="javascript:void()" class="btn btn-success">';
     icon_html+= ''+icon_tag+'</a>';

     $('#icon_show').html(icon_html);
     $('input[name=icon]').val(icon_name);

      $('#icon_modal').modal('hide');    
  });

</script>


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
