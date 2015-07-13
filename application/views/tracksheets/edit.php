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
<label for='ccomment' class='control-label col-lg-2'>Image</label>
<div class='col-lg-10'>
<input type='file' name='image'>
<br><br><img style='width:500px; height:150px; border-radius:10px;' src='<?php echo base_url(); ?>assets/uploads/tracksheets/<?php echo $rows->image; ?>'>
<span class='error'><?php echo form_error('image'); ?></span>
</div>
</div>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Title</label>
<div class='col-lg-10'>
<input type='text' class='form-control' name='title' value='<?php echo $rows->title; ?>'> 
<span class='error'><?php echo form_error('title'); ?></span>
</div>
</div>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Subtitle</label>
<div class='col-lg-10'>
<input type='text' class='form-control' name='subtitle' value='<?php echo $rows->subtitle; ?>'> 
<span class='error'><?php echo form_error('subtitle'); ?></span>
</div>
</div>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Password</label>
<div class='col-lg-10'>
<input type='password' class='form-control' name='password' value='<?php echo $rows->password; ?>'> 
<span class='error'><?php echo form_error('password'); ?></span>
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
<label for='ccomment' class='control-label col-lg-2'>Show In Header</label>
<div class='col-lg-10'>
<select name='in_header' class='form-control'>
<option value='0' <?php if($rows->in_header == 0){ echo 'selected'; } ?>>No</option>
<option value='1' <?php if($rows->in_header == 1){ echo 'selected'; } ?>>Yes</option>
</select>
</div>
</div>



<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Upload File</label>
<div class='col-lg-10'>
<input type='file' name='download'>
<br>
<a href='<?php echo base_url(); ?>tracksheets/download/<?php echo $rows->download; ?>'>View Tracksheet</a>
<br>
<span class='error'><?php echo form_error('download'); ?></span>
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
		<?php $this->load->view('service_packages/icons',TRUE); ?>
	</div>
	<div class="modal-footer">
	</div>
</div>
</div>
</div>