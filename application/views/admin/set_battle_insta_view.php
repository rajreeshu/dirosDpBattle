<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Set Battle Insta</title>



		<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>

	<script src="<?=base_url();?>utility/js/bootstrap.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
	
<div class="container" style="margin-top: 20px;">
	
	<form method="post" action="set_battle_data_insta">
		<input type="text" class=" form-control col-10 col-md-6" name="user1" id="user1" placeholder="user1"><br>
		<input type="text" class=" form-control col-10 col-md-6" name="user2" id="user2" placeholder="user2"><br>
		<input type="submit" class="btn btn-success" name="" id="submit_battle" value="submit">
	</form>

	<div class=" p-3 m-3 rounded" style="background: #d0d0d0;">
		<div id="sug_user" class="row">
			
		</div>
	</div>
</div>
</body>

<script type="text/javascript">
	
	$(document).ready(function() {
	

		var focus_inp="";

		$("#user1").click(function() {
			focus_inp="#user1";
		});

		$("#user2").click(function() {
			focus_inp="#user2";
		});	

		
		$("#user1").keyup(function() {
			
			user1=$('#user1').val();

			console.log(user1);
			if(user1!=''){
				show_sugg(user1);
			}
		});

		$("#user2").keyup(function() {
			
			user1=$('#user2').val();

				console.log(user1);
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
						user_data+="<div class=\"m-2 p-2 col-4 col-sm-3 col-md-2 rounded\" style=\"background:#eeecda;\" id=\"sug_user_data\" data-username=\""+this.username+"\">"+this.username+"</div>";
						//user_data+="</div>";

						//console.log(this.username);
						//console.log(user_data);	
						$("#sug_user").html(user_data);
					});

				

				}
			});
		}

		

		$(document).on('click',"#sug_user_data",function(){
			foc=$("#user1").is(":focus");
			user_insert=$(this).data('username');
			$(focus_inp).val(user_insert);
		});

	});


</script>

</html>