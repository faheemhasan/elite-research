<section id='content'>
<section class='vbox'>
<?php $this->load->view('admin/subheader'); ?>
<section id='content'>
<section class='wrapper'>
<div class='row'>
<div class='col-lg-12'>
<section class='panel'>
<header class='panel-heading'>
Comment
</header>
<div class='panel-body'>
<?php alert(); ?>
<section id='unseen'>
<?php if(!empty($rows)): ?>
<table class='table table-bordered table-striped table-condensed'>
<thead>
<tr>
<th>Name</th>
<th>Email</th>
<th>Created</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach($rows as $row): ?>
<tr>
<td><?php echo $row->name; ?></td>
<td><?php echo $row->email; ?></td>
<td><?php echo date('Y-m-d',$row->created); ?></td>
<td>
<a href="<?php echo base_url() ?>blog/detail/<?php echo $blog->slug ?>/#comment-<?php echo $row->id ?>" class="btn btn-info">View</a>

 <a class='btn btn-danger' onclick='return confirm("Are you sure ?");' href='<?php echo base_url()._INDEX; ?>blog/delete_comment/<?php echo $row->id; ?>/<?php echo $blog->slug ?>' >Delete</a></td></td></tr>
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
