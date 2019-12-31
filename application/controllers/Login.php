<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

	function __construct()
	{

		parent::__construct();
		$this->load->model('Login_model');
	}
	
	public function index()
	{
		$this->load->view('Pages/login');
		$this->session->sess_destroy();
	}

	public function login_validate()
	{
		$data=array("email"=>$this->input->post('email'),
					"password"=>$this->input->post('password'));

		$result=$this->Login_model->admin_Login($data);

		if($result)
		{
			redirect('Home');
		}
		else
		{
			redirect('Login');
		}
	}
	
	public function logOut(){
		$this->session->sess_destroy();
		$this->load->view('Pages/login');
		// redirect('');
	}

	public function Viewforgotpassword()
	{
		$this->load->view('Pages/forgotpassword');
		
		
	}
	public function forgot_pass()
	{
			$email=$this->input->post('email');
			$que=$this->db->query("select password,email from admin where email='$email'");
			$row=$que->row();
			$user_email=$row->email;

			if((!strcmp($email, $user_email)))
			{
			$pass=$row->password;
				/*Mail Code*/
			$to = $user_email;
			$subject = "Password";
			$txt = "Your password is $pass .";
			$headers = "From: password@example.com" . "\r\n" .
			"CC: ifany@example.com";

			mail($to,$subject,$txt,$headers);
			}
			else
			{
			$data['error']="Invalid Email ID !";
			}
		
	
	   $this->load->view('Pages/forgotpassword');	
   }
   


	            
}
