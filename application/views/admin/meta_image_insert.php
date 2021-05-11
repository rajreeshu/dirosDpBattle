<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Meta Data Set</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<!-- html2canvas -->
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
</head>
<body style="padding-bottom: 50px;">

	<div class="alert alert-primary col-11 col-md-6 col-sm-8 m-3">Battle Id:-<?=$_GET['battle_id'];?> </div>
	<a href="<?=base_url().'home?battle_id='.$_GET['battle_id'];?>" class="col-6 col-md-4 alert alert-danger m-4">Battle Link (click)</a>
	<div class="col-6 m-2 p-3 mt-3 rounded" style="background: #f6f5f5">
		<h2 class="text-info">Insert Meta Image</h2>
	<form enctype="multipart/form-data" method="post" id="meta_form">
		<input type="file" id="meta_img" name="meta_img" class="col-6 mt-2 mb-2" ><br>
		<input type="hidden" class="" id="battle_id" name="battle_id" value="<?=$_GET['battle_id'];?>">
		<input type="submit" value="submit" class="btn btn-success ml-3">
	</form>
	</div>



<h3 style="margin-left: 30px; margin-top: 30px;">Saved Frame (Will be Displayed)</h3>
<img id="canvas_present" class="ml-4" style="width: 300px; background: #d0d0d0;"><br>



<h3 style="margin-left: 30px; margin-top: 30px;">Created Image (save it)</h3>
<img id="canvas_present_display" class="ml-4" style="width: 300px; background: #d0d0d0;"><br>
<a id="programmed_meta_save" class="btn btn-success mt-1 ml-4" style="color: white;" download>download image</a>

<br>
<br>
<br>

<div style="opacity: 1">
<h3 style="margin-left: 30px;">Programmed Frame (take screenshot)</h3>
<div id="meta_img_frame" style="height: 300px; width: 300px; background: linear-gradient( rgb(255,29,29,0.7), rgb(255,48,108,0.7),rgb(193,53,132,0.7),rgb(131,58,180,0.7),rgb(88,81,219,0.7),rgb(64,93,230,0.7)); margin-left:30px; ">
	
	<img src="<?=base_url('utility/battle-images/');?><?=$img_data[0]->img_name;?>" id="user_img_1" class="mx-1" style="width:138px;  max-height:150px;  margin-top:50px;">
	<span style="position: absolute; left:130px; margin-top: 70px;color: red; font-size: 70px; z-index: 10; -webkit-text-stroke:1px black; text-shadow: 0px 0px 8px yellow;">v/s</span>
	<img src="<?=base_url('utility/battle-images/');?><?=$img_data[1]->img_name;?>" id="user_img_1" class="mx-1" style="width:138px;  max-height:150px;  margin-top:50px;">

</div>
</div>



<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<?php
$battle_id=$_GET['battle_id'];

//base_url('admin/start_battle_direct?battle_id='+$battle_id);
?>
<script type="text/javascript">


		$("#meta_form").submit(function(e){
			e.preventDefault();
			battle_id="<?=$_GET['battle_id'];?>"
			//console.log(new FormData(this));
			$.ajax({
				type:"POST",
				url:"<?=base_url().'admin/meta_send';?>",
				dataType:"json",
				data: new FormData(this),
				processData:false,
				contentType:false,

				success:function(data){
					console.log(data);
					saved_meta_load();	

					alert("data input "+data);
					$("#meta_img").val(null);
					
				},
				error:function(data){
					console.log(data);
					$("#meta_img").val(null);
				}
			});
		});

			var image="";
			html2canvas(document.querySelector("#meta_img_frame")).then(canvas => {
				window.scrollTo(0,0);
   			image = canvas.toDataURL("image/jpg").replace("image/jpg");

   			$("#canvas_present_display").attr("src",image);


   		$("#programmed_meta_save").click(function(){
   			//console.log(image);
			$(this).attr('href',image);
		});	


		});

	function saved_meta_load(){

			$.ajax({
				type:"POST",
				url:"canvas_get_img",
				dataType:"json",
				data: {
					id:<?= $_GET['battle_id'];?>,
				},

				success:function(data){
					console.log(data);
					$("#canvas_present").attr('src',data.url);
					$("#uploaded_meta_del").css("display",data.display);
					
				},
				error:function(data){
					console.log(data);
				
				}
			});

		}




		saved_meta_load();	




	</script>
</body>
</html>