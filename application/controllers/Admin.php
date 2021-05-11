<?php
class Admin extends CI_Controller{

	public function index(){

		if($admin_id=$this->session->userdata('battle_admin_id')){
			redirect('admin/set_battle');}

		$admin_info=$this->input->post();
	//	$this->load->model('admin_m');
		$this->load->model('rules');
		$this->load->model('database');

		
		if($this->rules->login_admin()){
			if($admin_data=$this->database->admin_data($admin_info)){
				//$this->database->get_admin_id($admin_info);
				$this->session->set_userdata('battle_admin_id',$admin_data->id);
				//print_r($admin_data->id);
				redirect('admin/set_battle');
			}else{
				$this->load->view('admin/login',['invalid'=>'Enter Correct Username & Password']);
			}
		}else{
			$this->load->view('admin/login');			
		}		
	}


	public function set_battle(){
		if(!$admin_id=$this->session->userdata('battle_admin_id')){
			redirect('admin');}

		$this->load->model('database');
		$admin_data_id=$this->database->admin_data_id($admin_id);
		//print_r($admin_data_id); 
		$admin_user_data=$this->database->get_admin_user($admin_data_id->username);
		//print_r($admin_user_data);
		 $selected_user=$this->input->post();

		 //$battle_id=$this->database->insert_battle($admin_data_id,$selected_user);


		if(isset($_POST['submit_battle'])){
			if(!empty($selected_user['user1'])&&!empty($selected_user['user2'])){
				if($selected_user['user1']!=$selected_user['user2']){
					if($battle_id=$this->database->insert_battle($admin_data_id,$selected_user)){
						 $user1=$selected_user['user1'];
						 $user2=$selected_user['user2'];
				redirect("admin/set_battle_data?battle_id=$battle_id&&user1=$user1&&user2=$user2");
				
			}else{$error_info='Something Wrong Occured';}
				}else{$error_info='Select Two Different Users for the Battle';}
			}else{$error_info='Please select Users for Setting Battle';}
		}
		
		if(empty($error_info)){
			$error_info=0;
		}
		
		$this->load->view('admin/work',['listed_users'=>$admin_user_data,'error_info'=>$error_info]);	
			
	}

	


	public function set_battle_insta(){
		if(!$admin_id=$this->session->userdata('battle_admin_id')){
			redirect('admin');}
		$this->load->view('admin/set_battle_insta_view');
	}

	public function user_suggest(){
		
		$input=$this->security->xss_clean($this->input->post());

		$data=$this->db->select('username')->like('username',$input['username'])->get('fighter')->result();

		echo json_encode($data);
	}

	public function set_battle_data_insta(){
		
		if(!$admin_id=$this->session->userdata('battle_admin_id')){
			redirect('admin');}

		$this->load->model('database');
		$admin_data_id=$this->database->admin_data_id($admin_id);
		//print_r($admin_data_id); 
		$admin_user_data=$this->database->get_admin_user($admin_data_id->username);
		//print_r($admin_user_data);
		 $selected_user=$this->security->xss_clean($this->input->post());

		 //$battle_id=$this->database->insert_battle($admin_data_id,$selected_user);

		 $error_info='none';
		
			if(!empty($selected_user['user1'])&&!empty($selected_user['user2'])){
				if($selected_user['user1']!=$selected_user['user2']){
					if($battle_id=$this->database->insert_battle($admin_data_id,$selected_user)){
						 $user1=$selected_user['user1'];
						 $user2=$selected_user['user2'];
				redirect("admin/set_battle_data?battle_id=$battle_id&&user1=$user1&&user2=$user2");
				
			}else{$error_info='Something Wrong Occured';}
				}else{$error_info='Select Two Different Users for the Battle';}
			}else{$error_info='Please select Users for Setting Battle';}
		

		echo $error_info;
		print_r($selected_user);
	}



	public function set_battle_data(){
		if(!$admin_id=$this->session->userdata('battle_admin_id')){
			redirect('admin');}
		$this->load->helper('form');

		$battle_data=$this->input->post();
	//	print_r($battle_data);

		$data_get=$this->input->get('battle_id');
		$data_get_all=$this->input->get();
	//	print_r($data_get);
		$this->load->model('database');

		$this->load->library('upload');

		if(isset($_POST['submit_save'])){
			
			if($this->database->battle_data_save($data_get,$battle_data,$data_get_all)){
				redirect("admin/listed_battles");
			}
	}


	if(isset($_POST['submit_run'])){
		if($this->database->battle_data_save($data_get,$battle_data,$data_get_all)){
				
		if($this->database->battle_start_date($data_get)){
			redirect("admin/meta_img_set?battle_id=$data_get");
		}
		}
	}	

		$this->load->view('admin/submit_battle',['battle_id'=>$data_get,'data_get_all'=>$data_get_all]);
	

	}

private function reg($admin_id){
	
	//$admin_id=$this->session->userdata('battle_admin_id');

	$this->load->helper('form');
		$this->load->library('upload');

		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<span>', '</span>');

		$fighter_data=$this->input->post();
	//	print_r($fighter_data);
		
		$this->load->model('database');
		$this->load->model('rules');

		$admin_id_data=$this->database->admin_data_id($admin_id);
		//print_r($admin_id_data);
		$admin_username=$admin_id_data->username;
	//	print_r($admin_username);

		if($this->rules->add_admin()){
		return $uu=$this->database->set_fighter($admin_username,$fighter_data);
		//	redirect('admin/set_battle');
		
	}
	//	print_r($uu);


	}


