<?php
class Home extends CI_Controller
 {
    function __construct(){
	parent::__construct();
	// if(!$this->session->userdata('login')){
	// 	redirect('Login-Page');
	$this->load->model('Category_model');
	// }
	}

	public function index()
	{
		 // print_r($this->session->userdata('login'));
		 $data['fetch_category']=$this->Category_model->fetchcategorydata();
 		  $this->load->view('Layout/header');
 		  $this->load->view('Pages/index',$data);
 		  $this->load->view('Layout/footer');
 	}
}
