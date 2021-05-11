<?php

class Home extends CI_Controller{

	public function index(){
	
	error_reporting(0);

	$battle_id=	$this->input->get('battle_id');

	$this->load->model('database');

	$war=$this->database->war_detail($battle_id);

// redirect to random battle

	
// check if battle dosent exist
	if(empty($battle_id)){
		$random_battle_id=$this->database->rand_id_selection();

		if($this->session->flashdata('voteing_status')=='3'){
			$this->session->set_flashdata('voteing_status','3');
		}
		redirect(base_url("home?battle_id=$random_battle_id->id"));

	}
	if(empty($war->row())){
		$random_battle_id=$this->database->rand_id_selection();
		redirect(base_url("home?battle_id=$random_battle_id->id"));
	}	

	$fighters=array_column($war->result_array(), 'username');
	
	$fighter=$this->database->fighter_detail($fighters);

	$votes=$this->database->vote_count($battle_id);

	 $battle_time_left=$this->database->battle_time_left($battle_id);

 


$admin_name=$this->database-> get_admin_username($battle_id);
$admin_data=$this->database->admin_detail($admin_name->admin);



	
		$this->database->visited_battle($battle_id);

		$visited_battle_show=$this->database->visited_battle_show($battle_id)->num_rows();



	//	print_r($visited_battle_show);
		//$next_battle_id=$battle_id+1;

		$last_battle_id=$this->db->select('id')->order_by('id','DESC')->get('battle_detail')->row()->id;
		
		$first_battle_id=$this->db->select('id')->where('end_time>=',date('Y-m-d H:i:s'))->order_by('id','ASC')->get('battle_detail')->row()->id;

		$next_active_battle_id=$this->db->select('id')->where(['end_time>='=>date('Y-m-d H:i:s'),'id>'=>$battle_id])->order_by('id','ASC')->get('battle_detail')->row()->id;
		//
		

		$battle_time_left_next_battle=$this->database->battle_time_left($next_battle_id);
		

		
		if($last_battle_id==$battle_id){
			$next_active_battle_id=$first_battle_id;
		}
		


		
		



		$this->load->view('body',['battle_detail'=>$war->result(),'fighter'=>$fighter->result(),'votes'=>$votes,'time_left'=>$battle_time_left,'admin_data'=>$admin_data,'visited_battle_show'=>$visited_battle_show,'next_active_battle_id'=>$next_active_battle_id]);

	}



	



	public function vote_credit(){

		

		$this->load->model('database');

		$battle_id=$this->input->get('war_id');

		

		redirect("home/?battle_id=$battle_id&&data=data");

		/*if($this->database->add_vote()){

			redirect("home/index?battle_id=$battle_id#here");

		}else{ }*/

	}

	public function g_api(){
		$this->load->view('google_api');
	}

	public function stats(){

		error_reporting(0);

		$battle_id=$this->input->get('battle_id');
		$username=$this->input->get('user');
		$this->load->model('database');

		$war=$this->database->war_detail($battle_id);
		$user_data=$this->database->fighter_detail($username)->row();

		$available_user=$this->db->where(['war_id'=>$battle_id,'username'=>$username])->get('war_field')->row();
		
		if(!empty($war->row())&&empty($available_user)){
				header('Refresh:5; url= '. base_url());
				echo '<h2>Loading....</h2><h3>Page url is Broken, We can&#39t find the User detail... You will be Redirected to Battle Link in 5 sec... </h3>';
			exit;
		}

		if(empty($war->row())||empty($user_data)){

			header('Refresh:5; url= '. base_url());
			echo '<h2>Loading....</h2><h3>Page url is Broken... You will be Redirected to <a href="'.base_url().'">Diros Official Site</a> in 5 sec...</h3>';
			exit;
		}



		
		$visited_battle_show=$this->database->visited_battle_show($battle_id)->num_rows();
		$battle_detail=$this->database->get_admin_username($battle_id);

		$track_social_media=$this->database->track_social_media($battle_id,$username);

		

		$fighterss=array_column($war->result_array(), 'username');
		$fighter=$this->database->fighter_detail($fighterss);
		$votes=$this->database->vote_count($battle_id);



				
		$this->load->view('statistics',['battle_id'=>$battle_id,'user_data'=>$user_data,'visited_battle_show'=>$visited_battle_show,'battle_detail'=>$battle_detail,'track_social_media'=>$track_social_media,'battle_details'=>$war->result(),'fighter'=>$fighter->result(),'votes'=>$votes]); 
	}






public function privacy_policy(){
	$this->load->view('privacyPolicy');
}

public function contact_us(){
	echo "<div style='margin:20px;'><h2>Contact Us</h2>
<p>If you have any query regrading Site, Advertisement and any other issue, please feel free to contact at 
<br><br>
Email:- <strong>dirosweb@gmail.com</strong><br>

WhatsApp:- <a href='https://wa.me/919110065497' class='btn btn-success' style='height: 80px;'>Click Here to contact on WhatsApp</a><br>
 Instagram Link:- <strong><a href='https://instagram.com/diros.in'>@diros.in</strong></a>
</p> Thank you..<br>:- Team Diros</div>" ;
}

public function about_us(){
	echo"<div style='margin:20px;'><h2>About Us</h2>
<p>Diros is an entertainment site, here You can Participate in Battles and You can also show your awsm pics to our Thousands of Visitors. We are always Giving Our best to make our audience Famous</p>


We are a Small Tean of Few People, Operates as per our intrest and our goal is to Expand our Customers and help More and More People to get Famous on insta and Facebook
<p>If you have any query regrading Site, Advertisement and any other issue, please feel free to contact at <strong>dirosweb@gmail.com</strong></p>
You can Follow us on Instagram at <strong><a href='https://instagram.com/diros.in'>@diros.in</strong></a><br>
website Link:- <a href='https://diros.in'>Https://diros.in</a><br><br>
 Thanks For Your Love and Support<br>
 :- Team Diros</div>";
}

public function dmca(){
	echo "<div style='margin:20px;'><h2>DMCA</h2>
<p>If we Have added some content that belong to you or your organization by mistake, We are sorry for that.<br> We apologize for that and assure you that this wont be repeated in future. <br>If you are rightful owner of the content used in our Website, Please mail us with your Name, Organization Name, Contact Details, Copyright infringing URL and Copyright Proof (URL or Legal Document) at <strong>dirosweb@gmail.com</strong></p>
<p>I assure you that, I will remove the infringing content Within 48 Hours.</p></div>";
}


}











?>