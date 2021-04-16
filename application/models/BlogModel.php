<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BlogModel extends CI_Model
{
public function __construct()
{
	parent::__construct();
}

	public function getAllBlogs($limit,$start,$cat=''){

		$this->db->select(array('*'));
		if($cat!=''){
			$this->db->where(array('category'=>$cat));
		}
		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'desc');
		$data=$this->db->get('blog_master_all')->result_array();
		if(count($data)>0){
			return $data;
		}else{
			return false;
		}
	}

	public function get_count($cat=''){
		$this->db->select(array('*'));
		if($cat!=''){
			$this->db->where(array('category'=>$cat));
		}
		$data=$this->db->get('blog_master_all')->num_rows();
		return $data;
	}

	public function getAllBlogsForAdmin(){
		$this->db->select(array('*'));
		$this->db->where(array('created_by'=>$this->session->user_session->id));

		$data=$this->db->get('blog_master_all')->result();
		if(count($data)>0){
			return $data;
		}else{
			return false;
		}
	}
	public function getAllCats(){

		$this->db->select(array('category','id'));
		$this->db->group_by('category');
		$data=$this->db->get('blog_master_all')->result_array();
		if(count($data)>0){
			return $data;
		}else{
			return false;
		}
	}


	public function getBlogById($where){
		$this->db->select(array('*'));
		$this->db->where($where);
		$data=$this->db->get('blog_master_all')->result_array();
		if(count($data)>0){
			return $data;
		}else{
			return false;
		}
	}

	public function addBlog($data){
		try {
			$this->db->trans_start();
			$this->db->insert('blog_master_all', $data);
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$result = FALSE;
			} else {
				$this->db->trans_commit();
				$result = TRUE;
			}
			$this->db->trans_complete();
		} catch (Exception $exc) {
			log_message('error', $exc->getMessage());
			$result = FALSE;
		}
		return $result;
	}

	public function deleteBlog($data){
		try {
			$this->db->trans_start();
			$this->db->where($data);
			$this->db->delete('blog_master_all');
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$result = FALSE;
			} else {
				$this->db->trans_commit();
				$result = TRUE;
			}
			$this->db->trans_complete();
		} catch (Exception $exc) {
			log_message('error', $exc->getMessage());
			$result = FALSE;
		}
		return $result;
	}

	public function updateBlog($where,$data){
		try {
			$this->db->trans_start();
			$this->db->where($where);
			$this->db->update('blog_master_all',$data);
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$result = FALSE;
			} else {
				$this->db->trans_commit();
				$result = TRUE;
			}
			$this->db->trans_complete();
		} catch (Exception $exc) {
			log_message('error', $exc->getMessage());
			$result = FALSE;
		}
		return $result;
	}



	function upload_file($upload_path) {

		if (isset($_FILES['userfile']) && $_FILES['userfile']['error'] != '4') {
			$files = $_FILES;
			if (is_array($_FILES['userfile']['name'])) {
				$count = count($_FILES['userfile']['name']); // count element
			} else {
				$count = 1;
			}
			$_FILES['userfile']['name'] = $files['userfile']['name'];
			$_FILES['userfile']['type'] = $files['userfile']['type'];
			$_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'];
			$_FILES['userfile']['error'] = $files['userfile']['error'];
			$_FILES['userfile']['size'] = $files['userfile']['size'];
			$config['upload_path'] = $upload_path;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '500000';    //limit 10000=1 mb
			$config['remove_spaces'] = true;
			$config['overwrite'] = false;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$fileName = preg_replace('/\s+/', '_', str_replace(' ', '_', $_FILES['userfile']['name']));
			$data = array('upload_data' => $this->upload->data());
			if (empty($fileName)) {
				$response['status'] = 203;
				$response['body'] = "file is empty";
				return false;
			} else {
				$file = $this->upload->do_upload('userfile');
				if (!$file) {
					$error = array('upload_error' => $this->upload->display_errors());
					$response['status'] = 204;
					$response['body'] = $upload_path.'/'.$files['userfile']['name'] . ' ' . $error['upload_error'];
					return $response;
				} else {
					$response['status'] = 200;
					$response['body'] = $upload_path.'/'.$fileName;
					return $response;
				}
			}
		} else {
			$response['status'] = 200;
			$response['body'] = "";
			return $response;
		}
	}


}

/* End of file .php */
?>
