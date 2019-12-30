<?php
class Clinic_model extends CI_Model
{
	public function fetchcountries()
	{
		return $this->db->get('countries')->result();

	}
	public function fetchState_Byid($countryid)
	{	
		$this->db->where('country_id',$countryid);
		return $this->db->get('states')->result();
	}
	public function fetchCities_Byid($stateId)
	{
		$this->db->where('state_id',$stateId);
		return $this->db->get('cities')->result();
	}
	public function insert_doctors($data)
	{
		$this->db->where($data);
		$re=$this->db->get('doctors')->result();
		if(count($re)==0)
		{
			$results=$this->db->insert('doctors',$data);
			if($results)
			{
				return 1;
			}
			else
			{
				return 0;
			}

		}
		else
		{
			return 2;
	    }
	} 

	public function fetchDoctors_ByCatid($cat_id)
	{
		// print_r($cat_id);
	 return $this->db->query("select doctors.*,category.*,doctors.doc_state as doc_state,doctors.doc_address as doctr_address,doctors.doc_city as doc_city,countries.*,states.*, cities.* ,countries.name as country_name, states.name as state_name, cities.name as city_name from doctors join countries on countries.country_id= doctors.doc_country join cities on cities.cities_id=doctors.doc_city join states on states.states_id=doctors.doc_state join category on category.cat_id=doctors.cat_id where doctors.cat_id=$cat_id")->result();
		 // return $this->db->get('doctors')->result();
		//  print_r($data);

	}
	public function insert_Clinic($data)
	{
		$this->db->where($data);
		$re=$this->db->get('clinic')->result();
		if(count($re)==0)
		{
			$results=$this->db->insert('clinic',$data);
			if($results)
			{
				return 1;
			}
			else
			{
				return 0;
			}

		}
		else
		{
			return 2;
	    }
	}
	
}
