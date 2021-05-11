<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>User Image</title>
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


<div class="container pb-5 mb-5" style="background: #f4f6ff;">
	<h2><?=ucfirst($_GET['user']);?></h2>
	
	<br>
	<div class="row">
		<div class="col text-muted">Today's Data</div>
	</div>

	<div class="row border m-2 p-2" id="today_img">
	
	</div>
<br><br>
	<div class="row">
		<div class="col text-muted">Remaining Data</div>
	</div>

	<div class="row border m-2 p-2" id="remaining_img">
		
	</div>


<br><br>
	<div class="row">
		<div class="col text-muted">Used Data</div>
	</div>

	<div class="row border m-2 p-2" id="used_img">
		
	</div>

</div>



<script type="text/javascript">

$("#header_home").addClass('active');

var battle_type="<?=$_GET['battle_type'];?>";
var username="<?=$_GET['user'];?>";

function show_data(){
				$.ajax({
				type:"POST",
				url:"user_data_all",
				dataType:"json",
				data:{
						username:"<?=$_GET['user'];?>",
						battle_type:"<?=$_GET['battle_type'];?>"
				},
				
				success:function(data){
					
					console.log(data);

					//console.log(battle_type);

					today_data="";
					$.each(data,function(){

						strin=JSON.stringify(this.battle_date_time);

						var date=strin.substring(1,11);



						var curr="<?= date('Y-m-d'); ?>";

						//console.log(date+'::'+curr);

						if(date==curr){
							console.log(battle_type);
							if(battle_type=="image"){
					down_data="<img src=\"<?=base_url('utility/insta_img/"+battle_type+"/"+username+"/"+this.file_name+"')?>\" style='height:150px; width:150px;'>";
				}else if (battle_type=="video"){
					down_data="<video width=\"150\" height=\"150\" controls><source src=\"<?=base_url('utility/insta_img/"+battle_type+"/"+username+"/"+this.file_name+"')?>\"></video>"
				}else if (battle_type=="website"){

					down_data="<img src=\"<?=base_url('utility/insta_img/"+battle_type+"/"+username+"/"+this.file_name+"')?>\" style='height:150px; width:150px;'>";
				}
						//	today_data+="<div class='col'><img src=\"<?=base_url();?>utility/insta_img/<?=$_GET['battle_type'];?>/<?=$_GET['user'];?>/"+this.file_name+"\" style=\"height:150px;\"></div>";
						today_data+=down_data;
						}		
					});
					
					$("#today_img").html(today_data);



					remaining_data="";
					$.each(data,function(){

/*						strin=JSON.stringify(this.battle_date_time);

						var date=strin.substring(1,11);

						var curr="<?= date('Y-m-d'); ?>";
*/
						if(this.status!='used'){
								

				if(battle_type=="image"){
					down_data="<img src=\"<?=base_url('utility/insta_img/"+battle_type+"/"+username+"/"+this.file_name+"')?>\" style='height:150px; width:150px;'>";
				}else if (battle_type=="video"){
					down_data="<video width=\"150\" height=\"150\" controls><source src=\"<?=base_url('utility/insta_img/"+battle_type+"/"+username+"/"+this.file_name+"')?>\"></video>"
				}else if(battle_type=="website"){
					down_data="<img src=\"<?=base_url('utility/insta_img/"+battle_type+"/"+username+"/"+this.file_name+"')?>\" style='height:150px; width:150px;'>";
				}

							remaining_data+="<div class='col-5 col-md-3 col-lg-2 m-1'>";
							remaining_data+="<span class='bg-danger text-white pl-1 pr-1' style='position:relative; top:10px; box-shadow:2px 2px 2px white; cursor:pointer;' id='del_rem_data' data-img_sn="+this.sn+">X</span>"
							//remaining_data+="<img src=\"<?=base_url();?>utility/insta_img/<?=$_GET['battle_type'];?>/<?=$_GET['user'];?>/"+this.file_name+"\" style=\"height:150px; width:150px;\">";
							
							remaining_data+=down_data;

							remaining_data+="</div>";
						}		
					});
					
					$("#remaining_img").html(remaining_data);


					used_data="";
					$.each(data,function(){

						if(this.status=='used'){
							if(battle_type=="image"){
					down_data="<img src=\"<?=base_url('utility/insta_img/"+battle_type+"/"+username+"/"+this.file_name+"')?>\" style='height:150px; width:150px;'>";
				}else if (battle_type=="video"){
					down_data="<video width=\"150\" height=\"150\" controls><source src=\"<?=base_url('utility/insta_img/"+battle_type+"/"+username+"/"+this.file_name+"')?>\"></video>"
				}else if(battle_type=="website"){
					down_data="<img src=\"<?=base_url('utility/insta_img/"+battle_type+"/"+username+"/"+this.file_name+"')?>\" style='height:150px; width:150px;'>";
				}
				used_data+=down_data;
							//used_data+="<div class='col-5 col-md-3 col-lg-2 m-1'><img src=\"<?=base_url();?>utility/insta_img/<?=$_GET['battle_type'];?>/<?=$_GET['user'];?>/"+this.file_name+"\" style=\"height:150px; width:150px;\"></div>";
						}		
					});
					
					$("#used_img").html(used_data);


				},
				error:function(data){
					console.log(data);
				}

			});	
		}

		show_data();



			$(document).on("click","#del_rem_data",function(){
				var del_sn=$(this).data('img_sn');
				console.log(del_sn);
				
					if(confirm("are you sure want to delete")){
						del_data_cnfrm(del_sn);
				
				}

			});

		function del_data_cnfrm(del_sn){
			$.ajax({
				type:"POST",
				url:"del_user_data",
				dataType:"json",
				data:{
						sn:del_sn
				},
				
				success:function(data){
					
					show_data();
					//data_arrange_table_dropdown(data);

					// window.location.href = "<?=base_url();?>utility/insta_img/"+img_battle_type+"/"+img_username+"/"+data.file_name;
				},
				error:function(data){
					console.log(data);
				}

			});	
		}



</script>


	</body>
</html>