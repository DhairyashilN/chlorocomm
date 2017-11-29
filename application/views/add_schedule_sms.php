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
          <div class="text-right" style="margin-bottom:20px;">
            <a href="<?php echo site_url('scheduled_sms');?>" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to List</a>
          </div>
          <?php if (isset($ObjSchedule) && !empty($ObjSchedule)){ ?>
          <form method="post" action="<?php echo site_url('store_scheduled_sms/'.$ObjSchedule->id)?>" class="form-horizontal">
            <?php }else{ ?>
            <form method="post" action="<?php echo site_url('store_scheduled_sms')?>" class="form-horizontal">
              <?php } ?>
              <div style="display:none">
                <input type="hidden" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>">
              </div>
              <?php if ($ObjSchedule->sms == 'quick'): ?>
                <input type="hidden" name="sms" value="<?php echo $ObjSchedule->sms;?>">
                <div class="form-group">
                  <label class="col-sm-2 control-label">To</label>
                  <div class="col-sm-10">
                    <textarea name="receiver" rows="5" id="receiver" class="form-control" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" required><?php echo ( isset($ObjSchedule->receivers) && !empty($ObjSchedule->receivers))? implode(',',unserialize($ObjSchedule->receivers)) : '' ?></textarea>
                    <p class="help-block text-danger"><i class="fa fa-info-circle"></i> For multiple Mobile numbers use Comma ( , ) between mobile numbers.</p>
                  </div>
                </div>
              <?php endif ?>
              <?php if ($ObjSchedule->sms == 'individual'): ?>
                <input type="hidden" name="sms" value="<?php echo $ObjSchedule->sms;?>">
                <div class="form-group">
                  <label class="col-sm-2 control-label">To</label>
                  <div class="col-sm-10">
                    <select data-placeholder="Choose Recepients" name="bunch_receiver[]" multiple  tabindex="3" class="form-control chosen-select" required="">
                      <?php 
                      $classes = $this->db->get('user_contacts_tbl')->result_array();
                      foreach($classes as $row):
                        ?>
                        <option value="<?php echo $row['mobile_no'];?>"><?php echo $row['user_name'];?></option>
                      <?php endforeach;?>
                    </select>
                  </div>
                </div>
              <?php endif ?>
              <?php if ($ObjSchedule->sms == 'bulk'): ?>
                <input type="hidden" name="sms" value="<?php echo $ObjSchedule->sms;?>">
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
            <?php endif ?>
            <div class="form-group">
              <label class="col-sm-2 control-label">SMS Body</label>
              <div class="col-sm-10">
                <textarea name="sms_body_one" rows="7"  id="sms_body_one" class="form-control" required><?php echo ( isset($ObjSchedule->sms_body) && !empty($ObjSchedule->sms_body))? $ObjSchedule->sms_body : '' ?></textarea>
                <p class="help-block text-warning" id="count"><b>Messages:<span class="messages"></span> | Remaining: <span class="remaining"></span></b></p>
                <input type="hidden" name="sms_count" id="sms_count" value="<?php echo ( isset($ObjSchedule->sms_count) && !empty($ObjSchedule->sms_count))? $ObjSchedule->sms_count : ''  ?>" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Date</label>
              <div class="col-sm-3">
                <input type="text" name="schedule_date" id="schedule_date" class="form-control" required="" value="<?php echo ( isset($ObjSchedule->scheduled_date) && !empty($ObjSchedule->scheduled_date))? $ObjSchedule->scheduled_date : '' ?>">
              </div>
              <label class="col-sm-2 control-label">Time</label>
              <div class="col-sm-3">
                <input type="text" name="schedule_time" id="time" class="timepicker form-control" required="" value="<?php echo ( isset($ObjSchedule->scheduled_time) && !empty($ObjSchedule->scheduled_time))? date('h:i A',$ObjSchedule->scheduled_time) : '' ?>">
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <div class="col-sm-4 col-sm-offset-2">
                <button class="btn btn-primary" type="submit">Schedule</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php $this->load->view('footer'); ?>
