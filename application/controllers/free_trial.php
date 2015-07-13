<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Free_trial extends CI_Controller
{
   	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
   	}

   	public function index()
   	{
		$data['template'] = 'free_trial/index';
		$this->load->view('templates/home_template',$data);
	}



 

   	public function all($offset=0)
	{
 		$limit=10;
 		$data['rows'] = $this->admin_model->get_pagination_result('free_trial',$limit,$offset);
 		$config = get_theme_pagination();
 		$config['base_url'] = base_url()._INDEX.'free_trial/all/';
 		$config['total_rows'] = $this->admin_model->get_pagination_result('free_trial',0,0);
 		$config['per_page'] = $limit;
 		$this->pagination->initialize($config);
 		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'free_trial/all';
		$this->load->view('templates/admin_template',$data);
	}

	public function delete($id=''){
		$where = array('id' => $id);

	    $row = $this->admin_model->get_row('free_trial',$where);	
	    $this->admin_model->delete('free_trial',$where);	

 		$this->session->set_flashdata('success_msg','Deleted successfully.');
        redirect(_INDEX.'free_trial/all');
	}

	public function is_unique_email()
	{
		$where = array('email' => $_POST['email']);

	    $row = $this->admin_model->get_row('free_trial',$where);	
	      if($row)
	      {
	        echo 1;
	      }
	      else
	      {
	      	echo 0;
	      }
	}



	public function submit()
	{
		extract($_POST);

		$insert = array(
			'first_name' => $first_name,
			'last_name' => $last_name,
			'mobile' => $mobile_number,
			'email' => $email,
			'city' => $city,
			'packages' => json_encode($this->input->post('package')),
			'created' => time()
		);
		$this->admin_model->insert('free_trial',$insert);

	    $this->load->library('email');
	    $config['protocol'] = "smtp";
	    $config['smtp_host'] = "ssl://smtp.mandrillapp.com";
	    $config['smtp_port'] = "465";
	    $config['smtp_user'] = "contact@faheemhasan.com";
	    $config['smtp_pass'] = "786ycxrFRADbdjmq3QEg-Q";
	    $config['charset'] = "utf-8";
	    $config['mailtype'] = "html";
	    $config['newline'] = "\r\n";
	    $this->email->initialize($config);
	    $this->email->from('contact@faheemhasan.com', 'Elite');
	    $this->email->to($email);
	    $this->email->reply_to('elite.com', 'Explendid Videos');
	    $this->email->subject('Contactus.');

		$message = '';
		$message .= '<html>
						<body>
						<h3>Request submitted by '.ucfirst($first_name).'</h3>
						<h3>You have request a Free trial.</h3>
						<a href="'.base_url()._INDEX.'">eliteresearch.co</a>
						</p>
						<p>&nbsp;</p>';
		$message .=	'</body></html>';
	
	    $this->email->message($message);

	    $this->email->send();

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

	public function update($slug='free_trial')
	{
    	$data['rows'] = $this->admin_model->get_row('update_free_trial',array('slug'=>$slug));	

        $this->form_validation->set_rules('title','Title','required');
        $this->form_validation->set_rules('bg_image','Background Image','callback_image_validation_for_update['.@$_FILES['bg_image']['name'].']|');

		if($this->form_validation->run() == TRUE)
		{

			$update = array(
				'title' => $this->input->post('title'),
				'updated' => time()
			);


			$update['bg_image'] = $data['rows']->bg_image;
			if($_FILES['bg_image']['name']!='')
			{
				$update['bg_image'] = uniqid().'.png';
   				move_uploaded_file($_FILES['bg_image']['tmp_name'],'./assets/uploads/free_trial/'.$update['bg_image']);
   				@unlink('./assets/uploads/free_trial/'.$data['rows']->bg_image);
			}


		    $where = array('slug' => $slug);
		    $this->admin_model->update('update_free_trial',$update,$where);
		    $this->session->set_flashdata('success_msg','Updated successfully.');
           	redirect(current_url());
		}
		$data['template'] = 'free_trial/update';
       	$this->load->view('templates/admin_template',$data);
	}




}
?>