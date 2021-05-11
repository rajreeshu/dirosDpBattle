<?php

class Ajax extends CI_Controller{
	
	public function cover(){

		$this->load->model('database');
		$visitor_id=$this->input->cookie('diros_traffic_track');

		while (empty($winner_username)) {
			
			$rand_id_over=$this->database->rand_id_selection_over();

			if(!empty($vote_compare=$this->database->vote_compare($rand_id_over->id))){

$x= max(array_column($vote_compare, 'count'));
$y= min(array_column($vote_compare, 'count'));

if(count($vote_compare)!=1){
	if($x!=$y){
foreach ($vote_compare as $compare) {
	if($compare->count==$x){
		$winner_username=$compare->voted_user;
		continue;

}
}
}
}else{
	$winner_username=$vote_compare[0]->voted_user;
}
}

		}
			$war_detail=$this->database->war_detail($rand_id_over->id);

		$fighter_detail=$this->database->fighter_detail($winner_username);

		$battle_time_left=$this->database->get_admin_username($rand_id_over->id);

		foreach ($war_detail->result() as $war) {
			if($war->username==$winner_username){

				echo '<div class="d-flex justify-content-center p-2"><div class="spinner-border text-info" role="status"></div><span class="text-info" style=" font-size:23px;"> &nbsp; Loading....</span></div>

				<div class="alert alert-dismissible alert-danger  m-2 m-md-0" >
				<h6><u>WINNER ShoutOut!!!</u></h6>
  						<!--<span><i><b>&nbsp;</b></i><span style="" class=""> Battle On :- </span><strong>'.substr($battle_time_left->start_time,0,10).'</span></strong> -->
  					  </div>';
			
				echo " <img src=".base_url('utility/battle-images/')."".$war->img_name." class='ml-1 m-md-3' style=' max-height: 400px; border:13px inset grey; background:#fce8d5;'>";

				echo "<div class='text-secondary font-weight-bold' style='text-shadow:2px 2px 2px #204051;'><h3><center>".ucfirst($fighter_detail->result()[0]->name)."</center></h3></div>";

				if(empty($already_cover=$this->db->where(['visitor_id'=>$visitor_id,'battle_id'=>$rand_id_over->id,'username'=>$war->username])->get('track_cover_image')->result())){
			
				$this->db->insert('track_cover_image',['visitor_id'=>$visitor_id,'battle_id'=>$rand_id_over->id,'username'=>$war->username,'date'=>date('Y-m-d H:i:s')]);
				}

			}
		}

	}

	public function social_media_track(){
		$postData=$this->security->xss_clean($this->input->post());
		$visitor_id=$this->input->cookie('diros_traffic_track');
	//	$this->db->insert('track_social_media',['user_id'=>2]);
		$this->db->insert('track_social_media',['battle_id'=>$postData['battle_id'],'visitor_id'=>$visitor_id,'social_media'=>$postData['socialMedia_type'],'username'=>$postData['username'],'date'=>date('Y-m-d H:i:s')]);
	}

	public function check_my_vote(){
		
		$input=$this->security->xss_clean($this->input->post());
		
		$fb_id=$_COOKIE['diros_fb_id'];
		$data=$this->db->select('voted_user')->where(['voter_fb_id'=>$fb_id,'war_id'=>$input['battle_id']])->get('voting')->row();
		echo json_encode($data);
		//echo json_encode($fb_id);
	}
}



?>