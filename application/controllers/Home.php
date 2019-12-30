<?php
class Home extends CI_Controller
 {
//     function __construct(){
// 	parent::__construct();
	// if(!$this->session->userdata('login')){
	// 	redirect('Login-Page');
	// }
	// }

	public function index()
	{
 		// print_r($this->session->userdata('login'));
 		  $this->load->view('Layout/header');
 		  $this->load->view('Pages/index');
 		  $this->load->view('Layout/footer');
 	}
}
