<?php
class Rules extends CI_model{

	public function login_admin(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('admin_email','Username','required');
		$this->form_validation->set_rules('admin_pass','Password','required');
		return $this->form_validation->run();
	}

	public function add_admin(){

		$this->form_validation->set_message('is_unique', 'It is already taken. try with another username');

		$this->form_validation->set_rules('username','Username','required|is_unique[fighter.username]');
		$this->form_validation->set_rules('name','Full Name','required');
		return $this->form_validation->run();
	}

}



?>