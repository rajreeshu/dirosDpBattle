<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Diros:-Winners</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
	</head>
	<body>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
		
		<!-- html2canvas -->
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

		<?php $this->load->view('insta/header') ;?>

<br>
<h3 class="text-info d-flex justify-content-center">Choose Winners</h3>
	<div class="row">
		<div class="col d-flex justify-content-center ml-5">
			<select class="form-control" style="width: 300px;" id="battle_type">
				
				<option value="image" selected>Dp Battle</option>
				<option value="video">Video Battle</option>
				<option value="website">Website Battle</option>
			</select>
		</div>
	</div>
	<br>
		<!-- today's table -->
		<div class="container bg-light p-2 mb-5">
			
			<table class="table">
				<thead class="thead-dark" >
					<tr>
						<th>username</th>
						
						<th>Image</th>

						<th>Action</th>
						<th>Open Account</th>
						
					</tr>
				</thead>
				<tbody id="table_body_dropdown">
					
					
				</tbody>
			</table>
		</div>
		<!-- table -->


<div class="container rounded">
	<div class="row" style="background: #f7f2e7;">
		<div class="col-6 col-md p-2">
			<h4>Caption</h4>
			
			<textarea rows="10" cols="30" id="caption_text"></textarea>
			

			<div class="btn btn-success btn-sm" id="caption_copy_btn">Copy</div>
		</div>

		<div class="col-7 col-md">
			<h4>Comments</h4>
			
			<textarea rows="10" cols="30" id="comments_text"></textarea>
			

			<div class="btn btn-success btn-sm" id="comments_copy_btn">Copy</div>
		</div>
	</div>
</div>

<!-- square image html2canvas -->
<div id="sqaure_canvas">
	<img id="sqaure_canvas_img">
	<a id="sqaure_canvas_a" download>
</div>
<!-- start square image -->
		<div class="container rounded">
			<div class="m-0 p-0" style="height: 720px; width: 720px;" id="square_frame_post">

			</div>
		</div>



<script type="text/javascript">

$("#header_winner").addClass('active');

	var battle_type=$("#battle_type").val();

	//var btn_action="";
	var bg_col="";
	var btn_color="";


	//var row_bg_col="";

	

	$("#battle_type").on("change",function(){
		battle_type=$("#battle_type").val();
		//console.log(battle_type);
		show_data();
		caption_texts();
		comments_texts();
	});
		function show_data(){
			
			$.ajax({
				type:"POST",
				url:"winner_data_show",
				dataType:"json",
				async:false,
				data:{
						battle_type:battle_type
				},
				
				success:function(data){
					console.log(data);
					var user_data="";
			$.each(data,function(){

				if(this.winner=='true'){
					bg_col='#d0d0d0';
					btn_text="Cancle";
					btn_action="false";
					btn_color="btn-danger";
				}else{
					btn_text="Winner";
					btn_action="true";
					btn_color="btn-primary";
				}
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

				

				user_data+="<tr class=\"\" style=\"background:"+bg_col+"\" id=\"row_target\" data-sn_ch=\""+this.sn+"\">";
				user_data+="<td id=\"username\">";
				user_data+="<div>@"+this.username+"</div>";
				user_data+="<div class=\"text-muted\" data-mute=\"hh\">( "+this.date_time+" )</div>";
				user_data+="</td>";
				user_data+="<td data-img_winner=\""+this.username+"\">";
				user_data+=down_data;
				user_data+="<a href=\""+img_url+"\" download=\"@"+this.username+"\"/>download</a>";
				user_data+=" </td>";
				
				user_data+="<td><div class=\"btn "+btn_color+"\" id=\"winner_approve\" data-sn=\""+this.sn+"\" data-action=\""+btn_action+"\" data-username=\""+this.username+"\">"+btn_text+"</div></td>";

				user_data+="<td><a href='https://instagram.com/"+this.username+"' target='_blank'><img src='https://qph.fs.quoracdn.net/main-qimg-8996d1e3e92f2671d6c83ce7c96f50d3' style='height:30px; widht:30px;'>Account</a></td>";
		
				user_data+="</tr>";

				bg_col="";
				


			});
					
				//$(".text-muted").html("image:");

			$("#table_body_dropdown").html(user_data);

				},
				error:function(data){
					console.log(data);
				}
			});
		}

