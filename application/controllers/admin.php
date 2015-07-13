<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		clear_cache();
		is_admin_authenticate();
		
		$this->load->model('admin_model');
	}

	public function index(){
		$data['template'] = 'admin/dashboard';
		$this->load->view('templates/admin_template', $data);
	}

	public function update_profile(){
		$data['admin'] = $this->admin_model->get_row('users',array('id' => get_admin_id()));

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_is_email_unique['.$data['admin']->email.']');
		$this->form_validation->set_rules('firstname', 'first name', 'required');
		$this->form_validation->set_rules('lastname', 'last name', 'required');

		if ($this->form_validation->run() == TRUE){
			$data = array(
				'firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('mobile'),
				'address' => $this->input->post('address'),
				'city' => $this->input->post('city'),
				'state' => $this->input->post('state'),
				'zip' => $this->input->post('zip'),
				'updated' => date("Y-m-d H:i:s")             
			);

			$this->admin_model->update('users', $data, array('id' => get_admin_id()));
			$this->session->set_flashdata('success_msg','Profile Updated Successfully ! ! !');
			redirect(base_url()._INDEX.'admin/update_profile');
		}
		
		$data['template'] = 'admin/update_profile';
		$this->load->view('templates/admin_template', $data);
	}

	public function change_password(){
		$data['admin'] = $this->admin_model->get_row('users',array('id' => get_admin_id()));

		$this->form_validation->set_rules('pwd', 'password', 'required|callback_check_old_password['.$data['admin']->password.']');
		$this->form_validation->set_rules('npwd', 'new password', 'required|min_length[6]');
		$this->form_validation->set_rules('cpwd', 'confirm password', 'required|matches[npwd]');

		if ($this->form_validation->run() == TRUE){
			$data = array(
				'password' => sha1($this->input->post('npwd')),
				'updated' => date("Y-m-d H:i:s")             
			);

			$this->admin_model->update('users', $data, array('id' => get_admin_id()));
			$this->session->set_flashdata('success_msg','Password Changed Successfully ! ! !');
			redirect(base_url()._INDEX.'admin/change_password');
		}
		$data['template'] = 'admin/change_password';
		$this->load->view('templates/admin_template', $data);  
	}

	public function logout(){
		$this->session->set_userdata('AdminInfo','');
		$this->session->set_userdata('BackUrlForAdmin','');
		$this->session->unset_userdata('AdminInfo');
		$this->session->unset_userdata('BackUrlForAdmin');
		$this->session->set_flashdata('success_msg','Logout successfully.');		
		redirect(base_url()._INDEX.'login');
	}

	public function check_is_email_unique($new_email, $old_email){
		if ($old_email === $new_email) {
				return TRUE;
		}else{
			$resp = $this->admin_model->get_row('users', array('email' => $new_email));
			if ($resp) {
				$this->form_validation->set_message('check_is_email_unique', 'Email you are choosing already exist.');
				return FALSE;
			}else{
				return TRUE;
			}
		}
	}

	public function check_old_password($pwd, $check_pwd){
		if (sha1($pwd) === $check_pwd) {
			return TRUE;
		}else{
			$this->form_validation->set_message('check_old_password', 'Old password is incorrect.');
			return FALSE;
		}
	}

	public function social_links(){		
		$this->form_validation->set_rules('twitter', 'Twitter', 'required');			
		$this->form_validation->set_rules('facebook', 'Facebook', 'required');			
		$this->form_validation->set_rules('youtube', 'Youtube', 'required');
		$this->form_validation->set_rules('pinterest', 'Pinterest', 'required');					
		$this->form_validation->set_rules('linkedin', 'Linkedin', 'required');			
		$this->form_validation->set_rules('instagram', 'Instagram', 'required');			
		$this->form_validation->set_rules('github', 'Git Hub', 'required');			
		$this->form_validation->set_rules('flickr', 'Flickr', 'required');			
		
		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
						'twitter' => $this->input->post('twitter'),
						'facebook' => $this->input->post('facebook'),
						'youtube' => $this->input->post('youtube'),
						'pinterest' => $this->input->post('pinterest'),
						'linkedin' => $this->input->post('linkedin'),				
						'instagram' => $this->input->post('instagram'),				
						'github' => $this->input->post('github'),				
						'flickr' => $this->input->post('flickr'),				
						);
			$this->admin_model->update('social_links',$data);		
			$this->session->set_flashdata('success_msg',"Updated");
			redirect(current_url());
		}

		$data['link'] = $this->admin_model->get_row('social_links', array('id'=>1));
		$data['template'] = 'admin/social_links';
        $this->load->view('templates/admin_template', $data);
	}




}