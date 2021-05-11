<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Diros Insta</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<script data-ad-client="ca-pub-7995590310420241" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	</head>
	<body>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
		
		<?php $this->load->view('insta/header') ;?>

		<div class="form-check rounded m-3 p-3" style="background: #ff847c;">
			
			<div class="col-4" id="error_display"></div>
			
			
			<div class="row" style="margin:5px;">
				<div class="col-8 col-md-4 col-lg-3" style=" padding: 5px; margin:5px; padding-right: 40px;" >
					<input type="text" placeholder="InstaUsername" class="form-control"  id="insta_username_dropdown">
					<div class="bg-white m-1 rounded" style="width: 30px; height: 30px; float: right; padding-left: 8px; padding-top: 4px; position: relative; left: 40px; top:-38px; cursor: pointer;" id="clear_input">X</div>
				</div>
				
				<div class="col-2" style="margin-top: 0px;">
					<select id="battle_type">
						<option selected="true" >Battle Type</option>
						<option value="image">DP Battle</option>
						<option value="video">Video Battle</option>
						<option value="website">Website Battle</option>
					</select>
				</div>
				<div class="col-2">
					<input type="submit" value="Add Battle" name="" class="btn btn-primary shadow" id="submit">
				</div>

				<div class="col-5 col-md-2" style="margin-top: 0px; margin-left: 100px;">
					<select id="battle_type_filter">
						<option selected="true" disabled="true" >Filter (All)</option>
						<option value="image">DP Battle</option>
						<option value="video">Video Battle</option>
						<option value="website">Website Battle</option>
					</select>
				</div>
			</div>
			
		</div>
		<br>
		<!-- today's table -->
		<div class="container bg-light p-2 mb-5">
			<center>Today's List</center>
			<table class="table">
				<thead class="thead-dark" >
					<tr>
						<th>username</th>
						<th>Last Battle Date</th>
						<th>Battle Type</th>
						
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="today_table_body_dropdown">
					
					
				</tbody>
			</table>
		</div>
		<!-- table -->
		
		<div class="container bg-light p-2 mb-5">
			<center>Complete List</center>
			<table class="table">
				<thead class="thead-dark" >
					<tr>
						<th>username</th>
						<th>Last Battle Date</th>
						<th>Battle Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="table_body_dropdown">
					
					
				</tbody>
			</table>
		</div>

<!-- <?php
echo date('d-m-Y H:i',strtotime("2020-07-24 06:17:58")) ;

?> -->

<script type="text/javascript">

	//var key="<?php echo $this->security->get_csrf_hash(); ?>";
	$("#header_home").addClass('active');




		var battle_type="";
		$("#battle_type").on("change",function(){
			battle_type=$("#battle_type").val();
		
		});

		var battle_type_filter="";

		$("#battle_type_filter").on("change",function(){
			battle_type_filter=$("#battle_type_filter").val();
			dropdown_ajax();

		
		});
		


		$("#submit").click(function(){

			event.preventDefault();

			var username=$("#insta_username_dropdown").val();
			
			battle_last_date_validate(username);

		});
		

		$( "#insta_username_dropdown" ).on( "keydown", function(event) {
      		if(event.which == 13){ 
      			event.preventDefault();
         	var username=$("#insta_username_dropdown").val();
			
			battle_last_date_validate(username);
		}
    	});

    	$( "#battle_type" ).on( "keydown", function(event) {
      		if(event.which == 13){ 
      			event.preventDefault();
         	var username=$("#insta_username_dropdown").val();
			
			battle_last_date_validate(username);
		}
    	});


		function battle_last_date_validate(username){

			$.ajax({
				type:"POST",
				url:"check_last_battle_date",
				dataType:"json",
				data:{
						username:username
				},
				
				success:function(data){

			if(data!=null){
					

					strin=JSON.stringify(data.date_time);

				var date=strin.substring(1,11);


//get date
				var curr="<?= $data['current']=date('Y-m-d'); ?>";


				if(date==curr){
					
					alert("today's battle is Already Registered");
				}else{

					add_username(username);
				}
				

			}else{
	
				add_username(username);
			//	$("#error_display").html("");

			}

				},
				error:function(data){
					console.log(username);
				}

			});
		} 


		function add_username(username){
			if(username!=''&&battle_type!=''){
			
			$("#error_display").html("");

		$.ajax({
			url:'insert_username_unique',
			type:'POST',
			data:{
				username:username
			},
			dataType:'json',
			success:function(data){
			//	console.log(data);
			},
			error:function(data){
				//console.log(data);
			}
		});

			$.ajax({
				type:"POST",
				url:"insert_username",
				dataType:"json",
				data:{
						username:username,
						battle_type:battle_type
						
					},
				
				success:function(data){
					$("#error_display").removeClass('bg-danger');
					$("#error_display").addClass('bg-success');
					$("#error_display").html("Data Inserted");

					$("#insta_username_dropdown").val("");

					dropdown_ajax();

					$("#insta_username_dropdown").focus();
		


				},
				error:function(data){
					console.log(data);
					$("#error_display").removeClass('bg-success');
					$("#error_display").removeClass('bg-danger');
					$("#error_display").addClass('bg-warning');
					$("#error_display").html("Data Input Failed");
				}
			});
		}else{
			$("#error_display").addClass('bg-danger');
			$("#error_display").html("Fill all the fields");

			$("#insta_username_dropdown").focus();
		}
		}

