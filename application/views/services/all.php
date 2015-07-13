<section id='content'>
<section class='vbox'>
<?php $this->load->view('admin/subheader'); ?>
<section id='content'>
<section class='wrapper'>
<div class='row'>
<div class='col-lg-12'>
<section class='panel'>
<header class='panel-heading'>
Services
<a href='<?php echo base_url()._INDEX ?>services/add' class='btn btn-success pull-right' style='margin-top:-8px;'>Add New</a>
</header>
<div class='panel-body'>
<?php alert(); ?>
<section id='unseen'>
<?php if(!empty($rows)): ?>
<table class='table table-bordered table-striped table-condensed'>
<thead>
<tr>
<th>Package</th>
<th>Icon</th>
<th>Title</th>
<th>Monthly</th>
<th>Quarterly</th>
<th>Half-Yearly</th>
<th>Yearly</th>
<th>Created</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach($rows as $row): ?>
<tr>
<?php $package = get_row('service_packages',array('id'=>$row->package_id)); ?>
<td><?php  echo word_limiter(ucwords($package->title),2); ?></td>
<td><i class="<?php echo $row->icon; ?>"></i></td>
<td><?php echo word_limiter($row->title,2); ?></td>
<td><?php echo $row->monthly; ?></td>
<td><?php echo $row->quarterly; ?></td>
<td><?php echo $row->half_yearly; ?></td>
<td><?php echo $row->yearly; ?></td>
<td><?php echo date('Y-m-d',$row->created); ?></td><td><a class='btn btn-info' href='<?php echo base_url()._INDEX; ?>services/edit/<?php echo $row->slug; ?>'  >Edit</a>&nbsp;&nbsp;&nbsp;<a class='btn btn-danger' onclick='return confirm("Are you sure ?");' href='<?php echo base_url()._INDEX; ?>services/delete/<?php echo $row->slug; ?>' >Delete</a></td></td></tr>
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
