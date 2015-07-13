




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
Add New
</header>
<div class='panel-body'>
<div class=' form'>
<?php echo form_open_multipart(cms_current_url(),array('class'=>'cmxform form-horizontal form-example')) ?>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Title</label>
<div class='col-lg-10'>
<input type='text' class='form-control' name='title' value='<?php echo set_value("title"); ?>'> 
<span class='error'><?php echo form_error('title'); ?></span>
</div>
</div>


<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Background-Image (size:1200x400)</label>
<div class='col-lg-10'>
<input type='file'   name='bg_image' > 
<span class='error'><?php echo form_error('bg_image'); ?></span>
</div>
</div>

<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'> Icon </label>
<div class='col-lg-10'>
<div style="overflow:hidden">
<a data-toggle="modal" href="#icon_modal" style="float:left;margin-right:5%" href="javascript:void()" class="btn btn-info">Select Icon</a>

<div style="float:left" id="icon_show">

  <?php if(set_value('icon')): ?>
  	<a href="javascript:void()" class="btn btn-success">
     	<i class="<?php echo set_value('icon') ?>"></i>
    </a>
  	<?php endif; ?>
	
</div>
</div>
<input type="hidden" name="icon" value="<?php if(set_value('icon')) echo set_value('icon') ?>">
<span class='error'><?php echo form_error('icon'); ?></span>
</div>
</div>




<div class='form-group'>
<div class='col-lg-offset-2 col-lg-10'>
<input type='submit' class='btn btn-primary' value='Add'>
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






