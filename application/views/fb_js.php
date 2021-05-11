<!DOCTYPE html>
<html>
<head>
    <title>Fb Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<script>



window.fbAsyncInit = function() {

    // FB JavaScript SDK configuration and setup

    FB.init({

      appId      : '235531264523889', // FB App ID

      cookie     : true,  // enable cookies to allow the server to access the session

      xfbml      : true,  // parse social plugins on this page

      version    : 'v2.8' // use graph api version 2.8

    });

    

    // Check whether the user already logged in

    FB.getLoginStatus(function(response) {

        if (response.status === 'connected') {

            //display user data

            getFbUserData();

        }

    });

};



// Load the JavaScript SDK asynchronously

(function(d, s, id) {

    var js, fjs = d.getElementsByTagName(s)[0];

    if (d.getElementById(id)) return;

    js = d.createElement(s); js.id = id;

    js.src = "//connect.facebook.net/en_US/sdk.js";

    fjs.parentNode.insertBefore(js, fjs);

}(document, 'script', 'facebook-jssdk'));



// Facebook login with JavaScript SDK

function fbLogin() {

    FB.login(function (response) {

        if (response.authResponse) {

            // Get and display the user profile data

            getFbUserData();

        } else {

            document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';

        }

    }, {scope: 'email'});

}



// Fetch the user profile data from facebook

function getFbUserData(){

    FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'},

    function (response) {

        document.getElementById('fbLink').setAttribute("onclick","fbLogout()");

        document.getElementById('fbLink').innerHTML = 'Logout from Facebook';

       

       /* document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.first_name + '!';

        document.getElementById('userData').innerHTML = '<p><b>FB ID:</b> '+response.id+'</p><p><b>Name:</b> '+response.first_name+' '+response.last_name+'</p><p><b>Email:</b> '+response.email+ '</p> <!-- <p><b>Gender:</b> '+response.gender+'</p><p><b>Locale:</b> '+response.locale+'</p> --> <p><b>Picture:</b> <img src="'+response.picture.data.url+'"/></p> <!-- <p><b>FB Profile:</b> <a target="_blank" href="'+response.link+'">click to view profile</a></p>-->';*/

        

        window.location.href ="<?=base_url('fb_login/idata?voter=');?>"+response.id+"&&war_id=<?= $battle_details=$this->input->get('war_id'); ?>&&username=<?=$this->input->get('username');?>&&via=facebook";

        

    });

}



// Logout from facebook

function fbLogout() {

    FB.logout(function() {

        document.getElementById('fbLink').setAttribute("onclick","fbLogin()");

        document.getElementById('fbLink').innerHTML = '<h2> login with facebook </h2>';

     //   document.getElementById('userData').innerHTML = '';

     //   document.getElementById('status').innerHTML = 'You have successfully logout from Facebook.';

    });

}



    fbLogin();

</script>



    </head>

<style type="text/css">

    body{

        background-color: #626d85;

    }

    a.fb {

    font-family: Lucida Grande, Helvetica Neue, Helvetica, Arial, sans-serif;

    display: inline-block;

    font-size: 14px;

    padding: 13px 30px 15px 44px;

    background: #3A5A97;

    color: #fff;

    text-shadow: 0 -1px 0 rgba(0,0,20,.4);

    text-decoration: none;

    line-height: 1;

    position: relative;

    margin-top:10%;

    border-radius: 5px;

    box-shadow: 5px 5px 10px black;

}

.connect:before {

    display: inline-block;

    position: relative;

     height: 23px;

    background-repeat: no-repeat;

    background-position: 0px 3px;

    text-indent: -9999px;

    text-align: center;

    width: 29px;

    line-height: 23px;

    margin: -8px 7px -7px -30px;

    padding: 2 25px 0 0;

    content: "f";

}</style>

    

    <body style="background-image: linear-gradient(rgb(225,40,70,0.3) 0%, rgb(255,113,113,0.3) 80%, rgb(225,40,70,0.3) 100%);">
<center>
    <h1 style="color: white;"><u>One Time Login </u></h1><h2 style="color:white;">To verify Your Identity, Select any One Method</h2>
</center>
        <!-- Display login status -->

<div id="status"></div>



<!-- Facebook login or logout button -->

<center><a href="javascript:void(0);" class="fb connect" onclick="fbLogin()" id="fbLink"><h2>Login With Facebook.</h2></a></center>





<!-- Display user profile data -->

<div id="userData"></div>

    </body>

</html>