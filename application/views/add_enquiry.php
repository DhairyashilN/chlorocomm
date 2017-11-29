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
          <a href="<?php echo site_url('customer_enquiry');?>" class="btn btn-warning pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to List</a>
          <h2>Add Customer Enquiry</h2>
        </div>
        <div class="ibox-content">
          <?php if (isset($ObjEnquiry) && !empty($ObjEnquiry)){ ?>
          <form method="post" action="<?php echo site_url('store_enquiry/'.$ObjEnquiry->id)?>" class="form-horizontal">
            <?php }else{ ?>
            <form method="post" action="<?php echo site_url('store_enquiry')?>" class="form-horizontal">
              <?php } ?>
              <div style="display:none">
                <input type="hidden" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>">
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"> Customer Name</label>
                <div class="col-sm-8">
                  <input type="text" name="cname" id="cname" class="form-control" required="" value="<?php echo ( isset($ObjEnquiry->name) && !empty($ObjEnquiry->name))? $ObjEnquiry->name : '' ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"> Details</label>
                <div class="col-sm-8">
                  <textarea name="details" id="sms_body_one" class="form-control" required="" rows="7" maxlength="305"><?php echo ( isset($ObjEnquiry->details) && !empty($ObjEnquiry->details))? $ObjEnquiry->details : '' ?> </textarea>
                  <p class="help-block text-warning" id="count"><b>Messages:<span class="messages"></span> | Remaining: <span class="remaining"></span></b></p>
                  <input type="hidden" name="sms_count" id="sms_count" value="<?php echo ( isset($ObjEnquiry->sms_count) && !empty($ObjEnquiry->sms_count))? $ObjEnquiry->sms_count : ''  ?>" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"> Enquiry Date</label>
                <div class="col-sm-3">
                  <input type="text" name="enq_date" id="enq_date" class="form-control" required="" value="<?php echo ( isset($ObjEnquiry->enq_date) && !empty($ObjEnquiry->enq_date))? $ObjEnquiry->enq_date : '' ?>">
                </div>
                <label class="col-sm-2 control-label"> Enquiry Time</label>
                <div class="col-sm-3">
                  <input type="text" name="enq_time" id="enq_time" class="timepicker form-control" required="" value="<?php echo ( isset($ObjEnquiry->enq_time) && !empty($ObjEnquiry->enq_time))? date('h:i A',$ObjEnquiry->enq_time) : '' ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Notify By SMS</label>
                <div class="col-sm-2">
                  <input type="checkbox" name="notify_sms" id="notify_sms" value="1" <?php if((isset($ObjEnquiry->sms_notify) && !empty($ObjEnquiry->sms_notify)) && $ObjEnquiry->sms_notify == 1){ echo "checked";} ?>/> Yes
                </div>
              </div>
              <div class="hr-line-dashed"></div>
              <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                  <button class="btn btn-primary" type="submit"><?php echo (isset($ObjEnquiry) && !empty($ObjEnquiry)) ? 'Update': 'Add Enquiry' ?></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php $this->load->view('footer'); ?>
