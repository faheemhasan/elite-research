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
Payment Page
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
<label for='ccomment' class='control-label col-lg-2'>Background Image</label>
<div class='col-lg-10'>
<input type='file' name='bg'>
<br><br><img style='width:100%; height:300px; border-radius:5px;' src='<?php echo base_url(); ?>assets/uploads/payment/<?php echo $rows->bg; ?>'>
<span class='error'><?php echo form_error('bg'); ?></span>
</div>
</div>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>First Logo</label>
<div class='col-lg-10'>
<input type='file' name='logo1'>
<br><br><img style='width:150px; height:100px; border-radius:5px;' src='<?php echo base_url(); ?>assets/uploads/payment/<?php echo $rows->logo1; ?>'>
<span class='error'><?php echo form_error('logo1'); ?></span>
</div>
</div>
<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Second Logo</label>
<div class='col-lg-10'>
<input type='file' name='logo2'>
<br><br><img style='width:150px; height:100px; border-radius:5px;' src='<?php echo base_url(); ?>assets/uploads/payment/<?php echo $rows->logo2; ?>'>
<span class='error'><?php echo form_error('logo2'); ?></span>
</div>
</div>
<div class='form-group'>
<div class='col-lg-offset-2 col-lg-10'>
<input type='submit' class='btn btn-success' value='Update'>
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
