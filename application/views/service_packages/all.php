<section id='content'>
<section class='vbox'>
<?php $this->load->view('admin/subheader'); ?>
<section id='content'>
<section class='wrapper'>
<div class='row'>
<div class='col-lg-12'>
<section class='panel'>
<header class='panel-heading'>
Service Packages


<a href='<?php echo base_url()._INDEX ?>service_packages/add' class='btn btn-success pull-right' style='margin-top:-8px;'>Add New</a>
</header>
<div class='panel-body'>
<?php alert(); ?>
<section id='unseen'>
<?php if(!empty($rows)): ?>
<table class='table table-bordered table-striped table-condensed'>
<thead>
<tr>
<th>Title</th>
<th>Background-Image</th>
<th>Icon</th>
<th>Created</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach($rows as $row): ?>
<tr>
<td><?php echo $row->title; ?></td>
<td><img src='<?php echo base_url(); ?>assets/uploads/service_packages/<?php echo $row->bg_image; ?>' style='width:80px; height:80px;'></td>
<td><i class="<?php echo $row->icon; ?>"></i></td>
<td><?php echo date('Y-m-d',$row->created); ?></td><td><a class='btn btn-info' href='<?php echo base_url()._INDEX; ?>service_packages/edit/<?php echo $row->slug; ?>'  >Edit</a>&nbsp;&nbsp;&nbsp;<a class='btn btn-danger' onclick='return confirm("Are you sure ?");' href='<?php echo base_url()._INDEX; ?>service_packages/delete/<?php echo $row->slug; ?>' >Delete</a></td></td></tr>
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



