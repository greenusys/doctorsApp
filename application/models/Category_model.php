<?php
class Category_model extends CI_Model
{
	public function addcat($data)
		{
			$this->db->where($data);
			$re=$this->db->get('category')->result();
			if(count($re)==0)
			{
				$results=$this->db->insert('category',$data);
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
		public function fetchcategorydata()
		{
		 
			 return $this->db->get('category')->result();
	
		}
	
}
