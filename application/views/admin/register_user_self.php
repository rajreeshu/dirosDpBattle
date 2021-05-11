<!DOCTYPE html>
<html>
<head>
	<title>Register User</title>

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

<section   style="margin-top: -10px; margin-left: 2%;  margin-bottom: 15px;">
  
  <?php echo form_open_multipart("admin/register_self");?>

<div class="form-group has-danger" style="max-width:500px;">
  <h5>Username <span style="color: maroon;font-size: 15px;"><?= form_error('username');?></span></h5>
  
  <input type="text" class="form-control border border-dark " id="inputInvalid" placeholder="Username" name="username" value="<?=set_value('username');?>">
  <div class="invalid-feedback">Sorry, that username's taken. Try another?</div>
</div>

<div class="form-group has-danger" style="max-width:500px;">
  <h5> Full Name  <span style="color: maroon;font-size: 15px;"><?= form_error('name');?></span></h5>
  <input type="text" class="form-control border border-dark " id="inputInvalid" placeholder="Full Name" name="name" value="<?=set_value('name');?>">
  <div class="invalid-feedback">Sorry, that username's taken. Try another?</div>
</div>




<div class="form-group has-danger" style="max-width:500px;">
  <h5>FB Id Link </h5>
  <textarea type="text" class="form-control border border-dark " id="inputInvalid" placeholder="Fb Link" name="fb_link" value="<?=set_value('fb_link');?>"></textarea>
  <div class="invalid-feedback">Sorry, that username's taken. Try another?</div>
</div>

<div class="form-group has-danger" style="max-width:500px;">
  <h5>Insta Id Link </h5>
  <textarea type="text" class="form-control border border-dark " id="inputInvalid" placeholder="Insta Link" name="insta_link" value="<?=set_value('insta_link');?>"></textarea>
  <div class="invalid-feedback">Sorry, that username's taken. Try another?</div>
</div>

<div class="form-group has-danger" style="max-width:500px;">
  <h5>TikTok Id Link </h5>
  <textarea type="text" class="form-control border border-dark " id="inputInvalid" placeholder="Tik Tok Link" name="tiktok_link" value="<?=set_value('tiktok_link');?>"></textarea>
  <div class="invalid-feedback">Sorry, that username's taken. Try another?</div>
</div>



<h5>User Image</h5>

        <input type="file" class="form-control-file" id="inputGroupFile02" name="user_image">

      <p><?php print_r($this->upload->display_errors());?></p>

<input type="Submit" name="submit_save" class="btn btn-info" value="Save User Detail">

</form>



</section>


</body>
</html>
