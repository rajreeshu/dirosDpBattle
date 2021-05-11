<?php

class Admin extends CI_Model{

	public function get($data){
	
		$this->db->where('username',$data['username']);
		$this->db->where('password',$data['password']);
		$ch=$this->db->get('admin');
		if($ch->result()){
			return 1;
		}

		//echo "password";
	}

}


?>