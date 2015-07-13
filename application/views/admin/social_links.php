<section id="content">
<section class="vbox">
<?php $this->load->view('admin/subheader'); ?>


      <!--main content start-->
      <section id="content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  <div class="col-lg-12">
                     <?php echo alert(); ?>  
                      <section class="panel">
                          <header class="panel-heading">
                              Social Links
                          </header>
                          <div class="panel-body">
                              <div class=" form">            

                <?php echo form_open_multipart(current_url()); ?>                  

                  <div class="form-group">
                  <label class="control-label" for="">Twitter</label>                  
                    <input  class="form-control" type="text" name="twitter" value="<?php if(!empty($link->twitter)) echo  $link->twitter; ?>">                  
                  <span style="color:red"><?php echo form_error('twitter') ?></span>
                  </div>

                  <div class="form-group">
                  <label class="" for="">Facebook</label>                  
                    <input  class="form-control" type="text" name="facebook" value="<?php if(!empty($link->facebook)) echo  $link->facebook; ?>">                  
                  <span style="color:red"><?php echo form_error('facebook') ?></span>
                  </div>

                  <div class="form-group">
                  <label class="" for="">Youtube</label>                  
                    <input  class="form-control" type="text" name="youtube" value="<?php if(!empty($link->youtube)) echo  $link->youtube; ?>">                  
                  <span style="color:red"><?php echo form_error('youtube') ?></span>
                  </div>

                  <div class="form-group">
                  <label class="" for="">Pinterest</label>                  
                    <input  class="form-control" type="text" name="pinterest" value="<?php if(!empty($link->pinterest)) echo  $link->pinterest; ?>">                  
                  <span style="color:red"><?php echo form_error('pinterest') ?></span>
                  </div>

                  <div class="form-group">
                  <label class="" for="">Linkedin</label>                  
                    <input  class="form-control" type="text" name="linkedin" value="<?php if(!empty($link->linkedin)) echo  $link->linkedin; ?>">                  
                  <span style="color:red"><?php echo form_error('linkedin') ?></span>
                  </div>

                  <div class="form-group">
                  <label class="" for="">Instagram</label>                  
                    <input  class="form-control" type="text" name="instagram" value="<?php if(!empty($link->instagram)) echo  $link->instagram; ?>">                  
                  <span style="color:red"><?php echo form_error('instagram') ?></span>
                  </div>


                  <div class="form-group">
                  <label class="control-label" for="">Git-Hub</label>                  
                    <input  class="form-control" type="text" name="github" value="<?php if(!empty($link->github)) echo  $link->github; ?>">                  
                  <span style="color:red"><?php echo form_error('github') ?></span>
                  </div>

                  <div class="form-group">
                  <label class="control-label" for="">Flickr</label>                  
                    <input  class="form-control" type="text" name="flickr" value="<?php if(!empty($link->flickr)) echo  $link->flickr; ?>">                  
                  <span style="color:red"><?php echo form_error('flickr') ?></span>
                  </div>


                  <br>
                  <input type="submit" class="btn btn-primary" value="Update">

                </form>             

            </div>

                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
</section>            