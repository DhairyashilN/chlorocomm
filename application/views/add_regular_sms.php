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
            <a href="<?php echo site_url('schedule_regular_sms');?>" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to List</a>
          </div>
          <?php if (isset($ObjSchedule) && !empty($ObjSchedule)){ ?>
          <form method="post" action="<?php echo site_url('store_regular_sms/'.$ObjSchedule->id)?>" class="form-horizontal">
            <?php }else{ ?>
            <form method="post" action="<?php echo site_url('store_regular_sms')?>" class="form-horizontal">
              <?php } ?>
              <div style="display:none">
                <input type="hidden" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>">
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Template</label>
                <div class="col-sm-6">
                  <select class="form-control" name="sms_template" id="sms_templateOne">
                    <option value="">Select Template</option>
                    <?php foreach($ArrTemplates as $row): ?>
                      <option value="<?php echo $row['id'];?>" <?php if(!empty($ObjSchedule->sms_template) && $row['id'] == $ObjSchedule->sms_template) { echo 'selected';} ?>><?php echo $row['title'];?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">SMS Body</label>
                <div class="col-sm-10">
                  <textarea name="sms_body_one" rows="7"  id="sms_body_one" class="form-control" required><?php echo ( isset($ObjSchedule->sms_body) && !empty($ObjSchedule->sms_body))? $ObjSchedule->sms_body : '' ?></textarea>
                  <p class="help-block text-warning" id="count"><b>Messages:<span class="messages"></span> | Remaining: <span class="remaining"></span></b></p>
                  <input type="hidden" name="sms_count" id="sms_count"/>
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
