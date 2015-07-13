<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo PROJECT_NAME ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/admin/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/admin/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/admin/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/admin/css/font.css" type="text/css" cache="false" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/admin/css/plugin.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/admin/css/app.css" type="text/css" />
  <!--[if lt IE 9]>
    <script src="<?php echo base_url() ?>assets/theme/admin/js/ie/respond.min.js" cache="false"></script>
    <script src="<?php echo base_url() ?>assets/theme/admin/js/ie/html5.js" cache="false"></script>
    <script src="<?php echo base_url() ?>assets/theme/admin/js/ie/fix.js" cache="false"></script>
  <![endif]-->
  <script src="<?php echo base_url() ?>assets/theme/admin/js/jquery.min.js"></script>
  <style type="text/css">
    .ci_alert{
      position: fixed !important;
      top: 0px !important;
      left: 0px !important;
      width: 100% !important;
      text-align: center !important;
      z-index: 9;
    }
  </style>
</head>
<body>

  <?php alert(); ?>

  <section id="content" class="m-t-lg wrapper-md animated fadeInUp">
    <a class="nav-brand" href="<?php echo base_url() ?>"><?php echo PROJECT_NAME ?></a>
    <div class="row m-n">
      <div class="col-md-4 col-md-offset-4 m-t-lg">
        <section class="panel">
          <header class="panel-heading text-center">
            Please enter password to reset
          </header>
          
           

          
          <?php echo form_open(cms_current_url(), array('class'=>'panel-body')) ?>
            <div class="form-group">
              <label class="control-label">New Password</label>
              <input type='password' name="password" placeholder="Password" class="form-control" required>
              <span style="color:#FF0000;"><?php echo form_error('email')?></span>
            </div>
            <button type="submit" class="btn btn-info">Reset Password</button>
            <div class="line line-dashed"></div>
          </form>
        </section>
      </div>
    </div>
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder clearfix">
      <p>
        <small>&copy; <?php echo date('Y') ?> - <?php echo PROJECT_NAME ?></small>
      </p>
    </div>
  </footer>
  <!-- / footer -->
  <!-- Bootstrap -->
  <script src="<?php echo base_url() ?>assets/theme/admin/js/bootstrap.js"></script>
  <!-- app -->
  <script src="<?php echo base_url() ?>assets/theme/admin/js/app.js"></script>
  <script src="<?php echo base_url() ?>assets/theme/admin/js/app.plugin.js"></script>
  <script src="<?php echo base_url() ?>assets/theme/admin/js/app.data.js"></script>
</body>
</html>