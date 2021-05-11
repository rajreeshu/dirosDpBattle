<!DOCTYPE html>
<html lang="en">
	<head>
		
		<title>Diros:-Insert</title>
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
<form enctype="multipart/form-data" id="insert_form" method="post">
<center>
		<select class="form-control" style="width: 300px;" name="battle_type" id="battle_type">
			<option value="" disabled="true" selected>Battle Type</option>
			<option value="image" >Dp Battle</option>
			<option value="video">Video Battle</option>
			<option value="website">Website Battle</option>
		</select>
</center>
		<br>

	<div class="container">
		<div class="row">
			<div class="col rounded" style="background: #ffe4e4; padding: 10px;">
				<h2>Select Files</h2>

				<div class="col-4 float-right" id="error_display" style="position:relative; top: -40px;"></div>

				<input type="file" id="file_class1" class="file_class" name="file_upload1" style="margin-top:5px;"> 
					<input type="text" class="mt-2" name="comment1" id="comment1" style="width: 150px;" placeholder="comment on pic1">
					<br><br>
				<input type="file" id="file_class2" class="file_class" name="file_upload2" style="margin-top:5px;">
					<input type="text" class="mt-2" name="comment2" id="comment2" style="width: 150px;" placeholder="comment on pic2">
					<br><br>
				<input type="file" id="file_class3" class="file_class" name="file_upload3" style="margin-top:5px;">
					<input type="text" class="mt-2" name="comment3" id="comment3" style="width: 150px;" placeholder="comment on pic3">
					<br><br>
				<input type="text" placeholder="Input Username" class="form-control" name="insta_username_bubble" id="insta_username_bubble" style="margin-top: 20px; width: 200px; margin-bottom: 15px;">
				<div class="bg-white m-1 rounded" style="width: 30px; height: 30px;  padding-left: 8px; padding-top: 4px; position: relative; left: 200px; top:-50px; cursor: pointer;" id="clear_input">X</div>

				<input type="submit" class="btn btn-primary" name="" id="insert_submit" style="margin-top: -50px;">
			


			</div>
		</div>

		<div class="row">
			<div class="col">
				<!-- <div class="progress">
					<div class="prgress-bar" role="progresbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
				</div> -->
				<div class="progress" id="progress_bar">
				  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
			</div>
			</div>
		</div>

		<div class="row rounded" style="margin-top: 20px; background: #f4f6ff;  padding: 0px;" id="bubble_display">
		<!-- 	<div class="col-4 col-sm-3 col-md-2"  style="height: 30px; border-radius: 30px; background: #f5f1da; margin: 10px;">@rajreeshu</div>
		<div class="col-4 col-sm-3 col-md-2"  style="height: 30px; border-radius: 30px; background: #f5f1da; margin: 10px;">@rajreeshu</div>
		<div class="col-4 col-sm-3 col-md-2"  style="height: 30px; border-radius: 30px; background: #f5f1da; margin: 10px;">@rajreeshu</div>
		<div class="col-4 col-sm-3 col-md-2"  style="height: 30px; border-radius: 30px; background: #f5f1da; margin: 10px;">@rajreeshu</div>
		<div class="col-4 col-sm-3 col-md-2"  style="height: 30px; border-radius: 30px; background: #f5f1da; margin: 10px;">@rajreeshu</div>
		<div class="col-4 col-sm-3 col-md-2"  style="height: 30px; border-radius: 30px; background: #f5f1da; margin: 10px;">@rajreeshu</div> -->
				
			
		</div>
	</div>
	</form>


	


<script type="text/javascript">

$("#header_insert").addClass('active');

$("#progress_bar").hide();


var accepted_format="";

var error_no ="1";	


//battle type

	var battle_type=$("#battle_type").val();

$(document).on("click",".file_class",function(e){

	if(battle_type==null){
		e.preventDefault();

		$("#error_display").html("<span class=\"bg-danger text-white\">Select Battle Type first</span>");
	}else{
		$("#error_display").html("");

	}
});

	$( "#insta_username_bubble" ).on( "keyup", function(event) {
   		dropdown_ajax();
   	});	


   	$("#battle_type").on("change",function(){



		battle_type=$("#battle_type").val();

		if(battle_type=="image"){
			accepted_format="image/*";
		}else if(battle_type=="video"){
			accepted_format="video/*";
		}else if(battle_type=="website"){
			accepted_format="image/*";
		}


		$(".file_class").attr("accept",accepted_format);
		
	});


