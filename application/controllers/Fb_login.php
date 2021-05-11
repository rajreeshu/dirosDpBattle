<?php

class Fb_login extends CI_Controller{

	public function temp(){
		$this->load->helper('cookie');
		$this->load->model('database');

		$data=$this->input->get();
//		$arrayName = array('war_id' => , );
		if($data['voter']=$this->input->cookie('diros_fb_id')){
			if(!empty($battle_id=$this->database->add_vote($data))){
				$this->input->set_cookie(['name'=>'diros_fb_id','value'=>$data['voter'],'expire'=>2592000]);
				$this->session->set_flashdata('voteing_status','1');
				redirect('home/index?battle_id='.$data['war_id']);
			}else{
		//	$this->input->set_cookie(['name'=>'diros_fb_id','value'=>$battle_id,'expire'=>2592000]);
			$this->session->set_flashdata('voteing_status','2');

		//	$this->session->set_flashdata('voteing_status','1');
			redirect('home/index?battle_id='.$data['war_id']);
		}
		}else{
			if($track_vote_id=$this->database->track_vote($data['war_id'])){
				$this->input->set_cookie(['name'=>'diros_vote_track','value'=>$track_vote_id,'expire'=>2592000]);
			}
			$this->load->view('fb_js');
			
			$this->load->view('google_api');
		}

	}



	public function idata(){

		$this->load->helper('cookie');
		$this->load->model('database');

		$data=$this->input->get();
		//$battle_id=$this->database->add_vote();

		$track_vote_id=$this->input->cookie('diros_vote_track');
		$this->database->track_vote_cnfrm($track_vote_id);

		if(!empty($data['voter'])){
			$this->input->set_cookie(['name'=>'diros_fb_id','value'=>$data['voter'],'expire'=>2592000]);
		}

		if(!empty($battle_id=$this->database->add_vote($data))){

			$this->db->insert('vote_via',['via'=>$data['via'],'date'=>date('Y-m-d H:i:s')]);

			
			$this->session->set_flashdata('voteing_status','1');
		}else{
			$this->session->set_flashdata('voteing_status','2');
		}

		//echo $battle_id;

		//header("home/index?battle_id=".$battle_id);

		redirect('home/index?battle_id='.$data['war_id']);

	}

	public function insta_login(){
		
	}



}

?>