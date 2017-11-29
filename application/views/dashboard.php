<?php $this->load->view('header'); ?>    
<div id="wrapper">
    <?php include('navigation.php');?>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <?php include('navbar.php');?>
        </div>
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title" style="background-color:#f39c12;color:#fff;border-color:#de8e0e">
                            <h5>Todays sent Emails</h5>
                            <span class="pull-right"><i class="fa fa-paper-plane fa-lg" aria-hidden="true"></i></span>
                        </div>
                        <div class="ibox-content" style="background-color:#f39c12;color:#fff">
                            <h1 class="no-margins">
                                <?php
                                $this->db->where('sent_date', date('d-m-Y'));
                                $this->db->from('sent_emails_data');
                                echo $this->db->count_all_results();
                                ?></h1>
                                <small>Total Sent Emails</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title" style="background-color:#f56954;color:#fff;border-color:#dc5540">
                                <h5>Todays sent SMS</h5>
                                <span class="pull-right"><i class="fa fa-paper-plane fa-lg" aria-hidden="true"></i></span>
                            </div>
                            <div class="ibox-content" style="background-color:#f56954;color:#fff">
                                <h1 class="no-margins"><?php
                                $sum=0;
                                $this->db->select('no_of_sms');
                                $this->db->where('sms_sent_date', date('d-m-Y'));
                                $this->db->from('sent_sms_data');
                                $result	= $this->db->get()->result_array();
                                foreach ($result as $row){
                                   $sum+=$row['no_of_sms'];
                               }
                               echo $sum;                                     
                               ?></h1>
                               <small>Total Sent SMS</small><br>
                           </div>
                       </div>
                   </div>
                   <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title" style="background-color:#f39c12;color:#fff;border-color:#de8e0e">
                            <h5>Emails</h5>
                            <span class="pull-right"><i class="fa fa-envelope fa-lg" aria-hidden="true"></i></span>
                        </div>
                        <div class="ibox-content" style="background-color:#f39c12;color:#fff">
                            <h1 class="no-margins">
                                <?php
                                $this->db->select('email');
                                $this->db->from('user_contacts_tbl');
                                $this->db->where('isdelete',0);
                                $this->db->where('email !=','');
                                echo $this->db->get()->num_rows();
                                ?>
                            </h1>
                            <small>Total Emails</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title" style="background-color:#f56954;color:#fff;border-color:#dc5540">
                            <h5>Contacts</h5>
                            <span class="pull-right"><i class="fa fa-mobile fa-lg" aria-hidden="true"></i></span>
                        </div>
                        <div class="ibox-content" style="background-color:#f56954;color:#fff">
                            <h1 class="no-margins">
                                <?php
                                $this->db->select('mobile_no');
                                $this->db->from('user_contacts_tbl');
                                $this->db->where('isdelete',0);
                                $smss = $this->db->get();
                                echo $smss->num_rows();
                                ?>
                            </h1>
                            <small>Total Contacts</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div style="box-shadow: -2px 2px 1px 0px #c1c1c1">
                        <div class="ibox-title" style="color:#fff;background-color:#2f9fde;border-color:#1787d2">
                            <p class="lead text-center" style="margin-bottom:5px;"><b>Today's Birthday</b> <i class="fa fa-birthday-cake" aria-hidden="true"></i></p>
                        </div>
                        <div class="ibox-content" style="height:260px">
                            <div class="table-responsive">
                                <table class="table table-bordered" >
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Contact Name</th>
                                        <th>Date of Birth</th>
                                    </tr>
                                    <?php
                                    $count = 1;
                                    $cdata = $this->db->get('user_contacts_tbl')->result_array();
                                    foreach ($cdata as $crow) {
                                        $a = explode('-',$crow['birth_date']);
                                        $day = date('d');
                                        $month = date('m');
                                        if ($day == $a[0] && $month == $a[1]) {
                                            ?>
                                            <tr>
                                                <td><?php echo $count++;?></td>
                                                <td><?php echo $crow['user_name'];?></td>
                                                <td><?php echo $crow['birth_date'];?></td>
                                            </tr>
                                            <?php }} ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="box-shadow: -2px 2px 1px 0px #c1c1c1"> 
                                <div class="ibox-title" style="color:#fff;background-color:#2f9fde;border-color:#1787d2">
                                    <p class="lead text-center" style="margin-bottom:5px;"><b>Today's Anniversary</b> <i class="fa fa-birthday-cake" aria-hidden="true"></i></p>
                                </div>
                                <div class="ibox-content" style="height:260px">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" >
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Contact Name</th>
                                                <th>Date of Birth</th>
                                            </tr>
                                            <tr>
                                                <?php
                                                $count = 1;
                                                $cdata = $this->db->get('user_contacts_tbl')->result_array();
                                                foreach ($cdata as $crow) {
                                                    $a = explode('-',$crow['anniversary_date']);
                                                    $day = date('d');
                                                    $month = date('m');
                                                    if ($day == $a[0] && $month == $a[1]) {
                                                        ?>
                                                        <td><?php echo $count++;?></td>
                                                        <td><?php echo $crow['user_name'];?></td>
                                                        <td><?php echo $crow['anniversary_date'];?></td>
                                                    </tr>
                                                    <?php }} ?>
                                                </table>
                                            </div>
                                        </div> 
                                    </div>  
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div style="box-shadow: -2px 2px 1px 0px #c1c1c1">
                                        <div class="ibox-title" style="color:#fff;background-color:#2f9fde;border-color:#1787d2">
                                            <p class="lead text-center" style="margin-bottom:5px;"><b>Today's Enquiries</b> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></p>
                                        </div>
                                        <div class="ibox-content" style="height:260px">
                                            <?php 
                                            $this->db->where('isdelete',0);
                                            $ArrEnquiry = $this->db->get('customer_enquiries_tbl')->result_array(); ?>
                                            <div class="table-responsive" style="<?php if (count($ArrEnquiry) > 5) {
                                                echo 'overflow-y: scroll;height:225px;';} ?>">
                                                <table class="table table-bordered" >
                                                    <tr>
                                                        <th>Sr. No.</th>
                                                        <th>Name</th>
                                                        <th>Details</th>
                                                    </tr>
                                                    <?php
                                                    $count = 1;
                                                    foreach ($ArrEnquiry as $crow) {
                                                        $a = explode('-',$crow['enq_date']);
                                                        $day = date('d');
                                                        $month = date('m');
                                                        if ($day == $a[0] && $month == $a[1]) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $count++;?></td>
                                                                <td><?php echo $crow['name'];?></td>
                                                                <td><?php echo $crow['details'];?></td>
                                                            </tr>
                                                            <?php }} ?>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div style="box-shadow: -2px 2px 1px 0px #c1c1c1"> 
                                                <div class="ibox-title" style="color:#fff;background-color:#2f9fde;border-color:#1787d2">
                                                    <p class="lead text-center" style="margin-bottom:5px;"><b>Today's Personal Reminders</b> <i class="fa fa-bell" aria-hidden="true"></i></p>
                                                </div>
                                                <div class="ibox-content" style="height:260px">
                                                    <?php
                                                    $this->db->where('isdelete',0); 
                                                    $ArrReminder = $this->db->get('reminder_tbl')->result_array();  
                                                    ?>
                                                    <div class="table-responsive" style="<?php if (count($ArrReminder) > 5) {
                                                        echo 'overflow-y: scroll;height:225px;';} ?>">
                                                        <table class="table table-bordered" >
                                                            <tr>
                                                                <th>Sr. No.</th>
                                                                <th>Title</th>
                                                                <th>Details</th>
                                                            </tr>
                                                            <?php
                                                            $count = 1;
                                                            foreach ($ArrReminder as $crow) {
                                                                $a = explode('-',$crow['rem_date']);
                                                                $day = date('d');
                                                                $month = date('m');
                                                                if ($day == $a[0] && $month == $a[1]) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $count++;?></td>
                                                                        <td><?php echo $crow['title'];?></td>
                                                                        <td><?php echo $crow['details'];?></td>
                                                                    </tr>
                                                                    <?php }} ?>
                                                                </table>
                                                            </div>
                                                        </div> 
                                                    </div>  
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div style="box-shadow: -2px 2px 1px 0px #c1c1c1">
                                                        <div class="ibox-title" style="color:#fff;background-color:#2f9fde;border-color:#1787d2">
                                                            <p class="lead text-center" style="margin-bottom:5px;"><b>My Dues List</b> </p>
                                                        </div>
                                                        <div class="ibox-content" style="height:260px">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered" >
                                                                    <tr>
                                                                        <th>Sr. No.</th>
                                                                        <th>Name</th>
                                                                        <th>Amount</th>
                                                                        <th>Details</th>
                                                                    </tr>
                                                                    <?php
                                                                    $count = 1;
                                                                    $this->db->where('isdelete',0);
                                                                    $cdata = $this->db->get('dues_tbl')->result_array();
                                                                    foreach ($cdata as $crow) {
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $count++;?></td>
                                                                            <td><?php echo $crow['person_name'];?></td>
                                                                            <td><?php echo $crow['dues_amount'];?></td>
                                                                            <td><?php echo $crow['dues_details'];?></td>
                                                                        </tr>
                                                                        <?php } ?>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div style="box-shadow: -2px 2px 1px 0px #c1c1c1"> 
                                                            <div class="ibox-title" style="color:#fff;background-color:#2f9fde;border-color:#1787d2">
                                                                <p class="lead text-center" style="margin-bottom:5px;"><b>My Debtors List</b></p>
                                                            </div>
                                                            <div class="ibox-content" style="height:260px">
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered" >
                                                                        <tr>
                                                                            <th>Sr. No.</th>
                                                                            <th>Name</th>
                                                                            <th>Debt Amount</th>
                                                                            <th>Details</th>
                                                                        </tr>
                                                                        <?php
                                                                        $count = 1;
                                                                        $this->db->where('isdelete',0);
                                                                        $cdata = $this->db->get('debtors_tbl')->result_array();
                                                                        foreach ($cdata as $crow) {
                                                                            ?>
                                                                            <tr>
                                                                                <td><?php echo $count++;?></td>
                                                                                <td><?php echo $crow['person_name'];?></td>
                                                                                <td><?php echo $crow['debt_amount'];?></td>
                                                                                <td><?php echo $crow['debt_details'];?></td>
                                                                            </tr>
                                                                            <?php }?>
                                                                        </table>
                                                                    </div>
                                                                </div> 
                                                            </div>  
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div><!-- /. Wrapper -->
                                                <br>
                                                <div class="footer">
                                                    <div class="pull-right">
                                                        <strong>All rights reserved</strong>.
                                                    </div>
                                                    <div>
                                                        <strong>Copyright</strong> CHLOROComm &copy; <?php echo date('Y') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $this->load->view('footer'); ?>