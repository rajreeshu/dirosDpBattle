<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Diros:-Stats</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
	</head>
	<body>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
		
		<?php $this->load->view('insta/header') ;?>

<br>

	<div class="row">
		<div class="col-4 d-flex justify-content-md-start justify-content-center ml-5">
			<select class="form-control" style="width: 300px;" id="battle_type">
				<option value="">Battle Type</option>
				<option value="image">Dp Battle</option>
				<option value="video">Video Battle</option>
				<option value="website">Website Battle</option>
			</select>
		</div>

		<div class="col-9  col-md-4 justify-content-center mt-2 mt-md-0" style="width: 300px;" >
			<select class="form-control"id="battle_upto">
				<option value=">=0" selected>No. of Battles (ALL)</option>
				<option value="=1">1 Battle</option>
				<option value="=2">2 Battle</option>
				<option value="=3">3 Battles</option>
				<option value="=4">4 Battles</option>
				<option value="=5">5 Battles</option>
				<option value="=6">6 Battles</option>
				<option value="=7">7 Battles</option>
				<option value="=8">8 Battles</option>
				<option value="=9">9 Battles</option>
				<option value="=10">10 Battles</option>
				<option value=">=10">More than 10 Battle</option>
				
			</select>
		</div>
		
		<div class="col-8 col-md-3 d-flex pt-2 pt-md-0 justify-content-center justify-content-md-end">
			<span class="form-inline">
				<input type="text" class="form-control" placeholder="SEARCH USER" id="user_specific"> &nbsp
			</span>
		</div>
	</div>
	<br>
		<!-- today's table -->
		<div class="container bg-light p-2 mb-5">
			
			<table class="table">
				<thead class="thead-dark" >
					<tr>
						<th>username</th>
						
					

						<th>Total Battle</th>
						<th>Open Account</th>
						
					</tr>
				</thead>
				<tbody id="table_body_dropdown">
					
					
				</tbody>
			</table>
		</div>
		<!-- table -->


<script type="text/javascript">

$("#header_stats").addClass('active');

	var battle_type=$("#battle_type").val();
	var battle_upto=$("#battle_upto").val();
	var data_arr=$("#battle_upto").data('arr');

	//console.log(data_arr);

	//var row_bg_col="";

	$("#battle_type").on("change",function(){
		battle_type=$("#battle_type").val();
		battle_upto=$("#battle_upto").val();
		//console.log(battle_type);
		show_data('');
	});

	$("#battle_upto").on("change",function(){
		battle_type=$("#battle_type").val();
		battle_upto=$("#battle_upto").val();

	
		show_data('');
	});
		function show_data(username){
				console.log(battle_upto);
			$.ajax({
				type:"POST",
				url:"distinct_username",
				dataType:"json",
				data:{
						battle_type:battle_type,
						battle_upto:battle_upto,
						username:username
				},
				
				success:function(data){
					//console.log(data);
					var user_data="";
			$.each(data,function(){

				//console.log(row_bg_col);

				user_data+="<tr class=\"\" >";
				user_data+="<td id=\"username\"><div>@"+this.username+"</div></td>";
				
				user_data+="<td>"+this.total+"<div class=\"text-muted\" style=\"cursor:pointer;\" id=\"check_status\" data-username=\""+this.username+"\">Check Status</div></td>";
				user_data+="<td><a href='https://instagram.com/"+this.username+"' target='_blank'><img src='https://qph.fs.quoracdn.net/main-qimg-8996d1e3e92f2671d6c83ce7c96f50d3' style='height:30px; widht:30px;'>Account</a></td>";
		
				user_data+="</tr>";

			});
				//console.log("<?=$this->db->last_query();?>")
			$("#table_body_dropdown").html(user_data);

				},
				error:function(data){
					console.log(data);
				}
			});
		}

		$("#user_specific").keyup(function(){

			
			var user_specific=$("#user_specific").val();
			show_data(user_specific);
		});	

	
		$(document).on("click","#check_status",function(){
			var chk_username=$(this).data('username');
			//console.log(this);
			$.ajax({
				type:"POST",
				url:"chk_status",
				dataType:"json",
				data:{
						username:chk_username,
				},
				
				success:function(data){
					console.log(data);

					var img_no=0;
					var vid_no=0;
					var web_no=0;
					$.each(data.web,function(){
						if(this.battle_type=='image'){
							img_no++;
						}
						if(this.battle_type=='video'){
							vid_no++;
						}
						if(this.battle_type=='website'){
							web_no++;
						}
					});
					
						admin_panel_data="<span class=\"bg-primary\">";
						admin_panel_data+="Website Battle : "+data.user_avail+"<br>";
						admin_panel_data+="Votes : "+data.votes+" | Battle : "+data.battle +"<br>";
						admin_panel_data+="Avg : "+Math.round(data.votes/data.battle);
						admin_panel_data+="</span>";
					$('div[data-username="'+chk_username+'"]').html("image: "+img_no+" | video: "+vid_no+" | web: "+web_no+"<br>"+admin_panel_data);
					$('div[data-username="'+chk_username+'"]').removeClass('text-muted');
					$('div[data-username="'+chk_username+'"]').addClass('text-white');
					$('div[data-username="'+chk_username+'"]').css("textShadow","black 1px 1px 5px");
					$('div[data-username="'+chk_username+'"]').css("cursor","default");
					//$('div[data-username="'+chk_username+'"]').html("video: "+vid_no);
					


					if(data.web!=0){

						$('div[data-username="'+chk_username+'"]').parent().parent().css('background','#96bb7c');

					}else{
						$('div[data-username="'+chk_username+'"]').parent().parent().css('background','#ff847c');
					}
				}
			});
		});

	
		show_data('');




</script>


	</body>
</html>