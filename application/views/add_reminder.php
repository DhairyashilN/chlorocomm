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
        <div class="page-heading">
          <a href="<?php echo site_url('personal_reminder');?>" class="btn btn-warning pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to List</a>
          <h2>Add Personal Reminder</h2>
        </div>
        <div class="ibox-content">
          <?php if (isset($ObjReminder) && !empty($ObjReminder)){ ?>
          <form method="post" action="<?php echo site_url('store_reminder/'.$ObjReminder->id)?>" class="form-horizontal">
            <?php }else{ ?>
            <form method="post" action="<?php echo site_url('store_reminder')?>" class="form-horizontal">
              <?php } ?>
              <div style="display:none">
                <input type="hidden" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>">
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Title</label>
                <div class="col-sm-8">
                  <input type="text" name="title" id="title" class="form-control" required="" value="<?php echo ( isset($ObjReminder->title) && !empty($ObjReminder->title))? $ObjReminder->title : '' ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"> Details</label>
                <div class="col-sm-8">
                  <textarea name="details" id="sms_body_one" class="form-control" required="" rows="7" maxlength="305"><?php echo ( isset($ObjReminder->details) && !empty($ObjReminder->details))? $ObjReminder->details : '' ?> </textarea>
                  <p class="help-block text-warning" id="count"><b>Messages:<span class="messages"></span> | Remaining: <span class="remaining"></span></b></p>
                  <input type="hidden" name="sms_count" id="sms_count" value="<?php echo ( isset($ObjReminder->sms_count) && !empty($ObjReminder->sms_count))? $ObjReminder->sms_count : ''  ?>" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Reminder Date</label>
                <div class="col-sm-3">
                  <input type="text" name="rem_date" id="rem_date" class="form-control" required="" value="<?php echo ( isset($ObjReminder->rem_date) && !empty($ObjReminder->rem_date)) ? $ObjReminder->rem_date : '' ?>">
                </div>
                <label class="col-sm-2 control-label">Reminder Time</label>
                <div class="col-sm-3">
                  <input type="text" name="rem_time" id="rem_time" class="timepicker form-control" required="" value="<?php echo ( isset($ObjReminder->rem_time) && !empty($ObjReminder->rem_time))? date('h:i A',$ObjReminder->rem_time) : '' ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Notify By SMS</label>
                <div class="col-sm-2">
                  <input type="checkbox" name="notify_sms" id="notify_sms" value="1" <?php if((isset($ObjReminder->sms_notify) && !empty($ObjReminder->sms_notify)) && $ObjReminder->sms_notify == 1){ echo "checked";} ?>/> Yes
                </div>
              </div>
              <div class="hr-line-dashed"></div>
              <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                  <button class="btn btn-primary" type="submit"><?php echo (isset($ObjReminder) && !empty($ObjReminder)) ? 'Update': 'Add Reminder' ?></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php $this->load->view('footer'); ?>