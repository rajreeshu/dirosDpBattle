<?php

$next_serial=$this->database->next_battle_serial();

//print_r($next_serial);


//print_r($vs_two); 

if(count($fighter)){
	$vs_two=ucfirst($fighter[1]->name).' v/s '.ucfirst($fighter[0]->name);
}else{
	$vs_two="Vote Now";
}

$meta_img=$this->db->where('id',$_GET['battle_id'])->select('meta_img')->get('battle_detail')->row();


$admin_name=$this->database-> get_admin_username($_GET['battle_id']);
	//print_r($admin_name->meta_img_canvas);
						
if(empty($meta_img->meta_img)){
	
	if(!empty($admin_name->meta_img_canvas)){
		$og_url=$admin_name->meta_img_canvas;
	}else{
		$og_url=base_url('utility/meta_img/default.jpg');
	}
}else{
	$og_url=base_url('utility/meta_img/').$meta_img->meta_img;
}
//print_r($og_url);
//print_r($meta_img);
?>


<!DOCTYPE html>
<html>
<head>
	<title>Home-Diros</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
		<link href='https://fonts.googleapis.com/css?family=Lora:400,700|Source+Sans+Pro:400,700&amp;subset=latin,cyrillic,latin-ext,vietnamese' rel='stylesheet' type='text/css'>
		
		<link rel="shortcut icon" href="<?=base_url('utility/titlelogo.png')?>" type="image/x-icon">



<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-175963912-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-175963912-1');
</script>

<!-- trial starts -->
<!-- <meta name="description" content="An Effective Way for DP Battle.. Easy to use.. Try Us For DP Battle"> -->

<!-- Google / Search Engine Tags -->
<meta itemprop="name" content="Diros:- DP Battle / Video Battle Platform">
<meta name="description" content="DP Battle Website for Awsm Battles and Shoutout.. Get a Chance to get featured in front of our visitors..\n Are you a Model and want to get featured on our Website and Instagram, Open this Page and contact us. Easy to use.. Try Us For DP Battle. Visit our Instagram Page @diros.in and Follow us for Video Battles">
<meta name="keywords" content="diros, diros.in, diros dp battle, diros video battle, diros website battle, video battle, website battle, Model,Models,dp battles, video battles, get featured, featured, actress, actor, beautiful, modeling, ramp, red carpet, ramp walk, beautiful girls, battles, beauty contest, image battle, pic battle, image fight, who is more hot, find sexy, select hot, select best, select awsm, hot">
<meta name="author" content="Diros">

<meta name="google-site-verification" content="7Fmy9_g2MQMfOyjtRj_jdkqJkNdCVz0Ozazj1Go9QX8" />
<meta itemprop="image" content="<?=base_url('utility/meta_img/').$meta_img->meta_img;?>">

<!-- Facebook Meta Tags -->
<meta property="og:url" content="https://diros.in/home?battle_id=<?=$_GET['battle_id'];?>">
<meta property="og:type" content="website">
<meta property="og:title" content="Diros:-<?=$vs_two;?>">
<meta property="og:description" content="An Effective Way for DP Battle.. Vote For Your Favorite..Try Us For DP Battle">
<meta property="fb:app_id" content="235531264523889">

<meta property="og:image" content="">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Home-Diros">
<meta name="twitter:description" content="An Effective Way for DP Battle.. Easy to use.. Try Us For DP Battle">
<meta name="twitter:image" itemprop="image" content="<?=base_url('utility/meta_img/').$meta_img->meta_img;?>">

<!-- Meta Tags Generated via http://heymeta.com -->

		
		<link href="<?=base_url();?>addon/filebody/css/style.css" rel="stylesheet" type="text/css">
		<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
		<script src="<?=base_url();?>addon/filebody/js/plugins.js" type="text-javascript"></script>
		<script src="<?=base_url();?>addon/filebody/js/functions.js" type="text/javascript"></script>
		<script src="<?=base_url();?>addon/filebody/js/html5shiv.js" type="text/javascript"></script>
			<script src="<?=base_url();?>utility/js/bootstrap.js"></script>


				<link href="<?=base_url();?>addon/poll/poll.css" rel="stylesheet" type="text/css">

					<script src="<?=base_url();?>utility/js/bootstrap.js"></script>

	<link rel="stylesheet" type="text/css" href="<?=base_url();?>utility/bootstrap.css">


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">


		<script src="<?=base_url();?>addon/poll/poll.js" type="text/javascript"></script>

<script src="<?=base_url();?>utility/jquery.simple.timer.js"></script>


<!-- to take screenshot -->
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>


<!-- Adds Meta tag -->

<!-- adsence link -->
<script data-ad-client="ca-pub-7850550473058323" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> 
<!-- hillstop -->
<!-- <meta name="hilltopads-site-verification" content="296a61668ab60734d2c53bef95407caa7717b84c" /> -->

<!-- bulletproof adds -->
<!-- <meta name='bulletprofit' content='YdILNrqL6RhXvcOyEbz9'/> -->