	public function register(){
	
		if(!$admin_id=$this->session->userdata('battle_admin_id')){
			redirect('admin');}

		if($this->reg($admin_id)){
			redirect('admin/set_battle');
		}
				$this->load->view('admin/register_user');
	/*			if(!$admin_id=$this->session->userdata('battle_admin_id')){
					$admin_id='reeshu';
				}
*/

		
}

	public function register_self(){
		$admin_id='3';
		if($this->reg($admin_id)){
			$this->session->set_flashdata('voteing_status','3');

			redirect('home');
		}

		$this->load->view('admin/register_user_self');
	}


	public function listed_battles(){

			if(!$admin_id=$this->session->userdata('battle_admin_id')){
			redirect('admin');}

			$this->load->model('database');

			$admin_data=$this->database->admin_data_id($admin_id);
			
		//	$this->database
			 $battle_list=$this->database->get_battle_username($admin_data->username);

		//	 
			
			$this->load->view('admin/listed_battles',['battle_list'=>$battle_list]);

	}

public function start_battle_left(){
	$this->load->model('database');
	$this->database->battle_start_date($this->input->get('battle_id'));
	redirect('admin/listed_battles');
}

public function start_battle_direct(){
	$battle_id=$this->input->get('battle_id');
	$this->load->model('database');
	$this->database->battle_start_date($battle_id);
	redirect("home?battle_id=$battle_id");
}


public function meta_img_set(){
	if(!$admin_id=$this->session->userdata('battle_admin_id')&&isset($_GET['battle_id'])){
			redirect('admin');
		}

	$this->load->model('database');
	$battle_id=$this->input->get('battle_id');
	
	
	$data=$this->database->war_detail($battle_id)->result();
	//print_r($data);
	
	$this->load->view('admin/meta_image_insert',['img_data'=>$data]);
}
	public function canvas_save_img(){
		$input=$this->security->xss_clean($this->input->post());

		$image=$_POST['img_file'];

		$chk=$this->db->where('id',$input['id'])->update('battle_detail',['meta_img_canvas'=>$image]);
		echo json_encode($chk);
	}

	public function canvas_get_img(){
		$input=$this->security->xss_clean($this->input->post());

		$this->load->model('database');
		$data['programmed']=$this->database-> get_admin_username($input['id']);
		$data['uploaded']=$this->db->where('id',$input['id'])->select('meta_img')->get('battle_detail')->row();


if(empty($data['uploaded']->meta_img)){
	
	
		$og_url['url']=base_url('utility/meta_img/default.jpg');
		$og_url['display']="none";

}else{
	$og_url['url']=base_url('utility/meta_img/').$data['uploaded']->meta_img;
	$og_url['display']="block";
}

		echo json_encode($og_url);
	}

	public function uploaded_meta_del(){
		$input=$this->security->xss_clean($this->input->post());

		$data=$this->db->where('id',$input['id'])->update('battle_detail',['meta_img'=>""]);
		
		echo json_encode($data);
	}




public function meta_send(){
	//$input=$this->security->xss_clean($this->input->post());
	$input=$this->input->post();
	$config['upload_path']          = 'utility/meta_img';
   $config['allowed_types']        = 'gif|jpg|png|jpeg';
    $config['max_size']             = 10000;
    $config['file_name']			=$input['battle_id'];
   // $config['max_width']            = 1024;
    //$config['max_height']           = 768;

    $this->load->library('upload', $config);

    if($this->upload->do_upload('meta_img')){
        $upload_data = $this->upload->data();
       	//echo json_encode($upload_data['file_name']);
       	$this->db->where('id',$input['battle_id'])->update('battle_detail',['meta_img'=>$upload_data['file_name']]);
       	echo json_encode('success');	
    }else{
    	echo json_encode($this->upload->display_errors());
	    echo json_encode($input);
    }




	//echo json_encode($input);
}



	public function delete_battle_cnfrm(){
		$battle_id=$this->input->get('battle_id');
		$this->load->view('admin/cnfrm_del_battle',['battle_id'=>$battle_id]);
	}
	
