<!DOCTYPE html>
<html>
<head>
  <title>My Battles</title>
  <script src="<?=base_url();?>addon/filebody/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>utility/js/bootstrap.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>utility/bootstrap.css">

<style type="text/css">

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

.card {
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  transition: all 0.2s ease-in-out;
  box-sizing: border-box;
  margin-top:10px;
  margin-bottom:10px;
  background-color:#FFF;
}

.card:hover {
  box-shadow: 0 5px 5px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
}
.card > .card-inner {
  padding:10px;
}
.card .header h2, h3 {
  margin-bottom: 0px;
  margin-top:0px;
}
.card .header {
  margin-bottom:5px;
}
.card img{
  width:100%;
}
  
</style>

</head>
<body>



<button type="button" class="btn btn-primary btn-lg btn-block" style="width:30%; float:right; margin:20px;" onclick="window.location.href = '<?=base_url();?>admin/set_battle'">Setup Battle</button>
<center>
<section style="margin-top: -10px; margin-left: 2%;  margin-bottom: 15px;">
  <h4 style="margin-top: -30px; color: black;">MY BATTLES</h4>
  
    <div class="container">
      <div class="row"  style="margin-top: -20px;">
<?php

foreach ($battle_list as $battle):


 $players=$this->database->war_detail($battle->id)->result();
$battle_time_left=$this->database->battle_time_left($battle->id);

//print_r($players);

if(empty($battle->start_time)){
    $battle_status= '<span class="badge badge-info">Battle is Not Started</span>';

    $on_click="admin/delete_battle_cnfrm?battle_id=$battle->id";
    $start_battle_btn="block";
    $delete_battle_btn="block";
}else{
if (!array_filter($battle_time_left)) {
  $battle_status= '<span class="badge badge-danger">Battle is Finished</span>';
  $start_battle_btn='none';
  $delete_battle_btn="none";
}else{
  $battle_status= '<span class="badge badge-success">Battle is Running</span>';
  $start_battle_btn='none';
  $delete_battle_btn="block";
}
}
?>


<div class="col-sm-4">
  <div class="card" style="border-radius: 10px;">
    <div class="image" style="display: flex; background:#a8aaa9; border-radius: 10px 10px 0px 0px;">
      <?php
        foreach ($players as $player):
        $fighter=  $this->database->fighter_detail($player->username)->row();
        
      ?>
      <div style="display: flex; flex-direction: column; background: #d4b2b4;  width: 50%; margin:5px; box-shadow: 1px 1px 3px grey; ">
      <img src="<?=base_url('utility/battle-images').'/'.$player->img_name;?>" style="height: 160px; object-fit: contain; background: #d0d0d0"/>
      <h5 style="color: black;"><?=$fighter->name.'<p style="font-size:18px;">( '.$player->username.' )</p>';?></h5>
      </div>
    <?php endforeach; ?>
    </div>
    <div class="card-inner">
    
    <div class="row m-1 p-1 rounded" style="background: #ffcb74;">
        <div class="col-4 justify-content-center">
          <a href="<?=base_url();?>/admin/battle_start_notify?battle_id=<?=$battle->id;?>" target="black"> <div class="bg-warning text-white pr-1 pl-1 rounded" style="float: left;">Battle Started</div></a>
        </div>

        
        <div class="col-3">
          <a href="<?=base_url();?>/admin/battle_reminder?battle_id=<?=$battle->id;?>" target="black"> <div class="bg-warning text-white pr-1 pl-1 rounded" style="float: left; height: 100%;">Reminder</div></a>
        </div>

        <div class="col-5">
          <a href="<?=base_url();?>/admin/battle_end_notify?battle_id=<?=$battle->id;?>" target="black"> <div class="bg-warning text-white pr-1 pl-1 rounded" style="float: left;">Battle End (Edit)</div></a>
        </div>

      </div>

            <div class="row m-1 p-1 rounded" style="background: #ff9c71;">
        <div class="col-6">
          <a href="<?=base_url();?>/admin/battle_reminder?battle_id=<?=$battle->id;?>" target="black"> <div class="bg-danger text-white pr-1 pl-1 rounded">Battle Start (Post)</div></a>
        </div>
  
        <div class="col-6">
          <a href="<?=base_url();?>/admin/battle_end_post?battle_id=<?=$battle->id;?>" target="black"> <div class="bg-danger text-white pr-1 pl-1 rounded">Battle End ( Post )</div></a>
        </div>


      </div>
     
      <div class="header">
     <?=$battle_status;?>
     <button type="button" class="btn btn-primary btn-sm" style="float: right;" onclick="window.open('<?= base_url("home?battle_id=$battle->id");?>','_blank')">Battle Link: <?=$battle->id;?></button>

        <h3 style="color: #123123; font-size: 30px;"><span style="font-size: 20px;">Heading:-</span><?=$battle->heading;?></h3>
    </div>
    <div class="content">
      <h6>Battle End:- <?=$battle->end_time.'( '.$battle->run_time.' Hrs )';?></h6>
      <button type="button" class="btn btn-primary"  onclick="window.location='<?= base_url("admin/start_battle_left?battle_id=$battle->id");?>'" style="float: left; display: <?=$start_battle_btn;?>">Start Battle</button>

      <button type="button" class="btn btn-danger"  onclick="window.location='<?= base_url("admin/delete_battle_cnfrm?battle_id=$battle->id");?>'" style="float: right; display: <?=$delete_battle_btn;?>">Delete Battle</button>

    </div>
      </div>
  </div>
</div>

<?php

endforeach;
?>



</div>
</div>
</section>


</body>
</html>
