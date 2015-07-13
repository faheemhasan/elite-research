<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bank_information extends CI_Controller
{
   	public function __construct()
   	{
		parent::__construct();
		$this->load->model('admin_model');
   		is_admin_authenticate();
   	}

   public function all($offset=0)
	{
 		$limit=10;
 		$data['rows'] = $this->admin_model->get_pagination_result('bank_information',$limit,$offset);
 		$config = get_theme_pagination();
 		$config['base_url'] = base_url()._INDEX.'bank_information/all/';
 		$config['total_rows'] = $this->admin_model->get_pagination_result('bank_information',0,0);
 		$config['per_page'] = $limit;
 		$this->pagination->initialize($config);
 		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'bank_information/all';
		$this->load->view('templates/admin_template',$data);
	}

	public function image_validation_for_create($image_not='0',$image)
  	{
		if($image==''){
			$this->form_validation->set_message('image_validation_for_create','Please select an image to upload.');
 			return false;
		}else{
			$image = explode('.',$image);
			$format = $image[count($image)-1];
			$format = strtolower($format);
			if($format == 'png' || $format == 'jpeg' || $format == 'jpg' || $format == 'gif'){
				return true;
			}else{
				$this->form_validation->set_message('image_validation_for_create','Image format not allowed.');
				return false;
			}
		}
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

	public function add()
	{

        $this->form_validation->set_rules('bank_logo','Bank Logo','callback_image_validation_for_create['.@$_FILES['bank_logo']['name'].']|');
        $this->form_validation->set_rules('bank_name','Bank Name','required|');
        $this->form_validation->set_rules('account_name','Account Name','required|');
        $this->form_validation->set_rules('account_number','Account Number','required|');
        $this->form_validation->set_rules('branch_name','Branch Name','required|');
        $this->form_validation->set_rules('ifsc_code','IFSC Code','required|');

		if($this->form_validation->run() == TRUE)
		{

			if($_FILES['bank_logo']['name']!='')
			{
				$ext = pathinfo($_FILES['bank_logo']['name'], PATHINFO_EXTENSION);
				$bank_logo = uniqid().'.'.$ext;
   				move_uploaded_file($_FILES['bank_logo']['tmp_name'],'./assets/uploads/bank_information/'.$bank_logo);
   				create_thumb($bank_logo,'./assets/uploads/bank_information/');
			}


			$insert = array(
				'slug' => create_slug('bank_information',$this->input->post('bank_name')),
				'bank_logo' => $bank_logo,
				'bank_name' => $this->input->post('bank_name'),
				'account_name' => $this->input->post('account_name'),
				'account_number' => $this->input->post('account_number'),
				'branch_name' => $this->input->post('branch_name'),
				'ifsc_code' => $this->input->post('ifsc_code'),
				'created' => time()
			);
		    $this->admin_model->insert('bank_information',$insert);
		    $this->session->set_flashdata('success_msg','Added successfully.');
                    redirect(_INDEX.'bank_information/all');
		}
		$data['template'] = 'bank_information/add';
                $this->load->view('templates/admin_template',$data);
	}

	public function edit($slug='')
	{
	    	$data['rows'] = $this->admin_model->get_row('bank_information',array('slug'=>$slug));	

        $this->form_validation->set_rules('bank_logo','Bank Logo','callback_image_validation_for_update['.@$_FILES['bank_logo']['name'].']|');
        $this->form_validation->set_rules('bank_name','Bank Name','required|');
        $this->form_validation->set_rules('account_name','Account Name','required|');
        $this->form_validation->set_rules('account_number','Account Number','required|');
        $this->form_validation->set_rules('branch_name','Branch Name','required|');
        $this->form_validation->set_rules('ifsc_code','IFSC Code','required|');

		if($this->form_validation->run() == TRUE)
		{

			$update = array(
				'slug' => create_slug_for_update('bank_information',$this->input->post('bank_name')),
			
				'bank_name' => $this->input->post('bank_name'),
				'account_name' => $this->input->post('account_name'),
				'account_number' => $this->input->post('account_number'),
				'branch_name' => $this->input->post('branch_name'),
				'ifsc_code' => $this->input->post('ifsc_code'),
				'updated' => time()
			);

			$update['bank_logo'] = $data['rows']->bank_logo;
			if($_FILES['bank_logo']['name']!='')
			{
				$ext = pathinfo($_FILES['bank_logo']['name'], PATHINFO_EXTENSION);
				$update['bank_logo'] = uniqid().'.'.$ext;
   				move_uploaded_file($_FILES['bank_logo']['tmp_name'],'./assets/uploads/bank_information/'.$update['bank_logo']);
   				create_thumb($update['bank_logo'],'./assets/uploads/bank_information/');
   				@unlink('./assets/uploads/bank_information/'.$data['rows']->bank_logo);
   				@unlink('./assets/uploads/bank_information/thumbs/'.$data['rows']->bank_logo);
			}

		    $where = array('slug' => $slug);
		    $this->admin_model->update('bank_information',$update,$where);
		    $this->session->set_flashdata('success_msg','Updated successfully.');
           redirect(_INDEX.'bank_information/all');
		}
		$data['template'] = 'bank_information/edit';
       $this->load->view('templates/admin_template',$data);
	}

	public function delete($slug='')
	{
		$where = array('slug' => $slug);
	    $row = $this->admin_model->get_row('bank_information',$where);	
	    $this->admin_model->delete('bank_information',$where);	

   		@unlink('./assets/uploads/bank_information/'.$row->bank_logo);
   		@unlink('./assets/uploads/bank_information/thumbs/'.$row->bank_logo);
		$this->session->set_flashdata('success_msg','Deleted successfully.');
        redirect(_INDEX.'bank_information/all');
	}


}
?>