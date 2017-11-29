<?php $this->load->view('header');?>
<div id="wrapper">
    <?php include('navigation.php');?>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <?php include('navbar.php');?>
        </div>
        <div class="wrapper wrapper-content">
            <?php if($this->session->flashdata('flash_message')){?>
            <div class="alert alert-info alert-dismissible" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <?php echo  $this->session->flashdata('flash_message');?>
           </div>
           <?php }?>
           <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Change Password</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="<?php echo site_url('change_password');?>">
                            <div style="display:none">
                              <input type="hidden" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>">
                          </div>
                          <?php foreach ($details as $row){?>
                          <div class="form-group"><label class="col-sm-2 control-label">User Name</label>
                            <div class="col-sm-6"><input type="text" class="form-control" value="<?php echo $row['username'];?>" disabled></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Contact No</label>
                            <div class="col-sm-6"><input type="text" class="form-control" value="<?php echo $row['contact'];?>" name="contact"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Current Password</label>
                            <div class="col-sm-6"><input type="password" class="form-control" name="password" ></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">New Password</label>
                            <div class="col-sm-6"><input type="password" class="form-control" name="newpassword" id="newpassword" onkeyup="passstrength();"  ></div>
                            <span id="pstr" ></span><span id="pstrclr"></span>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Confirm New Password</label>
                            <div class="col-sm-6">
                               <input type="password" class="form-control" name="cpassword" id="cpassword" onkeyup="confirmpswd();" >
                               <p id="pmsg"></p>
                           </div>
                       </div>
                       <?php } ?>
                       <div class="hr-line-dashed"></div>
                       <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-white" type="reset">Cancel</button>
                            <button class="btn btn-primary" type="submit">Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php $this->load->view('footer');?>
</body>
</html>
