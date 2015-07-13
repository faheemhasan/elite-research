<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		clear_cache();
		$this->load->model('admin_model');
	}

	public function all($offset=0)
	{
 		is_admin_authenticate();

		$limit=10;
		$data['users'] = $this->admin_model->get_pagination_where('users', $limit,$offset,array('role !='=>1));
		$config = get_theme_pagination();	
		$config['base_url'] = base_url()._INDEX.'users/all/';
		$config['total_rows'] = $this->admin_model->get_pagination_where('users', 0, 0,array('role !='=>1));
		$config['per_page'] = $limit;
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();		
        $data['template'] = 'users/all';
        $this->load->view('templates/admin_template', $data);
	}

	public function add()
	{
 		is_admin_authenticate();

		$this->form_validation->set_rules('fname', 'First name', 'required');
		$this->form_validation->set_rules('lname', 'Last name', 'required');
		$this->form_validation->set_rules('email', 'Email','trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('phone', 'Phone', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('state', 'State', 'required');
		$this->form_validation->set_rules('zip', 'Postal code', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$user=array(
				'slug'   => create_slug('users',$this->input->post('fname').'-'.$this->input->post('lname')),
				'status' => 1,
				'role'   => 2,
				'firstname' => $this->input->post('fname'),
				'lastname' => $this->input->post('lname'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'address' =>	$this->input->post('address'),
				'city' => $this->input->post('city'),
				'state' => $this->input->post('state'),
				'zip' => $this->input->post('zip'),
				'created' => time()
			);
			$this->admin_model->insert('users',$user);
			$this->session->set_flashdata('success_msg',"Member has been Added successfully.");
			redirect(_INDEX.'users/all');
		}
		$data['template'] = 'users/add';
		$this->load->view('templates/admin_template', $data);
	}


	public function edit($slug="")
	{
 		is_admin_authenticate();

		$where = array('slug' => $slug);
		$data['user'] = $this->admin_model->get_row('users',$where);
		if (empty($data['user'])) 
		{
			$this->session->set_flashdata('error_msg', 'Member information not found to update.');
			redirect(_INDEX.'users/all');
		}
		
		$this->form_validation->set_rules('fname', 'First name', 'required');
		$this->form_validation->set_rules('lname', 'Last name', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('state', 'State', 'required');
		$this->form_validation->set_rules('zip', 'Postal code', 'required');

		if($this->input->post('email')){
			$email = $this->input->post('email');
			if($data['user']->email != $email){
				$this->form_validation->set_rules('email', 'Email','trim|required|valid_email|is_unique[users.email]');
			}	
		}

		if ($this->form_validation->run() == TRUE)
		{
			$user=array(
				'slug'   => create_slug_for_update('users',$this->input->post('fname').'-'.$this->input->post('lname')),
				'firstname' => $this->input->post('fname'),
				'lastname' => $this->input->post('lname'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'address' =>	$this->input->post('address'),
				'city' => $this->input->post('city'),
				'state' => $this->input->post('state'),
				'zip' => $this->input->post('zip'),
				'updated' => time()
			);
			$this->admin_model->update('users',$user,$where);
			$this->session->set_flashdata('success_msg',"Member has been updated successfully.");
			redirect(_INDEX.'users/all');
		}
		$data['template'] = 'users/edit';
		$this->load->view('templates/admin_template', $data);
	}

	public function delete($slug="")
	{
 		is_admin_authenticate();

		$this->admin_model->delete('users', array('slug'=>$slug));	
		$this->session->set_flashdata('success_msg',"Member has been delete successfully.");
		redirect(_INDEX.'users/all');
	}

	public function changeStatus($slug='',$status)
	{
 		is_admin_authenticate();
		$update = array('status'=>$status);
		$where = array('slug'=>$slug);
		$this->admin_model->update('users',$update,$where);	
		$this->session->set_flashdata('success_msg',"Status has been changed successfully.");
		redirect(_INDEX.'users/all');
	}	

	public function check_availability()
	{
		$email = $this->input->post('email');
		$where = array('email' => $email);
		$query = $this->db->get_where('users',$where);	
		if($query->num_rows() == 0){
			echo 1;
		}else{
			echo 0;
		}
	}	

	public function check_availability_for_update($slug)
	{
		$email = $this->input->post('email');
		$where = array('email' => $email, 'slug !=' => $slug);
		$query = $this->db->get_where('users',$where);	
		if($query->num_rows() == 0){
			echo 1;
		}else{
			echo 0;
		}
	}	





}