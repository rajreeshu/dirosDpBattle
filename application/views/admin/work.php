<!DOCTYPE html>
<html>
<head>
	<title>Set Battle-Admin</title>


	<script src="<?=base_url();?>addon/filebody/js/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="<?=base_url();?>utility/js/bootstrap.js"></script>	
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>utility/bootstrap.css">


    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet" />
  

<style type="text/css">

.checkbox {
  padding-left: 20px;
}
.checkbox label {
  display: inline-block;
  vertical-align: middle;
  position: relative;
  padding-left: 5px;
}
.checkbox label::before {
  content: "";
  display: inline-block;
  position: absolute;
  width: 17px;
  height: 17px;
  left: 0;
  margin-left: -20px;
  border: 1px solid #cccccc;
  border-radius: 3px;
  background-color: #fff;
  -webkit-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
  -o-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
  transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
}
.checkbox label::after {
  display: inline-block;
  position: absolute;
  width: 16px;
  height: 16px;
  left: 0;
  top: 0;
  margin-left: -20px;
  padding-left: 3px;
  padding-top: 1px;
  font-size: 11px;
  color: #555555;
}
.checkbox input[type="checkbox"],
.checkbox input[type="radio"] {
  opacity: 0;
  z-index: 1;
}
.checkbox input[type="checkbox"]:focus + label::before,
.checkbox input[type="radio"]:focus + label::before {
  outline: thin dotted;
  outline: 5px auto -webkit-focus-ring-color;
  outline-offset: -2px;
}
.checkbox input[type="checkbox"]:checked + label::after,
.checkbox input[type="radio"]:checked + label::after {
  font-family: "FontAwesome";
  content: "\f00c";
}
.checkbox input[type="checkbox"]:disabled + label,
.checkbox input[type="radio"]:disabled + label {
  opacity: 0.65;
}
.checkbox input[type="checkbox"]:disabled + label::before,
.checkbox input[type="radio"]:disabled + label::before {
  background-color: #eeeeee;
  cursor: not-allowed;
}
.checkbox.checkbox-inline {
  margin-top: 0;
}


.checkbox-success input[type="checkbox"]:checked + label::before,
.checkbox-success input[type="radio"]:checked + label::before {
  background-color: #5cb85c;
  border-color: #5cb85c;
}
.checkbox-success input[type="checkbox"]:checked + label::after,
.checkbox-success input[type="radio"]:checked + label::after {
  color: #fff;
}

.checkbox.checkbox-lg label::before {
  width: 46px;
  height: 46px;
  top: -28px;
}
.checkbox.checkbox-lg label::after {
  width: 46px;
  height: 46px;
  padding-left: 4px;
  font-size: 36px;
  left: 1px;
  top: -31px;
}
.checkbox.checkbox-lg label {
  padding-left: 34px;
  top: 32px;
}


input[type="checkbox"].styled:checked + label:after,
input[type="radio"].styled:checked + label:after {
  font-family: 'FontAwesome';
  content: "\f00c";
}
input[type="checkbox"] .styled:checked + label::before,
input[type="radio"] .styled:checked + label::before {
  color: #fff;
}
input[type="checkbox"] .styled:checked + label::after,
input[type="radio"] .styled:checked + label::after {
  color: #fff;
}


/*Cardas css start*/

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
/*Profile Card 1*/

/*Profile Card 5*/
.profile-card-5{
    margin-top:20px;
}
.profile-card-5 .btn{
    border-radius:2px;
    text-transform:uppercase;
    font-size:12px;
    padding:7px 20px;
}
.profile-card-5 .card-img-block {
    width: 91%;
    margin: 0 auto;
    position: relative;
    top: -20px;
    
}
.profile-card-5 .card-img-block img{
    border-radius:5px;
    box-shadow:0 0 10px rgba(0,0,0,0.63);
}
.profile-card-5 h5{
    color:#4E5E30;
    font-weight:600;
}
.profile-card-5 p{
    font-size:14px;
    font-weight:300;
}
.profile-card-5 .btn-primary{
    background-color:#4E5E30;
    border-color:#4E5E30;
}
	
  </style>

</head>
<body>
  <div style="width: 100%; display: flex; flex-direction: row-reverse;">
<button type="button" class="btn btn-primary btn-lg btn-block" style=" max-width: 30%; margin:20px;" onclick="window.location.href = '<?=base_url();?>admin/register'">Register User</button>
<button type="button" class="btn btn-primary btn-lg btn-block" style="max-width: 30%; margin:20px;" onclick="window.location.href = '<?=base_url();?>admin/listed_battles'">My Battles</button>
<button type="button" class="btn btn-primary btn-lg btn-block" style="max-width: 30%; margin:20px;" onclick="window.location.href = '<?=base_url();?>admin/feed'">Diros Feed</button>
</div>

