<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Aboutus extends CI_Controller
{
   	public function __construct()
   	{
		parent::__construct();
		$this->load->model('admin_model');
   	}

   	public function index()
	{
		$where = array('slug' => 'aboutus');
 		$data['row'] = $this->admin_model->get_row('aboutus',$where);
 		$data['services'] = $this->admin_model->get_result('services',array('about_us_featured' => 'yes'));
		$data['template'] = 'aboutus/index';
		$this->load->view('templates/home_template',$data);
	}
	
	public function image_validation($image_not='0',$image)
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
				$this->form_validation->set_message('image_validation','Image format not allowed.');
				return false;
			}
		}
	}

	public function update($slug='aboutus')
	{
    	is_admin_authenticate();
    	$data['rows'] = $this->admin_model->get_row('aboutus',array('slug'=>$slug));	

        $this->form_validation->set_rules('title','Title','required|');
        $this->form_validation->set_rules('top_heading','Top Heading','trim|');
        $this->form_validation->set_rules('bottom_heading','Bottom Heading','trim|');
        $this->form_validation->set_rules('our_vision','Our Vision','trim|');
        $this->form_validation->set_rules('our_team','Our Team','trim|');
        $this->form_validation->set_rules('our_values','Our Values','trim|');
        $this->form_validation->set_rules('image','Background Image','callback_image_validation['.@$_FILES['image']['name'].']|');

		if($this->form_validation->run() == TRUE)
		{

			$update = array(
				'title' => $this->input->post('title'),
				'top_heading' => $this->input->post('top_heading'),
				'bottom_heading' => $this->input->post('bottom_heading'),
				'our_vision' => $this->input->post('our_vision'),
				'our_team' => $this->input->post('our_team'),
				'our_values' => $this->input->post('our_values'),
				'updated' => time()
			);

			$update['image'] = $data['rows']->image;
			if($_FILES['image']['name']!='')
			{
				$update['image'] = uniqid().'.png';
   				move_uploaded_file($_FILES['image']['tmp_name'],'./assets/uploads/aboutus/'.$update['image']);
   				create_thumb($update['image'],'./assets/uploads/aboutus/');
   				@unlink('./assets/uploads/aboutus/'.$data['rows']->image);
   				@unlink('./assets/uploads/aboutus/thumbs/'.$data['rows']->image);
			}

		    $where = array('slug' => $slug);
		    $this->admin_model->update('aboutus',$update,$where);
		    $this->session->set_flashdata('success_msg','Updated successfully.');
           	redirect(_INDEX.'aboutus/update');
		}
		$data['template'] = 'aboutus/update';
       	$this->load->view('templates/admin_template',$data);
	}

}
?>