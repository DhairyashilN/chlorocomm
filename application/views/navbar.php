<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <!-- <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a> -->
        <?php 
        $sum=0;
        $this->db->select('no_of_sms');
        $this->db->from('sent_sms_data');
        $result = $this->db->get()->result_array();
        foreach ($result as $row)
            $sum+=$row['no_of_sms'];
        $SMS = $this->db->get('app_settings')->row();
        ?>
       <span style="margin:12px 0px 12px 24px;font-size:14px;" class="btn btn-primary"><b>SMS Credit: <?php if ($SMS->sms_credit == $sum) { echo 0; } else{ echo $SMS->sms_credit-$sum; }?><?php if ($SMS->sms_credit == $sum) { echo '<em style="color:yellow">Please purchase new SMS Credit.</em>'; }?></b></span>
   </div>
   <ul class="nav navbar-top-links navbar-right">
    <li>
        <?php
        $this->db->select('contact');
        $this->db->from('admin');
        $query = $this->db->get()->row();
        if(empty($query->contact)){?>
        <h4 style="color:red">Please update your contact no.<a href="<?php echo site_url('chlorocomm/edit_profile');?>" style="color:red">Click Here</a></h4>
        <?php }?>
    </li>
    <li>
        <div class="dropdown profile-element"> 
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <!--<span>
                <img alt="image" class="img-circle" src="<?php ///echo base_url();?>assets/img/Admin-icon.png" />
            </span> -->
            <span class="text-xs block"> <span style="color:#fff;">A</span>ADMIN <b class="caret"></b> </span> </a>
            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                <li class="<?php if ($page_name == 'edit_profile') echo 'active'; ?>"><a href="<?php echo site_url('profile')?>">Profile</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo site_url('login/logout')?>">Logout</a></li>
            </ul>
        </div>
    </li>

</ul>

</nav>

