<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Diros Insta</title>
		    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	</head>
	<body>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

		<br><br>
		<center>
		<div class="form-check rounded m-3 p-3" style="background: #ff847c;">
			

			<div class="col-4" id="error_display"></div>
			

			<form >
				<div class="row" style="margin:5px;">
					<div class="col-4" style=" padding: 5px; margin:5px;">
						<input type="text" placeholder="InstaUsername" class="form-control" name="username" id="insta_username">
					</div>
					<div class="col-1 bg-light rounded" style="border: 1px solid grey; padding: 5px; margin:5px;">
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" value="DP Battle" name="battle_type" class="form-check-input">
								DP Battle
							</label>
						</div>
						
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" value="Reel Battle" name="battle_type" class="">
								
								Reel Battle
							</label>
						</div>
					</div>
					<div class="col-3 col-md-1 bg-light rounded" style="border: 1px solid grey; padding: 5px; margin:5px;">
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" value="DP Battle" name="result" class="form-check-input">
								Winner
							</label>
						</div>
						
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" value="Reel Battle" name="result" class="">
								Looser
							</label>
						</div>
					</div>
					<div class="col-1">
						<input type="submit" value="Add Battle" name="" class="btn btn-primary shadow" id="submit">
					</div>
				</div>
			</form>
		</div>
		</center>
		<br>
		<!-- table -->
		<div class="container">
			<table class="table">
				<thead class="thead-dark" >
					<tr>
						<th>username</th>
						<th>DP battle</th>
						<th>Reel battle</th>
						<th>Total battle</th>
					</tr>
				</thead>
				<tbody id="table_body">
					
						<td>@rajreeshu</td>
						<td>1</td>
						<td>4</td>
						<td>5</td>
					</tr>
					<tr>
						<td>@rajreeshu</td>
						<td>1</td>
						<td>4</td>
						<td>5</td>
					</tr>
				</tbody>
			</table>
		</div>


<script type="text/javascript">

	//var key="<?php echo $this->security->get_csrf_hash(); ?>";
	
	$(document).ready(function(){
		
		$("#submit").click(function(){

			event.preventDefault();

			var username=$("#insta_username").val();
			battle_type=$('input[name="battle_type"]:checked').val();
			result=$('input[name="result"]:checked').val();
			

			/*if(battle_type==undefined){

				alert('check type'+'username='+username);

			}*/
			
		if(username!=''&&battle_type!=undefined&&result!=undefined){
			$("#error_display").removeClass('bg-danger');
			$("#error_display").addClass('bg-success');
			$("#error_display").html("Data Inserted");
			

			$.ajax({
				type:"POST",
				url:"<?=base_url('insta/submit_data')?>",
				dataType:"json",
				data:{
						username:username,
						battle_type:battle_type,
						result:result

					//	<?php echo $this->security->get_csrf_token_name(); ?>: key
					},
				
				success:function(data){
					console.log(data);

				},
				error:function(data){
					$("#error_display").removeClass('bg-success');
					$("#error_display").removeClass('bg-danger');
					$("#error_display").addClass('bg-warning');
					$("#error_display").html("Data Input Failed");
				}
			});
		}else{
			$("#error_display").addClass('bg-danger');
			$("#error_display").html("Fill all the fields");
		}

		});

		$.ajax({
				type:"GET",
				url:"<?=base_url('insta/get_data')?>",
				dataType:"json",
				
				
				success:function(data){
					
					data_arrange_table(data);
				},
				error:function(data){
					console.log(data);
				}

			});

		function data_arrange_table(data){
			var user_data='';
			console.log(data);
			
			$.each(JSON.parse(data),function(key,value){
				user_data+="<tr>";
				user_data+="<td></td>";

				user_data+="</tr>";
			});

			$("#table_body").html(user_data);
		}
		

	});


</script>



	</body>
</html>