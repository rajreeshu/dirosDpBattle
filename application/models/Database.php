<?php

class Database extends CI_Model{

	private function user1_img_upload($battle_id){
		$upload_config=array(
								'upload_path'=>'utility/battle-images',
								'allowed_types'=>'jpg|png|jpeg',
								'max_size'=>5000,
								'file_name'=>$battle_id.'-1'
							);
		$this->upload->initialize($upload_config);
		$this->upload->do_upload('user1');
	}
		private function user2_img_upload($battle_id){
		$upload_config=array(
								'upload_path'=>'utility/battle-images',
								'allowed_types'=>'jpg|png|jpeg',
								'max_size'=>5000,
								'file_name'=>$battle_id.'-2'
							);
		$this->upload->initialize($upload_config);
		$this->upload->do_upload('user2');
	}




	public function war_detail($battle_id){

	$war_data=	$this->db->where('war_id',$battle_id)->get('war_field');

		return $war_data;
	}



	public function rand_id_selection(){
		date_default_timezone_set('Asia/Calcutta');


		$this->db->select('id');
	//	$this->db->where('end_time<',date('Y-m-d H:i:s'));
		//$this->db->where_in('id',[19,20,31]);
		$this->db->where(['end_time > '=> date('Y-m-d H:i:s')]);
		$this->db->order_by('rand()');
	    $this->db->limit(1);
	    $query = $this->db->get('battle_detail');
	    return $query->row();
	}
		public function rand_id_selection_except_current($id){
		date_default_timezone_set('Asia/Calcutta');


		$this->db->select('id');
	//	$this->db->where('end_time<',date('Y-m-d H:i:s'));
		//$this->db->where_in('id',[19,20,31]);
		$this->db->where(['end_time > '=> date('Y-m-d H:i:s')]);
		$this->db->where_not_in('id', $id);
		$this->db->order_by('rand()');
	    $this->db->limit(1);
	    $query = $this->db->get('battle_detail');
	    return $query->row();
	}

		public function rand_id_selection_over(){
		date_default_timezone_set('Asia/Calcutta');


		$this->db->select('id');
	//	$this->db->where('end_time<',date('Y-m-d H:i:s'));
		//$this->db->where_in('id',[19,20,31]);
		$this->db->where(['end_time < '=> date('Y-m-d H:i:s')]);
		$this->db->order_by('rand()');
	    $this->db->limit(1);
	    $query = $this->db->get('battle_detail');
	    return $query->row();
	}
		public function rand_id_selection_except_current_over($id){
		date_default_timezone_set('Asia/Calcutta');


		$this->db->select('id');
	//	$this->db->where('end_time<',date('Y-m-d H:i:s'));
		//$this->db->where_in('id',[19,20,31]);
		$this->db->where(['end_time < '=> date('Y-m-d H:i:s')]);
		//$this->db->where_not_in('id', $id);
		$this->db->order_by('rand()');
	    $this->db->limit(1);
	    $query = $this->db->get('battle_detail');
	    return $query->row();
	}

	public function next_battle_serial(){
		date_default_timezone_set('Asia/Calcutta');


		$this->db->select('id');
		$this->db->where(['end_time > '=> date('Y-m-d H:i:s')]);
		//$this->db->where_not_in('id', $id);
		//$this->db->order_by('rand()');
	    //$this->db->limit(1);
	    $query = $this->db->get('battle_detail');
	    return $query->result();
	}



	public function fighter_detail($fighter){

	return	$this->db->where_in('username',$fighter)->get('fighter');

	}

	public function add_vote($data){

	//	$data=$this->input->get();


$this->db->where('war_id',$data['war_id']);

$this->db->where('voter_fb_id',$data['voter']);

$x=$this->db->get('voting');

	if($x->row()==''){

		if($this->db->insert('voting',['voter_fb_id'=>$data['voter'],'war_id'=>$data['war_id'],'voted_user'=>$data['username']])){
			return 1;	
		}

		 

	}
	
	}

