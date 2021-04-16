<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function login($username, $password)
	{

		try {
			$where=['email'=>$username,'password'=>$password];
			$user_details = $this->db->select(array('*'))->where($where)->get('user_master')->row();
			if (is_null($user_details)) {
				$data["status"] = 201;
				$data["body"] = "Invalid username or Password";
				return $data;
			} else {

					$data["status"] = 200;
					$data["body"] = $user_details;
					return $data;

			}
		} catch (Exception $exc) {
			log_message('error', $exc->getMessage());
			$data["status"] = 204;
			$data["body"] = $exc->getMessage();
			return $data;
		}
	}

}

/* End of file .php */
?>
