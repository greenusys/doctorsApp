<?php
class Login_model extends CI_Model{

	public function admin_Login($data)
	{
		$this->db->where($data);
		$success=$this->db->get('admin')->result();

		if(count($success>0))
		{
			$re=$this->session->set_userdata('login',$success);
			// print_r($re);
			return true;
		}
		else
		{
			return false;
		}
	}
} 

