<!DOCTYPE html>
<html lang="en">
	<head>
		
		<title>Diros:-Daily Data</title>
		<meta charset="utf-8">
		<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
		<meta http-equiv="x-ua-compatible" content="ie=edge">
	</head>
	<body>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
		
		<?php $this->load->view('insta/header') ;?>

<br>

<center>
		<select class="form-control" style="width: 300px;" name="battle_type" id="battle_type">
			<option value="" disabled  selected>Battle Type</option>
			<option value="image" id="option_image">Dp Battle</option>
			<option value="video" id="option_video">Video Battle</option>
			<option value="website" id="option_website">Website Battle</option>
		</select>
</center>
		<br>
	<div class="container">
		<div class="row">
			<div class="col rounded" style="background: #ffe4e4; padding: 10px;">
				<h2>Data ( <?=date("d/m/Y");?> )</h2>

				<div class="col-4 float-right" id="error_display" style="position:relative; top: -40px;"></div>
			
			
		<div class="container bg-light p-2 mb-5">
			<div id="all_reserve_username"></div>
			<!--  table -->
			<table class="table mt-3">
				<thead class="thead-light" >
					<tr>
						<th>S.N</th>
						<th>username</th>
						<th>File</th>
						<th>Addon</th>
						
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="table_body_dropdown_reserve">
					

					
				</tbody>
			</table>


			<table class="table">
				<thead class="thead-dark" >
					<tr>
						<th>S.N</th>
						<th>username</th>
						<th>File</th>
						<th>Addon</th>
						
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="table_body_dropdown">
					

					
				</tbody>
			</table>	


		</div>
		<!-- table end -->

			</div>

		</div>
<h1 class="m-2 mt-0">Special Member</h1>
	<div class="bg-danger text-white rounded col-6 p-2" id="special_member_error"></div>
			<div class="row">
				 <input type="text" class=" col-3 col-md-4 form-control  m-3 ml-2" id="special_member_user" name="" placeholder="username">
				 <input type="text" class=" col-4 col-md-5 form-control  m-3 ml-2" name="" id="special_member_message" placeholder="message"> 
				<div class="col  m-3 ml-2">
				<button class="btn btn-success" id="special_member_save">Save</button>
			</div>
			<table class="table">
				<thead class="thead-dark" >
					<tr>
						<th>S.N</th>
						<th>username</th>
						
						
						
						<th>Message</th>
					</tr>
				</thead>
				<tbody id="table_special_member">
					

					
				</tbody>
			</table>
			</div>

		<div class="row">
			<div class="col"></div>
		</div>

		<div class="row rounded" style="margin-top: 20px; background: #f4f6ff;  padding: 0px;" id="bubble_display">	</div>
	</div>

<?php

	if(isset($_COOKIE['diros_daily_data_battle_type'])){
		$cookie_data=$_COOKIE['diros_daily_data_battle_type'];
	}else{
	$cookie_data="";
}


?>

	


<script type="text/javascript">

$("#header_daily_data").addClass('active');

var cookie_data="<?= $cookie_data; ?>";


	
	if(cookie_data!=""){
	
			$("#option_"+cookie_data).attr("selected","");
		
	}
//battle type

	var battle_type=$("#battle_type").val();


	show_data();

	$("#battle_type").on("change",function(){


		battle_type=$("#battle_type").val();

		show_data();
		show_data_reserve();
		special_member_load();
	});



