<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Diros Insta</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<script data-ad-client="ca-pub-7995590310420241" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	</head>
	<body>
		<?php $this->load->view('insta/header') ;?>
			
			<div class="container pt-3">
				<h2>Website Battle Stats</h2>
				<table class="table">
				<thead class="thead-dark" >
					<tr>
						<th>username</th>
						<th>Last Battle Date</th>
						<th>Battle Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="table_body">
					
					
				</tbody>
			</table>
			</div>
	</body>

	<script type="text/javascript">
		$(document).ready(function(){

			$.ajax({
				type:"POST",
				url:"website_stats",
				dataType:"json",
				data:{
						username:'input_dropdown'
				},
				
				success:function(data){
					console.log(data);
				},
				error:function(data){
					console.log(data);
				}
				});	

		});
	</script>

	</html>

		