	public function delete_battle(){
	//	$battle_id=$this->input->get('battle_id');
		$this->load->model('database');
		$this->database->delete_battle_model($this->input->get('battle_id'));


		redirect('admin/listed_battles');
	}

	public function battle_reminder(){

		$battle_id=$this->input->get('battle_id');

		$this->load->model('database');
		$war=$this->database->war_detail($battle_id);

		$fighters=array_column($war->result_array(), 'username');
	
	$fighter=$this->database->fighter_detail($fighters);

	$votes=$this->database->vote_count($battle_id);

	$end_time=$this->database->get_admin_username($battle_id)->end_time;

		$this->load->view("admin/battleReminder",['battle_detail'=>$war->result(),'fighter'=>$fighter->result(),'votes'=>$votes,'end_time'=>$end_time]);


	}

	public function battle_start_notify(){
		$id=$this->input->get('battle_id');

		$this->load->view('admin/start_notify',['battle_id'=>$id]);		
	}

	public function battle_end_notify(){
		error_reporting(0);
		$battle_id=$this->input->get('battle_id');

				$this->load->model('database');
		$war=$this->database->war_detail($battle_id);

		$fighters=array_column($war->result_array(), 'username');
	
	$fighter=$this->database->fighter_detail($fighters);

	$votes=$this->database->vote_count($battle_id);

	$end_time=$this->database->get_admin_username($battle_id)->end_time;

		$this->load->view('admin/end_notify',['battle_id'=>$battle_id,'battle_detail'=>$war->result(),'fighter'=>$fighter->result(),'votes'=>$votes,'end_time'=>$end_time]);		
	}

	public function battle_start_post(){

	}

	public function battle_end_post(){

		$battle_id=$this->input->get('battle_id');
		
		$this->load->model('database');
		$end_time=$this->database->get_admin_username($battle_id)->end_time;

		$this->load->view("admin/end_post",['battle_id'=>$battle_id,'end_time'=>$end_time]);
	}


public function feed(){
	if(!$admin_id=$this->session->userdata('battle_admin_id')){
			redirect('admin');}

	$this->load->view('admin/diros_feed');	
}


	public function direct_insert_file(){
		$input=$this->security->xss_clean($this->input->post());

		 $this->load->library('upload');

		$this->insta_data_file_name($input);
		if($this->upload->do_upload("file_upload1")){
		$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
		$this->db->insert('feed',['username'=>trim($input['insta_username_bubble']),'type'=>$input['battle_type'],'file_name'=>$upload_data['file_name'],'raw_name'=>$upload_data['raw_name'],'caption'=>$input['comment1'],'date'=>date('Y-m-d H-i-s')]);
				$message=$this->upload->display_errors();
		
		$result_file['file_one']="success";

		}else{
			$message=$this->upload->display_errors();
			$result_file['file_one']="failed";
		}


		$this->insta_data_file_name($input);
		if($this->upload->do_upload("file_upload2")){
		$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
		$this->db->insert('feed',['username'=>trim($input['insta_username_bubble']),'type'=>$input['battle_type'],'file_name'=>$upload_data['file_name'],'raw_name'=>$upload_data['raw_name'],'caption'=>$input['comment2'],'date'=>date('Y-m-d H-i-s')]);
				//$message=$this->upload->display_errors();
		//echo json_encode($message);
		
		$result_file['file_two']="success";

		}else{
			$message=$this->upload->display_errors();
			$result_file['file_two']="failed";

		}

		$this->insta_data_file_name($input);
		if($this->upload->do_upload("file_upload3")){
		$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
		$this->db->insert('feed',['username'=>trim($input['insta_username_bubble']),'type'=>$input['battle_type'],'file_name'=>$upload_data['file_name'],'raw_name'=>$upload_data['raw_name'],'caption'=>$input['comment3'],'date'=>date('Y-m-d H-i-s')]);
				//$message=$this->upload->display_errors();
		
		$result_file['file_three']="success";

		}else{
			$message=$this->upload->display_errors();
				
			$result_file['file_three']="failed";

		}


		echo json_encode($result_file);

	}

		private function insta_data_file_name($input){
		$file_name=$this->db->select('file_name,raw_name')->order_by('id','DESC')->get('feed')->row();
		if(!isset($file_name)){
			$file_name = new stdClass();
			$file_name->file_name=0;
			$file_name->raw_name=0;
		}


		$upload_config=array(
								'upload_path'=>'utility/feed',
								'allowed_types'=>'jpg|png|jpeg|mp4',
								'max_size'=>200000,
								'file_name'=>$file_name->raw_name+1
								
							);
		$this->upload->initialize($upload_config);
	}


	public function logout(){
		$this->session->unset_userdata('battle_admin_id');
		redirect('admin');
	}

}

?>