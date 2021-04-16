<?php
class BlogController extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('BlogModel');
		$this->load->library('pagination');
	}

	public function loadData($record=0) {
		$filter=$this->input->get_post('category');
		$recordPerPage = 3;
		if($record != 0){
			$record = ($record-1) * $recordPerPage;
		}
		$recordCount =$this->BlogModel->get_count($filter);
		$empRecord = $this->BlogModel->getAllBlogs($recordPerPage,$record,$filter);

		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = "<ul class='pagination pg-red'>";
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = '<i class="fa fa-fast-backward" aria-hidden="true" style="color: red"></i>';
		$config['last_link'] = '<i class="fa fa-fast-forward" aria-hidden="true" style="color: red"></i>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link waves-effect">';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="fas fa-arrow-left" style="color: red"></i>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '<i class="fas fa-arrow-right text-red" style="color: red"></i>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['total_rows'] = $recordCount;
		$config['per_page'] = $recordPerPage;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['empData'] = $empRecord;
		$data['last_query'] = $this->db->last_query();
		echo json_encode($data);
	}

	public function getAllBlogsForAdmin(){
		$data=$this->BlogModel->getAllBlogsForAdmin();
		if($data!=false){
			$table="";
foreach($data as $row){
	$table.='<tr>' .
		'<th scope="row">'.$row->id.'</th>' .
		'<th scope="row">'.$row->title.'</th>' .
		'<th scope="row">'.$row->category.'</th>' .
		'<th scope="row">'.$row->created_at.'</th>' .
		'<th scope="row">'.substr($row->description,0,50).'</th>' .
		'<td><div class="button_group"><button class="btn-primary btn-sm mr-2" onclick="getAllBlogsById(`'.$row->id.'`)"><i class="fas fa-edit"></i></button>' .
		'<button class="btn-danger btn-sm mt-2 mr-2 " onclick="deleteBlog(`'.$row->id.'`)"><i class="fas fa-trash"></i></button></div></td>' .
		'</tr>';
	
}
			
			
			
			$response['status']=200;
			$response['body']=$table;
		}else{
			$response['status']=201;
			$response['body']='No Blog Data Found';
		}
		echo json_encode($response);
	}

	public function getBlogById(){
		if(!empty($this->input->get_post('id'))){
			$where=array('id'=>$this->input->get_post('id'));
			$data=$this->BlogModel->getBlogById($where);
			if($data!=false){
				$response['status']=200;
				$response['body']=$data;
			}else{
				$response['status']=201;
				$response['body']='No Blog Data Found';
			}
		}else{
			$response['status']=202;
			$response['body']='Request Parameters missing';
		}
		echo json_encode($response);
	}

	public function addBlog(){
		if(!empty($this->input->get_post('title')) && !empty($this->input->get_post('category'))
		&& !empty($this->input->get_post('description'))
		){
			$id=$this->input->get_post('id');
			$previous_image=$this->input->get_post('pre_image');
			$des_path = "blog_images";

			if(isset($_FILES['userfile']) && $_FILES["userfile"]["error"] != 4){

				$result = $this->BlogModel->upload_file($des_path); //upload_multiple_file_new

				if ($result["status"] == 200) {
					if ($result["body"]!=null) {

						$des_path = $result["body"];


					} else {
						$des_path='';
					}
				}
			} else {
				$des_path=$previous_image;
			}

			$data=['title'=>$this->input->get_post('title'),
			'category'=>$this->input->get_post('category'),
			'description'=>$this->input->get_post('description'),
			'image'=>$des_path,
			'created_at'=>date("Y-m-d h:i:sa"),
			'created_by'=>$this->session->user_session->id,
			'status'=>1
			];
		if($id==''){

			if($this->BlogModel->addBlog($data)){
				$response['status']=200;
				$response['body']='Blog Post Successfully';
			}else{
				$response['status']=201;
				$response['body']='Something went wrong to Post your Blog';
			}
		}else{
			$where=array('id'=>$id);
			$data['update_by']=$this->session->user_session->id;
			$data['updated_at']=date("Y-m-d h:i:sa");
			if($this->BlogModel->updateBlog($where,$data)){
				$response['status']=200;
				$response['body']='Blog  Updated Successfully';
			}else{
				$response['status']=201;
				$response['body']='Something went wrong to Update your Blog';
			}
		}

		}else{
			$response['status']=202;
			$response['body']='Request Parameters missing';
		}
		echo json_encode($response);
	}

	public function deleteBlog(){
		if(!empty($this->input->get_post('id'))){
			$where=array('id'=>$this->input->get_post('id'));
			$data=$this->BlogModel->deleteBlog($where);
			if($data!=false){
				$response['status']=200;
				$response['body']=$data;
			}else{
				$response['status']=201;
				$response['body']='No Blog Data Found';
			}
		}else{
			$response['status']=202;
			$response['body']='Request Parameters missing';
		}
		echo json_encode($response);
	}

	public function getAllCats(){
		$data=$this->BlogModel->getAllCats();
		if($data!=false){
			$response['status']=200;
			$response['body']=$data;
		}else{
			$response['status']=201;
			$response['body']='No Blog Data Found';
		}
		echo json_encode($response);
	}

}

?>
