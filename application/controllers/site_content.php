<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site_content extends CI_Controller
{
   public function __construct()
   {
		parent::__construct();
		$this->load->model('admin_model');
   }

	public function image_validation_for_update($image_not='0',$image)
  	{
		if($image==''){
 			return true;
		}else{
			$image = explode('.',$image);
			$format = $image[count($image)-1];
			$format = strtolower($format);
			if($format == 'png' || $format == 'jpeg' || $format == 'jpg' || $format == 'gif'){
				return true;
			}else{
				$this->form_validation->set_message('image_validation_for_update','Image format not allowed.');
				return false;
			}
		}
	}

	public function change_logo($slug='site_content')
	{
 		is_admin_authenticate();
    	$data['rows'] = $this->admin_model->get_row('site_content',array('slug'=>$slug));	
  
        $this->form_validation->set_rules('logo','Logo','callback_image_validation_for_update['.@$_FILES['logo']['name'].']|');

		if($this->form_validation->run() == TRUE)
		{


			$update['logo'] = $data['rows']->logo;
			if($_FILES['logo']['name']!='')
			{
				$update['logo'] = time().uniqid().'.png';
   				move_uploaded_file($_FILES['logo']['tmp_name'],'./assets/uploads/site_content/logo/'.$update['logo']);
   				@unlink('./assets/uploads/site_content/logo/'.$data['rows']->logo);
			}


		    $where = array('slug' => $slug);
		    $this->admin_model->update('site_content',$update,$where);
		    $this->session->set_flashdata('success_msg','Updated successfully.');
           	redirect(current_url());
		}
		$data['template'] = 'site_content/change_logo';
       	$this->load->view('templates/admin_template',$data);
	}


}
?>