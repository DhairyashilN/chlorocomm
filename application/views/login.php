<?php if ($this->session->userdata('login')!=1){}else{redirect('login/dashboard');}?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CHLOROComm | Login</title>
  <link rel=" short icon" href="<?php echo base_url();?>img/chlorodots_logo.ico">
  <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Doppio+One" rel="stylesheet">
</head>
<body class="" style="background-color:#eaebed;">
  <div class="loginColumns animated fadeInDown" style="padding-top:160px !important;">
    <div class="row" style="margin-top: -70px;">
      <div class="col-lg-12 text-center">
        <img src="<?php echo base_url();?>assets/img/chlm.jpg" class="img img-responsive" style="margin: 0px auto;">
        <b style="margin-left: 225px;color: #000;">by Chlorodots</b>
      </div>
    </div>
    <div class="row" style="margin-top: 30px;">
      <div class="col-md-offset-3  col-md-6">
       <?php if($this->session->flashdata('loginfail')){?>
       <div class="alert alert-danger alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <?php echo $this->session->flashdata('loginfail');?>
       </div>
       <?php }?>
       <?php if($this->session->flashdata('logout_notification')){?>
       <div class="alert alert-success alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <?php echo $this->session->flashdata('logout_notification');?>
       </div>
       <?php }?>
       <div class="ibox-content">
        <?php echo $this->session->flashdata('invalid'); ?>
          <?php echo form_open('login', array('method'=>'post','class'=>'m-t')); ?>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Username" name="uname" id="uname" tabindex="1" required>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" name="upass" id="upass" tabindex="2" required>
          </div>
          <button type="submit" class="btn block full-width m-b" tabindex="3" style="background:#2f9fd9;border-color:#2f9fd9;color:#fff;">Login</button>
          <a href="#" tabindex="4">
            <small>Forgot password?</small>
          </a>
          <?php form_close();?>
        </div>
      </div>
    </div>
  </body>
  </html>
