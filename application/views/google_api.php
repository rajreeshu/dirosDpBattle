<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Google API</title>
	<meta name="google-signin-client_id" content="452809476654-dtuldg7to2b0tld0349ii0gnigo7svj6.apps.googleusercontent.com">
	<style>

	</style>
</head>
<body >

<center>
	<div class="g-signin2" data-onsuccess="onSignIn" style="width: 270px; height: 80px; margin-top: 20px;box-shadow: 5px 5px 10px black;"></div>
</center>

<script type="text/javascript">
	function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.

 //document.write(profile.getId());

//alert(profile.getId());

/*$(document).ready(function(){

	if(profile.get_Id()){
		document.write("data available");
	}else {
		document.write("data unavailable");
	}

})  ;*/
//window.location.href ="<?=base_url('fb_login/idat?voter=');?>"+profile.getId();
window.location.href ="<?=base_url('fb_login/idata?voter=');?>"+profile.getId()+"&&war_id=<?= $battle_details=$this->input->get('war_id'); ?>&&username=<?=$this->input->get('username');?>&&via=google";
}


</script>
<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
	<script src="https://apis.google.com/js/platform.js" async defer></script>
</body>
</html>

