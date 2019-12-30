<?php
class Clinic extends CI_Controller
{
	
	function __construct()
	{
	parent::__construct();
	  $this->load->model('Doctors_model');
	  $this->load->model('Category_model');
	  $this->load->model('Clinic_model');
	}

	public function viewClinicSection()
	{
		$data['fetchCountries']=$this->Doctors_model->fetchcountries();
		$data['fetchCategories']=$this->Category_model->fetchcategorydata();
		$this->load->view('Layout/header');
		$this->load->view('Pages/addclinic',$data);
		 $this->load->view('Layout/footer');	
	}
	public function addClinicSection()
	{
		$data['fetchCountries']=$this->Doctors_model->fetchcountries();
		
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

	public function fetchDoctorsByCat()
	{
		$cat_id=$this->input->post('category_id');
		// $category_id=
	 	  $results=$this->Clinic_model->fetchDoctors_ByCatid($cat_id);
	    //    print_r($results);
		die(json_encode(array("code"=>1,"data"=>$results)));
	}
	
	public function add_Clinic()
	{	
		//  print_r($_POST['doc']);
		$doc_seated_id=$this->input->post('doc');
		// print_r($doc_break_id);
		$doc_break_id=implode(",",$doc_seated_id);
		//  print_r($doc_break_id);

		// 

		$data = array();
		        
		  if($this->input->post() && !empty($_FILES['files']['name']))
		    {

		         $filesCount = count($_FILES['files']['name']);
		          for($i = 0; $i < $filesCount; $i++)
		           {
		               $ext = pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
		                $_FILES['file']['name']     = "clinic_image-".date("Y-m-d-H-i-s").$i.".".$ext;
		                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
		                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
		                $_FILES['file']['error']     = $_FILES['files']['error'][$i];
		                $_FILES['file']['size']     = $_FILES['files']['size'][$i];
		                
		                // File upload configuration
		                $uploadPath = 'assets/clinic_image/';
		                $config['upload_path'] = $uploadPath;
		                $config['allowed_types'] = 'jpg|jpeg|png|gif';
		                
		                // Load and initialize upload library
		                $this->load->library('upload', $config);
		                $this->upload->initialize($config);
		                
		                // Upload file to server
		                if($this->upload->do_upload('file'))
		                {
		                    // Uploaded file data
		                    $fileData = $this->upload->data();
		                    $uploadData[$i]['file_name'] = $fileData['file_name'];
		                    $uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
		                }
		                $images[]=$_FILES['file']['name'];



		            }
		            $pics=implode(",",$images);
					// print_r($pics);
					

		        if(!empty($uploadData))
		         {																				 
		            $data=array("clinic_cat_id"=>$this->input->post('cliniccategoryid'),
						"clinic_name"=>$this->input->post('clinicname'),
						"clinic_doctors"=>$doc_break_id,
						"clinic_email"=>$this->input->post('clinicemail'),
						"clinic_opentime"=>$this->input->post('opentime'),
						"clinic_closetime"=>$this->input->post('closetime'),
						"clinic_ownername"=>$this->input->post('ownamne'),
						"clinic_owneremail"=>$this->input->post('owemail'),
						"clinic_ownercontact"=>$this->input->post('ownercontact'),
				 		"clinic_registration"=>$this->input->post('registration'),
						"clinic_establish"=>$this->input->post('established'),
						 "clinic_country"=>$this->input->post('country'),
						 "clinic_state"=>$this->input->post('state'),
						"clinic_city"=>$this->input->post('city'),
						"clinic_postcode"=>$this->input->post('postcode'),
						"clinic_latitude"=>$this->input->post('latitude'),
						"clinic_longitude"=>$this->input->post('longitude'),
						"clinic_address"=>$this->input->post('address'),
						"clinic_bio"=>$this->input->post('bio'),
						"clinic_status"=>$this->input->post('status'),
						"clinic_adddate"=>date('d-m-y'),
			            'clinic_image'=>$pics);
		         
		           

        	   $results=$this->Clinic_model->insert_Clinic($data);
        	    // print_r($data);

         	  switch ($results) 
				{
					case 0:$this->session->set_flashdata('msg','Error');
						break;
					case 1:$this->session->set_flashdata('msg',' Added Successfully');
						break;
					case 2:$this->session->set_flashdata('msg','Already exist');
						break;
					
					default:$this->session->set_flashdata('msg','Error');
						break;
				}

				redirect('Clinic/viewClinicSection');

		        }

		        else
		        {
		        	echo"error";
		        }
		           
	       }
		        
		        else{

		        	echo "Try Again ";
		        }

		 }

		 public function clinicSection()
		 {
			 $data['fetchclinic']=$this->Clinic_model->fetchClinicdata();
			 $this->load->view('Layout/header');
			 $this->load->view('Pages/viewclinic',$data);
			  $this->load->view('Layout/footer');	
		 }
}

