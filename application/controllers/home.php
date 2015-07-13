<?php 
/**
* 
*/
class Home extends CI_controller
{

	public function __construct(){
		parent::__construct();
		clear_cache();
		$this->load->model('admin_model');
	}

	
	public function index()
	{   
		$this->db->order_by('order','asc');
		$data['home_slider'] = $this->admin_model->get_result('home_slider');

		$data['home_services'] = $this->admin_model->get_result('services',array('home_featured'=>'yes'));
		
		$data['template']='home/index';
		$this->load->view('templates/home_template',$data);
	}

	public function update($slug='home')
	{
 		is_admin_authenticate();
    	$data['rows'] = $this->admin_model->get_row('update_pages',array('slug'=>$slug));	

        $this->form_validation->set_rules('latest_updates','Latest Updates','required|');
        $this->form_validation->set_rules('clients_guidline','Clients Guidline','required');

		if($this->form_validation->run() == TRUE)
		{

			$update = array(
				'latest_updates' => $this->input->post('latest_updates'),
				'clients_guidline' => $this->input->post('clients_guidline'),
				'updated' => time()
			);


		    $where = array('slug' => $slug);
		    $this->admin_model->update('update_pages',$update,$where);
		    $this->session->set_flashdata('success_msg','Updated successfully.');
           	redirect(current_url());
		}
		$data['template'] = 'home/update';
       	$this->load->view('templates/admin_template',$data);
	}




	
}
 ?>