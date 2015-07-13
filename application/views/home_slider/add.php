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
<label for='ccomment' class='control-label col-lg-2'>Name</label>
<div class='col-lg-10'>
<input type='text' class='form-control' name='name' value='<?php echo set_value("name"); ?>'> 
<span class='error'><?php echo form_error('name'); ?></span>
</div>
</div>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Order</label>
<div class='col-lg-10'>
<input type='text' class='form-control' name='order' value='<?php echo set_value("order"); ?>'> 
<span class='error'><?php echo form_error('order'); ?></span>
</div>
</div>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Image</label>
<div class='col-lg-10'>
<input type='file' name='image'>
<span class='error'><?php echo form_error('image'); ?></span>
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
