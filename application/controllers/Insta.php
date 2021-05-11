<?php
class Insta extends CI_Controller{

	public function __construct() {
    	parent::__construct();
    	$this->load->helper("security");       
    	ini_set('upload_max_filesize', '115M');
	}

	public function main(){
		$this->load->view('insta/insta_home');
	}

	public function submit_data(){
		$data=$this->security->xss_clean($this->input->post());

		$this->db->insert('insta_table',['username'=>$data['username'],'battle_type'=>$data['battle_type']]);

		echo json_encode("reached");
	}

	public function get_data(){
		$data=$this->db->select('username,battle_type,result')->get('insta_table')->result();

		echo json_encode($data);
	}




// insert daily battlers username

	public function username(){
		$this->load->view('insta/daily_username');
	}

	public function insert_username(){
		$data=$this->security->xss_clean($this->input->post());

		$this->db->insert('insta_daily_username',['username'=>$data['username'],'battle_type'=>$data['battle_type'],'date_time'=>date('Y-m-d H-i-s')]);

		echo json_encode(1);
	}


	public function ajax_data_dropdown(){

		$input=$this->security->xss_clean($this->input->post());

		$data['data']=$this->db->like('a.username',$input['input'])->like('a.battle_type',$input['battle_type_filter'])->select('a.sn,a.username,a.date_time,a.battle_type,a.img_id,b.file_name,b.comment')->from('insta_daily_username as a')->join('insta_data_insert as b','a.img_id=b.sn','left')->order_by('a.sn','DESC')->limit(50)->get()->result();

		$data['website']=$this->db->select('username,id')->get('fighter')->result();
		echo json_encode($data);
	}





	public function daily_user_img_download(){

		$input=$this->security->xss_clean($this->input->post());

		$data=$this->db->select('file_name')->where('sn',$input['img_id'])->get('insta_data_insert')->row();

		echo json_encode($data);
	}


	public function ajax_data_delete(){
		$input=$this->security->xss_clean($this->input->post());

		$img_id=$this->db->select('img_id')->where('sn',$input['sn'])->get('insta_daily_username')->row();

		$this->db->where('sn',$img_id->img_id)->update('insta_data_insert',['status'=>'','battle_date_time'=>'']);

		$data=$this->db->where('sn',$input['sn'])->delete('insta_daily_username');
		echo json_encode($data);
	}

	public function check_last_battle_date(){
		
		$input=$this->security->xss_clean($this->input->post());

		$data=$this->db->select('MAX(date_time) as date_time')->where('username',$input['username'])->get('insta_daily_username')->row();

		
		echo json_encode($data);
	}



	//stats

	public function stats(){
		$this->load->view('insta/statistics');
	}

	public function distinct_username(){
		
		$input=$this->security->xss_clean($this->input->post());

		if(!empty($input['battle_type'])){
			$data=$this->db->like('username',$input['username'])->select('username,date_time,count(username) AS total')->having('count(username) '.$input['battle_upto'])->distinct()->group_by('username')->where('battle_type',$input['battle_type'])->limit(100)->order_by('total','DESC')->get("insta_daily_username")->result();
		}else{
			$data=$this->db->like('username',$input['username'])->select('username,date_time,count(username) AS total')->having('count(username) '.$input['battle_upto'])->distinct()->group_by('username')->limit(100)->order_by('total','DESC')->get("insta_daily_username")->result();
		}
		echo json_encode($data);
		//echo json_encode($this->db->last_query() );
		//echo json_encode($input);
	}

