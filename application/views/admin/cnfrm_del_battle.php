<!DOCTYPE html>
<html>
<head>
	<title>Confirm To Delete</title>

 <script src="<?=base_url();?>addon/filebody/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>utility/js/bootstrap.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>utility/bootstrap.css">

<style type="text/css">
	body{
		background: #d0d0d0;
	}
</style>

</head>
<body>


  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background: #f48024;">
      <div class="modal-header">
        <h5 class="modal-title" style="color: black;">Confirmation Box</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         
        </button>
      </div>
      <div class="modal-body">
        <p style="font-size:20px; color:black;">Are You sure Want to Delete this Battle</p>
      </div>
      <div class="modal-footer">
    
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location='<?= base_url("admin/listed_battles");?>'">Close</button>
            <button type="button" class="btn btn-danger" onclick="window.location='<?= base_url("admin/delete_battle?battle_id=$battle_id");?>'">Delete Battle</button>
      </div>
    </div>
  </div>


</body>
</html>