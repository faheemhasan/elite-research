<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Services extends CI_Controller
{
   public function __construct()
   {
		parent::__construct();
		$this->load->model('admin_model');
   }


   

   public function detail($package_slug="",$service_slug="")
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
    
    $data['service_slug'] = $service_slug;
	$data['services'] = $this->admin_model->get_result('services',array('package_id'=>$data['service_packages']->id));
	
	$data['template'] = 'services/detail';
	$this->load->view('templates/home_template',$data);

   }

   public function all($offset=0)
	{
 		$limit=10;
 		$data['rows'] = $this->admin_model->get_pagination_result('services',$limit,$offset);
 		$config = get_theme_pagination();
 		$config['base_url'] = base_url()._INDEX.'services/all/';
 		$config['total_rows'] = $this->admin_model->get_pagination_result('services',0,0);
 		$config['per_page'] = $limit;
 		$this->pagination->initialize($config);
 		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'services/all';
		$this->load->view('templates/admin_template',$data);
	}

	public function add()
	{

        $this->form_validation->set_rules('title','Title','required|');
        $this->form_validation->set_rules('description','Description','required|');
        $this->form_validation->set_rules('monthly','Monthly','required|numeric');
        $this->form_validation->set_rules('quarterly','Quarterly','required|numeric');
        $this->form_validation->set_rules('half_yearly','Half Yearly','required|numeric');
        $this->form_validation->set_rules('yearly','Yearly','required|numeric');
        $this->form_validation->set_rules('bg_color','Background-color','required|');
        $this->form_validation->set_rules('icon','Icon','required|');
        $this->form_validation->set_rules('package_id','Package ','required|');
        $this->form_validation->set_rules('footer_featured',' ','required|');
        $this->form_validation->set_rules('home_featured',' ','required|');
        $this->form_validation->set_rules('about_us_featured',' ','required|');
        $this->form_validation->set_rules('free_trial',' ','required|');

		if($this->form_validation->run() == TRUE)
		{


			$insert = array(
				'slug' => create_slug('services',$this->input->post('title')),
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'monthly' => $this->input->post('monthly'),
				'quarterly' => $this->input->post('quarterly'),
				'half_yearly' => $this->input->post('half_yearly'),
				'yearly' => $this->input->post('yearly'),
				'bg_color' => $this->input->post('bg_color'),
				'icon' => $this->input->post('icon'),
				'footer_featured' => $this->input->post('footer_featured'),
				'home_featured' => $this->input->post('home_featured'),
				'about_us_featured' => $this->input->post('about_us_featured'),
				'free_trial' => $this->input->post('free_trial'),
				'package_id' => $this->input->post('package_id'),
				'created' => time()
			);
		    $this->admin_model->insert('services',$insert);
		    $this->session->set_flashdata('success_msg','Added successfully.');
                    redirect(_INDEX.'services/all');
		}
		$data['template'] = 'services/add';
                $this->load->view('templates/admin_template',$data);
	}

	public function edit($slug='')
	{
	    	$data['rows'] = $this->admin_model->get_row('services',array('slug'=>$slug));	

        $this->form_validation->set_rules('title','Title','required|');
        $this->form_validation->set_rules('description','Description','required|');
        $this->form_validation->set_rules('monthly','Monthly','required|numeric');
        $this->form_validation->set_rules('quarterly','Quarterly','required|numeric');
        $this->form_validation->set_rules('half_yearly','Half Yearly','required|numeric');
        $this->form_validation->set_rules('yearly','Yearly','required|numeric');
        $this->form_validation->set_rules('bg_color','Background-color','required|');
        $this->form_validation->set_rules('icon','Icon','required|');
        $this->form_validation->set_rules('package_id','Package ','required|');

		if($this->form_validation->run() == TRUE)
		{

			$update = array(
				'slug' => create_slug_for_update('services',$this->input->post('title')),
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'monthly' => $this->input->post('monthly'),
				'quarterly' => $this->input->post('quarterly'),
				'half_yearly' => $this->input->post('half_yearly'),
				'yearly' => $this->input->post('yearly'),
				'bg_color' => $this->input->post('bg_color'),
				'icon' => $this->input->post('icon'),
				'footer_featured' => $this->input->post('footer_featured'),
				'home_featured' => $this->input->post('home_featured'),
				'about_us_featured' => $this->input->post('about_us_featured'),
				'free_trial' => $this->input->post('free_trial'),
				'package_id' => $this->input->post('package_id'),
				'updated' => time()
			);

		    $where = array('slug' => $slug);
		    $this->admin_model->update('services',$update,$where);
		    $this->session->set_flashdata('success_msg','Updated successfully.');
           redirect(_INDEX.'services/all');
		}
		$data['template'] = 'services/edit';
       $this->load->view('templates/admin_template',$data);
	}

	public function delete($slug='')
	{
		$where = array('slug' => $slug);
	    $row = $this->admin_model->get_row('services',$where);	
	    $this->admin_model->delete('services',$where);	

		$this->session->set_flashdata('success_msg','Deleted successfully.');
        redirect(_INDEX.'services/all');
	}


}
?>