	public function vote_count($war_id){

	$votes=	$this->db->where('war_id',$war_id)->get('voting');

	return $votes;

	}

	public function admin_data($data){

		$this->db->where('username',$data['admin_email']);

		$this->db->where('password',$data['admin_pass']);

		return $this->db->get('admin')->row();



	}

	public function admin_data_id($admin_id){
		return	$this->db->where('id',$admin_id)->get('admin')->row();	
	}

	public function get_admin_user($admin_username){
	return	$this->db->where('admin_id',$admin_username)->order_by('id',"desc")->get('fighter')->result();
	}

	public function insert_battle($data,$user){

		$this->db->insert('battle_detail',['admin'=>$data->username]);
		$battle_id=$this->db->insert_id();


		$this->db->insert('war_field',['username'=>$user['user1'],'war_id'=>$battle_id]);
		$this->db->insert('war_field',['username'=>$user['user2'],'war_id'=>$battle_id]);
		return $battle_id;
	}


	public function battle_data_save($battle_id,$battle_data,$data_get_all){

		$insert_array=array(
								'heading'=>$battle_data['description'],
								//'start_time'=>date('Y-m-d H:i:s'),
								'run_time'=>$battle_data['run_time']
							);
		$f_data=array_filter($insert_array,'strlen');



		
		

		$this->db->where('id',$battle_id);
		if(!empty($battle_data['run_time'])){
			$this->db->update('battle_detail',$f_data);
			$this->user1_img_upload($battle_id);
			$image_url1= $this->upload->data('full_path');
			$image_name1= $this->upload->data('file_name');

				$this->db->where('war_id',$battle_id);
				$this->db->where('username',$data_get_all['user1']);

				$this->db->update('war_field',['image'=>$image_url1,'img_name'=>$image_name1]);

			$this->user2_img_upload($battle_id);
			$image_url2= $this->upload->data('full_path');
			$image_name2= $this->upload->data('file_name');
		
				$this->db->where('war_id',$battle_id);
				$this->db->where('username',$data_get_all['user2']);

			return	$this->db->update('war_field',['image'=>$image_url2,'img_name'=>$image_name2]);
			
	}else{echo "Enter Battle Run Time";}


	}


	public function battle_start_date($battle_id){
		date_default_timezone_set('Asia/Calcutta');

		$current_time=date('Y-m-d H:i:s');
		$battle_time_data=$this->db->select('run_time')->where('id',$battle_id)->get('battle_detail')->row();

		$date=strtotime(date('Y-m-d H:i:s'))+60;
	

		$this->db->where('id',$battle_id);
		return $this->db->update('battle_detail',['start_time'=>$current_time,'end_time'=>date('Y-m-d H:i:s',strtotime($current_time)+($battle_time_data->run_time*3600))]);
	}


	public function battle_time_left($battle_id){

		date_default_timezone_set('Asia/Calcutta');
		$c_date=date('Y-m-d H:i:s');
		
		$battle_time_data=$this->db->select('start_time,run_time')->where('id',$battle_id)->get('battle_detail')->row();
		
		//$battle_time_start=$
		//print_r($battle_time);
		
		$diff=abs(strtotime($battle_time_data->start_time)-strtotime($c_date));

		$time_left=($battle_time_data->run_time)*60*60-$diff;

		if($time_left<=0){
			$time_left=0;
		}

		$d_hrs=$time_left/3600;
		$d_e_diff=floor($d_hrs);

		$d_min=($d_hrs-$d_e_diff)*60;
		$d_e_min=floor($d_min);
		
		$d_sec=($d_min-$d_e_min)*60;
		$d_e_sec=floor($d_sec);

		if($battle_time_data){
			return array('hrs'=>$d_e_diff,'min'=>$d_e_min,'sec'=>$d_e_sec);
		}

	}


