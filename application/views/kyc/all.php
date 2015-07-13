<section id='content'>
<section class='vbox'>
<?php $this->load->view('admin/subheader'); ?>
<section id='content'>
<section class='wrapper'>
<div class='row'>
<div class='col-lg-12'>
<section class='panel'>
<header class='panel-heading'>
KYC Form
</header>
<div class='panel-body'>
<?php alert(); ?>
<section id='unseen'>
<?php if(!empty($rows)): ?>
<table class='table table-bordered table-striped table-condensed'>
<thead>
<tr>
<th>Photo</th>
<th>Name</th>
<th>Email</th>
<th>ID Proof</th>
<th>Address Proof</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach($rows as $row): ?>
<tr>
<td><img style='border-radius:3px; width:100%; height:100px;' src='<?php echo base_url()._INDEX; ?>assets/uploads/kyc/photo/<?php echo $row->photo ?>'></td>
<td><?php echo $row->name; ?></td>
<td><a href='mailto:<?php echo $row->email; ?>'><?php echo $row->email; ?></a></td>
<td><a href='<?php echo base_url()._INDEX; ?>kyc/download/id_proof/<?php echo $row->id_proof ?>'>Download ID Proof</a></td>
<td><a href='<?php echo base_url()._INDEX; ?>kyc/download/address_proof/<?php echo $row->address_proof ?>'>Download Address Proof</a></td>
<td>
<a class='btn btn-success'  data-toggle="modal" data-target="#view_<?php echo $row->id ?>">View</a>
<a class='btn btn-danger' onclick='return confirm("Are you sure ?");' href='<?php echo base_url()._INDEX; ?>kyc/delete/<?php echo $row->slug; ?>' >Delete</a>
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

  				<div class='col-lg-12' align='center'>
  					<img src='<?php echo base_url() ?>assets/uploads/kyc/photo/<?php echo $row->photo; ?>' style='border-radius:5px; width:200px;'>
  				</div>

  				<div class='col-lg-6' style='text-align:right;' >Name</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->name; ?>
  				</div>
  				<div class='col-lg-6' style='text-align:right;' >Father Name</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->father_name; ?>
  				</div>
  				<div class='col-lg-6' style='text-align:right;' >Nationality</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->nationality; ?>
  				</div>
  				<div class='col-lg-6' style='text-align:right;' >Gender</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->gender; ?>
  				</div>
  				<div class='col-lg-6' style='text-align:right;' >Marital Status</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->marital; ?>
  				</div>
  				<div class='col-lg-6' style='text-align:right;' >Residental Status</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->residental; ?>
  				</div>
  				<div class='col-lg-6' style='text-align:right;' >Date Of Birth</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->dob; ?>
  				</div>
  				<div class='col-lg-6' style='text-align:right;' >PAN Number</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->pan; ?>
  				</div>
  				<div class='col-lg-6' style='text-align:right;' >Unique Identification No.</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->uin; ?>
  				</div>
  				<div class='col-lg-12' style='text-align:center;'>
					<a class='btn btn-success' href='<?php echo base_url()._INDEX ?>kyc/download/id_proof/<?php echo $row->id_proof; ?>' >
						Download ID Proof
					</a>
  				</div>


  				<div class='col-lg-6' style='text-align:right;' >Address</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->address; ?>
  				</div>
  				<div class='col-lg-6' style='text-align:right;' >City</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->city; ?>
  				</div>
  				<div class='col-lg-6' style='text-align:right;' >State</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->state; ?>
  				</div>
  				<div class='col-lg-6' style='text-align:right;' >Pincode</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->pincode; ?>
  				</div>
  				<div class='col-lg-6' style='text-align:right;' >Country</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->country; ?>
  				</div>
  				<div class='col-lg-6' style='text-align:right;' >Fax</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->fax; ?>
  				</div>
  				<div class='col-lg-6' style='text-align:right;' >Mobile</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->mobile; ?>
  				</div>
  				<div class='col-lg-6' style='text-align:right;' >Telephone</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->telephone; ?>
  				</div>
  				<div class='col-lg-6' style='text-align:right;' >Email</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->email; ?>
  				</div>
  				<div class='col-lg-12' style='text-align:center;'>
					<a class='btn btn-success' href='<?php echo base_url()._INDEX ?>kyc/download/address_proof/<?php echo $row->address_proof; ?>' >
						Download Address Proof
					</a>
  				</div>

  				<div class='col-lg-6' style='text-align:right;' >Annual Income</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->income; ?>
  				</div>
  				<div class='col-lg-6' style='text-align:right;' >New-worth Amount</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->new_worth_amount; ?>
  				</div>
  				<div class='col-lg-6' style='text-align:right;' >New-worth Date</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->new_worth_date; ?>
  				</div>
  				<div class='col-lg-6' style='text-align:right;' >Occupation</div>
  				<div class='col-lg-6' style='font-weight:bold;'>
  					<?php echo $row->occupation; ?>
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