<?php
		if(!empty($error_info)){
		echo'<div class="alert alert-dismissible alert-danger" style="width:300px; margin:30px; float:left;">
  
  <strong><u>WARNING :- </u>'.$error_info.'!</strong> 
</div>';
		}

?>






<!-- CArds design starts here -->

					
<center>
<section style="margin-top: -10px; margin-left: 2%;  margin-bottom: 15px;">
	<h2 style="margin-top: -30px;">1st Battle Warrier</h2>
	
	<form method="post" action="<?=base_url('admin/set_battle');?>"> 
    <div class="container">
    	<div class="row"  style="margin-top: -20px;">
   	    
<?php
error_reporting(0);
	$x=1;
foreach($listed_users as $listed_user):
//	echo $listed_user->username."<br>";
$user_image=$listed_user->img;

/*if(empty(getimagesize(base_url().'utility/battle-images/dm'.$listed_user->img))){
  $user_image='avatar.png';
}   else echo"hurr";*/


   $x=$x+1;

?>    		


    		<!--Profile Card 5-->
    		<div class="col-md-3 mt-3">
    		    <div class="card profile-card-5">
    		        <div class="card-img-block">
    		            <img class="card-img-top" src="<?=base_url('utility/battle-images/dm').'/'.$user_image;?>" alt="Card image cap"  height="200" style="  object-fit: contain; background-color:#d0d0d0; " >
    		        </div>
                    <div class="card-body pt-0">
                    		
                    	<div class="checkbox checkbox-lg checkbox-inline" style="margin-top: -20px;">
                        <input type="radio" id="inlineRadio1lg1<?=$x;?>" value="<?=$listed_user->username;?>" name="user1">
                        <label for="inlineRadio1lg1<?=$x;?>"> <h5 class="card-title" style="margin-top: -17px;"><?=$listed_user->name;?></h5> </label>
                        &nbsp;&nbsp;
                    </div>


                    		<br>
                    
                    <span class="card-text"><strong>Username:-</strong><?=$listed_user->username;?></span>
                    <a href="<?=$listed_user->fb_id;?>" target="blank">
                    <img src="https://cdn0.iconfinder.com/data/icons/popular-social-media-colored/48/JD-04-512.png" height="50" width="50" style="float: right; margin-top: -15px;">
                    </a>
                  </div>
                </div>
                
    		</div>



   <?php

		endforeach;

   ?> 		
		
    	</div>
    </div>	



</section>





<!-- 2nd User  -->

<section   style=" margin-left: 2%; margin-bottom: 15px;background: #3e978b;">
	<h2 style="margin-top: -30px;">2nd Battle Warrier</h2>
    <div class="container">
    	<div class="row"  style="margin-top: -20px;">
    	    
<?php
	$x=1;
foreach($listed_users as $listed_user):
//	echo $listed_user->username."<br>";
$user_image=$listed_user->img;
   $x=$x+1;


?>    		
    		<!--Profile Card 5-->
    		<div class="col-md-3 mt-3" style="">
    		    <div class="card profile-card-5">
    		        <div class="card-img-block">
    		            <img class="card-img-top" src="<?=base_url('utility/battle-images/dm').'/'.$user_image;?>" alt="Card image cap"  height="200" style="  object-fit: contain; background-color:#d0d0d0; ">
    		        </div>
                    <div class="card-body pt-0">
                    		
                    	<div class="checkbox checkbox-lg checkbox-inline" style="margin-top: -20px;">
                        <input type="radio" id="inlineRadio1lg2<?=$x;?>" value="<?=$listed_user->username;?>" name="user2">
                        <label for="inlineRadio1lg2<?=$x;?>"> <h5 class="card-title" style="margin-top: -17px;"><?=$listed_user->name;?></h5> </label>
                        &nbsp;&nbsp;
                    </div>


                    		<br>
                    
                    <span class="card-text"><strong>Username:-</strong><?=$listed_user->username;?></span>
                    <a href="<?=$listed_user->fb_id;?>" target="blank">
                    <img src="https://cdn0.iconfinder.com/data/icons/popular-social-media-colored/48/JD-04-512.png" height="50" width="50" style="float: right; margin-top: -15px;">
                    </a>
                  </div>
                </div>
                
    		</div>


   <?php

		endforeach;

   ?> 		
    	</div>
    </div>
    <input type="submit" class="btn btn-success btn-lg btn-block shadow p-3 mb-5 rounded" style="width:150px; position: fixed; bottom:10px; right:30px; box-shadow: 10px 10px 15px 15px black; " value="Set Battle" name="submit_battle" >
			</form>
</section>
</center>

</body>
</html>