<section id='content'>
<section class='vbox'>
<?php $this->load->view('admin/subheader'); ?>
<section id='content'>
<section class='wrapper'>
<div class='row'>
<div class='col-lg-12'>
<section class='panel'>
<header class='panel-heading'>
Contact Us
</header>
<div class='panel-body'>
<?php alert(); ?>
<section id='unseen'>
<?php if(!empty($rows)): ?>
<table class='table table-bordered table-striped table-condensed'>
<thead>
<tr>
<th>Name</th>
<th>Company</th>
<th>Email</th>
<th>Phone</th>
<th>Created</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach($rows as $row): ?>
<tr>
<td><?php echo $row->full_name; ?></td>
<td><?php echo $row->company; ?></td>
<td><?php echo $row->email; ?></td>
<td><?php echo $row->phone; ?></td>
<td><?php echo date('Y-m-d',$row->created); ?></td>
<td>


<a class='btn btn-info'  data-toggle="modal" data-target="#view_<?php echo $row->id ?>">View</a>

<!-- Modal -->
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="view_<?php echo $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title" id="myModalLabel">Full Information</h4>
      		</div>
      		<div class="modal-body">

  				<div class='col-lg-6' style='font-weight:bold;text-align:right;' >
  				Name</div>
  				<div class='col-lg-6' >
  					<?php echo $row->full_name; ?>
  				</div>

  				<div class='col-lg-6' style='font-weight:bold;text-align:right;' >Company</div>
  				<div class='col-lg-6' >
  					<?php echo $row->company; ?>
  				</div>


  				<div class='col-lg-6' style='font-weight:bold;text-align:right;' >Email</div>
  				<div class='col-lg-6' >
  					<a href='mailto:<?php echo $row->email; ?>'><?php echo $row->email; ?></a>
  				</div>

  				<div class='col-lg-6' style='font-weight:bold;text-align:right;' >Phone</div>
  				<div class='col-lg-6' >
  					<?php echo $row->phone; ?>
  				</div>

  				<div class='col-lg-6' style='font-weight:bold;text-align:right;' >Message</div>
  				<div class='col-lg-6' >
  					<?php echo $row->message; ?>
  				</div>

  				<div>&nbsp;</div>
		    </div>

          <div class="modal-footer"  style='clear:both;'>
          </div>
		</div>
  	</div>
</div>
<!-- Modal -->
<!-- Modal -->




&nbsp;&nbsp;&nbsp;
<a class='btn btn-danger' onclick='return confirm("Are you sure ?");' href='<?php echo base_url()._INDEX; ?>contactus/delete/<?php echo $row->id; ?>' >Delete</a></td></td></tr>
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
