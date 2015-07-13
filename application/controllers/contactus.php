<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contactus extends CI_Controller
{
    public function __construct()
    {
		parent::__construct();
		$this->load->model('admin_model');
    }

	public function index($slug='contactus')
	{
    	// $data['row'] = $this->admin_model->get_row('contactus',array('slug'=>$slug));	
		$data['template'] = 'contactus/index';
        $this->load->view('templates/home_template',$data);
    }	

	public function update($slug='contactus')
	{
 		is_admin_authenticate();
		$where = array('slug' => $slug);
    	$data['rows'] = $this->admin_model->get_row('update_contactus',$where);	

         
		if($_POST)
		{
			$map_address = $this->input->post('map_address');
			$map_address = urlencode($map_address);
			$request_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=".$map_address."&sensor=true";
			$xml = simplexml_load_file($request_url);
			$status = $xml->status;
			if($status=='OK'){
				$lat = $xml->result->geometry->location->lat;
				$lng = $xml->result->geometry->location->lng;
			}else{
				$lat = 0;
				$lng = 0;
			}

			$update = array(
				'lat' => $lat,
				'long' => $lng,
				'map_address' => $this->input->post('map_address'),
				'address' => $this->input->post('address'),
				'email' => $this->input->post('email'),
				'contact' => $this->input->post('contact'),
				'updated' => time()
			);

		    
		    $this->admin_model->update('update_contactus',$update,$where);
		    echo 1;
		    exit;
		}


		$data['template'] = 'contactus/update';
        $this->load->view('templates/admin_template',$data);
	}

	public function form_submit()
	{
		extract($_POST);
        
        $insert = array('full_name'=>$full_name,
						'company'=>$company,
						'email'=>$email,
						'phone'=>$phone,
						'message'=>$message,
						'created'=>time(),
        	            );

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
	    $this->email->message("<p>Thank you for Contacting us.<br>
								Sincerely,<br>
								The Elite Research Team</p>"
		);
	    $this->email->send();

		$this->admin_model->insert('contactus',$insert);
	}

   public function all($offset=0)
	{
 		is_admin_authenticate();
 		$limit=10;
 		$data['rows'] = $this->admin_model->get_pagination_result('contactus',$limit,$offset);
 		$config = get_theme_pagination();
 		$config['base_url'] = base_url()._INDEX.'contactus/all/';
 		$config['total_rows'] = $this->admin_model->get_pagination_result('contactus',0,0);
 		$config['per_page'] = $limit;
 		$this->pagination->initialize($config);
 		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'contactus/all';
		$this->load->view('templates/admin_template',$data);
	}

	public function delete($id='')
	{
 		is_admin_authenticate();
		$where = array('id' => $id);
	    $row = $this->admin_model->get_row('contactus',$where);	
	     
	     if(empty($row))
	     {
	     	redirect('contactus/all');
	     }
	    $this->admin_model->delete('contactus',$where);	

		$this->session->set_flashdata('success_msg','Deleted successfully.');
        redirect(_INDEX.'contactus/all');
	}
}
?>