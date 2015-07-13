<section id='content'>
<section class='vbox'>
<?php $this->load->view('admin/subheader'); ?>
<section id='content'>
<section class='wrapper'>
<div class='row'>
<div class='col-lg-12'>
<section class='panel'>
<header class='panel-heading'>
Bank Information
<a href='<?php echo base_url()._INDEX ?>bank_information/add' class='btn btn-success pull-right' style='margin-top:-8px;'>Add New</a>
</header>
<div class='panel-body'>
<?php alert(); ?>
<section id='unseen'>
<?php if(!empty($rows)): ?>
<table class='table table-bordered table-striped table-condensed'>
<thead>
<tr>
<th>Bank Logo</th>
<th>Bank Name</th>
<th>Account Name</th>
<th>Account Number</th>
<th>Branch Name</th>
<th>IFSC Code</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach($rows as $row): ?>
<tr>
<td><img src='<?php echo base_url(); ?>assets/uploads/bank_information/<?php echo $row->bank_logo; ?>' style='width:90px; height:60px;'></td>
<td><?php echo $row->bank_name; ?></td>
<td><?php echo $row->account_name; ?></td>
<td><?php echo $row->account_number; ?></td>
<td><?php echo $row->branch_name; ?></td>
<td><?php echo $row->ifsc_code; ?></td>
<td><a class='btn btn-info' href='<?php echo base_url()._INDEX; ?>bank_information/edit/<?php echo $row->slug; ?>'  >Edit</a>&nbsp;&nbsp;&nbsp;<a class='btn btn-danger' onclick='return confirm("Are you sure ?");' href='<?php echo base_url()._INDEX; ?>bank_information/delete/<?php echo $row->slug; ?>' >Delete</a></td>
</td></tr>
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
