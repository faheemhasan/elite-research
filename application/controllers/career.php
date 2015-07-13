<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Career extends CI_Controller
{
   	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
   	}


   	public function index(){
		$this->db->like('slug','career');
		$query = $this->db->get('cms');
		if($query->num_rows() > 0){
			$row = $query->row();
			echo file_get_contents(base_url()._INDEX.'cms/page/'.$row->slug);
		}else{
			redirect(base_url());
		}
	}

	public function download($download){
		$this->load->helper('download');
		$name = $download;	
		$data = file_get_contents(base_url()._INDEX.'assets/uploads/career/'.$download);
		force_download($name,$data); 
	}

   	public function all($offset=0)
	{
 		is_admin_authenticate();
 		$limit=10;
 		$data['rows'] = $this->admin_model->get_pagination_result('career',$limit,$offset);
 		$config = get_theme_pagination();
 		$config['base_url'] = base_url()._INDEX.'career/all/';
 		$config['total_rows'] = $this->admin_model->get_pagination_result('career',0,0);
 		$config['per_page'] = $limit;
 		$this->pagination->initialize($config);
 		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'career/all';
		$this->load->view('templates/admin_template',$data);
	}

	public function delete($slug=''){
 		is_admin_authenticate();
		$where = array('slug' => $slug);
	    $row = $this->admin_model->get_row('career',$where);	
	    $this->admin_model->delete('career',$where);	
  		@unlink('./assets/uploads/career/'.$row->resume);
 		$this->session->set_flashdata('success_msg','Deleted successfully.');
        redirect(_INDEX.'career/all');
	}

	public function submit()
	{
		if($_FILES['resume']['name']!=''){
			$resume = uniqid().'_'.$_FILES['resume']['name'];
			move_uploaded_file($_FILES['resume']['tmp_name'],'./assets/uploads/career/'.$resume);
		}
		$insert = array(
			'slug' => create_slug('career',$this->input->post('name')),
			'position_applied_for' => $this->input->post('position_applied_for'),
			'name' => $this->input->post('name'),
			'address' => $this->input->post('address'),
			'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email'),
			'degree' => $this->input->post('degree'),
			'clg' => $this->input->post('clg'),
			'completed' => $this->input->post('completed'),
			'resume' => $resume,
			'created' => time()
		);
		$this->admin_model->insert('career',$insert);

		$message = '';
		$message .= '<html>
						<body>
						<h3>Resume submitted by '.$insert['name'].'</h3>
						<p>Please click on this link to download full resume <a href="'.base_url()._INDEX.'career/download/'.$insert['resume'].'">Download Resume</a>.</p>
						<a href="'.base_url()._INDEX.'">eliteresearch.co</a>
						</p>
						<p>&nbsp;</p>';
		$message .=	'</body></html>';
		$this->load->library('smtp_lib/smtp_email');
		$is_fail = $this->smtp_email->sendEmail(array('no-reply@eliteresearch.co' =>'eliteresearch.co'),'sohailkhan2092@gmail.com','Career : Resume Submitted',$message);

		echo "<div style='background-color:#DFF0D8; font-size:16px; color:green; margin-top:100px; padding:10px; border-radius:5px;' align='center'>Your resume has been submitted successfully.</div>";
	}

	public function form(){
		?>
		<br>
		<h1 align='center' style='color:white;'><b>Resume</b></h1>
		<form action="<?php echo base_url()._INDEX ?>career/submit" style='color:#fff' id="career-form" method="post" enctype="multipart/form-data">
			<input  name="position_applied_for" placeholder="Position Applied For"  class="form-control"  type="text" required>
			<input  name="name" placeholder="Full Name"  class="form-control"  type="text" required>
			<input  name="address" placeholder="Address"  class="form-control"  type="text" required>
			<input  name="phone" placeholder="Phone"  class="form-control"  type="text" required>
			<input  name="email" placeholder="Email"  class="form-control"  type="email" required>
			<input  name="degree" placeholder="Qualification Title"  class="form-control"  type="text" required>
			<input  name="clg" placeholder="University/Institute"  class="form-control"  type="text" required>
			<input  name="completed" placeholder="Year Completed"  class="form-control"  type="text" required>
			<b>Upload Resume</b><br> 
			<input  name="resume" class="form-control"  type="file" required>
			<br><br>
			<input  name="submit" value='Submit' class="form-control"  type="submit" >
			<br><br>
		</form>
		<style>
			form#career-form input[type=text],form#career-form input[type=email]{
				margin-bottom:20px;
				width:49%;
				height:40px;
				padding:5px;
				border:none;
			}
		</style>
		<?php 
	}


}
?>