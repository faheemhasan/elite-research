<section id='content'>
<section class='vbox'>
<?php $this->load->view('admin/subheader'); ?>
<section id='content'>
<section class='wrapper'>
<div class='row'>
<div class='col-lg-12'>
<section class='panel'>
<header class='panel-heading'>
Career
</header>
<div class='panel-body'>
<?php alert(); ?>
<section id='unseen'>
<?php if(!empty($rows)): ?>
<table class='table table-bordered table-striped table-condensed'>
<thead>
<tr>
<th>Position Applied For</th>
<th>Name</th>
<th>Email</th>
<th>Resume</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach($rows as $row): ?>
<tr>
<td><?php echo $row->position_applied_for; ?></td>
<td><?php echo $row->name; ?></td>
<td><a href='mailto:<?php echo $row->email; ?>'><?php echo $row->email; ?></a></td>
<td><a href='<?php echo base_url()._INDEX ?>career/download/<?php echo $row->resume; ?>' >Download Resume</a></td>
<td>
<a class='btn btn-success'  data-toggle="modal" data-target="#view_<?php echo $row->id ?>">View</a>
<a class='btn btn-danger' onclick='return confirm("Are you sure ?");' href='<?php echo base_url()._INDEX; ?>career/delete/<?php echo $row->slug; ?>' >Delete</a>
</td>
</tr>


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

          <div class='col-lg-6' style='font-weight:bold;text-align:right;' >   Position Applied For</div>
  				<div class='col-lg-6' >
  					<?php echo $row->position_applied_for; ?>
  				</div>

          <div class='col-lg-6' style='font-weight:bold;text-align:right;' >   Qualification Title</div>
  				<div class='col-lg-6' >
  					<?php echo $row->degree; ?>
  				</div>

          <div class='col-lg-6' style='font-weight:bold;text-align:right;' >   Name</div>
  				<div class='col-lg-6' >
  					<?php echo $row->name; ?>
  				</div>

          <div class='col-lg-6' style='font-weight:bold;text-align:right;' >   Email</div>
  				<div class='col-lg-6' >
  					<a href='mailto:<?php echo $row->email; ?>'><?php echo $row->email; ?></a>
  				</div>

          <div class='col-lg-6' style='font-weight:bold;text-align:right;' >   Phone</div>
  				<div class='col-lg-6' >
  					<?php echo $row->phone; ?>
  				</div>

          <div class='col-lg-6' style='font-weight:bold;text-align:right;' >   Address</div>
  				<div class='col-lg-6' >
  					<?php echo $row->address; ?>
  				</div>

          <div class='col-lg-6' style='font-weight:bold;text-align:right;' >   Institute/University</div>
  				<div class='col-lg-6' >
  					<?php echo $row->clg; ?>
  				</div>

          <div class='col-lg-6' style='font-weight:bold;text-align:right;' >   Year Completed</div>
  				<div class='col-lg-6' >
  					<?php echo $row->completed; ?>
  				</div>

  				<div>&nbsp;</div>
		    </div>
      		<div class="modal-footer"  style='clear:both;'>
				<a class='btn btn-success' href='<?php echo base_url()._INDEX ?>career/download/<?php echo $row->resume; ?>' >Download Resume</a>
      		</div>
		</div>
  	</div>
</div>
<!-- Modal -->
<!-- Modal -->





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