	public function vote_compare($battle_id){

/*SELECT voted_user,count(*) FROM `voting` GROUP BY voted_user*/
	
	$this->db->select('voted_user');
	$this->db->select('COUNT(*) as count');
	$this->db->where('war_id',$battle_id);
	$this->db->group_by('voted_user');
	return $this->db->get('voting')->result();

	}


	public function set_fighter($admin_username,$fighter_data){
		 $last_row=$this->db->select('id')->order_by('id',"desc")->limit(1)->get('fighter')->row()->id;

				$upload_config=array(
								'upload_path'=>'utility/battle-images/dm',
								'allowed_types'=>'jpg|png|jpeg',
								'max_size'=>0,
								'file_name'=>$last_row+1
							);
		$this->upload->initialize($upload_config);



		if($this->upload->do_upload('user_image')){
			$image_name= $this->upload->data('file_name');
	
		$data_up=array(
			'username'=>$fighter_data['username'],
			'name'=>$fighter_data['name'],
			'fb_id'=>$fighter_data['fb_link'],
			'insta_id'=>$fighter_data['insta_link'],
			'tiktok_id'=>$fighter_data['tiktok_link'],
			'admin_id'=>$admin_username,
			'img'=>$image_name

		);
		$data_up_f=array_filter($data_up,'strlen');

			return $this->db->insert('fighter',$data_up_f);
		}

	}

public function get_admin_username($battle_id){
	return $this->db->where('id',$battle_id)->get('battle_detail')->row();
}

public function admin_detail($admin_username){
	return $this->db->where('username',$admin_username)->get('admin')->row();
}

public function get_battle_username($admin){
	return $this->db->where('admin',$admin)->order_by('id',"desc")->get('battle_detail')->result();
}

public function delete_battle_model($battle_id){
	$this->db->where('id',$battle_id);
	$this->db->delete('battle_detail');

	$this->db->where('war_id',$battle_id);
	$this->db->delete('war_field');

	$this->db->where('war_id',$battle_id);
	$this->db->delete('voting');
}

public function track_vote($battle_id){

	$track_vote_id=$this->input->cookie('diros_vote_track');
	$get_id_arr=$this->db->select('random_id')->where('sn',$track_vote_id)->get('track_vote')->row();

	

		if(empty($get_id_arr)){
			$this->db->insert('track_vote',['random_id'=>rand(),'battle_id'=>$battle_id,'date'=>date('Y-m-d H:i:s')]);
			return $this->db->insert_id();
		}


	
}

public function track_vote_cnfrm($track_vote_id){
	$this->db->where('sn',$track_vote_id)->delete('track_vote');
}

public function visited_battle($battle_id){

	$user_track=$this->db->select('sn')->order_by('sn','desc')->get('visitor_traffic')->row();
//	echo $user_track->sn;

	if(empty($this->input->cookie('diros_traffic_track'))){
		
		$this->db->insert('visitor_traffic',['sn'=>$user_track->sn+1,'battle_id'=>$battle_id,'date'=>date('Y-m-d H:i:s')]);

		$this->input->set_cookie(['name'=>'diros_traffic_track','value'=>$user_track->sn+1,'expire'=>2592000]);
		
	}else{
		$sn_user=$this->input->cookie('diros_traffic_track');
	
	if(empty($this->db->where(['sn'=>$sn_user,'battle_id'=>$battle_id])->get('visitor_traffic')->result())){
		$this->db->insert('visitor_traffic',['sn'=>$sn_user,'battle_id'=>$battle_id,'date'=>date('Y-m-d H:i:s')]);
	}
	}

	
}

public function visited_battle_show($battle_id){
	return $this->db->select('id')->where('battle_id',$battle_id)->get('visitor_traffic');
}

public function track_social_media($battle_id,$username){
	return $this->db->where(['battle_id'=>$battle_id,'username'=>$username])->get('track_social_media')->num_rows();
}

public function track_social_media_specific($battle_id,$username,$media_type){
	return $this->db->where(['battle_id'=>$battle_id,'username'=>$username,'social_media'=>$media_type])->get('track_social_media')->num_rows();
}





}







?>