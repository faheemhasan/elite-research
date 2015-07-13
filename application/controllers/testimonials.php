<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Testimonials extends CI_Controller
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
 		$data['rows'] = $this->admin_model->get_pagination_result('testimonials',$limit,$offset);
 		$config = get_theme_pagination();
 		$config['base_url'] = base_url()._INDEX.'testimonials/all/';
 		$config['total_rows'] = $this->admin_model->get_pagination_result('testimonials',0,0);
 		$config['per_page'] = $limit;
 		$this->pagination->initialize($config);
 		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'testimonials/all';
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
        $this->form_validation->set_rules('position','Position','required|');
        $this->form_validation->set_rules('quote','Quote','required|');
        $this->form_validation->set_rules('image','Image','callback_image_validation_for_create['.@$_FILES['image']['name'].']|');

		if($this->form_validation->run() == TRUE)
		{

			if($_FILES['image']['name']!='')
			{
				$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				$image = uniqid().'.'.$ext;
   				move_uploaded_file($_FILES['image']['tmp_name'],'./assets/uploads/testimonials/'.$image);
   				create_thumb($image,'./assets/uploads/testimonials/');
			}


			$insert = array(
				'slug' => create_slug('testimonials',$this->input->post('name')),
				'name' => $this->input->post('name'),
				'position' => $this->input->post('position'),
				'quote' => $this->input->post('quote'),
				'image' => $image,
				'created' => time()
			);
		    $this->admin_model->insert('testimonials',$insert);
		    $this->session->set_flashdata('success_msg','Added successfully.');
                    redirect(_INDEX.'testimonials/all');
		}
		$data['template'] = 'testimonials/add';
                $this->load->view('templates/admin_template',$data);
	}

	public function edit($slug='')
	{
 		is_admin_authenticate();
    	$data['rows'] = $this->admin_model->get_row('testimonials',array('slug'=>$slug));	

        $this->form_validation->set_rules('name','Name','required|');
        $this->form_validation->set_rules('position','Position','required|');
        $this->form_validation->set_rules('quote','Quote','required|');
        $this->form_validation->set_rules('image','Image','callback_image_validation_for_update['.@$_FILES['image']['name'].']|');

		if($this->form_validation->run() == TRUE)
		{

			$update = array(
				'slug' => create_slug_for_update('testimonials',$this->input->post('name')),
				'name' => $this->input->post('name'),
				'position' => $this->input->post('position'),
				'quote' => $this->input->post('quote'),
			
				'updated' => time()
			);

			$update['image'] = $data['rows']->image;
			if($_FILES['image']['name']!='')
			{
				$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				$update['image'] = uniqid().'.'.$ext;
   				move_uploaded_file($_FILES['image']['tmp_name'],'./assets/uploads/testimonials/'.$update['image']);
   				create_thumb($update['image'],'./assets/uploads/testimonials/');
   				@unlink('./assets/uploads/testimonials/'.$data['rows']->image);
   				@unlink('./assets/uploads/testimonials/thumbs/'.$data['rows']->image);
			}

		    $where = array('slug' => $slug);
		    $this->admin_model->update('testimonials',$update,$where);
		    $this->session->set_flashdata('success_msg','Updated successfully.');
           redirect(_INDEX.'testimonials/all');
		}
		$data['template'] = 'testimonials/edit';
       $this->load->view('templates/admin_template',$data);
	}

	public function delete($slug='')
	{
 		is_admin_authenticate();
		$where = array('slug' => $slug);
	    $row = $this->admin_model->get_row('testimonials',$where);	
	    $this->admin_model->delete('testimonials',$where);	

   		@unlink('./assets/uploads/testimonials/'.$row->image);
   		@unlink('./assets/uploads/testimonials/thumbs/'.$row->image);
		$this->session->set_flashdata('success_msg','Deleted successfully.');
        redirect(_INDEX.'testimonials/all');
	}


}
?>