<style type="text/css">
  .form-control{
    width: 50%;
  }
</style>

<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/plugins/password_strength_checker/style.css">
<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/password_strength_checker/script.js"></script>
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
                    <header class="panel-heading font-bold">Change Password </header>
                    <div class="panel-body">
                      <?php echo form_open(cms_current_url(), array('role'=>'form')) ?>
                        <div class="form-group">
                          <label>Old Password</label>
                          <input type="password" class="form-control" name="pwd" id="pwd"  value="<?php echo set_value('pwd') ?>">  
                          <span style="color: red; font-size: 12px; font-style: italic;"> <?php echo form_error('pwd') ?> </span>           
                        </div>

                        <div class="form-group">
                          <label>New Password <span id="result"> &nbsp; </span> </label>
                          <input type="password" class="form-control" name="npwd" id="password"  value="<?php echo set_value('npwd') ?>">  
                          <span style="color: red; font-size: 12px; font-style: italic;"> <?php echo form_error('npwd') ?> </span>           
                        </div>

                        <div class="form-group">
                          <label>Confirm New Password</label>
                          <input type="password" class="form-control" name="cpwd" id="cpwd"  value="<?php echo set_value('cpwd') ?>">  
                          <span style="color: red; font-size: 12px; font-style: italic;"> <?php echo form_error('cpwd') ?> </span>           
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