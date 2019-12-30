<?php
class API extends CI_Controller
{
	
	function __construct()
	{
	parent::__construct();
	$this->load->model('Doctors_model');
	$this->load->model('Category_model');
	$this->load->model('Clinic_model');
	}

	public function getCategories()
	{
		$data=$this->Category_model->fetchcategorydata();
		if(count($data)>0)
        {
            die(json_encode(array('code'=>1,"data"=>$data)));
        }
        else
        {
             die(json_encode(array('code'=>0,"data"=>"No data Found ")));
        }
	}
	public function getDoctors(){
		$data=$this->Doctors_model->fetchDoctorsdata();
		if(count($data)>0)
        {
            die(json_encode(array('code'=>1,"data"=>$data)));
        }
        else
        {
             die(json_encode(array('code'=>0,"data"=>"No data Found ")));
        }
	}
	public function loginValidate(){
		$condition=array("email"=>$this->input->post('user_email'),"password"=>$this->input->post('user_password'));
		$this->db->where($condition);
		if(count($data=$this->db->get('users')->result())>0){
			die(json_encode(array('code'=>1,"msg"=>"Login Successful.","data"=>$data)));
		}else{
			die(json_encode(array('code'=>0,"msg"=>"Invalid Email or Password.")));
		}
	}
	public function userRegistration(){
		$data=array(
				"email"=>$this->input->post('user_email'),
				"password"=>$this->input->post('user_password'),
				"phone"=>$this->input->post('phone'),
				"full_name"=>$this->input->post('full_name'),
				);
		$this->db->where($data);
		if(count($this->db->get('users')->result())==0){
			if($this->db->insert('users',$data)){
				die(json_encode(array('code'=>1,"msg"=>"User Registered Successfully.")));
			}else{
				die(json_encode(array('code'=>0,"msg"=>"Failed To Insert")));
			}
			
		}else{
			die(json_encode(array('code'=>0,"msg"=>"User Already Exists.")));
		}
	}
	public function get_States()
    {
		$data=$this->Doctors_model->fetchState_Byid($this->input->post('countryid'));
        if(count($data)>0)
        {
            die(json_encode(array('code'=>1,"data"=>$data)));
        }
        else
        {
             die(json_encode(array('code'=>0,"data"=>"No data Found ")));
        }
    }
	public function get_Cities()
    {
        $data=$this->Doctors_model->fetchCities_Byid($this->input->post('stateId'));
        if(count($data)>0)
        {
            die(json_encode(array('code'=>1,"data"=>$data)));
        }
        else
        {
             die(json_encode(array('code'=>0,"data"=>"No data Found ")));
        }
    }

}
