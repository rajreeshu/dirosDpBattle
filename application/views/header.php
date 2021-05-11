<!DOCTYPE html>
<html>
<head>
	<title>Battle Ground</title>

<style type="text/css">
  .btn1 {
  display: inline-block;
  padding: .375rem 1rem;
  font-size: 1rem;
  font-weight: normal;
  line-height: 1.5;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  -ms-touch-action: manipulation;
      touch-action: manipulation;
  cursor: pointer;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  border: .0625rem solid transparent;
  border-radius: .25rem;
}


</style>

<!-- 
<script src="utility/jquery.js"></script>
 -->
	<script src="<?=base_url();?>utility/js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>utility/bootstrap.css">
</head>
<body>

<!-- Header start -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="border:black;">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor02">
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
      <button class="btn1 btn-secondary my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
<!-- Header end -->
