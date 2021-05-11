<!DOCTYPE html>
<html>
<head>
  <title>My Battles</title>
  <script src="<?=base_url();?>addon/filebody/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>utility/js/bootstrap.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>utility/bootstrap.css">
<style type="text/css">

section{
    float:left;
    width:96%;
    background: #fff;  /* fallback for old browsers */
    padding:30px 0;
    background-color:#debf71;
}
h2{
  color:black;
}
</style>
</head>
<body>



<button type="button" class="btn btn-primary btn-lg btn-block" style="width:30%; float:right; margin:20px;" onclick="window.location.href = '<?=base_url();?>admin/set_battle'">Setup Battle</button>

<section style="margin-top: -10px; margin-left: 2%;  margin-bottom: 15px;">
<center>  <h4 style="margin-top: -30px; color: black;">Add Feed Data</h4></center>
  
<form enctype="multipart/form-data" id="insert_form" method="post">
<center>
		<select class="form-control" style="width: 300px;" name="battle_type" id="battle_type">
			<option value="" disabled="true" selected>Battle Type</option>
			<option value="image" >Image</option>
			<option value="video">Video</option>
			
		</select>
</center>

	<div class="container">
		<div class="row">
			<div class="col rounded" style=" padding: 10px;">
				<h2>Select Files</h2>

				<div class="col-4 float-right" id="error_display" style="position:relative; top: -40px;"></div>

				<input type="file" id="file_class1" class="file_class" name="file_upload1" style="margin-top:5px;"> 
					<input type="text" class="mt-2" name="comment1" id="comment1" style="width: 150px;" placeholder="caption on pic1">
					<br><br>
				<input type="file" id="file_class2" class="file_class" name="file_upload2" style="margin-top:5px;">
					<input type="text" class="mt-2" name="comment2" id="comment2" style="width: 150px;" placeholder="caption on pic2">
					<br><br>
				<input type="file" id="file_class3" class="file_class" name="file_upload3" style="margin-top:5px;">
					<input type="text" class="mt-2" name="comment3" id="comment3" style="width: 150px;" placeholder="caption on pic3">
					<br><br>
				<input type="text" placeholder="Input Username" class="form-control" name="insta_username_bubble" id="insta_username_bubble" style="margin-top: 20px; width: 200px; margin-bottom: 15px;">
				<div class="bg-white m-1 rounded" style="width: 30px; height: 30px;  padding-left: 8px; padding-top: 4px; position: relative; left: 200px; top:-50px; cursor: pointer;" id="clear_input">X</div>

				<input type="submit" class="btn btn-primary" name="" id="insert_submit" style="margin-top: -50px;">
			


			</div>
		</div>

		<div class="row">
			<div class="col">

				<div class="progress" id="progress_bar">
				  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
			</div>
			</div>
		</div>

		<div class="row rounded" style="margin-top: 20px; background: #f4f6ff;  padding: 0px;" id="bubble_display">

			
		</div>
	</div>
	</form>
	<div class=" p-3 m-3 rounded" style="background: #d0d0d0;">
		<div id="sug_user" class="row">
			
		</div>
	</div>
  </section>

</body>

<script type="text/javascript">
	
$("#progress_bar").hide();


var accepted_format="";


//battle type

var battle_type=$("#battle_type").val();

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

$(document).on("click",".file_class",function(e){
	//console.log("clicked");
	if(battle_type==null){
		e.preventDefault();

		$("#error_display").html("<span class=\"bg-danger text-white\">Select Battle Type first</span>");
	}else{
		$("#error_display").html("");

	}
});

	$("#clear_input").click(function(){
		$("#insta_username_bubble").val('');
		$("#insta_username_bubble").focus();
		$("#sug_user").html('');
		
	});

		$("#insta_username_bubble").keyup(function() {
			
			user1=$('#insta_username_bubble').val();

			//	console.log(user1);
			if(user1!=''){
				show_sugg(user1);
			}

		});

		function show_sugg(user){
			$.ajax({	
				url: "user_suggest",
				type: 'POST',
				dataType: 'json',
				data: {username: user1},
				success:function(data){
					
					var user_data="";
					$.each(data,function(){
						//user_data+="<div id=\"user1_sug\">";
						user_data+="<div class=\"m-2 p-2 col-4 col-sm-3 col-md-2 rounded \" style=\"background:#eeecda; color:black;\" id=\"sug_user_data\" data-username=\""+this.username+"\">"+this.username+"</div>";
						//user_data+="</div>";

						//console.log(this.username);
						//console.log(user_data);	
						$("#sug_user").html(user_data);
					});

				

				}
			});
		}

		$(document).on('click',"#sug_user_data",function(){
			
			user_insert=$(this).data('username');
			$('#insta_username_bubble').val(user_insert);
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
				url:"<?=base_url('admin/direct_insert_file');?>",
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
					console.log(data.file_one);



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
</html>