	public function chk_status(){
		$input=$this->security->xss_clean($this->input->post());

		$data['web']=$this->db->where(['username'=>$input['username'],'status!='=>'used'])->get('insta_data_insert')->result();
		$data['votes']=$this->db->where('voted_user',$input['username'])->get('voting')->num_rows();
		$data['battle']=$this->db->where('username',$input['username'])->get('war_field')->num_rows();

		$user_avail=$this->db->where('username',$input['username'])->get('fighter')->num_rows();
		if($user_avail!=0){
			$data['user_avail']='Yes';
		}else{
			$data['user_avail']='No';
		}
		
		echo json_encode($data);
	}

/*	public function status_from_admin(){
		$input=$this->security->xss_clean($this->input->post());

		
		
		//$data['battles']
		echo json_encode($data);
	}*/

	//insert battle data

	public function insert(){
		$this->load->view('insta/insert_battle_data');
	}


	public function ajax_data_bubble(){

		$input=$this->security->xss_clean($this->input->post());

		$data=$this->db->like('username',$input['input'])->select('sn,username,date_time,battle_type')->distinct()->group_by('username')->order_by('sn','DESC')->limit(40)->get('insta_daily_username')->result();
		//$data['date_format']=date('d-m-Y H:i',strtotime($data['date_time']));

		echo json_encode($data);
	}

	public function insert_username_unique(){

		$input=$this->security->xss_clean($this->input->post());

		//$data=;
		if($this->db->insert('insta_unique_identify',['username'=>$input['username']])){
			echo json_encode('New User');
		}else{
			echo json_encode("Old user");
		}
		
	}

	public function direct_insert_file(){
		$input=$this->security->xss_clean($this->input->post());

		$result_file['input']=$input;

		
		
		 $this->load->library('upload');

		if(is_dir('utility/insta_img/'.$input['battle_type'].'/'.trim($input['insta_username_bubble']))==false){
			mkdir('utility/insta_img/'.$input['battle_type'].'/'.trim($input['insta_username_bubble']));
		}

		$this->insta_data_file_name($input);
		if($this->upload->do_upload("file_upload1")){
		$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
		$this->db->insert('insta_data_insert',['username'=>trim($input['insta_username_bubble']),'battle_type'=>$input['battle_type'],'raw_name'=>$upload_data['raw_name'],'file_name'=>$upload_data['file_name'],'comment'=>$input['comment1'],'date_time'=>date('Y-m-d H-i-s')]);
				$message=$this->upload->display_errors();
		//echo json_encode($message);
		//echo json_encode("success1");
		
		$result_file['file_one']="success";

		}else{
			$message=$this->upload->display_errors();
			//echo json_encode($message);
			//echo json_encode("failed1");

			$result_file['file_one']="failed";
		}


		$this->insta_data_file_name($input);
		if($this->upload->do_upload("file_upload2")){
		$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
		$this->db->insert('insta_data_insert',['username'=>trim($input['insta_username_bubble']),'battle_type'=>$input['battle_type'],'raw_name'=>$upload_data['raw_name'],'file_name'=>$upload_data['file_name'],'comment'=>$input['comment2'],'date_time'=>date('Y-m-d H-i-s')]);
				//$message=$this->upload->display_errors();
		//echo json_encode($message);
		
		$result_file['file_two']="success";

		}else{
			$message=$this->upload->display_errors();
			$result_file['file_two']="failed";
			//echo json_encode($message);
			//echo json_encode("failed1");
		}



		$this->insta_data_file_name($input);
		if($this->upload->do_upload("file_upload3")){
		$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
		$this->db->insert('insta_data_insert',['username'=>trim($input['insta_username_bubble']),'battle_type'=>$input['battle_type'],'raw_name'=>$upload_data['raw_name'],'file_name'=>$upload_data['file_name'],'comment'=>$input['comment3'],'date_time'=>date('Y-m-d H-i-s')]);
				//$message=$this->upload->display_errors();
		
		$result_file['file_three']="success";

		//echo json_encode($message);
		//echo json_encode("success3");
		}else{
			$message=$this->upload->display_errors();
				
			$result_file['file_three']="failed";

			//echo json_encode($message);
			//echo json_encode("failed1");
		}

		
		//echo json_encode($input);

		/*$message=$this->upload->display_errors();
		echo json_encode($message);*/

		echo json_encode($result_file);
		//echo json_encode($input);
	}

