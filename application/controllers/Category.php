<?php
class Category extends CI_Controller
{
	function __construct()
	{
	parent::__construct();
	   $this->load->model('Category_model');
	}

	public function viewCatSection()
	{
		$this->load->view('Layout/header');
		$this->load->view('Pages/addcategories');
		 $this->load->view('Layout/footer');	
	}
	public function addCatSection()
	{	
		$data=array('cat_name'=>$this->input->post('category'),
					'cat_date'=>date('Y-m-d'));
		$results=$this->Category_model->addcat($data);

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

		  redirect('Category/viewCatSection');

	}
	public function catSection()
	{
		$data['fetch_category']=$this->Category_model->fetchcategorydata();
		$this->load->view('Layout/header');
		$this->load->view('Pages/viewcategory',$data);
		 $this->load->view('Layout/footer');	
	}
	public function get_States()
    {
		$data=$this->Doctors_model->fetchState_Byid($this->input->post('countryid'));
		// print_r($data);
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
