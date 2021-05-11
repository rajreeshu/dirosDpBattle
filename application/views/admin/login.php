<!DOCTYPE html>
<html>
<head>
	<title>Login-Admin</title>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="<?=base_url();?>utility/js/bootstrap.js"></script>
	<script src="<?=base_url();?>addon/filebody/js/jquery-1.9.1.min.js" type="text/javascript"></script>
		
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>utility/bootstrap.css">

	   <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

<style type="text/css">
	
.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
<body>

<!-- Header -->
<!-- 
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor03">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

 -->
<!-- Login form -->

<form class="form-signin" method="post" action="<?=base_url('admin');?>">
          	     
      <h1 class="h3 mb-3 font-weight-normal">Admin sign in</h1>
      <div class="text-danger" style="margin-top: 10px;">
       <?php 
       if(!empty($email_error=form_error('admin_email'))){
       	echo $email_error;
       }elseif(!empty($pass_error=form_error('admin_pass'))){
       	echo $pass_error;
       }elseif(!empty($invalid)){
       	echo $invalid;
       }

        ?>
        </div>
      <label for="inputEmail" class="sr-only" style="margin-top: 5px;">Email address</label>
      <input type="text" id="inputEmail" class="form-control" placeholder="Email address" name="admin_email" value=<?=set_value('admin_email');?>>

      <br>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="admin_pass" >
      <div class="checkbox mb-3">

      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

    </form>

</body>
</html>