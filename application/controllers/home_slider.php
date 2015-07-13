<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home_slider extends CI_Controller
{
   public function __construct()
   {
		parent::__construct();
		$this->load->model('admin_model');
   }

   public function all($offset=0)
	{
 		is_admin_authenticate();
 		$limit=10;
 		$data['rows'] = $this->admin_model->get_pagination_result('home_slider',$limit,$offset);
 		$config = get_theme_pagination();
 		$config['base_url'] = base_url()._INDEX.'home_slider/all/';
 		$config['total_rows'] = $this->admin_model->get_pagination_result('home_slider',0,0);
 		$config['per_page'] = $limit;
 		$this->pagination->initialize($config);
 		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'home_slider/all';
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

        $this->form_validation->set_rules('name','Name','required|');
        $this->form_validation->set_rules('order','Order','required|numeric|');
        $this->form_validation->set_rules('image','Image','callback_image_validation_for_create['.@$_FILES['image']['name'].']|');

		if($this->form_validation->run() == TRUE)
		{

			if($_FILES['image']['name']!='')
			{
				$image = uniqid().'.png';
   				move_uploaded_file($_FILES['image']['tmp_name'],'./assets/uploads/home_slider/'.$image);
   				create_thumb($image,'./assets/uploads/home_slider/');
			}


			$insert = array(
				'slug' => create_slug('home_slider',$this->input->post('name')),
				'name' => $this->input->post('name'),
				'order' => $this->input->post('order'),
				'image' => $image,
				'created' => time()
			);
		    $this->admin_model->insert('home_slider',$insert);
		    $this->session->set_flashdata('success_msg','Added successfully.');
                    redirect(_INDEX.'home_slider/all');
		}
		$data['template'] = 'home_slider/add';
                $this->load->view('templates/admin_template',$data);
	}

	public function edit($slug='')
	{
 		is_admin_authenticate();
	    	$data['rows'] = $this->admin_model->get_row('home_slider',array('slug'=>$slug));	

        $this->form_validation->set_rules('name','Name','required|');
        $this->form_validation->set_rules('order','Order','required|numeric|');
        $this->form_validation->set_rules('image','Image','callback_image_validation_for_update['.@$_FILES['image']['name'].']|');

		if($this->form_validation->run() == TRUE)
		{

			$update = array(
				'slug' => create_slug_for_update('home_slider',$this->input->post('name')),
				'name' => $this->input->post('name'),
				'order' => $this->input->post('order'),
			
				'updated' => time()
			);

			$update['image'] = $data['rows']->image;
			if($_FILES['image']['name']!='')
			{
				$update['image'] = uniqid().'.png';
   				move_uploaded_file($_FILES['image']['tmp_name'],'./assets/uploads/home_slider/'.$update['image']);
   				create_thumb($update['image'],'./assets/uploads/home_slider/');
   				@unlink('./assets/uploads/home_slider/'.$data['rows']->image);
   				@unlink('./assets/uploads/home_slider/thumbs/'.$data['rows']->image);
			}

		    $where = array('slug' => $slug);
		    $this->admin_model->update('home_slider',$update,$where);
		    $this->session->set_flashdata('success_msg','Updated successfully.');
           redirect(_INDEX.'home_slider/all');
		}
		$data['template'] = 'home_slider/edit';
       $this->load->view('templates/admin_template',$data);
	}

	public function delete($slug='')
	{
 		is_admin_authenticate();
		$where = array('slug' => $slug);
	    $row = $this->admin_model->get_row('home_slider',$where);	
	    $this->admin_model->delete('home_slider',$where);	

   		@unlink('./assets/uploads/home_slider/'.$row->image);
   		@unlink('./assets/uploads/home_slider/thumbs/'.$row->image);
		$this->session->set_flashdata('success_msg','Deleted successfully.');
        redirect(_INDEX.'home_slider/all');
	}


}
?>