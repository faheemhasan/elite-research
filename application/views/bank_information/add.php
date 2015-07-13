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
<label for='ccomment' class='control-label col-lg-2'>Bank Logo</label>
<div class='col-lg-10'>
<input type='file' name='bank_logo'>
<span class='error'><?php echo form_error('bank_logo'); ?></span>
</div>
</div>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Bank Name</label>
<div class='col-lg-10'>
<input type='text' class='form-control' name='bank_name' value='<?php echo set_value("bank_name"); ?>'> 
<span class='error'><?php echo form_error('bank_name'); ?></span>
</div>
</div>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Account Name</label>
<div class='col-lg-10'>
<input type='text' class='form-control' name='account_name' value='<?php echo set_value("account_name"); ?>'> 
<span class='error'><?php echo form_error('account_name'); ?></span>
</div>
</div>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Account Number</label>
<div class='col-lg-10'>
<input type='text' class='form-control' name='account_number' value='<?php echo set_value("account_number"); ?>'> 
<span class='error'><?php echo form_error('account_number'); ?></span>
</div>
</div>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Branch Name</label>
<div class='col-lg-10'>
<input type='text' class='form-control' name='branch_name' value='<?php echo set_value("branch_name"); ?>'> 
<span class='error'><?php echo form_error('branch_name'); ?></span>
</div>
</div>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>IFSC Code</label>
<div class='col-lg-10'>
<input type='text' class='form-control' name='ifsc_code' value='<?php echo set_value("ifsc_code"); ?>'> 
<span class='error'><?php echo form_error('ifsc_code'); ?></span>
</div>
</div>
<div class='form-group'>
<div class='col-lg-offset-2 col-lg-10'>
<input type='submit' class='btn btn-primary' value='Add'>
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