function show_data_reserve(){
	//var user_data="";
		//console.log(battle_type);
				if(battle_type=="image"){
					res_val=1;
				}else if(battle_type=="video"){
					res_val=2;
				}else if(battle_type=="website"){
					res_val=3;
				}

			$.ajax({
				url:"show_data_daily_data_reserve",
				type:"POST",
				//async:false,
				data: {
						battle_type:battle_type,
						reserve:res_val
				},
				dataType:'json',
				//contentType:false,

				/*beforeSend:function(){
					var loader_gif="<img src=\"https://i.gifer.com/4V0b.gif\">";
					$("#table_body_dropdown").html(loader_gif);
				},*/
				
				success:function(data){

					//console.log(data);
					
					var new_date="";
					var user_data="";
					var sn=1;
					//window.color_class="";
				$.each(data.data,function(key,value){
					var new_date="";
					$.each(data.reserve,function(key2, value2){
						
						//console.log(value.username+'--'+value2.username);
						if(value.username==value2.username){
							value="";
						}
						
					});

					if(new_date=="found"){
						return;
					}
					
					var con=Object.values(value);
					var inarra=$.inArray("ree", con);
					

					var bg_color="";
					var btn_status="";
					var btn_cursor_type="";
					var down_data="";
			if(this.date!=null){		
				strin=JSON.stringify(this.date);

				var date=strin.substring(1,11);

				var n_date= new Date(date);

				var ne_month= (n_date.getMonth()+1)<10 ? '0'+(n_date.getMonth()+1) : ''+(n_date.getMonth()+1);
				var ne_date= (n_date.getDate())<10 ? '0'+(n_date.getDate()) : ''+(n_date.getDate());
				//var new_date=n_date.toString('dd-MM-yy');
				new_date=ne_date+"-"+ne_month+"-"+n_date.getFullYear();
				//console.log(new_date);


				//get date
				var curr="<?= date('Y-m-d',strtotime('-1 day')); ?>";

						if(date==curr){
							bg_color="#fccbcb";

							//console.log(bg_color);
						}
						else if(date=="<?= date('Y-m-d'); ?>"){
							bg_color="#ff847c";
							btn_status="disabled";
							btn_cursor_type="not-allowed";
						}
					}

				if(this.comment==""){
					comment_db="<div class='text-muted' style=\"margin-bottom:-20px;\">Add Comment</div>";
					comment_color="";
				}else{
					comment_db="<span class='bg-white rounded p-2 ' style='position:relative; top:10px; box-shadow:-0px 0px 4px grey;' >"+this.comment+"</span>";
					comment_color="bg-warning";
				}

				if(battle_type=="image"){
					down_data="<img src=\"<?=base_url('utility/insta_img/"+battle_type+"/"+this.username+"/"+this.file_name+"')?>\" style='height:100px; width:100px;'>";
				}else if (battle_type=="video"){
					down_data="<video width=\"130\" height=\"130\" ><source src=\"<?=base_url('utility/insta_img/"+battle_type+"/"+this.username+"/"+this.file_name+"')?>\"></video>"
				}else if(battle_type=="website"){
					down_data="<img src=\"<?=base_url('utility/insta_img/"+battle_type+"/"+this.username+"/"+this.file_name+"')?>\" style='height:100px; width:100px;'>";
				}
				

				if(this.star==0||this.star==null){
					star_url=" <img src=\"https://pngimg.com/uploads/star/star_PNG1595.png\" alt=\"\" height=\"15\" class=\"star\" data-star_n=\""+this.star+"\" data-username=\""+this.username+"\">";
				}else{
					star_url=" <img src=\"https://www.freepnglogos.com/uploads/star-png/star-vector-png-transparent-image-pngpix-21.png\" alt=\"\" height=\"20\" class=\"star\" data-star_n=\""+this.star+"\" data-username=\""+this.username+"\">";
				}
				//console.log(down_data);
				//console.log(battle_type);
			if(value.username==undefined){
				user_data+="<tr class='' style='background:"+bg_color+"'>";
				
				user_data+="<td>";
				user_data+=sn;
				user_data+= star_url;
				user_data+="<br>  <input type=\"checkbox\" id=\"unreserve_check\" data-sn_reserve=\""+this.sn+"\" data-user_reserve=\""+this.username+"\"><span class=\"text-muted\"> UnReserve</span>";
				user_data+="</td>";
				
				user_data+="<td id=\"username\">";
				user_data+=" <img src=\"https://cdn4.iconfinder.com/data/icons/wirecons-free-vector-icons/32/menu-alt-512.png\" style=\"height:20px; width:20px; cursor:pointer; \" id=\"battle_file_all_open\" data-battle_type="+battle_type+" data-username="+this.username+"> &nbsp";
				user_data+="<span>@"+this.username+"</span>";
				user_data+="</td>";
				
				user_data+="<td>";
				user_data+=down_data;
				user_data+="</td>";
				
				user_data+="<td class=\""+comment_color+"\">";
				user_data+="<a href='https://instagram.com/"+this.username+"' target='_blank'><img src='https://qph.fs.quoracdn.net/main-qimg-8996d1e3e92f2671d6c83ce7c96f50d3' style='height:30px; widht:30px;'>Account</a><br>";
				user_data+="<div class=\"\" style=\"cursor:pointer;\" id=\"comment_toggle\" data-sn=\""+this.sn+"\">"+comment_db+"</div>";
				user_data+="<div id=\"comment_full_"+this.sn+"\" style=\"display:none;\">";
				user_data+="<textarea id=\"comment_textarea_"+this.sn+"\" class=\"mt-4\"></textarea>";
				user_data+="<div class=\"btn btn-sm btn-primary\" id=\"comment_submit\" data-sn_submit=\""+this.sn+"\" style=\"margin-top:-25px; margin-left:2px;\">save</div>";
				user_data+="<div class='' style='margin-top:-10px; cursor:pointer;' id='comment_hide' data-sn=\""+this.sn+"\">Hide</div>"
				user_data+="</div>";
				user_data+="</td>";

				user_data+="<td>";
				//user_data+="<a href=\"<?=base_url('utility/insta_img/"+battle_type+"/"+this.username+"/"+this.file_name+"')?>\"  download=\"@"+this.username+"\"/>";
				user_data+="<span class=\"text-white mt-3 bg-info p-1\" style=\"\">"+this.upload_date.substring(0,11)+"</span><br>";
				user_data+="<button class=\"btn btn-primary mt-2\" id=\"battle_data_insert\" data-sn=\""+this.sn+"\" data-username=\""+this.username+"\" style=\"cursor:"+btn_cursor_type+";\""+btn_status+">Select</button>";
				//user_data+="</a>";
				//user_data+="<div class=\"text-muted mt-3\">"+new_date+"</date>";
				user_data+="</td>";
		
				user_data+="</tr>";
				sn++;
				new_date="";


			}

			});

			$("#table_body_dropdown_reserve").html(user_data);
				
			var reserve_all_username="";

			$.each(data.all_reserve,function() {
				reserve_all_username+="<span class=\"bg-warning m-1 p-1 rounded\">"+this.username+"</span>"	;			
			});
			$("#all_reserve_username").html(reserve_all_username);
			
				},
				error:function(data){
					console.log(data);
				}
			});



	
}
show_data_reserve();