$('div[data-mute="hh"]').hide();



		$(document).on("click","#winner_approve",function(){
			data_sn=$(this).data('sn');
			data_action=$(this).data('action');
			data_username=$(this).data('username');
			//alert(btn_action);
		//	alert(data_sn);
			$.ajax({
				type:"POST",
				url:"winner_approve",
				dataType:"json",
				data:{
						sn:data_sn,
						action:data_action
				},
				
				success:function(data){
					//console.log(data);
					show_data();
					comments_texts();
				}
			});

			//console.log(data_username);
				//dropdown_ajax(data_username,battle_type);
		
		});


var tagall="";
$.ajax({
	url:'hashtag',
	type:'POST',
	dataType:'json',
	async:false,
	success:function(data){
		var array = $.map(data, function(value, index) {
   	 return [value];
	});

	for(i=0;i<=20;i++){
		rand=array[Math.floor(Math.random()*array.length)];

		tagall=tagall+' '+rand;
	}


	}


});

	




		var caption_text="";

		function caption_texts(){

			if(battle_type=="image"){
				battle="DP Battle's";
				insta_tags=tagall;

			}else if(battle_type=="video"){
				battle="Video Battle's";
				insta_tags=" #video #music #love #instagram #like #tiktok #follow #instagood #youtube #photography #viral #art #videos #likeforlikes #reelitfeelit #diros #dirosdpbattle #dirosreel #dpbattle #dp #model #actress #actor #famous #reels #reel ";
			}else{
				battle=" ";

			}

			caption_text+="🎉🎉🎉🎉 Today's "+battle+" Results.. 🥂🥂🥂\n⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐\n\n";
			caption_text+=insta_tags;

			$("#caption_text").val(caption_text);
			caption_text="";

		}

		caption_texts();


	$("#caption_copy_btn").on('click',function(){
    	$("#caption_text").select();
	    if(document.execCommand('copy')){
	    	alert("Caption Copied");
	    }
	});





		var ccomments_text="";
		var winners_tags="";
		function comments_texts(){
			
			$.ajax({
				type:"POST",
				url:"winners_tags",
				async:false,
				dataType:"json",
				data:{
						battle_type:battle_type
				},
				
				success:function(data){
					//console.log(data);
					$.each(data,function(){
					//	console.log(this.username);
						winners_tags+="@"+this.username + "  ";
					});
				}
			});
			//console.log(winners_tags);

			if(battle_type=="image"){
				battle="DP Battle's";
				

			}else if(battle_type=="video"){
				battle="Video Battle's";
				
			}else{
				battle=" ";

			}

			caption_text+="🎉🎉🎉🎉 Congratss to all the winners..🥳🥳🥳🥳🥳 \n";
			caption_text+=winners_tags;
			caption_text+="\n🥂🥂🥂";

			$("#comments_text").val(caption_text);
			caption_text="";
			winners_tags="";

		}

		comments_texts();


	$("#comments_copy_btn").on('click',function(){
    	$("#comments_text").select();
	    if(document.execCommand('copy')){
	    	alert("comments Copied");
	    }
	});



//function dropdown_ajax(input_dropdown,battle_type_filter){

	//var input_dropdown=$("#insta_username_dropdown").val();
//	console.log(input_dropdown);
//	console.log(battle_type_filter);
/*		var post_square="";
		$.ajax({
				type:"POST",
				async:false,
				url:"ajax_data_dropdown_winner",
				dataType:"json",
				data:{
						input:input_dropdown,
						battle_type_filter:battle_type_filter
				},
				
				success:function(data){
					console.log(data);
					//post_square+="<div id=\"square_frame_post_frame\" style=\"height:720px; width:720px; background:red; display: inline-block; position: relative; margin:0px; padding:0px;\" class=\"m-0 p-0\">";
					post_square+="<img src=\"<?=base_url();?>utility/insta_img/"+battle_type_filter+"/"+data_username+"/"+data.file_name+"\" style=\"\">";
					//post_square+="</div>";
					
					console.log(post_square);
					$('td[data-img_winner="'+input_dropdown+'"]').html("post_square");

					if($('td[data-img_winner="'+input_dropdown+'"]').length){
						alert("exists");
					}else{
						alert("not avail");
					}

					//$("#winner_img"+input_dropdown).html(post_square);
				},
				error:function(data){
					console.log(data);
				}

			});*/

/*	var image="";
	html2canvas(document.querySelector("#square_frame_post")).then(canvas => {
		window.scrollTo(0,0);
   		image = canvas.toDataURL("image/jpg").replace("image/jpg");

   		$("#sqaure_canvas_img").attr("src",image);
		//$("#sqaure_canvas_a").attr('scr',image);
   		$("#programmed_meta_save").click(function(){
   			//console.log(image);
			$(this).attr('href',image);
		});


	});*/
//	}




	
		show_data('');


</script>


	</body>
</html>