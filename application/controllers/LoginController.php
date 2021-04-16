<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('LoginModel');
	}

	public function index()
	{
		$this->load->view('home.php');
	}
	public function adminPage(){
if($this->session->user_session!="") {
	$this->load->view('admin.php');
} else {
	redirect(base_url());
}
	}

	public function userLogin()
	{
		if (!empty($this->input->get_post('username')) && !empty($this->input->get_post('password_login'))) {
			$data = $this->LoginModel->login($this->input->get_post('username'), $this->input->get_post('password_login'));
			if ($data['status'] == 200) {
				$this->session->user_session=$data['body'];
				$response['status']=200;
				$response['body']='Login Successfully';

			} else {
				$response = $data;
			}
		} else {
		$response['status']=204;
		$response['body']='Request Parameters Missing';
		}
		echo json_encode($response);
	}

	public function userLogout(){
		$this->session->sess_destroy();
		$response['status']=200;
		$response['body']='Logout Successfully';
		echo json_encode($response);
	}

}

?>
