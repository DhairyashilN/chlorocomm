<?php $this->load->view('header');?>
<div id="wrapper">
    <div id="navb"><?php include('navigation.php');?></div>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <?php include('navbar.php');?>
        </div>
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="page-heading">
                  <h2>Datewise statistics of sent SMS </h2>
              </div>
              <div class="ibox-content" id="dtpick">
                <form method="post" action="<?php echo site_url('view_sent_sms_satistics')?>" class="form-horizontal" onsubmit="return checkdatediff();">
                    <div style="display:none">
                        <input type="hidden" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> From Date</label>
                        <div class="col-sm-3">
                            <input  type="text" class="form-control" name="from_date" placeholder="click to show datepicker"  id="from_date" required="">
                        </div>
                        <label class="col-sm-1 control-label"> To Date</label>
                        <div class="col-sm-3">
                            <input  type="text" class="form-control" name="to_date" placeholder="click to show datepicker"  id="to_date" required="">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-white" type="reset">Cancel</button>
                            <button class="btn btn-primary" type="submit">View</button>
                        </div>
                    </div>
            </form>
        </div>
        <br><br>
        <?php 
        if (isset($sms_stats) && !empty($sms_stats)) {?>
        <div class="ibox-content">
            <div id="show">
                <div class="table-responsive" >
                 <table class="table table-bordered" id="example1" >
                    <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>SMS</th>
                            <th>Mobile No</th>
                            <th>Sent Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $count=1;
                        foreach(@$sms_stats as $row):
                            ?>
                            <tr>
                                <td width="7%"><?php echo $count++;?></td>
                                <td><?php echo $row['sms_body'];?> </td>
                                <td><?php echo $row['sms_recepients']?></td>
                                <td><?php echo $row['sms_sent_date'];?>&nbsp; <?php echo $row['time'];?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="text-center">
                  <button class="btn btn-warning" type="button" id="printss" onclick="printDiv();" ><i class="fa fa-print"></i> Print</button> 
              </div>
          </div>
      </div>
  </div>
  <?php }//else{
    // echo "<h3 class='text-center'>Sorry... No records founds for selected date</h3>";
  //} ?>
  <?php $this->load->view('footer');?>                                        
  <script type="text/javascript">

  </script>