	private function insta_data_file_name($input){
		$file_name=$this->db->select('file_name,raw_name')->where(['username'=>trim($input['insta_username_bubble']),'battle_type'=>$input['battle_type']])->order_by('sn','DESC')->get('insta_data_insert')->row();
		if(!isset($file_name)){
			$file_name = new stdClass();
			$file_name->file_name=0;
			$file_name->raw_name=0;
		}


		$upload_config=array(
								'upload_path'=>'utility/insta_img/'.$input['battle_type'].'/'.trim($input['insta_username_bubble']),
								'allowed_types'=>'jpg|png|jpeg|mp4',
								'max_size'=>200000,
								'file_name'=>$file_name->raw_name+1
								
							);
		$this->upload->initialize($upload_config);
	}



	//daily battle data AI

	public function daily_data(){
		$this->load->view("insta/daily_data_show");
	}





	
	public function show_data_daily_data(){
		
		$input=$this->security->xss_clean($this->input->post());

		
			setcookie('diros_daily_data_battle_type',$input['battle_type'],time() + (86400 * 100), "/");


	
		$data['reserve']=$this->db->select('username,star')->where('reserve!=',0)->get('insta_unique_identify')->result();

		$data['data']=$this->db->select('b.sn,b.username,b.file_name,b.comment,b.reserve,MAX(a.date_time) as date,MAX(b.date_time) as upload_date, c.star')->from('insta_data_insert as b')->where(['b.battle_type'=>$input['battle_type'],'b.status!='=>'used'])->distinct()->group_by('b.username')->join('insta_daily_username as a', 'b.username=a.username','left')->join('insta_unique_identify as c', 'c.username=b.username','left')->order_by('b.sn','DESC')->get()->result();
		echo json_encode($data);
		


	}

	public function show_data_daily_data_reserve(){

		$input=$this->security->xss_clean($this->input->post());

		$data['reserve']=$this->db->select('username')->where('reserve',$input['reserve'])->get('insta_unique_identify')->result();
		
		$data['all_reserve']=$this->db->select('username')->where('reserve!=',0)->get('insta_unique_identify')->result();

		$data['data']=$this->db->select('b.sn,b.username,b.file_name,b.comment,b.reserve,MAX(a.date_time) as date,MAX(b.date_time) as upload_date, c.star')->from('insta_data_insert as b')->where(['b.battle_type'=>$input['battle_type'],'b.status!='=>'used'])->distinct()->group_by('b.username')->join('insta_daily_username as a', 'b.username=a.username','left')->join('insta_unique_identify as c', 'c.username=b.username','left')->order_by('b.sn','DESC')->get()->result();
		echo json_encode($data);

	}

	public function star_val(){

		$input=$this->security->xss_clean($this->input->post());

		$data=$this->db->where('username',$input['username'])->update('insta_unique_identify',['star'=>$input['star']]);

		echo json_encode($data);
	}



public function save_special_member(){
	$input=$this->security->xss_clean($this->input->post());

	$data=$this->db->insert('insta_special_member',['username'=>$input['username'],'battle_type'=>$input['battle_type'],'message'=>$input['message']]);

	echo json_encode($data);
}

public function show_special_member(){
	$input=$this->security->xss_clean($this->input->post());

	$data=$this->db->select('id,username,message')->where('battle_type',$input['battle_type'])->get('insta_special_member')->result();	

	echo json_encode($data);
}


	public function approve_battle_data(){
		$input=$this->security->xss_clean($this->input->post());

		$data=$this->db->where('sn',$input['sn'])->update('insta_data_insert',['battle_date_time'=>date('Y-m-d H-i-s'),'status'=>'used']);

		
			$this->db->insert('insta_daily_username',['username'=>$input['username'],'battle_type'=>$input['battle_type'],'date_time'=>date('Y-m-d H-i-s'),'img_id'=>$input['sn']]);
		

		echo json_encode($data);
	}


