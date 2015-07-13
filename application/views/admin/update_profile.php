<style type="text/css">
  .form-control{
    width: 50%;
  }
</style>
<!-- .vbox -->
    <section id="content">
      <section class="vbox">
        
        <?php $this->load->view('admin/subheader'); ?>

        <section class="scrollable wrapper">
          <div class="tab-content">
            <section class="tab-pane active" id="basic">
              <div class="row">
                <div class="col-sm-12">

                  <?php alert(); ?>

                  <section class="panel">
                    <header class="panel-heading font-bold">Edit Profile </header>
                    <div class="panel-body">
                      <?php echo form_open(cms_current_url(), array('role'=>'form')) ?>
                        <div class="form-group">
                          <label>First Name</label>
                          <input type="text" class="form-control" name="firstname" id="firstname"  value="<?php echo $admin->firstname ?>">  
                          <span style="color: red; font-size: 12px; font-style: italic;"> <?php echo form_error('firstname') ?> </span>           
                        </div>

                        <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" class="form-control" name="lastname" id="lastname"  value="<?php echo $admin->lastname ?>">  
                          <span style="color: red; font-size: 12px; font-style: italic;"> <?php echo form_error('lastname') ?> </span>           
                        </div>

                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" class="form-control" name="email" id="email"  value="<?php echo $admin->email ?>">  
                          <span style="color: red; font-size: 12px; font-style: italic;"> <?php echo form_error('email') ?> </span>           
                        </div>

                        <div class="form-group">
                          <label>Phone</label>
                          <input type="text" class="form-control" name="mobile" id="mobile"  value="<?php echo $admin->phone ?>">  
                          <span style="color: red; font-size: 12px; font-style: italic;"> <?php echo form_error('mobile') ?> </span>           
                        </div>

                        <div class="form-group">
                          <label>Address</label>
                          <input type="text" class="form-control" name="address" id="address"  value="<?php echo $admin->address ?>">  
                          <span style="color: red; font-size: 12px; font-style: italic;"> <?php echo form_error('address') ?> </span>           
                        </div>

                        <div class="form-group">
                          <label>City</label>
                          <input type="text" class="form-control" name="city" id="city"  value="<?php echo $admin->city ?>">  
                          <span style="color: red; font-size: 12px; font-style: italic;"> <?php echo form_error('city') ?> </span>           
                        </div>

                        <div class="form-group">
                          <label>State</label>
                          <input type="text" class="form-control" name="state" id="state"  value="<?php echo $admin->state ?>">  
                          <span style="color: red; font-size: 12px; font-style: italic;"> <?php echo form_error('state') ?> </span>           
                        </div>

                        <div class="form-group">
                          <label>Zip</label>
                          <input type="text" class="form-control" name="zip" id="zip"  value="<?php echo $admin->zip ?>">  
                          <span style="color: red; font-size: 12px; font-style: italic;"> <?php echo form_error('zip') ?> </span>           
                        </div>
                        
                        
                        <button type="submit" class="btn btn-sm btn-default">Submit</button>
                      </form>
                    </div>
                  </section>
                </div>
              </div>
              
             
            
      
          </div>
        </section>
      </section>
    </section>
    <!-- /.vbox -->