$("#insta_username_dropdown").on('keyup',function(event){

if(event.which != 13){ 
	dropdown_ajax();
}

	//dropdown_ajax(input_dropdown)
//	console.log(input_dropdown);
	

});





function dropdown_ajax(){

	var input_dropdown=$("#insta_username_dropdown").val();

	console.log(battle_type_filter);

			$.ajax({
				type:"POST",
				url:"ajax_data_dropdown",
				dataType:"json",
				data:{
						input:input_dropdown,
						battle_type_filter:battle_type_filter
				},
				
				success:function(data){
					console.log(data);
					
					data_arrange_table_dropdown(data.data,data.website);
				},
				error:function(data){
					console.log(data);
				}

			});


//today register check
if(input_dropdown!=""){
			$.ajax({
				type:"POST",
				url:"check_last_battle_date",
				dataType:"json",
				data:{
						username:input_dropdown
				},
				
				success:function(data){

			if(data!=null){
					

				strin=JSON.stringify(data.date_time);

				var date=strin.substring(1,11);


//get date
				var curr="<?= $data['current']=date('Y-m-d'); ?>";


				if(date==curr){
					
					$("#error_display").addClass('bg-warning');
					$("#error_display").html("Already Registered For Today's Battle")
				}

			}else{
				$("#error_display").html("");
			}


				},
				error:function(data){
					
				}

			});
		}else{
			$("#error_display").html("");
		}

}



		function data_arrange_table_dropdown(data,website){
			var user_data='';
			//console.log(data);
			var i=1;
			//console.log(datavalue);
			$.each(data,function(datakey,datavalue){
			
			


				strin=JSON.stringify(this.date_time);

				var date=strin.substring(1,11);


//get date
				var curr="<?= $data['current']=date('Y-m-d',strtotime('-1 day')); ?>";

				

				var row_color="";
				if(date==curr){
					row_color="#fccbcb";
				}

			commnet_bg_color="";
			if(this.comment){
				commnet_bg_color="bg-warning"
			}
			

//show data

			if(date!="<?= $data['current']=date('Y-m-d'); ?>"){


				user_data+="<tr id=\"com_data_row\" style=\"background:"+row_color+";\">";


				user_data+="<td>";

				user_data+=i+" <img src=\"https://cdn4.iconfinder.com/data/icons/wirecons-free-vector-icons/32/menu-alt-512.png\" style=\"height:15px; width:15px; cursor:pointer; \" id=\"battle_file_all_open\" data-battle_type="+this.battle_type+" data-username="+this.username+"> &nbsp &nbsp ";

				user_data+="<span onClick='set_input(\""+this.username+"\")'>@"+this.username+"</span></td>";
				
			//	user_data+="<td>"+this.date_time+"</td>";

				user_data+="<td class=\""+commnet_bg_color+"\">"+this.date_time+"<br>	<span style=\"background:white; box-shadow:3px 3px 3px grey; max-width\">"+this.comment+"</span></td>";
				
				user_data+="<td>";
				user_data+=this.battle_type;

				if(this.img_id==0){
					
					display_img_d="none";
					 img_url="";
				}else{
					display_img_d="inline-block";
					img_url="<?=base_url();?>utility/insta_img/"+this.battle_type+"/"+this.username+"/"+this.file_name;
				}

				if(this.battle_type=="image"){
					down_data="<img src=\""+img_url+"\" style=\"height:60px; width:60px;  cursor:pointer; display:"+display_img_d+"\" id=\"battle_file_download\">";

				}else if (this.battle_type=="video"){
					down_data="<video style=\"widht:50px; height:50px; background:#d0d0d0  cursor:pointer; display:"+display_img_d+";\"  id=\"battle_video_download\"><source src=\""+img_url+"\"></video>"
				}else if(this.battle_type=="website"){
					down_data="<img src=\""+img_url+"\" style=\"height:60px; width:60px;  cursor:pointer; display:"+display_img_d+"\" id=\"battle_file_download\">";
				}

				user_data+=down_data;
				//console.log(this.battle_type);
				user_data+="<a href=\""+img_url+"\" download=\""+this.comment +"@"+this.username+"\"/>download</a>";

				//user_data+=" <img src='"+img_url+"' style=\"height:50px; width:50px; cursor:pointer; display:"+display_img_d+";\" id=\"battle_file_download\">";

				user_data+="</td>";
				
				user_data+="<td><div class='btn btn-success' id=\"dropdown_delete\" onclick='battle_last_date_validate(\""+this.username+"\")'>Add</div></td>";
			//	user_data+="<td><div class='btn btn-danger' id=\"dropdown_add\" onclick='delete_data("+this.sn+")'>Delete</div></td>";


				user_data+="</tr>";

			}
			i++;
			var img_url="";

			});


			$("#table_body_dropdown").html(user_data);


			var user_data_today='';
			var i=1;

			$.each(data,function(key,value){

				var img_url="";
				strin=JSON.stringify(this.date_time);

				var date=strin.substring(1,11);

//console.log(datavalue.username);
			
				website_username_avail=0;
				$.each(website,function(webkey,webvalue){
					
					if(value.username==webvalue.username){
						website_username_avail=1;
						
					}
				});

				//console.log(datavalue.username+"=="+website_username_avail);

			web_user_avail="";
			

				if(website_username_avail==1){
					web_user_avail="<a href=\"../admin/set_battle_insta\"><div style=\"color:green;\">Account available</div></a>";
				}else{
					web_user_avail="<div style=\"color:red;\"><a href=\"<?=base_url('admin/register');?>?insta_user="+this.username+"\" target=\"_blank\"> Create Account</a></div>";
				}
		//	}	
			//console.log(web_user_avail);



//get date
				var curr="<?= $data['current']=date('Y-m-d'); ?>";
				var display_img_d="";
				
				commnet_bg_color="";
			if(this.comment){
				commnet_bg_color="bg-warning"
			}
				//
				if(date==curr){

				user_data_today+="<tr>";

				user_data_today+="<td><span style='margin-top:10px;'>"+i+"&nbsp &nbsp</span>";
				
				user_data_today+=" <img src=\"https://cdn4.iconfinder.com/data/icons/wirecons-free-vector-icons/32/menu-alt-512.png\" style=\"height:15px; width:15px; cursor:pointer; \" id=\"battle_file_all_open\" data-battle_type="+this.battle_type+" data-username="+this.username+"> &nbsp &nbsp ";

				user_data_today+="<span onClick='set_input(\""+this.username+"\")'>@"+this.username+"</span></td>";
				
			//	user_data+="<td>"+this.date_time+"</td>";

				user_data_today+="<td class=\""+commnet_bg_color+"\">"+this.date_time+"<a href=\"https://instagram.com/"+this.username+"\" target=\"_blank\"> Insta</a><br>	<span style=\"background:white; box-shadow:3px 3px 3px grey; max-width\">"+this.comment+"</span></td>";
				
				user_data_today+="<td>";

				user_data_today+=this.battle_type;
				
				if(this.img_id==0){
					
					display_img_d="none";
					img_url="";
				}else{
					display_img_d="inline-block";
					img_url="<?=base_url();?>utility/insta_img/"+value.battle_type+"/"+value.username+"/"+value.file_name;
				}

				if(this.battle_type=="image"){
					down_data="<img src=\""+img_url+"\" style=\"height:60px; width:60px; cursor:pointer; display:"+display_img_d+"\" id=\"battle_file_download\">";
				}else if (this.battle_type=="video"){
					down_data="<video style=\"widht:50px; height:50px; background:#d0d0d0  cursor:pointer; display:"+display_img_d+";\"  id=\"battle_video_download\"><source src=\""+img_url+"\"></video>"
				}else if(this.battle_type=="website"){
					down_data="<img src=\""+img_url+"\" style=\"height:60px; width:60px; cursor:pointer; display:"+display_img_d+"\" id=\"battle_file_download\">";
				}

				user_data_today+=down_data;

				user_data_today+="<a href=\""+img_url+"\" download=\""+this.comment +"@"+this.username+"\"/>download</a>";
				//console.log(web_user_avail);
			if(this.battle_type=="website"){
				user_data_today+=web_user_avail;
			}
				//console.log(down_data);
				//user_data_today+=" <img src='"+img_url+"' style=\"height:50px; width:50px; cursor:pointer; display:"+display_img_d+";\" id=\"battle_file_download\">";

				user_data_today+="</td>";
				
				user_data_today+="<td><div class='btn btn-danger' id=\"dropdown_add\" onclick='del_data_check("+this.sn+")'>Delete</div></td>";

				user_data_today+="</tr>";
			}
			i++;

		 img_url=" ";

			});

			if(user_data_today==''){
					user_data_today="<div class='text-muted'>Empty for for Today's battle</div>";
				}

			$("#today_table_body_dropdown").html(user_data_today);
		}

		$(document).on('click','#battle_file_download', function(){
			
			$(this).css('height','100px');
			$(this).css('width','100px');
			//$(this).css('marginBottom','-30px');
			
		});

		$(document).on('click','#battle_video_download', function(){
			
			$(this).css('height','130px');
			$(this).css('width','130px');

			$(this).attr('controls','');
			//$(this).css('marginBottom','-30px');
			
		});


		$(document).on("click","#battle_file_all_open",function(){

			//var img_id=$(this).data('img_id');
			var img_battle_type=$(this).data('battle_type');
			var img_username=$(this).data('username');

			 window.location.href="show_images?user="+img_username+"&&battle_type="+img_battle_type;
		});

			function del_data_check(sn){
				if(confirm("are you sure want to delete")){
					delete_data(sn);
				}
				
			}


			function delete_data(sn){
			//	console.log(sn);
				$.ajax({
				type:"POST",
				url:"ajax_data_delete",
				dataType:"json",
				data:{
						sn:sn
				},
				
				success:function(data){
					//console.log(data);
					dropdown_ajax();

					$("#error_display").html('');
					$("#error_display").removeClass('bg-success');
					$("#error_display").removeClass('bg-warning');
					$("#error_display").addClass('bg-danger');
					$("#error_display").html("Data Deleted");


				},
				error:function(data){
					console.log(data);
				}

			});


			}

			function set_input(data){
			
				$("#insta_username_dropdown").val(data);
				$("#insta_username_dropdown").focus();


				dropdown_ajax();
			}

	$("#clear_input").click(function(){
		$("#insta_username_dropdown").val('');
		$("#insta_username_dropdown").focus();

		dropdown_ajax();
	});

	dropdown_ajax();

</script>



	</body>
</html>