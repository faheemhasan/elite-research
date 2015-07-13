<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Payment extends CI_Controller
{
   	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
   	}


   	public function index(){
		$data['template'] = 'payment/index';
		$this->load->view('templates/home_template',$data);
	}

	public function image_validation($image_not='0',$image){
		if($image==''){
 			return true;
		}else{
			$image = explode('.',$image);
			$format = $image[count($image)-1];
			$format = strtolower($format);
			if($format == 'png' || $format == 'jpeg' || $format == 'jpg' || $format == 'gif'){
				return true;
			}else{
				$this->form_validation->set_message('image_validation','Image format not allowed.');
				return false;
			}
		}
	}

	public function update ($slug='payment'){
 		is_admin_authenticate();
    	$data['rows'] = $this->admin_model->get_row('update_payment',array('slug'=>$slug));	
        $this->form_validation->set_rules('title','Title','required|');
        $this->form_validation->set_rules('bg','Background Image','callback_image_validation['.@$_FILES['bg']['name'].']|');
        $this->form_validation->set_rules('logo1','First Logo','callback_image_validation['.@$_FILES['logo1']['name'].']|');
        $this->form_validation->set_rules('logo2','Second Logo','callback_image_validation['.@$_FILES['logo2']['name'].']|');
		if($this->form_validation->run() == TRUE)
		{
			$update = array(
				'title' => $this->input->post('title'),
				'updated' => time()
			);

			$update['bg'] = $data['rows']->bg;
			if($_FILES['bg']['name']!=''){
				$ext = pathinfo($_FILES['bg']['name'], PATHINFO_EXTENSION);
				$update['bg'] = uniqid().'.'.$ext;
   				move_uploaded_file($_FILES['bg']['tmp_name'],'./assets/uploads/payment/'.$update['bg']);
   				@unlink('./assets/uploads/payment/'.$data['rows']->bg);
			}

			$update['logo1'] = $data['rows']->logo1;
			if($_FILES['logo1']['name']!=''){
				$ext = pathinfo($_FILES['logo1']['name'], PATHINFO_EXTENSION);
				$update['logo1'] = uniqid().'.'.$ext;
   				move_uploaded_file($_FILES['logo1']['tmp_name'],'./assets/uploads/payment/'.$update['logo1']);
   				@unlink('./assets/uploads/payment/'.$data['rows']->logo1);
			}

			$update['logo2'] = $data['rows']->logo2;
			if($_FILES['logo2']['name']!=''){
				$ext = pathinfo($_FILES['logo2']['name'], PATHINFO_EXTENSION);
				$update['logo2'] = uniqid().'.'.$ext;
   				move_uploaded_file($_FILES['logo2']['tmp_name'],'./assets/uploads/payment/'.$update['logo2']);
   				@unlink('./assets/uploads/payment/'.$data['rows']->logo2);
			}

		    $where = array('slug' => $slug);
		    $this->admin_model->update('update_payment',$update,$where);
		    $this->session->set_flashdata('success_msg','Updated successfully.');
           	redirect(_INDEX.'payment/update');
		}
		$data['template'] = 'payment/update';
       	$this->load->view('templates/admin_template',$data);
	}







}
?>