<!-- ads meta tag end -->
<!-- <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-175963912-1');
</script> -->


<?php

$battle_id=$this->input->get('battle_id');

?>
<style type="text/css">
.btn-status:disabled {
    opacity: 0.5;
}	
.jst-hours {

  background: white;
  color: black;
  font-size: 26px;
  padding: 10px;
  height: 50px;
  font-family: Serif;
  margin-right: 10px;	

}
.jst-minutes {
  background: white;
  color: black;
  font-size: 26px;
  padding: 10px;
  height: 50px;
  font-family: Serif;
  margin-right: 10px;	

}
.jst-seconds {
  background: white;
  color: black;
  font-size: 26px;
  padding: 10px;
  height: 50px;
  font-family: Serif;	
  
}
.jst-clearDiv {
  clear: both;
}
.jst-timeout {
  color: red;
}
.timer-pause{
	/*max-width:90%;*/ 
	display: flex;
	justify-content: center;
}
.bg-secondary{
	border-radius: 40px 40px 0px 0px;
	margin-bottom: -50px;
	box-shadow: inset 0px 20px 40px black ;
	padding-top: 10px;
	padding-bottom: 20px;
}
.box_time{
	width: 100%;
	/* margin-left: 3.5%; */
	padding-top: 5px;
	background: linear-gradient(90deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 50%, rgba(252,176,69,1) 100%);
	border-radius: 40px 40px 0px 0px;

	box-shadow: 5px -5px 15px #d0d0d0 ; 
	padding-top: 10px;
	padding-bottom: 10px;
	margin-top: -60px;

	
}



/*Loader Css Starts*/

/*loader css end*/
#cover_div{
	position: fixed;
	height: 100%;
	width: 100%;
	background: #ff847c;
	z-index: 10;
	 
}

.cover_img{

	position: absolute;
	top: 50%;
	transform: translateY(-50%);
	left: 35%;

	/*transform: :translateX(-50%);*/
}

/* shine seen */

.ribbon-wrapper {
 
  z-index:998;
}
  .ribbon-front {
  background-color: #cc3333;  
  height: 25px;
  width: 100%;
  position: relative;
  left:-10px;
  z-index: 2;
  font:19px bold Verdana, Geneva, sans-serif;
  color:#f8f8f8; 
  text-align:center;
  text-shadow: 0px 1px 2px #cc6666;
  padding: 3px;

}

  .ribbon-front,
  .ribbon-back-left,
  .ribbon-back-right
{
  -moz-box-shadow: 0px 0px 4px rgba(0,0,0,0.55);
  -khtml-box-shadow: 0px 0px 4px rgba(0,0,0,0.55);
  -webkit-box-shadow: 0px 0px 4px rgba(0,0,0,0.55);
  -o-box-shadow: 0px 0px 4px rgba(0,0,0,0.55);
}




@-webkit-keyframes flow {
  0% { left:-20px;opacity: 0;}
  50% {left:100px;opacity: 0.3;}
    100%{ left:180px;opacity: 0;}
}
@keyframes flow {
  0% { left:-20px;opacity: 0;}
  50% {left:100px;opacity: 0.3;}
    100%{ left:180px;opacity: 0;}
}

