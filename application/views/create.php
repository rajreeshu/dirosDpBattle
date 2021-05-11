<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>

	<script src="<?=base_url();?>utility/js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>utility/bootstrap.css">
	<script src="<?=base_url();?>addon/filebody/js/jquery-1.9.1.min.js" type="text/javascript"></script>

<body>




<?= form_open('create/index'); ?> 
  <fieldset style="margin:0px 30px 0px 20px;">
    <legend><u>Admin Panel</u></legend>




    <div class="form-group">
      <label for="exampleInputEmail1">Username</label>
      <?= form_input(['class'=>'form-control','id'=>'exampleInputEmail1','placeholder'=>'username','name'=>'username','style'=>'width:300px;','value'=>set_value('username')]);  ?>
      <?= form_error('username',"<p class='text-danger'>","</p>"); ?>
     <!-- <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username">-->
     
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <?= form_password(['class'=>'form-control','placeholder'=>'password','style'=>'width:300px;','name'=>'password']); ?>
      <?= form_error('password',"<p class='text-danger'>","</p>"); ?>
      <!--<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">-->
    </div>
    <?= form_submit(['class'=>'btn btn-primary','value'=>'submit','name'=>'submit']); ?> 
   <!-- <button type="submit" class="btn btn-primary">Submit</button>-->
  </fieldset>
</form>



</body>
</html>