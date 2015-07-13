<section id='content'>
<section class='vbox'>
<?php $this->load->view('admin/subheader'); ?>
<section id='content'>
<section class='wrapper'>
<div class='row'>
<div class='col-lg-12'>
<section class='panel'>
<header class='panel-heading'>
Testimonials
<a href='<?php echo base_url()._INDEX ?>testimonials/add' class='btn btn-success pull-right' style='margin-top:-8px;'>Add New</a>
</header>
<div class='panel-body'>
<?php alert(); ?>
<section id='unseen'>
<?php if(!empty($rows)): ?>
<table class='table table-bordered table-striped table-condensed'>
<thead>
<tr>
<th>Image</th>
<th>Name</th>
<th>Position</th>
<th>Quote</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach($rows as $row): ?>
<tr>
<td><img src='<?php echo base_url(); ?>assets/uploads/testimonials/<?php echo $row->image; ?>' style='width:80px; height:80px; border-radius:40px;'></td>
<td><?php echo $row->name; ?></td>
<td><?php echo $row->position; ?></td>
<td><?php echo word_limiter($row->quote,10); ?></td>
<td><a class='btn btn-info' href='<?php echo base_url()._INDEX; ?>testimonials/edit/<?php echo $row->slug; ?>'  >Edit</a>&nbsp;&nbsp;&nbsp;<a class='btn btn-danger' onclick='return confirm("Are you sure ?");' href='<?php echo base_url()._INDEX; ?>testimonials/delete/<?php echo $row->slug; ?>' >Delete</a></td></td></tr>
<?php endforeach; ?>
</tbody>
</table>
<?php else: ?>
No record found.
<?php endif; ?>
</section>
<?php echo @$pagination; ?>
</div>
</section>
</div>
</div>
</section>
</section>
</section>
</section>