	public function add_comment(){
		
		$input=$this->security->xss_clean($this->input->post());

		$data=$this->db->where('sn',$input['sn'])->update('insta_data_insert',['comment'=>$input['comment']]);

		echo json_encode($data);
	}


	public function reserve_data(){
		$input=$this->security->xss_clean($this->input->post());

		$data=$this->db->where('username',$input['username'])->update('insta_unique_identify',['reserve'=>$input['value']]);

		echo json_encode($data);
	}



	//user all image display

	public function show_images(){
		$this->load->view('insta/show_user_image');
	}

	public function user_data_all(){

		$input=$this->security->xss_clean($this->input->post());

		$data=$this->db->select('b.file_name,b.status,b.sn,a.date_time as battle_date_time')->where(['b.username'=>$input['username'],'b.battle_type'=>$input['battle_type']])->from('insta_data_insert as b')->join('insta_daily_username as a','b.sn=a.img_id','left')->get()->result();

		echo json_encode($data);
	}

	public function del_user_data(){
		$input=$this->security->xss_clean($this->input->post());

		$data=$this->db->where('sn',$input['sn'])->delete('insta_data_insert');

		echo json_encode($data);
	}


//winners section
	public function winner(){
		$this->load->view('insta/winners');	
	}

	public function winner_data_show(){
		$input=$this->security->xss_clean($this->input->post());
		$data=$this->db->select("a.sn,a.username,a.date_time,a.winner,a.battle_type,b.file_name")->like('a.date_time',date('Y-m-d',strtotime("yesterday")))->where('a.battle_type',$input['battle_type'])->from('insta_data_insert as b')->join('insta_daily_username as a','b.sn=a.img_id')->get()->result();
		echo json_encode($data);
	}

	public function winner_approve(){
		$input=$this->security->xss_clean($this->input->post());
		$data=$this->db->where('sn',$input['sn'])->update('insta_daily_username',['winner'=>$input['action']]);
		echo json_encode($data);
	}

	public function winners_tags(){
		$input=$this->security->xss_clean($this->input->post());
		$data=$this->db->select('username')->like('date_time',date('Y-m-d',strtotime("yesterday")))->where(['battle_type'=>$input['battle_type'],'winner'=>'true'])->get('insta_daily_username')->result();
		echo json_encode($data);
	}

