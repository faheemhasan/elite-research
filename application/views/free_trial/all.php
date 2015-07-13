<section id='content'>
<section class='vbox'>
<?php $this->load->view('admin/subheader'); ?>
<section id='content'>
<section class='wrapper'>
<div class='row'>
<div class='col-lg-12'>
<section class='panel'>
<header class='panel-heading'>
Free Trial
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
<th>Mobile</th>
<th>City</th>
<th>Created</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach($rows as $row): ?>
<tr>
<td><?php echo ucwords($row->first_name.' '.$row->last_name); ?></td>
<td><a href='mailto:<?php echo $row->email; ?>'><?php echo $row->email; ?></a></td>
<td><?php echo $row->mobile ?></td>
<td><?php echo $row->city ?></td>
<td><?php echo date('m/d/Y',$row->created) ?></td>
<td>
<a class='btn btn-success'  data-toggle="modal" data-target="#view_<?php echo $row->id ?>">View</a>
<a class='btn btn-danger' onclick='return confirm("Are you sure ?");' href='<?php echo base_url()._INDEX; ?>free_trial/delete/<?php echo $row->id; ?>' >Delete</a>
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


  				<div class='col-lg-6' style='text-align:right;' >Name</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo ucwords($row->first_name.' '.$row->last_name);  ?>
  				</div>
  				<div class='col-lg-6' style='text-align:right;' >Email</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->email; ?>
  				</div>
  				<div class='col-lg-6' style='text-align:right;' >Mobile</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->mobile; ?>
  				</div>
  				<div class='col-lg-6' style='text-align:right;' >City</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->city; ?>
  				</div>

          
            <?php $json = $row->packages; ?>
  					<?php $id_array = json_decode($json); ?>
       <div style="margin-top:90px">
         
          <div class='col-lg-6' style='text-align:right;' >Services.</div>
          <div class='col-lg-6' style='font-weight:bold;'>
            <?php if($id_array): ?>
                  <ol>
            <?php foreach($id_array as $id): ?>
                  <?php $services = get_row('services',array('id'=>$id)); ?>
                    <li>
                      <?php echo $services->title ?>
                    </li>
            <?php endforeach; ?>
                  </ol>
            <?php endif; ?>
          </div>
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
