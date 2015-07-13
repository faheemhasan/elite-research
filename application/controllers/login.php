<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index(){
		if(admin_login_in()===TRUE)
			redirect(base_url()._INDEX.'admin');

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == TRUE){
			$this->load->model('cms_model');		
			$status = $this->cms_model->login($this->input->post('email'),$this->input->post('password'),1);	
			
			if($status){
				if($this->session->userdata('BackUrlForAdmin') && $this->session->userdata('BackUrlForAdmin') != ''){
					$redirect_url = $this->session->userdata('BackUrlForAdmin');
					$this->session->set_userdata('BackUrlForAdmin', '');
					redirect($redirect_url);
				}else{
					redirect(base_url()._INDEX.'admin');
				}
			}
			else{
				redirect(base_url()._INDEX.'login/login');
			}
		}

		$this->load->view('login/admin');
	}

	public function forgotpassword()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		if ($this->form_validation->run() == TRUE)
		{
			$email=$this->input->post('email');
			$where = array('email' => $email);
			$user  = $this->admin_model->get_row('users',$where);
            if(empty($user)){
				$this->session->set_flashdata('error_msg','Invalid email, Please enter registered email.');
				redirect(_INDEX.'login/forgotpassword');
            }
            if($user->status == 0){
				$this->session->set_flashdata('error_msg','Sorry your account is inactive.');
				redirect(_INDEX.'login/forgotpassword');
            }

            ///////// insert secret key in database  //////////
            $secret_key = sha1($email);
            $data = array('secret_key' => $secret_key);
            $this->admin_model->update('users',$data,$where);
            /////////////   send mail to user  ///////////////
			$this->load->library('smtp_lib/smtp_email');
			$subject = 'Reset your password on CMS';
			$from = array('no-reply@bnbclone.com' =>'bnbclone.com');
			$username = $user->firstname.' '.$user->lastname;
			$html = $this->template_for_forget_password($username, $email, $secret_key);
			$is_fail = $this->smtp_email->sendEmail($from,$email,$subject,$html);
			if($is_fail){
				echo "ERROR :";
				print_r($is_fail);
			}
			$this->session->set_flashdata('success_msg','Please check your email to reset password.');
			redirect(_INDEX.'login/forgotpassword');	
		}
		$this->load->view('login/forgotpassword');
	}

	public function template_for_forget_password($username, $email, $secret_key){
		$message = '';
		$message .= '<html>
						<body>
						<h3>Dear '.$username.',</h3>
						<p>Please click on the following link to reset your password of your account which email is <a style="text-decoration:none">'.$email.'</a>.</p>
						<p> <a href="'.base_url()._INDEX.'login/forget_password_response/'.$secret_key.'" ><font color="green" size="+1">Reset your password</font></a></p>
						<p>&nbsp;</p>
						<p>Should you have any questions about your account, please contact us at:   
						<a href="'.base_url()._INDEX.'">'.PROJECT_NAME.'</a>
						</p>
						<p>&nbsp;</p>
						<p>-</p>
						<p>Regards,</p>
						<p>cms.com</p>
						<p><a href="'.base_url()._INDEX.'">'.PROJECT_NAME.'</a></p>';		
		$message .=	'</body></html>';

		return $message;
	}


	public function forget_password_response($secret_key)
	{
		$where = array('secret_key' => $secret_key);
		$user = $this->admin_model->get_row('users',$where);
		if(empty($user))
		{
			$this->session->set_flashdata('error_msg','Email link has been expired,please enter email.');
			redirect(_INDEX.'login/forgotpassword');
		}	
        
        if($this->input->post('password'))
        {
            $pwd = sha1($this->input->post('password'));
            $where = array('secret_key' => $secret_key);
            $data = array('password' => $pwd, 'secret_key' =>'');
            $this->admin_model->update('users', $data, $where);
			$this->session->set_flashdata('success_msg','Password has been reset successfully, please login..!');
            redirect(_INDEX.'login');
        }
		$this->load->view('login/reset_forget_password');
	}
    

}