	public function ajax_data_dropdown_winner(){

		$input=$this->security->xss_clean($this->input->post());

		$data=$this->db->where('a.username',$input['input'])->like('a.battle_type',$input['battle_type_filter'])->select('a.sn,a.username,a.date_time,a.battle_type,a.img_id,b.file_name')->from('insta_daily_username as a')->join('insta_data_insert as b','a.img_id=b.sn','left')->order_by('a.sn','DESC')->limit(50)->get()->row();


		echo json_encode($data);
	}



/*
	public function website_user_account(){
		$input=$this->security->xss_clean($this->input->post());

		$data=$this->db->select('username,sn')->get('fighter')->result();

		echo json_encode($data);
	}*/

public function hashtag(){
	$array= array('#videobattle','#dpbattle', '#dp', '#battle', '#follow', '#vote', '#winner' ,'#india' ,'#likes', '#battlefield',' #like',' #likeforlikes',' #followback',' #trending',' #boys',' #girls',' #battleroyale',' #fitness',' #post',' #photography',' #instagood',' #king',' #faver',' #sport',' #food',' #gym',' #body',' #photoshoot',' #model',' #officialdpbattle',' #love',' #dpbattles',' #nature',' #recentforrecent',' #queen',' #modeling',' #question',' #naturalphotographs',' #fitt',' #received',' #fight',' #gymlover',' #natural',' #instagram',' #instadaily',' #brother',' #likeforlike',' #photooftheday',' #of',' #dpbattleground',' #battleground',' #dpbattlewinner',' #followforfollow',' #followme',' #fashionblogger',' #style',' #indian','#style',' #love','#like',' #photography',' #photooftheday',' #picoftheday',' #model',' #bhfyp',' #me',' #smile',' #likeforlikes',' #ootd',' #moda','  #myself','  #happy',' #instalike',' #photo','#makeup ','#likes',' #followforfollowback',' #l',' #instafashion',' #fashionstyle',' #f',' #likeforfollow',' #likeforlike',' #selfie',' #nature',' #life',' #lifestyle',' #portrait',' #photoshoot',' #summer',' #shopping',' #followers',' #followforfollow',' #outfit',' #look',' #dress',' #design',' #photographer',' #handmade',' #travel',' #onlineshopping',' #fun',' #OOTD',' #Style',' #Vintage',' #Fashionista',' #StreetStyle',' #Stylish',' #MensFashion',' #WomensFashion',' #InstaStyle',' #LookBook',' #WhatIWore',' #FashionDiaries',' #StyleInspo','  #LookBook',' #WIWT',' #FashionWeek',' #Fashion',' #StyleBlog',' #Blog',' #StyleBlogger',' #StreetFashion',' #OutfitOfTheDay',' #OOTD',' #OOTDfashion',' #DailyLook',' #InstaOOTD',' #WIW',' #WIWT',' #LookBook',' #OutfitPost',' #OutfitGoals',' #TodayImWearing',' #MeToday',' #OutfitOfTheDay',' #TodaysOutfit',' #OOTDShare',' #MyLook',' #CurrentlyWearing',' #MyLookToday',' #InMyCloset',' #LookOfTheDay',' #OutfitIdeas4You',' #OutfitLook',' #Inspofashion',' #InspiringOutfit',' #OOTDinspo',' #OutfitGrid',' #MensFashion',' #MensStyle',' #MenWithStyle',' #Menswear',' #StreetStyleGuys',' #GuyFashion',' #StyleForGuys',' #MaleStreetwear',' #MensFashionTeam',' #MensFashionairy',' #MenAboutFashion',' #OOTDMenStyle',' #MensFashionApparel',' #MensFashionTrends',' #MensStylePage',' #MenOOTD',' #ClassyDapper',' #BestOfMenStyle',' #DapperMan',' #MensFashionFix',' #StreetStyle',' #StreetwearFashion',' #StreetFashion',' #StreetLook',' #UrbanStyle',' #PauseShots',' #BestOfStreetwear',' #StreetwearAddicted',' #AllStreetwear','#StreetwearSource',' #UrbanOutfit',' #StreetwearStyle',' #UrbanWear',' #StreetwearCulture',' #DailyStreetLooks',' #StyleBlogger',' #StreetwearCentral',' #FashionWeek',' #FashionWeekStyle',' #ParisFashionWeek',' #PFW',' #NewYorkFashionWeek',' #NFW',' #NYCFashion',' #MilamFashionWeek',' #MFW',' #ModaMilano',' #MilanFashion',' #LondonFashionWeek',' #LFW',' #FashionArchives',' #AnnaParisChic',' #Vogue',' #Runway',' #FashionMag',' #RunwayModel',' #RunwayStyle',' #RunwayFashion',' #EmergingDesigners',' #FashionDesigners ','#shoutout',' #like','#s ','#love',' #photooftheday',' #l',' #shoutouts','#so',' #shout',' #likes',' #c',' #shoutoutforshoutout',' #out',' #photography',' #followforfollow','  #picoftheday',' #model',' #likeforlikes',' #shoutoutback',' #shoutouter',' #bhfyp','  #pleasefollow',' #photo',' #followhim',' #followall',' #commentback',' #me','  #pleaseshoutout',' #followers',' #likeback',' #insta','#followher',' #igers',' #teamfslcback','#soback',' #fslcback',' #sobackteam',' #pleaselike',' #ilovemyfollowers',' #fslc',' #likeforlike',' #follows',' #tflers',' #pleasecomment',' #fslcalways','  #shoutout',' #shoutouts',' #shoutoutforshoutout',' #followshoutoutlikecomment',' #shoutoutback',' #shoutout4shoutout',' #pleaseshoutout',' #shoutouter',' #artist_4_shoutout',' #boxer_dog_shoutout',' #gymnasticsshoutouts',' #kpopshoutout',' #hmshostshoutout',' #aussieshepherd_shoutout',' #runnershoutouts',' #likeforshoutout',' #gayshoutout',' #shoutoutpage',' #shoutoutsaturday',' #freeshoutouts',' #amrezyshoutouts',' #youtubeshoutout',' #shoutoutshere',' #frenchie_shoutout',' #s4shoutout',' #shoutouts4free',' #retriever_shoutout',' #beagle_shoutout',' #shoutouts_4_cats',' #shoutoutme','  #shoutout','#photooftheday','  #photo','#igers',' #picoftheday',' #instalove',' #igaddict',' #instagrammers','#bestoftheday',' #insta',' #like',' #love',' #instafamous',' #contests',' #filters',' #shoutoutforshoutout',' #photography',' #f4f',' #tag',' #followforfollow',' #iphoneography',' #hipster',' #shoutout',' #shoutouts',' #shout',' #out',' #shoutouter','#s4s',' #shoutoutforshoutout',' #shoutout4shoutout',' #so',' #so4so',' #photooftheday',' #ilovemyfollowers',' #love',' #sobackteam',' #soback','#f4f',' #followforfollow',' #followhim',' #followher','#shout_out',' #shoutout',' #like','#s',' #love',' #photooftheday',' #l',' #shoutouts',' #so',' #shout',' #likes',' #c',' #shoutoutforshoutout',' #out',' #photography',' #followforfollow','#picoftheday',' #model',' #likeforlikes',' #shoutoutback',' #shoutouter','   #comments',' #pleasefollow',' #photo',' #followhim',' #me','  #pleaseshoutout ','#followers',' #likeback',' #insta',' #followher',' #igers',' #teamfslcback','#soback',' #fslcback',' #sobackteam',' #pleaselike',' #ilovemyfollowers',' #fslc',' #likeforlike',' #follows',' #tflers',' #pleasecomment',' #fslcalways ','#photo',' #photos',' #pic',' #pics','  #picture',' #pictures',' #snapshot',' #picoftheday',' #photooftheday',' #color',' #all_shots',' #exposure',' #composition',' #focus',' #capture',' #moment',' #hdr',' #hdrspotters',' #hdrstyles_gf',' #hdri',' #hdroftheday',' #hdriphonegraphy',' #hdr_lovers',' #awesome_hdr',' #photo',' #photography',' #photooftheday','#love',' #like #picoftheday',' #photographer',' #nature',' #me',' #myself',' #style',' #model',' #photoshoot','#smile',' #likeforlikes',' #travel',' #portrait',' #life',' #selfie',' #naturephotography',' #canon',' #foto',' #makeup',' #l',' #fotografia',' #pic',' #ig',' #likes',' #picture #travelphotography',' #photos',' #insta',' #instaphoto',' #music',' #summer',' #portraitphotography',' #landscape #friends',' #artist',' #sunset',' #lifestyle',' #photographylovers',' #modeling',' #sky',' #minimalism',' #minimalist',' #minimal',' #minimalistic',' #minimalistics',' #minimalove',' #minimalobsession',' #photooftheday',' #minimalninja',' #instaminim',' #minimalisbd',' #simple',' #simplicity',' #keepitsimple',' #minimalplanet',' #love',' #minimalhunter',' #minimalista',' #minimalismo','  #lessismore',' #simpleandpure',' #negativespace',' #minimalism',' #minimal',' #minimalist',' #architecture',' #design',' #interiordesign',' #bnw',' #photography',' #interior',' #contemporaryart',' #ig',' #photooftheday',' #nature',' #simplicity',' #abstractart',' #blackandwhite','  #love',' #minimalistic',' #abstract',' #homedecor',' #minimalmood',' #artist','  #minimalismo',' #illustration',' #graphicdesign',' #streetphotography',' #hdr',' #hdriphoneographer',' #hdrspotters',' #hdrstyles_gf',' #hdri',' #hdroftheday',' #hdriphonegraphy',' #hdrepublic',' #hdr_lovers',' #awesome_hdr',' #hdrphotography',' #photooftheday',' #hdrimage',' #hdr_gallery',' #hdr_love',' #hdrfreak',' #hdrama',' #hdrart',' #hdrphoto',' #hdrfusion',' #hdrmania',' #hdrstyles',' #ihdr',' #str8hdr',' #hdr_edits',' #hdr',' #photography',' #photooftheday','#hdrphotography',' #picoftheday ','#nature',' #ig',' #hdrspotters',' #hdrstyles #photo',' #capture',' #love',' #hdroftheday','#landscape',' #composition',' #exposure',' #lovers',' #moment',' #hdri',' #awesome',' #snapshot',' #gf',' #instaphoto',' #hdriphonegraphy',' #travel',' #sunset','  #hdrphoto',' #pics',' #igers','#photoshop',' #color ','#camera',' #d',' #photogram',' #k',' #photos',' #naturephotography',' #pic',' #focus',' #justgoshoot',' #shots',' #picture',' #like',' #photographer',' #sky',' #pictures',' #travelphotography',' #hdrimage',' #all',' #instafocus',' #gallery',' #likeforlikes',' #hdriphoneographer',' #photoshoot',' #style',' #stylish',' #love','  #me','  #photooftheday',' #nails',' #hair','#pretty',' #girl',' #eyes',' #model',' #dress',' #skirt',' #shoes',' #heels',' #styles',' #outfit',' #purse',' #jewelry',' #shopping',' #style',' #love',' #like',' #photography',' #photooftheday',' #picoftheday',' #model',' #me','#smile',' #likeforlikes',' #ootd','#moda',' #fashionblogger',' #myself',' #photo','#makeup',' #likes',' #l',' #fashionstyle #f',' #likeforfollow',' #likeforlike',' #selfie',' #nature',' #life',' #lifestyle',' #portrait',' #photoshoot',' #summer',' #shopping',' #followers',' #followforfollow',' #outfit',' #look','  #dress',' #design',' #photographer',' #handmade',' #travel',' #onlineshopping',' #makeup',' #instamakeup',' #cosmetic',' #cosmetics',' #eyeshadow',' #lipstick',' #gloss',' #mascara',' #palettes',' #eyeliner',' #lip',' #lips',' #concealer',' #foundation',' #powder',' #eyes',' #eyebrows',' #lashes',' #lash',' #glue',' #glitter',' #crease',' #primers',' #base','   #makeup','  #makeupartist',' #mua',' #love',' #makeuptutorial',' #like',' #photography',' #model',' #style','  #photooftheday','  #makeuplover',' #skincare',' #selfie',' #myself',' #photo',' #me',' #smile',' #picoftheday',' #makeupaddict',' #maquiagem',' #likeforlikes','#makeuplooks',' #makeupideas',' #cosmetics',' #lashes',' #wedding',' #eyeshadow','#lipstick',' #photoshoot',' #makeupoftheday','#l',' #maquillaje',' #life',' #hudabeauty',' #portrait',' #make',' #instamakeup',' #makeuplook',' #photographer',' #anastasiabeverlyhills ',' #hairstyle',' #likes',' #modeling','#swag',' #style',' #stylish',' #me',' #swagger',' #photooftheday',' #jacket','#pants',' #shirt',' #handsome',' #cool',' #polo',' #swagg',' #guy',' #boy',' #boys',' #man',' #model',' #tshirt',' #shoes',' #sneakers',' #styles',' #jeans',' #fresh',' #dope',' #style',' #love',' #like',' #photography',' #photooftheday',' #follow','  #picoftheday',' #model',' #me','#smile',' #likeforlikes',' #ootd','#moda',' #fashionblogger',' #myself',' #photo','#makeup',' #likes','#l',' #fashionstyle',' #f',' #likeforfollow',' #likeforlike',' #selfie #nature',' #life',' #lifestyle',' #portrait',' #photoshoot',' #summer',' #shopping',' #followers',' #followforfollow',' #outfit',' #look',' #dress',' #design ','#photographer',' #handmade',' #travel',' #onlineshopping','#like4like ','#liker',' #likes',' #l4l',' #likes4likes',' #photooftheday',' #love',' #likeforlike',' #likesforlikes',' #liketeam',' #likeback',' #likebackteam','#likeall',' #likealways','#liking','#like',' #love',' #photooftheday',' #picoftheday','  #likes',' #me',' #f','  #likeforlikes',' #l',' #smile','#photography',' #myself',' #followforfollow',' #likeforlike',' #followers',' #likeforfollow',' #style','#selfie','#life','  #photo',' #likesforlikes',' #igers',' #nature','  #model',' #friends',' #tbt',' #amazing',' #following',' #bestoftheday',' #instafollow',' #makeup',' #food',' #summer',' #travel',' #insta',' #follower',' #music',' #look',' #follows',' #lifestyle',' #likeme',' #comment4comment',' #c4c',' #commenter',' #comments',' #commenting',' #love',' #comments4comments','#commentteam',' #commentback',' #commentbackteam',' #commentbelow',' #photooftheday',' #commentall',' #commentalways',' #pleasecomment','  #like',' #follow',' #love',' #likeforlikes',' #likes','#photooftheday',' #l',' #photography',' #f',' #likeforfollow',' #followers',' #likeforlike',' #picoftheday',' #followforfollow',' #share',' #me',' #myself','  #smile',' #explorepage',' #viral',' #music',' #photo',' #explore',' #insta',' #tiktok',' #memes',' #nature',' #following',' #repost',' #comment',' #friends',' #s',' #c',' #model',' #life',' #trending',' #follower',' #india','  #shoutout #funny',' #likeforlikeback',' #likesforlike',' #likelike',' #selfie',' #selfienation',' #selfies',' #me',' #love',' #pretty',' #handsome',' #instaselfie',' #selfietime',' #face',' #shamelessselefie',' #life',' #portrait',' #igers','#instalove',' #smile',' #igdaily',' #eyes',' #follow','  #selfie',' #like',' #me',' #myself',' #love',' #smile',' #photooftheday',' #style','#photography','#picoftheday ','#life','#photo',' #art',' #l',' #model',' #beauty','  #makeup',' #nature',' #portrait',' #likes',' #music',' #friends',' #instamood',' #summer',' #igers',' #insta',' #lifestyle',' #f',' #instaselfie',' #selfietime',' #tbt',' #travel',' #fitness',' #pic',' #photographer',' #likeforlike',' #photoshoot','#ootd ','#self',' #k',' #instaphoto',' #pose',' #tiktok',' #mylife',' #love',' #couple',' #cute',' #adorable',' #envywear',' #PleaseForgiveMe',' #kiss',' #kisses',' #hugs',' #romance',' #forever',' #girlfriend',' #boyfriend',' #gf',' #bf',' #bff',' #together',' #photooftheday','#me','#boy',' #beautiful',' #instalove',' #loveher',' #lovehim');
	
/*	$data['c_array']=count($array);
	$data['c_unique_array']=count(array_unique($array));
	$data['array']=array_unique($array);
	$data['array_un_value']=array_count_values($array);*/

	$data=array_unique($array);


echo json_encode($data);
//echo json_encode($data);
}







}



?>