<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Service_packages extends CI_Controller
{
   public function __construct()
   {
		parent::__construct();
		$this->load->model('admin_model');
   }

	public function index()
	{
	   $this->all();
	}


   public function all($offset=0)
	{
 		is_admin_authenticate();
 		$limit=10;
 		$data['rows'] = $this->admin_model->get_pagination_result('service_packages',$limit,$offset);
 		$config = get_theme_pagination();
 		$config['base_url'] = base_url()._INDEX.'service_packages/all/';
 		$config['total_rows'] = $this->admin_model->get_pagination_result('service_packages',0,0);
 		$config['per_page'] = $limit;
 		$this->pagination->initialize($config);
 		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'service_packages/all';
		$this->load->view('templates/admin_template',$data);
	}

	public function image_validation_for_create($image_not='0',$image)
  	{
		if($image==''){
			$this->form_validation->set_message('image_validation_for_create','Please select an image to upload.');
 			return false;
		}else{
			$image = explode('.',$image);
			$format = $image[count($image)-1];
			$format = strtolower($format);
			if($format == 'png' || $format == 'jpeg' || $format == 'jpg' || $format == 'gif'){
				return true;
			}else{
				$this->form_validation->set_message('image_validation_for_create','Image format not allowed.');
				return false;
			}
		}
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

	public function add()
	{
 		is_admin_authenticate();

        $this->form_validation->set_rules('title','Title','required|');
        $this->form_validation->set_rules('bg_image','Background Image','callback_image_validation_for_create['.@$_FILES['bg_image']['name'].']|');
        $this->form_validation->set_rules('icon','Icon','required|');

		if($this->form_validation->run() == TRUE)
		{

			$insert = array(
				'slug' => create_slug('service_packages',$this->input->post('title')),
				'title' => $this->input->post('title'),
				'icon' => $this->input->post('icon'),
				'created' => time()
			);


			if($_FILES['bg_image']['name']!='')
			{
				$image = uniqid().'.png';
   				move_uploaded_file($_FILES['bg_image']['tmp_name'],'./assets/uploads/service_packages/'.$image);
   				create_thumb($image,'./assets/uploads/service_packages/');
				$insert['bg_image'] = $image;
			}

		    $this->admin_model->insert('service_packages',$insert);
		    $this->session->set_flashdata('success_msg','Added successfully.');
                    redirect(_INDEX.'service_packages/all');
		}
		$data['template'] = 'service_packages/add';
                $this->load->view('templates/admin_template',$data);
	}

	public function edit($slug='')
	{
 		is_admin_authenticate();
	    	$data['rows'] = $this->admin_model->get_row('service_packages',array('slug'=>$slug));	

        $this->form_validation->set_rules('title','Title','required|');
        $this->form_validation->set_rules('bg_image','Background Image','callback_image_validation_for_update['.@$_FILES['bg_image']['name'].']|');
        $this->form_validation->set_rules('icon','Icon','required|');

		if($this->form_validation->run() == TRUE)
		{

			$update = array(
				'slug' => create_slug_for_update('service_packages',$this->input->post('title')),
				'title' => $this->input->post('title'),
				'icon' => $this->input->post('icon'),
				'updated' => time()
			);


			if($_FILES['bg_image']['name']!='')
			{
				$update['bg_image'] = uniqid().'.png';
   				move_uploaded_file($_FILES['bg_image']['tmp_name'],'./assets/uploads/service_packages/'.$update['bg_image']);
   				create_thumb($update['bg_image'],'./assets/uploads/service_packages/');
   				@unlink('./assets/uploads/service_packages/'.$data['rows']->bg_image);
   				@unlink('./assets/uploads/service_packages/thumbs/'.$data['rows']->bg_image);
			}

		    $where = array('slug' => $slug);
		    $this->admin_model->update('service_packages',$update,$where);
		    $this->session->set_flashdata('success_msg','Updated successfully.');
           redirect(_INDEX.'service_packages/all');
		}
		$data['template'] = 'service_packages/edit';
       $this->load->view('templates/admin_template',$data);
	}

	public function delete($slug='')
	{
 		is_admin_authenticate();
		$where = array('slug' => $slug);
	    $row = $this->admin_model->get_row('service_packages',$where);	
	    $this->admin_model->delete('service_packages',$where);	

		$this->session->set_flashdata('success_msg','Deleted successfully.');
        redirect(_INDEX.'service_packages/all');
	}


}
?>