function show_data(){
	//var user_data="";
		//console.log(battle_type);

			$.ajax({
				url:"show_data_daily_data",
				type:"POST",
				//async:false,
				data: {
						battle_type:battle_type
				},
				dataType:'json',

			/*	beforeSend:function(){
					var loader_gif="<img src=\"https://i.gifer.com/4V0b.gif\">";
					$("#table_body_dropdown").html(loader_gif);
				},*/
				
				success:function(data){

					//console.log(data);
					
					var new_date="";
					var user_data="";
					var sn=1;
					//window.color_class="";
				$.each(data.data,function(key,value){
					var new_date="";
					$.each(data.reserve,function(key2, value2){
						
						//console.log(value.username+'--'+value2.username);
						if(value.username==value2.username){
							value="";
						}
						
					});

					if(new_date=="found"){
						return;
					}
					
					var con=Object.values(value);
					var inarra=$.inArray("ree", con);
					

					var bg_color="";
					var btn_status="";
					var btn_cursor_type="";
					var down_data="";
			if(this.date!=null){		
				strin=JSON.stringify(this.date);

				var date=strin.substring(1,11);

				var n_date= new Date(date);

				var ne_month= (n_date.getMonth()+1)<10 ? '0'+(n_date.getMonth()+1) : ''+(n_date.getMonth()+1);
				var ne_date= (n_date.getDate())<10 ? '0'+(n_date.getDate()) : ''+(n_date.getDate());
				//var new_date=n_date.toString('dd-MM-yy');
				new_date=ne_date+"-"+ne_month+"-"+n_date.getFullYear();
				//console.log(new_date);


				//get date
				var curr="<?= date('Y-m-d',strtotime('-1 day')); ?>";

						if(date==curr){
							bg_color="#fccbcb";

							//console.log(bg_color);
						}
						else if(date=="<?= date('Y-m-d'); ?>"){
							bg_color="#ff847c";
							btn_status="disabled";
							btn_cursor_type="not-allowed";
						}
					}

				if(this.comment==""){
					comment_db="<div class='text-muted' style=\"margin-bottom:-20px;\">Add Comment</div>";
					comment_color="";
					comment_name_add="";
				}else{
					comment_db="<span class='bg-white rounded p-2 ' style='position:relative; top:10px; box-shadow:-0px 0px 4px grey;' >"+this.comment+"</span>";
					comment_color="bg-warning";
					comment_name_add=this.comment;
				}

				if(battle_type=="image"){
					down_data="<img src=\"<?=base_url('utility/insta_img/"+battle_type+"/"+this.username+"/"+this.file_name+"')?>\" style='height:100px; width:100px;'>";
				}else if (battle_type=="video"){
					down_data="<video width=\"130\" height=\"130\" ><source src=\"<?=base_url('utility/insta_img/"+battle_type+"/"+this.username+"/"+this.file_name+"')?>\"></video>"
				}else if(battle_type=="website"){
					down_data="<img src=\"<?=base_url('utility/insta_img/"+battle_type+"/"+this.username+"/"+this.file_name+"')?>\" style='height:100px; width:100px;'>";
				}

				if(this.star==0||this.star==null){
					star_url=" <img src=\"https://pngimg.com/uploads/star/star_PNG1595.png\" alt=\"\" height=\"15\" class=\"star\" data-star_n=\""+this.star+"\" data-username=\""+this.username+"\">";
				}else{
					star_url=" <img src=\"https://www.freepnglogos.com/uploads/star-png/star-vector-png-transparent-image-pngpix-21.png\" alt=\"\" height=\"20\" class=\"star\" data-star_n=\""+this.star+"\" data-username=\""+this.username+"\">";
				}
				
				//console.log(down_data);
				//console.log(battle_type);
			if(value.username!=undefined){
				user_data+="<tr class='' style='background:"+bg_color+"'>";
				
				user_data+="<td>";
				user_data+=sn;
				user_data+=star_url;
				user_data+="<br>  <input type=\"checkbox\" id=\"reserve_check\" data-sn_reserve=\""+this.sn+"\" data-user_reserve=\""+this.username+"\"><span class=\"text-muted\">Reserve</span>";
				user_data+="</td>";
				
				user_data+="<td id=\"username\">";
				user_data+=" <img src=\"https://cdn4.iconfinder.com/data/icons/wirecons-free-vector-icons/32/menu-alt-512.png\" style=\"height:20px; width:20px; cursor:pointer; \" id=\"battle_file_all_open\" data-battle_type="+battle_type+" data-username="+this.username+"> &nbsp";
				user_data+="<span>@"+value.username+"</span>";
				user_data+="</td>";
				
				user_data+="<td>";
				user_data+=down_data;
				user_data+="</td>";
				
				user_data+="<td class=\""+comment_color+"\">";
				user_data+="<a href='https://instagram.com/"+this.username+"' target='_blank'><img src='https://qph.fs.quoracdn.net/main-qimg-8996d1e3e92f2671d6c83ce7c96f50d3' style='height:30px; widht:30px;'>Account</a><br>";
				
				user_data+="<div class=\"\" style=\"cursor:pointer;\" id=\"comment_toggle\" data-sn=\""+this.sn+"\">"+comment_db+"</div>";
				user_data+="<div id=\"comment_full_"+this.sn+"\" style=\"display:none;\">";
				user_data+="<textarea id=\"comment_textarea_"+this.sn+"\" class=\"mt-4\"></textarea>";
				user_data+="<div class=\"btn btn-sm btn-primary\" id=\"comment_submit\" data-sn_submit=\""+this.sn+"\" style=\"margin-top:-25px; margin-left:2px;\">save</div>";
				user_data+="<div class='' style='margin-top:-10px; cursor:pointer;' id='comment_hide' data-sn=\""+this.sn+"\">Hide</div>"
				user_data+="</div>";
				user_data+="</td>";

				user_data+="<td>";
				//user_data+="<a href=\"<?=base_url('utility/insta_img/"+battle_type+"/"+this.username+"/"+this.file_name+"')?>\" type=\"application/octet-stream\"  download=\""+comment_name_add +"@"+this.username+"\"/>";
				user_data+="<span class=\"text-white mt-3 bg-info p-1\" style=\"\">"+this.upload_date.substring(0,11)+"</span><br>";
				user_data+="<button class=\"btn btn-primary mt-2\" id=\"battle_data_insert\" data-sn=\""+this.sn+"\" data-username=\""+this.username+"\" data-file_name=\""+this.file_name+"\" style=\"cursor:"+btn_cursor_type+";\""+btn_status+">Select</button>";
				//user_data+="</a>";
				user_data+="<div class=\"text-muted mt-3\">"+new_date+"</date>";
				user_data+="</td>";
		
				user_data+="</tr>";
				sn++;
				new_date="";
			}
			});

			$("#table_body_dropdown").html(user_data);
					
				},
				error:function(data){
					console.log(data);
				}
			});



	
}
			
			$(document).on('click','.star',function(){

				star_n=$(this).data('star_n');
				star_username=$(this).data('username');
				
				if(star_n==0||star_n==null){
					star_val=1;
				}else{
					star_val=0;
				}
				$.ajax({
					url:"star_val",
					type:'POST',
					dataType:'json',
					data:{
						username:star_username,
						star:star_val
					},
					success:function(data){
						console.log(data);
						show_data();
						show_data_reserve();
					},
					error:function(data){
						console.log(data);
					}
				});

			});
			

			$(document).on('click','#battle_data_insert', function(){


				var file_name=$(this).data("file_name");
				var id_sn=$(this).attr("data-sn");
				var data_username=$(this).attr("data-username");

				//window.location.href="<?=base_url('utility/insta_img/"+battle_type+"/"+data_username+"/"+file_name+"')?>";
			$.ajax({
					url:"reserve_data",
					type:"POST",
					dataType:"json",
					data:{
						username:data_username,
						//id:reserve_id,
						value:0
					},
					success:function(data){
						//console.log('data');
						/*show_data();
						show_data_reserve();*/


					}
				});			

				approve_battle_data(id_sn,data_username,);

		$.ajax({
			url:'insert_username_unique',
			type:'POST',
			data:{
				username:data_username
			},
			dataType:'json',
			success:function(data){
			//	console.log(data);
			},
			error:function(data){
				//console.log(data);
			}
		});


				
			});

				$(document).on("click","#comment_toggle",function(){
					var sn_comment=$(this).data('sn');
					//console.log(sn_comment);

					$("#comment_full_"+sn_comment).show();
					$("#comment_textarea_"+sn_comment).focus();

				});

				$(document).on("click","#comment_hide",function(){
					var hide_sn=$(this).data("sn");

				$("#comment_full_"+hide_sn).hide();
				});	


			$(document).on("click","#comment_submit",function(){
				var sn_comment_submit=$(this).data("sn_submit");

				var comment_value=$("#comment_textarea_"+sn_comment_submit).val();

				
					
			$.ajax({
				url:"add_comment",
				type:"POST",
				//async:false,
				data: {
						sn:sn_comment_submit,
						comment:comment_value
				},
				dataType:'json',

				success:function(data){
					//console.log(data);
					show_data();
					show_data_reserve();
				}

			});

			});

			//console.log(battle_type);

			$(document).on("click","#reserve_check",function(){

				var reserve_id=$(this).data("sn_reserve");
				var reserve_username=$(this).data("user_reserve");

				if(battle_type=="image"){
					res_val=1;
				}else if(battle_type=="video"){
					res_val=2;
				}else if(battle_type=="website"){
					res_val=3;
				}

				//console.log(reserve_id);
				$.ajax({
					url:"reserve_data",
					type:"POST",
					dataType:"json",
					data:{
						username:reserve_username,
						//id:reserve_id,
						value:res_val
					},
					success:function(data){
						//console.log('data');

						/*setTimeout(show_data,2000);
						setTimeout(show_data_reserve,2000);*/
						show_data();
						show_data_reserve();

					},	
					error:function(data){
						console.log(data);
					}
				});

			});

			$(document).on("click","#unreserve_check",function(){

				var reserve_id=$(this).data("sn_reserve");
				var reserve_username=$(this).data("user_reserve");
				res_val=0;

				//console.log(reserve_id);
				$.ajax({
					url:"reserve_data",
					type:"POST",
					dataType:"json",
					data:{
						username:reserve_username,
						//id:reserve_id,
						value:res_val
					},
					success:function(data){
						//console.log('data');
						show_data();
						show_data_reserve();


					},	
					error:function(data){
						console.log(data);
					}
				});

			});

