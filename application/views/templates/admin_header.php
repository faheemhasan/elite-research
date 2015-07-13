<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo PROJECT_NAME ?> | Admin Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/admin/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/admin/css/colorbox.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/admin/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/admin/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/admin/css/font.css" type="text/css" cache="false" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/admin/css/plugin.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/admin/css/app.css" type="text/css" />
 
<link rel='stylesheet' id='dslc-font-awesome-css'  href='<?php echo base_url() ?>assets/theme/front/wp-content/plugins/ds-live-composer/css/font-awesome.css?ver=4.0' type='text/css' media='all' />
<link rel='stylesheet' id='mm_icomoon-css'  href='<?php echo base_url() ?>assets/theme/front/wp-content/plugins/mega_main_menu/src/css/external/icomoon.css?ver=4.0' type='text/css' media='all' />
<link rel='stylesheet' id='mm_font-awesome-css'  href='<?php echo base_url() ?>assets/theme/front/wp-content/plugins/mega_main_menu/src/css/external/font-awesome.css?ver=4.0' type='text/css' media='all' />
  <!--[if lt IE 9]>
    <script src="<?php echo base_url() ?>assets/theme/admin/js/ie/respond.min.js" cache="false"></script>
    <script src="<?php echo base_url() ?>assets/theme/admin/js/ie/html5.js" cache="false"></script>
    <script src="<?php echo base_url() ?>assets/theme/admin/js/ie/fix.js" cache="false"></script>
  <![endif]-->
  <!-- ript src="<?php echo base_url() ?>assets/theme/admin/js/jquery.min.js"></scri -->


  <script src="<?php echo base_url(); ?>assets/theme/admin/js/jquery.min.js"></script>  
</head>
<body>
  <section class="hbox stretch">
    <!-- .aside -->
    <aside class="bg-light aside b-r" id="nav">
      <section class="vbox">
        <header class="bg-dark nav-bar">
          <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav">
            <i class="fa fa-bars"></i>
          </a>
          <a href="<?php echo base_url()._INDEX; ?>admin" class="nav-brand"><?php echo PROJECT_NAME ?></a>
          <a class="btn btn-link visible-xs" data-toggle="collapse" data-target=".navbar-collapse">
            <i class="fa fa-comment-o"></i>
          </a>
        </header>
        <section>
          <!-- nav -->
          <nav class="nav-primary b-r bg-gradient hidden-xs">
            <ul class="nav">
            
            <li>
                <a href="<?php echo base_url()._INDEX.'admin'; ?>">
                  <i class="fa fa-dashboard"></i>
                  <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url() ?>blog/all">
                  <i class="im-icon-blogger-2"></i>
                  <span>Blog</span>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url() ?>cms/all">
                  <i class="fa fa-folder-open"></i>
                  <span>CMS</span>
                </a>
            </li>

            <li class="dropdown-submenu">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bar-chart-o"></i>
                  <span>Products</span>
                </a>
                <ul class="dropdown-menu">                
                  	<li>
                    	<a href="<?php echo base_url() ?>service_packages/all">Packages</a>
                  	</li>
                    <li>
                	    <a href="<?php echo base_url() ?>services/all">Services</a>
                	</li>
                </ul>
            </li>

            <li class="dropdown-submenu">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                  	<i class="fa fa-cog"></i>
                  	<span>Site content</span>
                </a>
                <ul class="dropdown-menu">                
		            <li>
		                <a href="<?php echo base_url() ?>bank_information/all">
		                  	Account Details
		                </a>
		            </li>
                  	<li>
                  		<a href="<?php echo base_url() ?>home_slider/all">
                  			Home Slider
              			</a>
           		    </li>
           		    <li>
           		    	<a href="<?php echo base_url() ?>admin/social_links">
                  			Social Links
		                </a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>testimonials/all">
							Testimonials
						</a>
                   	</li>
                   	<li>
                   		<a href="<?php echo base_url() ?>site_content/change_logo">
                   			Website logo
               			</a>
        		    </li>
                </ul>
            </li>

			<li class="dropdown-submenu">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-download"></i>
                  <span>Submissions</span>
                </a>
                <ul class="dropdown-menu">                
					<li>
		                <a href="<?php echo base_url() ?>career/all">
		                  	Career Form
		                </a>
	                </li>
	                <li>    
	                    <a href="<?php echo base_url() ?>contactus/all">
	                    	Contact Us Form
                    	</a>
					</li>
	                <li>    
	                    <a href="<?php echo base_url() ?>free_trial/all">
	                    	Free Trial Form
                    	</a>
					</li>
					<li>	
						<a href="<?php echo base_url()._INDEX ?>kyc/all">
							KYC Form
						</a>
					</li>
                </ul>
            </li>

			<li class="dropdown-submenu">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                  	<i class="fa fa-file"></i>
                  	<span>Templates</span>
                </a>
                <ul class="dropdown-menu">                
                  	<li>
						<a href="<?php echo base_url() ?>aboutus/update">About Us Page</a>
					</li>
					<li>	
						<a href="<?php echo base_url() ?>contactus/update">Contact Us Page</a>
					</li>
					<li>	
						<a href="<?php echo base_url() ?>free_trial/update">Free Trial Page</a>
					</li>
					<li>	
						<a href="<?php echo base_url() ?>home/update">Home Page</a>
                    </li>
                    <li>	
                    	<a href="<?php echo base_url() ?>payment/update">Payment Page</a>
                    </li>
                    <li>	
                    	<a href="<?php echo base_url() ?>pricing/update">Pricing Page</a>
                  	</li>
                  	<li>	
                  		<a href="<?php echo base_url() ?>tracksheets/update">Tracksheet Page</a>
                  	</li>
                </ul>
            </li>

            <li>
                <a href="<?php echo base_url() ?>tracksheets/all">
                  	<i class="fa fa-list"></i>
                  	Tracksheets
                </a>
            </li>

            </ul>
          </nav>
          <!-- / nav -->
        </section>
        </section>
    </aside>
    <!-- /.aside -->

 <style>
 .error{
  color:red !important;
 }
 .panel-heading{
  font-weight: bold;
 }
 </style>



<script>
onload = function(){
	$('a').each(function(){
		var url = $(this).attr('href');
		if(url == '<?php echo current_url(); ?>'){
			$(this).parents().addClass('active');
		}
	});
}
</script>