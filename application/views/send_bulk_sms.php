<?php $this->load->view('header');?>
<div id="wrapper">
  <?php include('navigation.php');?>
  <div id="page-wrapper" class="gray-bg">
    <div class="row border-bottom">
      <?php include('navbar.php');?>
    </div>
    <div class="wrapper wrapper-content">
      <div class="row">
        <?php if($this->session->flashdata('sms_sent_success')){?>
        <div class="alert alert-success">
          <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong><?php echo $this->session->flashdata('sms_sent_success');?></strong> 
        </div>
        <?php }?>
        <div class="ibox-content">
          <div class="panel panel-default">
            <div class="panel-heading"><h3><i class="fa fa-mobile"></i> Send Group/Bulk SMS</h3></div>
            <div class="panel-body">
              <form method="post" action="<?php echo site_url('send_bulk_sms')?>" class="form-horizontal">
                <div style="display:none">
                  <input type="hidden" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>">
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">To</label>
                  <div class="col-sm-10">
                    <select data-placeholder="Choose Recepients" name="bunch_receiver" tabindex="3" class="form-control chosen-select ">
                      <option value=""></option>
                      <?php 
                      $smscat = $this->db->get('category_tbl')->result_array();
                      foreach($smscat as $row):
                        ?>
                        <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                      <?php endforeach;?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">SMS Body</label>
                  <div class="col-sm-10">
                    <textarea name="sms_body_one" rows="7"  id="sms_body_one" class="form-control" required></textarea>
                    <p class="help-block text-warning" id="count"><b>Messages:<span class="messages"></span> | Remaining: <span class="remaining"></span></b></p>
                    <input type="hidden" name="sms_count" id="sms_count"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
                    <input type="checkbox" name="schedule_sms" id="schedule_sms" value="Yes"/> Schedule SMS
                  </div>
                  <div class="form-group date_time_block" style="display:none;">
                    <div class="col-sm-3">
                      <input type="text" name="schedule_date" id="schedule_date" class="form-control" placeholder="Date">
                    </div>
                    <div class="col-sm-3">
                      <input type="text" name="schedule_time" id="schedule_time" class="timepicker form-control" placeholder="Time">
                    </div>
                  </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                  <div class="col-sm-4 col-sm-offset-2">
                    <button class="btn btn-primary send_sms_btn" type="submit" name="send_sms_btn" value="send_sms_btn"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</button>
                    <button class="btn btn-primary schedule_sms_btn" type="submit" style="display:none;" name="schedule_sms_btn" value="schedule_sms_btn"><i class="fa fa-paper-plane" aria-hidden="true"></i> Schedule SMS</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('footer'); ?>