/*			function check_reserve(username){
				$.ajax({
					url:"chk_reserve",
					type:"POST",
					dataType:"json",
					data:{
						username:reserve_username,
						//id:reserve_id,
						value:1
					},
					success:function(data){
						console.log(data);
					},	
					error:function(data){
						console.log(data);
					}
				});
			}*/


function approve_battle_data(sn,username){
				battle_type=$("#battle_type").val();
				$.ajax({
				url:"approve_battle_data",
				type:"POST",
				async: true,
				data: {
						sn:sn,
						username:username,
						battle_type:battle_type
				},
				dataType:'json',				
				success:function(data){
					show_data();
					show_data_reserve();
				},
				error:function(data){
					console.log(data);
				}
			});
			}


		$(document).on("click","#battle_file_all_open",function(){

			//var img_id=$(this).data('img_id');
			var img_battle_type=$(this).data('battle_type');
			var img_username=$(this).data('username');

			 window.location.href="show_images?user="+img_username+"&&battle_type="+img_battle_type;
		});

$("#special_member_error").hide();
$("#special_member_save").click(function() {
	var special_member_user=$("#special_member_user").val();
	var special_member_message=$("#special_member_message").val();
			if(special_member_user!=""){
				$.ajax({
				url:"save_special_member",
				type:"POST",
				//async: true,
				data: {
						
						username:special_member_user,
						battle_type:battle_type,
						message:special_member_message
				},
				dataType:'json',				
				success:function(data){

					special_member_user=$("#special_member_user").val('');
					special_member_message=$("#special_member_message").val('');
					if(data=true){
						//$("#special_member_error").html("Error Occured");
						$("#special_member_error").hide();
					}
					special_member_load()
				},
				error:function(data){
					$("#special_member_error").html("Error Occured");
					$("#special_member_error").show();
				}
			});
		}else {
			alert("Empty username");
		}

});

function special_member_load(){

			var spe_mem_data="";
				$.ajax({
				url:"show_special_member",
				type:"POST",
				//async: true,
				data: {
						
						
						battle_type:battle_type,
					
				},
				dataType:'json',				
				success:function(data){

				console.log(data);
			$.each(data,function(){
				spe_mem_data+="<tr>";
				spe_mem_data+="<td>"+this.id+"</td>";
				spe_mem_data+="<td>"+this.username+"</td>";
				spe_mem_data+="<td>"+this.message+"</td>";
				spe_mem_data+="</tr>";
			});

			$("#table_special_member").html(spe_mem_data);
				},
				error:function(data){
					console.log(data);
				}
			});
}

special_member_load();
</script>


	</body>
</html>