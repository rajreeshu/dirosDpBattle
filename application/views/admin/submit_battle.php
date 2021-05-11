<!DOCTYPE html>
<html>
<head>
	<title>Submit Battle</title>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="<?=base_url();?>addon/filebody/js/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="<?=base_url();?>utility/js/bootstrap.js"></script>	
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>utility/bootstrap.css">


    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet" />
  
  <style type="text/css">
  	section{
    float:left;
    width:96%;
    background: #fff;  /* fallback for old browsers */
    padding:30px 0;
    background-color:#debf71;
    color:black;
    padding:20px;
}
.width-arrange{
	max-width: 500px;
}
  </style>


</head>

<body>


<section  style="margin-top: 10px; margin-left: 2%;  margin-bottom: 15px;">

<div class="alert alert-primary" role="alert" style="max-width: 250px; padding-top: 10px; padding-bottom: 1px;" >
  <h5>Battle Id:- <?=$battle_id;?></h5>
</div>

<!-- <form method="post" action="<?=base_url();?>admin/set_battle_data?battle_id=<?=$battle_id;?>"> -->
<?php 
	$user1=$data_get_all['user1'];
	$user2=$data_get_all['user2'];


?>

<?php echo form_open_multipart("admin/set_battle_data?battle_id=$battle_id&&user1=$user1&&user2=$user2");?>

<div class="form-group has-danger" style="max-width:500px;">
  <h5>Battle Description.</h5>
  <input type="text" class="form-control border border-dark " id="inputInvalid" placeholder="Battle Description" name="description" value="<?=set_value('description');?>">
  <div class="invalid-feedback">Sorry, that username's taken. Try another?</div>
</div>

<div class="form-group has-danger" style="max-width:500px;">
  <h5>Run Time (In Hrs)</h5>
  <input type="number" class="form-control border border-dark " id="inputInvalid" placeholder="___ Hours" name="run_time" value="<?=set_value('run_time');?>">
  <div class="invalid-feedback">Sorry, that username's taken. Try another?</div>
</div>


<h5>User 1 img <span style="color: maroon;">( <u><?=ucfirst($user1);?></u> )</span> </h5>

        <input type="file" class="form-control-file" id="inputGroupFile02" name="user1">
<br>
 <h5>User 2 img <span style="color: maroon;">( <u><?=ucfirst($user2);?></u> )</span> </h5>
        <input type="file" class="form-control-file" id="inputGroupFile02" name="user2">
        
<p><?php print_r($this->upload->display_errors());?></p>

<input type="Submit" name="submit_save" class="btn btn-info" value="Save battle">
<input type="Submit" name="submit_run" class="btn btn-success" value="Save and Start battle">

</form>
<!-- <img src="../utility/battle-images/20-21.png">
 -->




</section>


<!-- <script>
    $(document).ready(function(){
        $('#inputGroupFile02').change(function(e){
            var fileName = e.target.files[0].name;
            document.getElementById('upload_error_text').innerHTML += fileName;
        //    alert('The file "' + fileName +  '" has been selected.');
        });
    });
</script>
 -->


</body>
</html>