<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog extends CI_Controller
{
   public function __construct()
   {
		parent::__construct();
		$this->load->model('admin_model');
   }

   public function index()
   {
        $data['blogs'] = $this->admin_model->get_result('blog');
		$data['template'] = 'blog/index';
		$this->load->view('templates/home_template',$data);
   }


   public function like_blog($blog_id="")
   {
   	     $ip = $this->input->ip_address();
   	    $where = array('blog_id'=>$blog_id,'ip_address'=>$ip);
        $response= $this->admin_model->get_row('like_blog',$where);
     
        if(empty($response))
        {  
        	$where['created'] = time();
            $response= $this->admin_model->insert('like_blog',$where);
            echo 1;
	    }
	    else
	    {
	    	echo 0;
	    }
   }

   public function detail($slug="")
   {

    	$data['blog'] = $this->admin_model->get_row('blog',array('slug'=>$slug));
	    
	    if(empty($data['blog']))
	    {
	    	redirect('blog');
	    }
       

	    ///////////// get previus and next blogs /////////////
		$blog_id = $data['blog']->id;
		$data['previus'] = $this->admin_model->get_neighbour_row('blog',$blog_id,'previus');
		$data['next'] = $this->admin_model->get_neighbour_row('blog',$blog_id,'next');
	    ///////////// get previus and next blogs /////////////

	    //////////////////get recent blogs starts
        $data['recent_blogs'] = $this->admin_model->get_pagination_result('blog','10','0');
	    //////////////////get recent blogs ends


		//////////////// get Comment starts//////////  
		$this->db->order_by('id','desc');  
        $data['comment'] = $this->admin_model->get_result('comment',array('blog_id'=>$blog_id));
        $data['comment_count'] = $this->admin_model->get_pagination_result('comment',0,0,array('blog_id'=>$blog_id));
		//////////////// get Comment ensd //////////    

	    ////////////////  Comment forms submit Starts////////
        $this->form_validation->set_rules('name','Name','required|');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('comment','Comment','required|');
        $this->form_validation->set_error_delimiters('<div style="color:red;font-size:14px">', '</div>'); 
		if($this->form_validation->run() == TRUE)
		{

			$insert = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'comment' => $_POST['comment'],
				'blog_id' => $data['blog']->id,
				'created' => time()
			);
		    $this->admin_model->insert('comment',$insert);
		    // $this->session->set_flashdata('success_msg','Added successfully.');
            redirect('blog/detail/'.$slug);
		}

	    ////////////////  Comment forms submit Ends////////

		$data['template'] = 'blog/detail';
		$this->load->view('templates/home_template',$data);
   }

   

	public function comment($slug="",$offset=0)
	{
		is_admin_authenticate(); 
		$data['blog'] = $this->admin_model->get_row('blog',array('slug'=>$slug));
         
 		$limit=10;
 		$data['rows'] = $this->admin_model->get_pagination_result('comment',$limit,$offset,array('blog_id'=>$data['blog']->id));
 		$config = get_theme_pagination();
 		$config['base_url'] = base_url()._INDEX.'blog/comment/'.$slug;
 		$config['total_rows'] = $this->admin_model->get_pagination_result('comment',0,0,array('blog_id'=>$data['blog']->id));
 		$config['per_page'] = $limit;
 		$config['uri_segment'] = 4;
 		$this->pagination->initialize($config);
 		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'blog/comment';
		$this->load->view('templates/admin_template',$data);
	}

	public function delete_comment($id='',$blog_slug="")
	{
		is_admin_authenticate();
		$id = urldecode($id);
		$where = array('id' => $id);
	    $this->admin_model->delete('comment',$where);	

		$this->session->set_flashdata('success_msg','Deleted successfully.');
        redirect(_INDEX.'blog/comment/'.$blog_slug);
	}


   public function all($offset=0)
	{
 		is_admin_authenticate();
 		$limit=10;
 		$data['rows'] = $this->admin_model->get_pagination_result('blog',$limit,$offset);
 		$config = get_theme_pagination();
 		$config['base_url'] = base_url()._INDEX.'blog/all/';
 		$config['total_rows'] = $this->admin_model->get_pagination_result('blog',0,0);
 		$config['per_page'] = $limit;
 		$this->pagination->initialize($config);
 		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'blog/all';
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
		is_admin_authenticate();
        $this->form_validation->set_rules('title','Title','required|');
        $this->form_validation->set_rules('description','Description','required|');
        $this->form_validation->set_rules('image','Image','callback_image_validation_for_create['.@$_FILES['image']['name'].']|');

		if($this->form_validation->run() == TRUE)
		{

			if($_FILES['image']['name']!='')
			{
				$image = uniqid().'.png';
   				move_uploaded_file($_FILES['image']['tmp_name'],'./assets/uploads/blog/'.$image);
   				create_thumb($image,'./assets/uploads/blog/');
			}


             $author = $this->session->userdata('AdminInfo');

			$insert = array(
				'slug' => create_slug('blog',$this->input->post('title')),
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'image' => $image,
				'author_id' => $author['id'],
				'created' => time()
			);
		    $this->admin_model->insert('blog',$insert);
		    $this->session->set_flashdata('success_msg','Added successfully.');
                    redirect(_INDEX.'blog/all');
		}
		$data['template'] = 'blog/add';
                $this->load->view('templates/admin_template',$data);
	}

	public function edit($slug='')
	{
		is_admin_authenticate();
		$slug = urldecode($slug);
	    	$data['rows'] = $this->admin_model->get_row('blog',array('slug'=>$slug));	

        $this->form_validation->set_rules('title','Title','required|');
        $this->form_validation->set_rules('description','Description','required|');
        $this->form_validation->set_rules('image','Image','callback_image_validation_for_update['.@$_FILES['image']['name'].']|');

		if($this->form_validation->run() == TRUE)
		{
             $author = $this->session->userdata('AdminInfo');

			$update = array(
				'slug' => create_slug_for_update('blog',$this->input->post('title')),
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'author_id' => $author['id'],
				'updated' => time()
			);


			$update['image'] = $data['rows']->image;
			if($_FILES['image']['name']!='')
			{
				$update['image'] = uniqid().'.png';
   				move_uploaded_file($_FILES['image']['tmp_name'],'./assets/uploads/blog/'.$update['image']);
   				create_thumb($update['image'],'./assets/uploads/blog/');
   				@unlink('./assets/uploads/blog/'.$data['rows']->image);
   				@unlink('./assets/uploads/blog/thumbs/'.$data['rows']->image);
			}

		    $where = array('slug' => $slug);
		    $this->admin_model->update('blog',$update,$where);
		    $this->session->set_flashdata('success_msg','Updated successfully.');
           redirect(_INDEX.'blog/all');
		}
		$data['template'] = 'blog/edit';
       $this->load->view('templates/admin_template',$data);
	}

	public function delete($slug='')
	{
		is_admin_authenticate();
		$slug = urldecode($slug);
		$where = array('slug' => $slug);
	    $row = $this->admin_model->get_row('blog',$where);	
	    $this->admin_model->delete('blog',$where);	

   		@unlink('./assets/uploads/blog/'.$row->image);
   		@unlink('./assets/uploads/blog/thumbs/'.$row->image);
		$this->session->set_flashdata('success_msg','Deleted successfully.');
        redirect(_INDEX.'blog/all');
	}



}
?>