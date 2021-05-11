<?php
$id=$this->input->get('battle_id');


?>


Your Battle at <?=base_url();?> is Still in Progress...<br><br>

Battle link :- <?=base_url();?>/home?battle_id=<?=$id;?><br><br>

Votes [ <?=date('d-m-Y');?> ( <?=date('H:i');?> ) ] :- <br>
-------<br>
	<?php 
	
						foreach ($battle_detail as $battle_details):

							$username_chk=$battle_details->username;

						foreach ($fighter as $fighters):
							if($username_chk==$fighters->username):
	
	foreach ($votes->result() as $votes_res) {
		if($votes_res->voted_user==$fighters->username){
			$vote_avail=1;
			continue;
			//print_r($votes_res);
		}
	}
if(!empty($votes->result())){
	if(!empty($vote_avail)){
	$user_personal_vote=array_count_values(array_column($votes->result(), 'voted_user'))[$fighters->username];
}else{
	$user_personal_vote=0;
}
}else{
	$user_personal_vote=0;
}
	if(!$user_personal_vote){
			$user_personal_vote=0;
	}

	?>

	<?= ucfirst($fighters->name);?> :-
      
      		<?= $user_personal_vote ?> Vote<br>
     

									  <?php
										endif;
									    endforeach;
									    endforeach;
									    ?><br>

<?=base_url();?>/home?battle_id=<?=$id;?><br><br>

Share this Battle link with Your Friends & Family to Win this Battle.<br>

Your Battle will End at <u><?=date('d-m-Y',strtotime($end_time)).' ( '.date('H:i',strtotime($end_time));?></u> ) <br><br>
-----------
Team Diros
-----------<br>



