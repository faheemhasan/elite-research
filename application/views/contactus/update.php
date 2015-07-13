<script type="text/javascript" src="http://localhost/elite/assets/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
    mode : "textareas",
    editor_selector : "mceEditor",
    theme : "advanced",  
    plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks,openmanager,jbimages",   
    theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,|,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,code,|,forecolor|,removeformat|,fullscreen,jbimages",   
    file_browser_callback: "openmanager",
    open_manager_upload_path: '../../../uploads/'
}); 
</script>
<!-- /TinyMCE -->



<section id='content'>
<section class='vbox'>
<?php $this->load->view('admin/subheader'); ?>
<section id='content'>
<section class='wrapper'>
<div class='row'>
<div class='col-lg-12'>

<div id="success_msg">
<?php alert(); ?>
</div>

<section class='panel'>
<header class='panel-heading'>
Update Contact Us Detail
</header>
<div class='panel-body'>
<div class=' form'>
<?php echo form_open_multipart(cms_current_url(),array('class'=>'cmxform form-horizontal form-example','id'=>'form_contact')) ?>


<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Address</label>
<div class='col-lg-10'>
<input type='text' class='form-control'  name='address' value='<?php echo $rows->address; ?>'> 
<span class='error'></span>
</div>
</div>

<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Map Address</label>
<div class='col-lg-10'>
<input type='text' class='form-control'  name='map_address' value='<?php echo $rows->map_address; ?>'> 
<span class='error'></span>
</div>
</div>

<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Emails</label>
<div class='col-lg-10'>
<input type='text' placeholder="" class='form-control' name='email' value='<?php echo $rows->email; ?>'> 
<p>Enter Email addresses Seperated by Comma. i.e. john@gmail.com , smith@gmail.com , brad@gmail.com</p>
<span class='error'></span>
</div>
</div>

<div class='form-group '>
<label for='ccomment' class='control-label col-lg-2'>Contacts</label>
<div class='col-lg-10'>
<input type='text' placeholder="" class='form-control' name='contact' value='<?php echo $rows->contact; ?>'> 
<p>Enter Contact numbers Seperated by Comma. i.e. 1234567890 , 9876543210 </p>
<span class='error'></span>
</div>
</div>






<div class='form-group'>
<div class='col-lg-offset-2 col-lg-10'>
<input type='submit' class='btn btn-primary' value='Update'>
</div>
</div>


<?php echo form_close(); ?>
</div>
</div>
</section>
</div>
</div>
</section>
</section>
</section>
</section>


<script type="text/javascript">
	$(document).on('submit','#form_contact',function(event)
	{
         event.preventDefault();
		$('#success_msg').hide();
		$('input[type=submit]').attr('disabled','disabled');

		 status = true; 

         address = $('input[name=address]').val();
         map_address = $('input[name=map_address]').val();
         email = $('input[name=email]').val();
         contact = $('input[name=contact]').val();

         if(address=="")
         {
           $('input[name=address]').siblings('span').html("Address field is required");
           status = false;
         }
         else
         {
           $('input[name=address]').siblings('span').html("");
         }

         if(map_address=="")
         {
           $('input[name=map_address]').siblings('span').html("Map Address field is required");
           status = false;
         }
         else
         {
           $('input[name=map_address]').siblings('span').html("");
         }

// /////////////Email Validation ///////////////////////

         if(email=="")
         {
           $('input[name=email]').siblings('span').html("Email field is required");
           status = false;
         }
         else
         {
		     flag = true;
	         email_array = email.split(',');
	         email_array.forEach(function(value,index)
	         {
					    if (!validateEmail(value) && value!="")
					    {
					        flag =  false;
					        status=false;
					    }
	         });

				if(flag)
				{
					$('input[name=email]').siblings('span').html("");
				}
				else
				{
					$('input[name=email]').siblings('span').html("Invalid Email Address");
				}		    
         }


// /////////////Email Validation End ///////////////////////

         if(contact=="")
         {
           $('input[name=contact]').siblings('span').html("Contact field is required");
           status = false;
         }
         else
         {
			 // contact_flag=true;
	   //       contact_array = contact.split(',');
	   //       contact_array.forEach(function(value,index)
	   //       {
				// 	    if (isNaN(value)==true)
				// 	    {
				// 	        contact_flag =  false;
				// 	    }
	   //       });

				// if(contact_flag)
				// {
					$('input[name=contact]').siblings('span').html("");
				// }
				// else
				// {
				// 	$('input[name=contact]').siblings('span').html("Contact must be only numeric value");
			 //        status=false;
				// }		    
         }

       
         if(status=='true')
         {
            slug = '<?php echo $rows->slug ?>';
            $.ajax({
                type:"post",
                url:"<?php echo base_url() ?>contactus/update/"+slug,
                data:{email:email,contact:contact,address:address,map_address:map_address},
                success:function(res)
                {
                    if(res=="1")
                    {
						$('input[type=submit]').removeAttr('disabled','disabled');
                    	html = '<div class="alert alert-success ci_alert alert-dismissable">';
                        
                        html += '<button data-dismiss="alert" class="close" type="button">×</button>';
  			
  			            html += '<strong>Success!</strong> Updated SuccessFully </div>';

                    	$('#success_msg').html(html);
                       $('#success_msg').fadeIn();
                    }
                }
            });
         }
         else
         {
			$('input[type=submit]').removeAttr('disabled','disabled');
         }


	});


	    function validateEmail(email)
	    {       
	          var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	          // alert(re.test(email));
	          return re.test(email);
	    }
</script>

