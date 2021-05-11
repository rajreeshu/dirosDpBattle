<?php
class Feeds extends CI_Controller{

	public function index(){

		$this->load->view('feed');
	}
	public function f(){
		redirect('feeds','refresh');
	}

	public function select_feed(){

		$input=$this->security->xss_clean($this->input->post());
		//print_r($input);

		$this->load->library('session');
		$ip_cookie=$this->input->cookie('diros_fb_id');

		if(empty($ip_cookie)){
			$ip= $this->input->ip_address();
			$this->input->set_cookie(['name'=>'diros_fb_id','value'=>$ip,'expire'=>2592000]);
			$ip_cookie=$this->input->cookie('diros_fb_id');
		}

		$viewed_posts=$this->db->select('feed.id')->where('feed_view.viewer',$ip_cookie)->from('feed_view as feed_view')->join('feed as feed','feed_view.data_id=feed.id','left')->order_by('feed.rating','DESC')->get()->result_array();
/*		print_r( array_column($viewed_posts,'id'));*/

		$all_sorted_array=$this->db->select('id,username,file_name,type,caption,rating')->order_by('rating','DESC')->get('feed')->result();		
		
		if($input['change_post']==1){
			$this->session->unset_userdata('diros_feed_id');
		}

	if(empty($diros_feed_id_session=$this->session->userdata('diros_feed_id'))){
		
		if(empty($viewed_posts)){
			$data['feed_data']=$this->db->select('id,username,file_name,type,caption,rating')->order_by('rating','DESC')->get('feed')->row();
		}else{
		
			foreach ($all_sorted_array as $all_sorted) {

			
				$in_arr=in_array($all_sorted->id, array_column($viewed_posts,'id'));

				if($in_arr!=1){
					
					$next_id=$all_sorted->id;
					break;
				}

			}
			if(!empty($next_id)){
				$data['feed_data']=$this->db->select('id,username,file_name,type,caption,rating')->where('id',$next_id)->order_by('rating','DESC')->get('feed')->row();
			}else{
				$data['feed_data']=$this->db->select('id,username,file_name,type,caption,rating')->where('id !=',$diros_feed_id_session)->order_by('rand()')->get('feed')->row();
			}
			

		}
	}else{
		 $data['feed_data']=$this->db->select('id,username,file_name,type,caption,rating')->where('id',$diros_feed_id_session)->order_by('rating','DESC')->get('feed')->row();
	}




		$data['model_data']=$this->db->select('name,fb_id,insta_id')->where('username',$data['feed_data']->username)->get('fighter')->row();

		$this->session->set_userdata('diros_feed_id', $data['feed_data']->id);
		echo json_encode($data);
	}

	public function insert_views(){

		$input=$this->security->xss_clean($this->input->post());

		$ip= $this->input->ip_address();

		$ip_cookie=$this->input->cookie('diros_fb_id');
		if(empty($ip_cookie)){
			$ip_cookie= $this->input->ip_address();
		}

		$is_viewed=$this->db->select('liked')->where(['data_id'=>$input['data_id'],'viewer'=>$ip_cookie])->get('feed_view')->row();

		if(empty($is_viewed)){
			$x=$this->db->insert('feed_view',['data_id'=>$input['data_id'],'viewer'=>$ip_cookie,'date_view'=>date('Y-m-d H-i-s')]);
			$data['view']=2; //inserted
			
		}else{
			$data['view']=1; //already viewed
			$data['liked']=$is_viewed->liked;
		}
		$this->insert_rating($input['data_id']);

		echo json_encode($data);

	}

	public function insert_likes(){

		$input=$this->security->xss_clean($this->input->post());

		$ip_cookie=$this->input->cookie('diros_fb_id');

		$is_liked=$this->db->select('liked')->where(['data_id'=>$input['data_id'],'viewer'=>$ip_cookie])->get('feed_view')->row();
		if($is_liked->liked!=1){
			$data=$this->db->where(['data_id'=>$input['data_id'],'viewer'=>$ip_cookie])->update('feed_view',['liked'=>1,'date_liked'=>date('Y-m-d H-i-s')]);
		}else{
			$data="liked";
		}
		$this->insert_rating($input['data_id']);
		echo json_encode($data);
	}

	private function insert_rating($image_id){

		$no_views=$this->db->where('data_id',$image_id)->get('feed_view')->num_rows();
			
			if($no_views>=15){
				$no_likes=$this->db->where(['data_id'=>$image_id,'liked'=>1])->get('feed_view')->num_rows();

				$final_rating=$no_likes/$no_views;
				$this->db->where('id',$image_id)->update('feed',['rating'=>$final_rating]);
			}
		



	}

	public function like_unlike(){

		$input=$this->security->xss_clean($this->input->post());

		$ip_cookie=$this->input->cookie('diros_fb_id');

		$is_liked=$this->db->select('liked')->where(['data_id'=>$input['data_id'],'viewer'=>$ip_cookie])->get('feed_view')->row();
		if($is_liked->liked!=1){
			$this->db->where(['data_id'=>$input['data_id'],'viewer'=>$ip_cookie])->update('feed_view',['liked'=>1,'date_liked'=>date('Y-m-d H-i-s')]);
			$data=1;
		}else{
			$this->db->where(['data_id'=>$input['data_id'],'viewer'=>$ip_cookie])->update('feed_view',['liked'=>0,'date_liked'=>date('Y-m-d H-i-s')]);	
			$data=0;
		}
		echo json_encode($data);
	}

	public function views_likes(){
		
		$input=$this->security->xss_clean($this->input->post());

		$ip_cookie=$this->input->cookie('diros_fb_id');

		$data['views']=$this->db->where('data_id',$input['data_id'])->get('feed_view')->num_rows();
		
		$data['likes']=$this->db->where(['data_id'=>$input['data_id'],'liked'=>1])->get('feed_view')->num_rows();

		echo json_encode($data);

	}

}
?>