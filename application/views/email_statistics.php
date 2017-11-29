<?php $this->load->view('header');?>
<div id="wrapper">
    <?php include('navigation.php');?>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <?php include('navbar.php');?>
        </div>
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="ibox-content">
                    <div class="text-center"> 
                        <h2>Date Wise Statistics of sent Emails </h2>
                    </div>
                    <br/>
                    <form method="post" action="<?php echo site_url('chlorocomm/view_sent_emails_satistics')?>" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Date</label>
                            <div class="col-sm-6">
                                <input  type="text" class="form-control" name="select_date" placeholder="click to show datepicker"  id="email_date">
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
                <?php if (@$email_stats) {?>
                <div class="ibox-content">
                    <div class="table-responsive ">
                      <table class="table table-bordered" id="areaToPrint">
                        <tr>
                            <th>Sr.No.</th>
                            <th>Email Recepients</th>
                            <th>Email Subject</th>
                            <th>Email Body</th>
                            <th>Sent Date</th>
                        </tr>
                        <?php 
                        $count=1;
                        echo "<h4>Total result(s) found:&nbsp".count($email_stats)."</h4>"; 
                        foreach(@$email_stats as $row):
                            ?>
                            <tr>
                                <td><?php echo $count++;?></td>
                                <td><?php echo  $row['email_recepients'];?></td>
                                <td><?php echo  $row['email_subject'];?></td>
                                <td><?php echo  $row['email_body'];?></td>
                                <td><?php echo  $row['sent_date'];?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <div class="text-center">
                      <button class="btn btn-warning" type="button" id="printes" onclick="printDiv();" ><i class="fa fa-print"></i> Print</button> 
                  </div>
              </div>
          </div>
          <?php }else{
            echo "<h3 class='text-center'>Sorry... No records founds for selected date</h3>";
        }?>
<?php $this->load->view('footer');?>