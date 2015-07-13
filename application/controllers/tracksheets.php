<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tracksheets extends CI_Controller
{
   public function __construct()
   {
		parent::__construct();
		$this->load->model('admin_model');
   }

   	public function index()
	{
 		$data['rows'] = $this->admin_model->get_result('tracksheets');
		$data['template'] = 'tracksheets/index';
		$this->load->view('templates/home_template',$data);
	}

	public function download($download)
	{
		$this->load->helper('download');
		$data = file_get_contents(base_url()._INDEX.'assets/uploads/tracksheets/'.$download);
		$name = 'Tracksheet_'.$download;	
		force_download($name,$data); 
	}

	public function counter()
	{
		$id = $this->input->post('id');
		$where = array('id' => $id);
		$counter = $this->input->post('counter');
		$counter = $counter+1;
		$update = array('counter' => $counter);
		$this->admin_model->update('tracksheets',$update,$where); 
		echo true;
	}

   	public function all($offset=0)
	{
 		is_admin_authenticate();
 		$limit=10;
 		$data['rows'] = $this->admin_model->get_pagination_result('tracksheets',$limit,$offset);
 		$config = get_theme_pagination();
 		$config['base_url'] = base_url()._INDEX.'tracksheets/all/';
 		$config['total_rows'] = $this->admin_model->get_pagination_result('tracksheets',0,0);
 		$config['per_page'] = $limit;
 		$this->pagination->initialize($config);
 		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'tracksheets/all';
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

        $this->form_validation->set_rules('image','Image','callback_image_validation_for_create['.@$_FILES['image']['name'].']|');
        $this->form_validation->set_rules('title','Title','required|');
        $this->form_validation->set_rules('subtitle','Subtitle','required|');
        $this->form_validation->set_rules('password','Password','trim|');
        $this->form_validation->set_rules('download','Upload File','trim|');
		$this->form_validation->set_rules('icon','Icon','required');

		if($this->form_validation->run() == TRUE)
		{

			if($_FILES['image']['name']!='')
			{
				$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				$image = uniqid().'.'.$ext;
   				move_uploaded_file($_FILES['image']['tmp_name'],'./assets/uploads/tracksheets/'.$image);
   				create_thumb($image,'./assets/uploads/tracksheets/');
			}

			if($_FILES['download']['name']!='')
			{
				$ext = pathinfo($_FILES['download']['name'], PATHINFO_EXTENSION);
				$download = uniqid().'.'.$ext;
   				move_uploaded_file($_FILES['download']['tmp_name'],'./assets/uploads/tracksheets/'.$download);
			}


			$insert = array(
				'slug' => create_slug('tracksheets',$this->input->post('title')),
				'image' => $image,
				'title' => $this->input->post('title'),
				'subtitle' => $this->input->post('subtitle'),
				'password' => $this->input->post('password'),
				'download' => $download,
				
				'in_header' => $this->input->post('in_header'),
				'icon' => $this->input->post('icon'),
				
				'created' => time()
			);
		    $this->admin_model->insert('tracksheets',$insert);
		    $this->session->set_flashdata('success_msg','Added successfully.');
                    redirect(_INDEX.'tracksheets/all');
		}
		$data['template'] = 'tracksheets/add';
                $this->load->view('templates/admin_template',$data);
	}

	public function edit($slug='')
	{
 		is_admin_authenticate();
	    	$data['rows'] = $this->admin_model->get_row('tracksheets',array('slug'=>$slug));	

        $this->form_validation->set_rules('image','Image','callback_image_validation_for_update['.@$_FILES['image']['name'].']|');
        $this->form_validation->set_rules('title','Title','required|');
        $this->form_validation->set_rules('subtitle','Subtitle','required|');
        $this->form_validation->set_rules('password','Password','trim|');
        $this->form_validation->set_rules('download','Upload File','trim|');
		$this->form_validation->set_rules('icon','Icon','required');

		if($this->form_validation->run() == TRUE)
		{

			$update = array(
				'slug' => create_slug_for_update('tracksheets',$this->input->post('title')),
				'title' => $this->input->post('title'),
				'subtitle' => $this->input->post('subtitle'),
				'password' => $this->input->post('password'),

				'in_header' => $this->input->post('in_header'),
				'icon' => $this->input->post('icon'),
			
				'updated' => time()
			);

			$update['image'] = $data['rows']->image;
			if($_FILES['image']['name']!='')
			{
				$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				$update['image'] = uniqid().'.'.$ext;
   				move_uploaded_file($_FILES['image']['tmp_name'],'./assets/uploads/tracksheets/'.$update['image']);
   				create_thumb($update['image'],'./assets/uploads/tracksheets/');
   				@unlink('./assets/uploads/tracksheets/'.$data['rows']->image);
   				@unlink('./assets/uploads/tracksheets/thumbs/'.$data['rows']->image);
			}

			$update['download'] = $data['rows']->download;
			if($_FILES['download']['name']!='')
			{
				$ext = pathinfo($_FILES['download']['name'], PATHINFO_EXTENSION);
				$update['download'] = uniqid().'.'.$ext;
   				move_uploaded_file($_FILES['download']['tmp_name'],'./assets/uploads/tracksheets/'.$update['download']);
   				@unlink('./assets/uploads/tracksheets/'.$data['rows']->download);
			}

		    $where = array('slug' => $slug);
		    $this->admin_model->update('tracksheets',$update,$where);
		    $this->session->set_flashdata('success_msg','Updated successfully.');
           redirect(_INDEX.'tracksheets/all');
		}
		$data['template'] = 'tracksheets/edit';
       $this->load->view('templates/admin_template',$data);
	}

	public function delete($slug='')
	{
 		is_admin_authenticate();
		$where = array('slug' => $slug);
	    $row = $this->admin_model->get_row('tracksheets',$where);	
	    $this->admin_model->delete('tracksheets',$where);	

   		@unlink('./assets/uploads/tracksheets/'.$row->image);
   		@unlink('./assets/uploads/tracksheets/thumbs/'.$row->image);
   		@unlink('./assets/uploads/tracksheets/'.$row->download);
   		@unlink('./assets/uploads/tracksheets/thumbs/'.$row->download);
		$this->session->set_flashdata('success_msg','Deleted successfully.');
        redirect(_INDEX.'tracksheets/all');
	}



	public function update($slug='tracksheets')
	{
 		is_admin_authenticate();
    	$data['rows'] = $this->admin_model->get_row('update_tracksheets',array('slug'=>$slug));	

        $this->form_validation->set_rules('page_title','Title','required|');
        $this->form_validation->set_rules('header_description','Description','required');
        $this->form_validation->set_rules('bg_image','Background Image','callback_image_validation['.@$_FILES['bg_image']['name'].']|');
        $this->form_validation->set_rules('header_image','Header Image','callback_image_validation['.@$_FILES['header_image']['name'].']|');

		if($this->form_validation->run() == TRUE)
		{

			$update = array(
				'page_title' => $this->input->post('page_title'),
				'header_description' => $this->input->post('header_description'),
				'updated' => time()
			);

			$update['header_image'] = $data['rows']->header_image;
			if($_FILES['header_image']['name']!='')
			{
				$update['header_image'] = time().uniqid().'.png';
   				move_uploaded_file($_FILES['header_image']['tmp_name'],'./assets/uploads/tracksheets/home/'.$update['header_image']);
   				@unlink('./assets/uploads/tracksheets/home/'.$data['rows']->header_image);
			}

			$update['bg_image'] = $data['rows']->bg_image;
			if($_FILES['bg_image']['name']!='')
			{
				$update['bg_image'] = uniqid().'.png';
   				move_uploaded_file($_FILES['bg_image']['tmp_name'],'./assets/uploads/tracksheets/home/'.$update['bg_image']);
   				@unlink('./assets/uploads/tracksheets/home/'.$data['rows']->bg_image);
			}

			// print_r($update);
			// die();

		    $where = array('slug' => $slug);
		    $this->admin_model->update('update_tracksheets',$update,$where);
		    $this->session->set_flashdata('success_msg','Updated successfully.');
           	redirect(current_url());
		}
		$data['template'] = 'tracksheets/update';
       	$this->load->view('templates/admin_template',$data);
	}


}
?>