.glow{
 background: rgb(255,255,255); 
 width:40px; 
 height:25px; 
 z-index:999; 
 position:absolute;-webkit-animation: flow 1.5s linear infinite;-moz-animation: flow 1.5s linear infinite;-webkit-transform: skew(20deg);
     -moz-transform: skew(20deg);
       -o-transform: skew(20deg);background: -moz-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0) 1%, rgba(255,255,255,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(255,255,255,0)), color-stop(1%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(left, rgba(255,255,255,0) 0%,rgba(255,255,255,0) 1%,rgba(255,255,255,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(left, rgba(255,255,255,0) 0%,rgba(255,255,255,0) 1%,rgba(255,255,255,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(left, rgba(255,255,255,0) 0%,rgba(255,255,255,0) 1%,rgba(255,255,255,1) 100%); /* IE10+ */
background: linear-gradient(to right, rgba(255,255,255,0) 0%,rgba(255,255,255,0) 1%,rgba(255,255,255,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00ffffff', endColorstr='#ffffff',GradientType=1 ); /* IE6-9 */ border-left:1px solid #fff;
}

.profile-card__img {
  width: 170px;
  height: 170px;
  margin-left: auto;
  margin-right: auto;
  transform: translateY(-50%);
  border-radius: 25%;
  overflow: hidden;
  margin-top: 160px;
/* background-image: linear-gradient(45deg, #405de6 ,#5851db, #833ab4, #c13584, #e1306c, #fd1d1d); */
background-image: linear-gradient( rgb(255,29,29,0.75), rgb(255,48,108,0.75),rgb(193,53,132,0.75),rgb(131,58,180,0.75),rgb(88,81,219,0.75),rgb(64,93,230,0.75));
  z-index: 4;
  box-shadow: 0px 5px 20px 0px #6c44fc, 0px 0px 0px 7px rgba(107, 74, 255, 0.5);

}

#vote_btn:hover{
	position: relative;
	top:-2px;

}

.next_battle_top{
	width:100px;
	box-shadow: 3px 3px 3px grey;
	
	animation-name:btn;
	animation-duration: 1s;
	animation-iteration-count: infinite;
}

@keyframes btn {
	0% {width: 90px;}
	50%{width:84px;}
	100% {width: 90px;}
	 
}
</style>
	
	

	</head>
<?php

		$random_battle_id=$this->database->rand_id_selection_except_current($xx=$this->input->get('battle_id'));
		$random_battle_id_over=$this->database->rand_id_selection_except_current_over($xx=$this->input->get('battle_id'));
	

if(!empty($vote_compare=$this->database->vote_compare($battle_id))){

//print_r(count($vote_compare));
//echo count($vote_compare);
$x= max(array_column($vote_compare, 'count'));

$y= min(array_column($vote_compare, 'count'));
//print_r(array_column($vote_compare, 'count'));
//print_r($x."-".$y);

if(count($vote_compare)!=1){
	if($x!=$y){
		foreach ($vote_compare as $compare) {
			if($compare->count==$x){
				$winner_username=$compare->voted_user;

			}
		}
	}
}else{
	$winner_username=$vote_compare[0]->voted_user;
}

}
	if (!array_filter($time_left)) {
			$status="disabled";
			$display_watermark="block";


	}else{ 
			$status="active";
			$display_watermark="none";
		}
		
?>


	<body>





<div id="screenshot_popup" style="position: absolute; z-index: 100; width: 100%; height: 100%; background: linear-gradient( rgb(255,29,29,0.5), rgb(255,48,108,0.5),rgb(193,53,132,0.5),rgb(131,58,180,0.5),rgb(88,81,219,0.5),rgb(64,93,230,0.5)); display: none; padding-top: 30px;">
	<div class="text-white float-right mr-5" style="font-size: 50px; cursor: pointer;">X</div>
	<div id="screenshot_show" class="text-center" style=" "></div>
<!-- 	<img src="https://www.freepnglogos.com/uploads/old-logo-png-transparent-7.png" alt=""> -->
</div>






<div id="cover_div" class="" style="background-image: linear-gradient( #d0d0d0 0%, #6944ff 30%, #ff2846 100%); color:black;">

		

	<div class="d-flex justify-content-center" style="max-width: 90%; margin:auto; position: relative; top:-25px;">
  <div class="" id="cover_img" style="margin-top: 40px;">
    <span class="sr-only">Loading...</span>
  </div>

</div>


<!--                 
<div id="adm-container-15461"></div><script data-cfasync="false" async type="text/javascript" src="//bulletprofitads.com/display/items.php?15461&4861&336&280&4&0&38"></script> -->




</div>

</div>

<?php
 $sec15min=20/60;

$next_battle_link=base_url("home?battle_id=$next_active_battle_id");

$vote_update_data=$this->session->flashdata('voteing_status');

if(!empty($vote_update_data)):

?>


<div class="" id="next_battle_t_div" style=" position: fixed; top: 20px; right: 10px; z-index: 3;">

	<div class="rounded p-1 pr-2" style="  position: relative; top: 20px; right: 20px; background: white; box-shadow: 4px 4px 10px grey; color: black;"><img src="https://www.freepngimg.com/thumb/clock/94129-alarm-area-timer-clock-free-hq-image.png" height="40">Next Battle in <span class="next_battle_timer"></span></div>
	    
	    
                 
             
</div>
<script>

var countDownDate = new Date().getTime()+21000;
var delay=1000;

var redirect_delay= 20000;
var to_redirect=true;

$("#next_battle_t_div").click(function() {
	$(this).hide();
	to_redirect=false;
	//redirect_fn();
});

var x = setInterval(function() {

  var now = new Date().getTime();

  var distance = countDownDate - now;
    
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
	
	if(seconds<=0){
		$("#next_battle_t_div").hide();
		
		if(to_redirect!=false){
		window.location = "<?=$next_battle_link;?>";
		//window.open("<?=$next_battle_link;?>");
		}
	}    

  $(".next_battle_timer").html(seconds);


}, delay);

/*function redirect_fn(){
	console.log(redirect_delay);
	setTimeout(function(){ window.location = "<?=$next_battle_link;?>"; },redirect_delay);
}
redirect_fn();*/
</script>

<?php
endif;
	if (!array_filter($time_left)) {
?>




<div class="row">
<div class="col text-center text-md-left pl-3 pl-md-5 pt-3" style='background:#d92027; font-size:30px; color:white; margin:0px; height: 60px; margin-top: 30px;'><center>This Battle is not Active</center></div>
	</div>

<?php
}

?>

<div class="p-2 " style="position: fixed; top:0px;background: linear-gradient(90deg, rgba(253,29,29,1) 0%, rgba(252,176,69,1) 100%); z-index: 9; width: 100%; height: 40px; border-radius: 0px 0px 10px 10px; box-shadow: 0px 1px 13px 0px black; color: white;">
	<center>
	<?php

$this->load->view('body_header');
?>
</center>
</div>

		<div id="fb-root"></div>
		<div class="page-container">
			<div class="section header" data-name="Page Content" data-lead-id="competition-page_
			0_Page-Content_container">
					<div class="custom-background" data-name="Background Image" data-lead-id="competition-page_1_Background-Image_container" style="background-image: linear-gradient(-20deg, #ff2846 0%, #6944ff 100%);">
						<!-- <img data-name="Image" data-lead-id="competition-page_2_Image_background-image" src="<?=base_url();?>addon/filebody/img/background.png"> -->
					</div>
					<div class="container " id="here" style="margin-top: 33px;">
						<div class="row flexible rounded" style="box-shadow: 0px 8px 60px -10px rgba(13, 28, 39, 0.6);">

							<div data-name="Column 1" data-lead-id="competition-page_3_Column-1_container" class="col-md-8 p-0 " style="background: white;">
<div class="row flex-column flex-sm-row m-0" style="background: #91bd3a; width: 100%;">
	<div class="col order-sm-2">	
		<div class="ribbon-wrapper mt-2 float-sm-right"><div class="glow">&nbsp;</div>
	<div class="ribbon-front ml-2 mr-2">
		<?=$visited_battle_show;?> Peoples Visited This Battle
	</div>
	
</div>
</div>
<!--  -->










<div class="col order-sm-1 ">

<h5 class="mt-1 ml-2 " ><img src="https://pngimage.net/wp-content/uploads/2018/06/youtube-share-png-2.png" height="30" id="old_insta_img">Share Battle:-</h5>

</div>
</div>
<!--  -->
<div class="row m-0 pl-2 pr-2 pb-1" style="background: #91bd3a; ">
	<div class="col-9 col-md-5 align-self-start rounded " style=" padding: 5px;  margin-bottom: 5px; background: #158467;  ">
	
<div class="a2a_kit a2a_kit_size_32 a2a_default_style justify-content-around justify-content-sm-start" style=" width: auto;">


<a class="a2a_button a2a_button_facebook_messenger" title="messenger"></a>
<div><a class="a2a_button a2a_button_whatsapp a2a_user" title="whatsapp"></a></div>
<a class="a2a_button a2a_button_sms a2a_user" title="SMS"></a>
<div><a class="a2a_button a2a_button_telegram a2a_user" title="telegram"></a></div>

<div><a class="a2a_button a2a_button_copy_link a2a_user" title="copy"></a></div>
<a class="a2a_button a2a_dd" ></a>

</div>
</div>
	<div class="col-3 col-md-5 pl-3 p-0 mb-1" style=" ">
		<a href="<?=base_url("home?battle_id=$next_active_battle_id");?>"><div class="btn btn-info float-right m-0 next_battle_top" style="">NeXT BaTTle</div></a>
	</div>
</div>




		

<script async src="https://static.addtoany.com/menu/page.js"></script>

<?php
	if(!empty($vote_update_data)){
		
		if($vote_update_data==1){
?>	
<div class="alert alert-dismissible alert-success" style="margin: 10px 0px 0px 0px; width: 450px; max-width: 100%;">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
   Your Vote is <b style="font-size: 20px;">Submitted..</b>
  </div>		
<?php		}elseif($vote_update_data==2){
	?>
<div class="alert alert-dismissible alert-info " style="margin: 10px 0px 0px 0px; width: 450px; max-width: 100%;">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  Your Vote for this Battle is <b  style="font-size: 20px;">Already Registered..</b>
</div>
	<?php
	}elseif($vote_update_data==3){
?>
<div class="alert alert-dismissible alert-success" style="margin: 10px 0px 0px 0px; width: 450px; max-width: 100%;">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
   Your information is <b style="font-size: 20px;">Submitted..</b>
  </div>
<?php		
	}
}

?>
							<!-- <img id="canvas_present" src="<?=$og_url;?>" name="canvas_present"> -->

								<div class="text-center logo mobile" style="margin-top: -50px; margin-bottom: -50px;" >
								<!-- 
									<span style="float: right; margin-right: -16px; margin-top: 0px;">
									<a href="https://wa.me/?text=VOTE Here and Let choose the best and let him Win the Battle at DIROS DP Battle :-  <?=base_url('home?battle_id='.$battle_id);?>"><img src="https://cdn4.iconfinder.com/data/icons/social-media-2210/24/Whatsapp-512.png" height="90"><p style="margin-top: -30px; margin-right: 2px; color:tan;">Share</p></a>
									</span> -->
									<div class="sharethis-inline-share-buttons" style=""></div>

							<a href="https://instagram.com/diros.in" style="text-decoration: none;">
								<div class="profile-card__img">
									<img data-name="Mobile Logo" data-lead-id="competition-page_4_Mobile-Logo_image" src="https://image.flaticon.com/icons/svg/2379/2379692.svg" height="200" alt="Diros Logo" style="margin-top: -50px;">
							
									<h3 style="margin-top: -60px; margin-bottom: 40px; color: white; text-shadow: 0px 2px 5px black;">Diros</h3>
								</div>
							</a>
<div class="alert alert-dismissible alert-info registered_alert" style="margin: -50px 10px 0px 10px; margin-bottom: 70px; display: none;">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
 <b  style="font-size: 20px;">Voted</b>
</div>
<!-- BAttle time left top start -->

 <?php
                  $time_left_top_minutes=$time_left['hrs']*60+$time_left['min']+$time_left['sec']/60;
                  ?>

<div class="box_time" style="">
<h5 class="text-center lora" data-name="Title" data-lead-id="competition-page_10_Title_text" style="margin-top: 10px; font-size: 20px;">CONTEST ENDS IN</h5>
									<div class="counter" data-name="Countdown" data-lead-id="competition-page_11_Countdown_countdown" style="margin-bottom: 50px">

    <div class="timer-pause" data-minutes-left="<?=$time_left_top_minutes;?>"></div>
                 
                  <script> $('.timer-pause').startTimer(); </script>
			</div>





</div>
								</div>


								<div class="text-center" style="padding: 0px; padding-top: 0px;">

									<div class="row pl-sm-2 pr-sm-2">
					<?php 
						foreach ($battle_detail as $battle_details):
							$username_chk=$battle_details->username;

						foreach ($fighter as $fighters):
							if($username_chk==$fighters->username):



 ?>






									  <div class="col-6 p-sm-3 user_card_box" data-id="<?=$fighters->username;?>" style="margin-top: 15px; margin:0px; padding: 0px; ">
									    <div class="card" style="box-shadow: 5px 5px 10px rgb(179,52,147,0.3);">
									      <div class="card-body"  style="background: #ffc7c7; padding: 0px; display: flex; flex-direction: column; display: inline-block;">
									       
									        <div data-username_img_background="<?=$fighters->username;?>" class="username_img_background" style="background: linear-gradient( rgb(255,29,29,0.5), rgb(255,48,108,0.5),rgb(193,53,132,0.5),rgb(131,58,180,0.5),rgb(88,81,219,0.5),rgb(64,93,230,0.5));">
									        <div style="height:300px;  display: inline-block; position: relative;">
									        
									        <img class="user_card_image" data-username_img="<?=$fighters->username;?>" data-name="Image" data-lead-id="competition-page_5_Image_image" src="<?=base_url('utility/battle-images/');?><?=$battle_details->img_name?>"  style=" max-height: 300px; position: relative; top: 50%; transform: translateY(-50%);">
									        <?php
									        if(!empty($winner_username)):
									        if($fighters->username==$winner_username):
									        	?>
									       
									        <img src="https://i1.wp.com/www.pngall.com/wp-content/uploads/2016/04/Winner-Free-PNG-Image.png" height="150" style="position: absolute; z-index: 2; top: 60%; opacity: 0.92; right: 0%; width: 60%; height: auto;  display: <?=$display_watermark;?> " >
									        <?php
									    endif;
									    endif;
									   
									        ?>
									        </div>
									    </div>
									        <div style="">
									        
									        
									        	<a href="<?=base_url('utility/battle-images/');?><?=$battle_details->img_name?>" download="<?=$fighters->name;?>"  class="btn btn-danger m-0 down_user_img" style="width: 90%;">

									        	<img src="https://image.flaticon.com/icons/svg/892/892681.svg" height="20">Download Image</a>


									        <h2 class="per_hed" style="font-size: 30px; background: #ffc7c7; color:black; border-top: 1px solid black;">
									        	<?= ucfirst($fighters->name); ?>

										<a href='<?=base_url("home/stats?battle_id=$battle_id&&user=$fighters->username");?>'>
									        <div class="badge badge-info m-2 float-right mr-4" style="font-size: 12px; font-weight: normal;">Stats</div>
									    </a>
									        </h2>

									 
									        	</div>

									      </div>
									    
<center style="background:#ffc7c7;">
<!--  <button type="button"  class=" btn-danger badge-pill btn-status vote_btn_class" id="vote_btn"  onclick="window.location.href ='<?=base_url()?>fb_login/temp?war_id=<?= $battle_details->war_id; ?>&&username=<?=$fighters->username;?>'" style="margin: 10px; width:75%; height: auto;    background: linear-gradient(45deg, #d5135a, #f05924); box-shadow: 0px 4px 30px rgba(223, 45, 70, 0.35);" <?=$status;?>>VOTE</button></center> -->
<?php $ip_vote= $this->input->ip_address(); ?>
 <button type="button"  class=" btn-danger badge-pill btn-status vote_btn_class" id="vote_btn"  onclick="window.location.href ='<?=base_url()?>fb_login/idata?voter=<?=$ip_vote;?>&&war_id=<?= $battle_details->war_id; ?>&&username=<?=$fighters->username;?>&&via=ip_address'" style="margin: 10px; width:75%; height: auto;    background: linear-gradient(45deg, #d5135a, #f05924); box-shadow: 0px 4px 30px rgba(223, 45, 70, 0.35);" <?=$status;?>>VOTE</button></center>

									       <div id="status" style="color:black;"></div>
<!-- 
									       <a href="javascript:void(0);" onclick="fbLogin()" id="fbLink"><h2>Login With Facebook.</h2></a> -->
 

										<div style="overflow: auto; background: linear-gradient(46deg ,#F15F79,#ffc7c7,#F15F79);">
											<ul class="social_ul" style="margin-bottom: 15px; margin-top:8px;">
											 
												<?php if(!empty($fighters->fb_id)):  ?>
											  <a class="social_a" style="background: black; color:red;"href="<?=$fighters->fb_id;?>">
											  	<li class="social_li" onclick="social_track_insert('<?=$battle_id;?>','<?=$fighters->username;?>','facebook')">
											    
											      <i class="fab fa-facebook" style="color:#e1306c;"></i>
											  
											  </li>
											    </a>
											 <?php endif;
												
												if(!empty($fighters->insta_id)):
											  ?>


											  <li class="social_li" onclick="social_track_insert('<?=$battle_id;?>','<?=$fighters->username;?>','instagram')">
											    <a class="social_a" href="<?=$fighters->insta_id;?>" style="background: black;">
											      <i class="fab fa-instagram" style="color:#e1306c;"></i>
											    </a>
											  </li>
											 

											 	<?php
											 		endif;
											 	 if(!empty($fighters->tiktok_id)):  ?>
											  <li class="social_li" onclick="social_track_insert('<?=$battle_id;?>','<?=$fighters->username;?>','tiktok')">
											    <a class="social_a" href="<?=$fighters->tiktok_id;?>">
											       <i class="fab fa-tiktok" style="font-family: sans-serif; font-size: 20px; color:#EE1D52;"><strong>Tik<br>Tok</strong></i>
											    </a>
											    
											  </li>
											 <?php endif;  ?>
											</ul>
										</div>

									    </div>
									  </div>
									  <?php
										endif;
									    endforeach;
									    endforeach;
									    ?>

									</div>



								</div>
						


<!-- ads by Eonads -->  
<!-- <center>
    <a href="https://www.eonads.com" class="ex2" target="_blank">Ads by Eonads</a>
    <ins data-revive-zoneid=17430 data-revive-id="f87497be83f6ed6b52c3b340d803ae0d"></ins>
	<script async src=//network.eonads.com/adserver/www/delivery/asyncjs.php?code=></script>                       
</center> -->
     <!-- ads by Eonads -->  

<!-- 
<div class="row">
	<div class="col">
		
			<div id="adm-container-15451"></div><script data-cfasync="false" async type="text/javascript" src="//bulletprofitads.com/display/items.php?15451&4861&336&280&4&0&38"></script>
		
	</div>
	<div class="col d-md-block d-none">
		
			<div id="adm-container-15455"></div><script data-cfasync="false" async type="text/javascript" src="//bulletprofitads.com/display/items.php?15455&4861&336&280&4&0&38"></script>
			

	</div>
</div> -->


   



								<div class="padding-container" style="margin-top: -50px;">
									<h5 class="lora" data-name="Title" data-lead-id="competition-page_6_Title_text" style="margin-top:30px;">
										Voting Results:-
									</h5>

<div class="rounded shadow" id="container"  style="padding: 20px; background: linear-gradient(90deg,#00bf8f,#fcb045,#D38312);" >

	<?php 
/*echo "<span style='background-color:grey; padding:8px; margin:20px; border-radius:10px;'><u><b>Total Votes:-";
echo $votes->num_rows().'</b></u><br></span>'; 
*/

	
						foreach ($battle_detail as $battle_details):

							$username_chk=$battle_details->username;

						foreach ($fighter as $fighters):
							if($username_chk==$fighters->username):
							
/*echo "<pre>";						
print_r($votes->result());
echo "</pre>";*/


	foreach ($votes->result() as $votes_res) {
		if($votes_res->voted_user==$fighters->username){
			$vote_avail=1;
			continue;
			//print_r($votes_res);
		}
	}
if(!empty($votes->result())){
	if(!empty($vote_avail)){
	$user_personal_vote=array_count_values(array_column($votes->result(), 'voted_user'))[$fighters->username];
}else{
	$user_personal_vote=0;
}
}else{
	$user_personal_vote=0;
}
	if(!$user_personal_vote){
			$user_personal_vote=0;
	}

if($user_personal_vote!=0){
	$cell_width=$user_personal_vote/$votes->num_rows()*100;
	}else{$cell_width=0;}

	?>

<span style="">	<?= ucfirst($fighters->name);?></span>
      <div style="min-width:150px; background: linear-gradient(to right, #fe8c00, #f83600); width:<?=$cell_width;?>%">
      	<span>
      		<?= /*$user_personal_vote*/ round($cell_width,0) ?>% Vote
      	</span>
      </div>

									  <?php
										endif;
									    endforeach;
									    endforeach;
									    ?>

 </div>






<div class="row justify-content-between text-center" >		
 
	
	<div class="col-12 col-sm-6  mt-md-0 order-md-2">
	 <a class="btn btn-success " id="vote_btn" href='<?=base_url("home?battle_id=$random_battle_id->id");?>' style=" background: linear-gradient(45deg, #065446, #519872);
  box-shadow: 0px 4px 30px rgba(19, 127, 212, 0.4);">Next Active Battle (Random)</a>
	 </div>
	 <div class="col-12 col-sm-6 justify-content-end order-md-1" style="margin-top: 0px;">
	 <a class="btn btn-danger " href='<?=base_url("home?battle_id=$random_battle_id_over->id")?>' id="vote_btn" style="background: linear-gradient(45deg, #d5135a, #f05924); box-shadow: 0px 4px 30px rgba(223, 45, 70, 0.35);">Completed Battles (Random)</a>
	</div>

</div>


							
								</div>








							</div>


							<div data-name="Column 2" data-lead-id="competition-page_8_Column-2_container" class="col-md-4" >
								<div class="padding-container">
									



									<div class="text-center logo desktop" style="margin-top: -30px;">

										
										<img data-name="Logo" data-lead-id="competition-page_9_Logo_image" src="https://image.flaticon.com/icons/svg/2379/2379692.svg" height="150"> 									
									<h5 class="text-center lora" data-name="Title" data-lead-id="competition-page_10_Title_text">CONTEST ENDS IN</h5>
									<div class="counter" data-name="Countdown" data-lead-id="competition-page_11_Countdown_countdown">
										<ul class="countdown flexible" id="countdown">
											
											<li>
												<div class="digit"><span class="hours"><?=$time_left['hrs'];?></span></div>
											</li>
											<li></li>
											<li>
												<div class="digit"><span class="minutes"><?=$time_left['min'];?></span></div>
											</li>
											<li></li>
											<li>
												<div class="digit"><span class="seconds"><?=$time_left['sec'];?></span></div>
											</li>
										</ul>
									</div>
									<div data-name="Countdown Labels" data-lead-id="competition-page_12_Countdown-Labels_container" class="counter">
										<ul class="countdown">
											
											<li>
												<div class="text" data-name="Hours" data-lead-id="competition-page_14_Hours_text">Hours</div>
											</li>
											<li></li>
											<li>
												<div class="text" data-name="Minutes" data-lead-id="competition-page_15_Minutes_text">Minutes</div>
											</li>
											<li></li>
											<li>
												<div class="text" data-name="Seconds" data-lead-id="competition-page_16_Seconds_text">Seconds</div>
											</li>
										</ul>
									</div>
								
													
									</div>



								</div>

 
								
								
								<div class="rows p-3 mb-3   text-center" style="background: #3f3f44; ">
									<div class="col">
										<h5>Want to Start Your Battle</h5>
										<h5><u>Register Here</u></h5>
									</div>
								
									<div class="row">

									<!-- 	<div class="col ">
										<a href="<?= base_url('admin/register_self');?>" class="btn btn-warning" target="blank" style="height: 80px; padding-top: 17px;">
										<span>Submit Data Directly</span></a>
																		</div> -->

										<div class="col">
											<a href="https://wa.me/919110065497" class="btn btn-success" style="height: 80px;">


	 										 <li class="social_li" style="margin-top: -15px; margin-left: -15px;">
											      <i class="fab fa-whatsapp" style="font-size: 30px;"> <span style="font-size: 16px;">Contact on Whatsapp</span></i>    
											  </li>


										</a></div>

									<div class="col mt-3">
										<div class="pl-1 pr-1 pt-2 pb-3 mt-1 rounded" style="background: #3b5999;">
									<a target="blank" href="https://www.facebook.com/Diros-909835679174691" style="text-decoration:none; height: 80px;">	
										<div class="col" style="color: white;"><b>Facebook Page</b></div>
										<div class="col"><img src="https://clipart.info/images/ccovers/1509135259facebook-logo-png-like-button.png" height="30"></div>
									</a>
								</div>
									</div>

									<br>
										<a target="blank" href="https://www.instagram.com/diros.in/" style="text-decoration:none; width: 100%;">
										<div class=" m-3" style="">
										<div class="pl-1 pr-1 pt-2 pb-3 mt-1 rounded" style="background: linear-gradient(205deg, #405de6, #833ab4, #c13584, #fd1d1d);">
										
										
										<img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" height="80" class="">
										<span class="" style="color: white;"><b>Follow on Instagram</b></span>
										
								
								</div>
									</div>
										</a>

										

									</div>
									
<!-- 									<center>
								<div class="row flex-column pb-2 pl-3 " style="margin-top: -20px; background: #30475e; width: 140px; border-radius: 10px;">
								<div style=" margin-left: -5px;">
								<a target="blank" href="https://www.facebook.com/groups/732525747484692/" style="text-decoration:none;">	
									<div class="col" style="color: white;"><b>Facebook Page</b></div>
									<div class="col"><img src="https://clipart.info/images/ccovers/1509135259facebook-logo-png-like-button.png" height="40"></div>
								</a>
								</div>
								</div>
								</center>	
								 -->								</div>	

									<!-- Bulletprofit - Ad Display Code -->
<!-- <div id="adm-container-15923"></div><script data-cfasync="false" async type="text/javascript" src="//bulletprofitads.com/display/items.php?15923&4861&336&280&4&0&38"></script> -->
<!-- Bulletprofit - Ad Display Code -->
<br>

<h4 data-name="Subtitle #1" data-lead-id="competition-page_17_Subtitle-#1_text">Battle Setup By:- </h4>
								<h5><?=ucfirst($admin_data->admin_full_name);?></h5>
									<a target="blank" class="btn btn-primary" style="width: 80%; " href="<?=$admin_data->group_id;?>" data-name="Subtitle #1" data-lead-id="competition-page_17_Subtitle-#1_text">Admin</a>


							</div>



						</div>
					</div>
			</div>

			<footer class="section footer" data-name="Footer" data-lead-id="competition-page_34_Footer_container">
				<div class="container text-center">
					<p data-name="Disclaimer" data-lead-id="competition-page_35_Disclaimer_text"><strong>Disclaimer:</strong> Terms and conditions may apply. All federal, state, or local taxes associated with this prize are solely the responsibility of the winner.</p>

					<center>© 2020 <b style="font-size: 26px;">Diros</b></center>
						

					<ul data-name="Fine Print" data-lead-id="competition-page_36_Fine-Print_container">
						
						<li data-name="Legal" data-lead-id="competition-page_38_Legal_text">
							<a href="<?=base_url('home/privacy_policy');?>">Privacy Policy</a> | 
						</li>
						<li data-name="Legal" data-lead-id="competition-page_38_Legal_text">
							<a href="<?=base_url('home/about_us');?>">About Us</a> | 
						</li>
						<li data-name="Legal" data-lead-id="competition-page_38_Legal_text">
							<a href="<?=base_url('home/contact_us');?>">Contact Us</a> | 
						</li>
						<li data-name="Legal" data-lead-id="competition-page_38_Legal_text">
							<a href="<?=base_url('home/dmca');?>">DMCA</a>
						</li>
					</ul>
				</div>
			</footer>
		</div>

<script type="text/javascript">
	$(document).ready(function(){
	
		$("#left_arrow").hide();




	//$("#screenshot_popup").show();

$("#screenshot_popup").click(function() {
	$(this).hide()
});



/*
		$.ajax({
			url:"<?=base_url('ajax/cover');?>",
			type:"GET",
			success : function(result){
				$("#cover_img").html(result);
			}
		});
*/
		$('#cover_div').fadeIn('slow', function(){
               $('#cover_div').delay(100).fadeOut(); 
            });
	
		$.ajax({
			url:"<?=base_url('ajax/check_my_vote');?>",
			type:'POST',
			dataType:'json',
			data:{
				battle_id:<?= $_GET['battle_id'];?>
			},
			success:function(data){
				//console.log(data);
				if(data!=null){

					$(".vote_btn_class").attr('disabled','');
					$(".vote_btn_class").removeAttr('id');
					//$(".vote_btn_class").css('corsor','text');

					$("img[data-username_img='"+data.voted_user+"']").css('box-shadow','0px 0px 10px 5px red');

					//$(".user_card_box:not(div[data-id='"+data.voted_user+"']) > .user_card_image").css("opacity","0.7");
					$(".user_card_image:not(img[data-username_img='"+data.voted_user+"'])").css("opacity","0.5");

					$(".registered_alert").css('display','block');

					$(".username_img_background:not(div[data-username_img_background='"+data.voted_user+"'])").css("background","#d0d0d0");
					
					//console.log(data.username);

				}

			},
			error:function(data){
				console.log(data);
			}
		})
	


	});



			


		function social_track_insert(battle_id,username,socialMedia_type){
			$.ajax({
				type:'POST',
				url:"<?=base_url('ajax/social_media_track');?>",
				data:{
					battle_id:battle_id,
					socialMedia_type:socialMedia_type,
					username:username
				},
				success:function(){
					//console.log(done_social);
				}
			});
		};

		$(".down_user_img").click(function() {
			
			window.open("https://bulletprofitsmartlink.com/display/index.php?page=query/items/&aduid=15438&displaytype=4&smartlink=1","_blank");
			//window.open("//azoaltou.com/afu.php?zoneid=3618715","_blank");
			
		});

		$(".social_li").click(function() {
			window.open("https://bulletprofitsmartlink.com/smart-link/15917/4");
		});


</script>

</div> 

</body>
</html>