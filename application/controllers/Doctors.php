<?php
class Doctors extends CI_Controller
{
	
	function __construct()
	{
	parent::__construct();
	  $this->load->model('Doctors_model');
	  $this->load->model('Category_model');
	}

	public function viewDCSection()
	{
		$data['fetchdoctors']=$this->Doctors_model->fetchDoctorsdata();
		$this->load->view('Layout/header');
		$this->load->view('Pages/viewdoctors',$data);
		 $this->load->view('Layout/footer');	
	}
	public function addDCSection()
	{
		$data['fetchCountries']=$this->Doctors_model->fetchcountries();
		$data['fetchCategories']=$this->Category_model->fetchcategorydata();
		$this->load->view('Layout/header');
		$this->load->view('Pages/adddoctors',$data);
		 $this->load->view('Layout/footer');	
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
	
	public function adddoctors()
	{
		if(!empty($_FILES['userfile']['name']))
	    	{   
	       // 	$ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
	       // 	$_FILES['file']['name'] = "country_image-".date("Y-m-d-H-i-s").$ext;
                $configg['upload_path'] = 'assets/doctor_image/';
                $configg['allowed_types'] = 'jpg|jpeg|png|gif';
                $configg['file_name'] = $_FILES['userfile']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$configg);
                $this->upload->initialize($configg);
                
                    if($this->upload->do_upload('userfile'))
                    {
                        $uploadData = $this->upload->data();
                        $doc_pic =$uploadData['file_name'];
                    }
                    else
                    {
                        $doc_pic = '';
                    }
                }
                else{
                	echo"doc image error";
				}
					 								 	
				$data=array("cat_id"=>$this->input->post('categoryid'),
				"doc_fname"=>$this->input->post('fname'),
				"doc_lname"=>$this->input->post('lname'),
				"doc_passyear"=>$this->input->post('passyear'),
				"doc_email"=>$this->input->post('email'),
				"doc_dob"=>$this->input->post('dob'),
				"doc_gender"=>$this->input->post('gender'),
				"doc_country"=>$this->input->post('country'),
				"doc_state"=>$this->input->post('state'),
				"doc_city"=>$this->input->post('city'),
				"doc_postcode"=>$this->input->post('postcode'),
				"doc_address"=>$this->input->post('address'),
				"doc_phone"=>$this->input->post('phnnumber'),
				"doc_bio"=>$this->input->post('bio'),
				"doc_status"=>$this->input->post('status'),
				"doc_date"=>date('d-m-y'),
				"doc_image"=>$doc_pic);

  			 $results=$this->Doctors_model->insert_doctors($data);
 

				switch($results) 
				{
					case 0:$this->session->set_flashdata('msg','Error');
						break;
					case 1:$this->session->set_flashdata('msg','Add Successfully');
						break;
					case 2:$this->session->set_flashdata('msg','Already exist');
						break;
					
					default:$this->session->set_flashdata('msg','Error');
						break;
				}

					redirect('Doctors/addDCSection');
				

	}

}
