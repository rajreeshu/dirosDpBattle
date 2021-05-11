<?php
class Create extends CI_Controller{
	
	public function index(){
		$this->load->helper('form');

		// /$this->load->view('create');

		$data=$this->input->post();

		$this->load->model('admin');

		$this->load->library('form_validation');

		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');
		
//		if(isset($data['submit'])){
			if($this->form_validation->run()){
		if($this->admin->get($data)){
			redirect('admin/form');
		}$this->session->set_flashdata('login_failed','Incorrect Username/Password');
		
		}else { $this->load->view('create'); }

//		}
	}

}



?>