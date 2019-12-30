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
    
		            $data=array("fname"=>$this->input->post('fname'),
						"lname"=>$this->input->post('lname'),
						"email"=>$this->input->post('email'),
						"address"=>$this->input->post('address'),
						"country"=>$this->input->post('country'),
						"city"=>$this->input->post('city'),
						"state"=>$this->input->post('state'),
						"zip_code"=>$this->input->post('zc'),
						"home_phone"=>$this->input->post('hc'),
				 		"work_phone"=>$this->input->post('wc'),
						"mobile"=>$this->input->post('mob'),
			 			"note"=>$this->input->post('note'),
			            'owner_image'=>$pics);
		         
		           

        	   $results=$this->Clinic_model->insert_Clinic($data);
        	  // print_r($results);

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
}