//username dropdown
	function dropdown_ajax(){

	var input_dropdown=$("#insta_username_bubble").val();
		if(input_dropdown!=""){
		$.ajax({
				type:"POST",
				url:"ajax_data_bubble",
				dataType:"json",
				data:{
						input:input_dropdown
				},
				
				success:function(data){
					//console.log(data);
					data_arrange_bubble(data);
				},
				error:function(data){
					console.log(data);
				}

			});
	}else{
		$("#bubble_display").html("");
	}

	}

	function data_arrange_bubble(data){
		bubble_data="";
		$.each(data,function(){
			bubble_data+="<div class=\"col-4 col-sm-3 col-md-2\"  style=\"height: 30px; border-radius: 30px; background: #f5f1da; margin: 10px; border:1px solid grey; cursor:pointer;\" onclick=\"set_input('"+this.username+"')\">@"+this.username+"</div>";
		});
		$("#bubble_display").html(bubble_data);
	}


	function set_input(data){
			
		$("#insta_username_bubble").val(data);
		$("#insta_username_bubble").focus();

		dropdown_ajax();
	}

	$("#clear_input").click(function(){
		$("#insta_username_bubble").val('');
		$("#insta_username_bubble").focus();

		dropdown_ajax();
	});



	$("#insert_form").submit(function(e){
		e.preventDefault();

		error_no="1";
		
		battle_type=$("#battle_type").val();
		username_insert=$("#insta_username_bubble").val();

		var file_class1=$("#file_class1").val();
		var file_class2=$("#file_class2").val();
		var file_class3=$("#file_class3").val();


		//console.log(file_class);
		

	if(battle_type!=null&&username_insert!=''){


		if(file_class1!=""||file_class2!=""||file_class3!=""){
		

		$.ajax({
			url:'insert_username_unique',
			type:'POST',
			data:{
				username:username_insert
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
				url:"direct_insert_file",
				type:"POST",
				data: new FormData(this),
				dataType:"json",
				processData:false,
				contentType:false,

				beforeSend:function(){
					$("#progress_bar").show();
				},

				success:function(data){
					if(file_class1!=""&&data.file_one=='success'){
						success_notify();
						error_no++;
					}else if(file_class1!=""&&data.file_one=='failed'){
						fail_notify();
						error_no++;
					}else{
						error_no++;
					}

					if(file_class2!=""&&data.file_two=='success'){
						success_notify();
						error_no++;
					}else if(file_class2!=""&&data.file_two=='failed'){
						fail_notify();error_no++;
					}else{
						error_no++;
					}

					if(file_class3!=""&&data.file_three=='success'){
						success_notify();
						error_no++;
					}else if(file_class3!=""&&data.file_three=='failed'){
						fail_notify();
						error_no++;
					}else{
						error_no++;
					}

					//console.log(typeof data);
					console.log(data);



					//console.log(data);
				},
				error:function(data){
					console.log(data);
				}
			});
		}else{
			//$("#error_display").addClass('bg-danger');
			//$("#error_display").addClass('text-white');
			$("#error_display").html("<span class=\"bg-danger text-white\">Select atleast one file</span>");
		}
	}else{
		//$("#error_display").addClass('bg-danger');
		//$("#error_display").addClass('text-white');
		$("#error_display").html("<span class=\"bg-danger text-white\">Fill Both Battle Type and Username field</span>");
	}
});
	

function success_notify(){

					$("#error_display").append("<span class=\"bg-success text-white\">"+error_no+". Files Uploaded Successfully</span><br>");
					$("#progress_bar").hide();
					$(".file_class").val("");
					$("#insta_username_bubble").val("");
					
}		

function fail_notify(){

					$("#error_display").append("<span class=\"bg-danger text-white\">"+error_no+". Uploading failed please check<br>");
					$("#progress_bar").hide();
					$(".file_class").val("");
					$("#insta_username_bubble").val("");			
}



</script>


	</body>
</html>