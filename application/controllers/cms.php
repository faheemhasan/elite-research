<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cms extends CI_Controller
{
   	public function __construct()
   	{
		parent::__construct();
		$this->load->model('admin_model');
   	}

   	public function page($slug='') 
   	{
 		$data['page'] = $this->admin_model->get_row('cms',array('slug' => $slug));
		if(!$data['page']){
			redirect(base_url());
		}
		$data['template'] = 'cms/page';
		$this->load->view('templates/home_template',$data);
   	}


    public function all($offset=0)
	{
 		is_admin_authenticate();
 		$limit=10;
 		$data['rows'] = $this->admin_model->get_pagination_result('cms',$limit,$offset);
 		$config = get_theme_pagination();
 		$config['base_url'] = base_url()._INDEX.'cms/all/';
 		$config['total_rows'] = $this->admin_model->get_pagination_result('cms',0,0);
 		$config['per_page'] = $limit;
 		$this->pagination->initialize($config);
 		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'cms/all';
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
        $this->form_validation->set_rules('content','Content','trim|');
        $this->form_validation->set_rules('image','Backgroung Image','callback_image_validation_for_create['.@$_FILES['image']['name'].']|');
        $this->form_validation->set_rules('in_header','Link Show In Header','trim|');
        $this->form_validation->set_rules('in_footer','Link Show In Footer','trim|');
        $this->form_validation->set_rules('icon','Icon','required');

		if($this->form_validation->run() == TRUE)
		{

			if($_FILES['image']['name']!='')
			{
				$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				$image = uniqid().'.'.$ext;
   				move_uploaded_file($_FILES['image']['tmp_name'],'./assets/uploads/cms/'.$image);
   				create_thumb($image,'./assets/uploads/cms/');
			}


			$insert = array(
				'slug' => create_slug('cms',$this->input->post('title')),
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'image' => $image,
				'in_header' => $this->input->post('in_header'),
				'in_footer' => $this->input->post('in_footer'),
				'icon' => $this->input->post('icon'),
				'created' => time()
			);
		    $this->admin_model->insert('cms',$insert);
		    $this->session->set_flashdata('success_msg','Added successfully.');
                    redirect(_INDEX.'cms/all');
		}
		$data['template'] = 'cms/add';
                $this->load->view('templates/admin_template',$data);
	}

	public function edit($slug='')
	{
 		is_admin_authenticate();
	    	$data['rows'] = $this->admin_model->get_row('cms',array('slug'=>$slug));	

        $this->form_validation->set_rules('title','Title','required|');
        $this->form_validation->set_rules('content','Content','trim|');
        $this->form_validation->set_rules('image','Backgroung Image','callback_image_validation_for_update['.@$_FILES['image']['name'].']|');
        $this->form_validation->set_rules('in_header','Link Show In Header','trim|');
        $this->form_validation->set_rules('in_footer','Link Show In Footer','trim|');
        $this->form_validation->set_rules('icon','Icon','required');

		if($this->form_validation->run() == TRUE)
		{

			$update = array(
				'slug' => create_slug_for_update('cms',$this->input->post('title')),
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
			
				'in_header' => $this->input->post('in_header'),
				'in_footer' => $this->input->post('in_footer'),
				'icon' => $this->input->post('icon'),
				'updated' => time()
			);

			$update['image'] = $data['rows']->image;
			if($_FILES['image']['name']!='')
			{
				$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				$update['image'] = uniqid().'.'.$ext;
   				move_uploaded_file($_FILES['image']['tmp_name'],'./assets/uploads/cms/'.$update['image']);
   				create_thumb($update['image'],'./assets/uploads/cms/');
   				@unlink('./assets/uploads/cms/'.$data['rows']->image);
   				@unlink('./assets/uploads/cms/thumbs/'.$data['rows']->image);
			}

		    $where = array('slug' => $slug);
		    $this->admin_model->update('cms',$update,$where);
		    $this->session->set_flashdata('success_msg','Updated successfully.');
           redirect(_INDEX.'cms/all');
		}
		$data['template'] = 'cms/edit';
       $this->load->view('templates/admin_template',$data);
	}

	public function delete($slug='')
	{
 		is_admin_authenticate();
		$where = array('slug' => $slug);
	    $row = $this->admin_model->get_row('cms',$where);	
	    $this->admin_model->delete('cms',$where);	

   		@unlink('./assets/uploads/cms/'.$row->image);
   		@unlink('./assets/uploads/cms/thumbs/'.$row->image);
		$this->session->set_flashdata('success_msg','Deleted successfully.');
        redirect(_INDEX.'cms/all');
	}


}
?>