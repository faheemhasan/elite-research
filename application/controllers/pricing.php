<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pricing extends CI_Controller
{
   public function __construct()
   {
		parent::__construct();
		$this->load->model('admin_model');
   }


   	public function detail($package_slug="")
	{
	     if($package_slug=="")
	     {
	     	redirect('home');
	     }
	    $data['service_packages'] = $this->admin_model->get_row('service_packages',array('slug'=>$package_slug));
	    
	    if(empty($data['service_packages']))
	    {
	    	redirect('home');
	    }

		$data['services'] = $this->admin_model->get_result('services',array('package_id'=>$data['service_packages']->id));

		$data['template'] = 'pricing/index';
		$this->load->view('templates/home_template',$data);
	}


	public function update($slug='pricing')
	{
 		is_admin_authenticate();
    	$data['rows'] = $this->admin_model->get_row('update_pricing',array('slug'=>$slug));	

        // $this->form_validation->set_rules('page_title','Title','required|');
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
   				move_uploaded_file($_FILES['header_image']['tmp_name'],'./assets/uploads/pricing/home/'.$update['header_image']);
   				@unlink('./assets/uploads/pricing/home/'.$data['rows']->header_image);
			}

			$update['bg_image'] = $data['rows']->bg_image;
			if($_FILES['bg_image']['name']!='')
			{
				$update['bg_image'] = uniqid().'.png';
   				move_uploaded_file($_FILES['bg_image']['tmp_name'],'./assets/uploads/pricing/home/'.$update['bg_image']);
   				@unlink('./assets/uploads/pricing/home/'.$data['rows']->bg_image);
			}

			// print_r($update);
			// die();

		    $where = array('slug' => $slug);
		    $this->admin_model->update('update_pricing',$update,$where);
		    $this->session->set_flashdata('success_msg','Updated successfully.');
           	redirect(current_url());
		}
		$data['template'] = 'pricing/update';
       	$this->load->view('templates/admin_template',$data);
	}


}
?>