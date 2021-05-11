WINNER<br>
-------------<br>
Congrats!!!!! You Won a Battle Against <br>

battle link:- <?=base_url("home?battle_id=$battle_id");?>
<br>
FB Group Post :- 
<br>

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


To Organise Another Battle Contact Us:-<br>
---------------------------------------------<br>
DIROS WhatsApp :-  https://wa.me/919110065497<br>
FB group link :- https://www.facebook.com/groups/732525747484692<br><br>

Thank You for Conducting Your Battle On Diros..<br>
-----------<br>
Team Diros <br>
------------ <br>

<br><br><br>
---------------------------------------------------------<br><br><br>

Better Luck Next Time<br>
-------------<br>
Oppps!!!!! You Lost a Battle Against <br>

battle link:- <?=base_url("home?battle_id=$battle_id");?>
<br>
FB Group Post :- 
<br>

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


To Organise Another Battle Contact Us:-<br>
---------------------------------------------<br>
DIROS WhatsApp :-  https://wa.me/919110065497<br>
FB group link :- https://www.facebook.com/groups/732525747484692<br><br>

Thank You for Conducting Your Battle On Diros..<br>
-----------<br>
Team Diros <br>
------------ <br><br><br>






<div class="form-group">

  <textarea class="form-control" rows="19" style="width: 90%;" id="comment"></textarea>
</div>

