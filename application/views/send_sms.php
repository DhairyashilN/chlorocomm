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
            <div class="panel-heading"><h3><i class="fa fa-mobile"></i> Send Quick SMS</h3></div>
            <div class="panel-body">
              <form method="post" action="<?php echo site_url('quick_sms')?>" class="form-horizontal">
                <div style="display:none">
                  <input type="hidden" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>">
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">To</label>
                  <div class="col-sm-10">
                    <textarea name="receiver" rows="5" id="receiver" class="form-control" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" required></textarea>
                    <p class="help-block text-danger"><i class="fa fa-info-circle"></i> For multiple Mobile numbers use Comma ( , ) between mobile numbers.</p>
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
          <div class="hr-line-dashed"></div>
          
        </div>
        <br/><br/>
      <!-- <div class="ibox-content">
        <h3 class="text-center"><i class="fa fa-user"></i> <i class="fa fa-mobile"></i> Send SMS to indivudal person </h3>
        <hr/>
        <br/>
        <form method="post" action="<?php echo site_url('chlorocomm/send_it1')?>" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label">To</label>
            <div class="col-sm-6">
              <select data-placeholder="Choose Recepients" name="bunch_receiver[]"multiple  tabindex="3" class="form-control chosen-select ">
                <option value=""></option>
                <?php 
                $classes = $this->db->get('user_contacts_tbl')->result_array();
                foreach($classes as $row):
                  ?>
                  <option value="<?php echo $row['mobile_no'];?>"><?php echo $row['user_name'];?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">SMS Body</label>
            <div class="col-sm-6">
              <textarea name="sms_body" rows="10"  id="sms_body" class="form-control" maxlength=160 required></textarea>
              <p id="count1"></p>
            </div>
          </div>
          <div class="hr-line-dashed"></div>
          <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
              <button class="btn btn-primary" type="submit">Send</button>
            </div>
          </div>
        </form>
      </div> -->
      <!-- <script type="text/javascript">
        document.getElementById('sms_body').onkeyup = function () 
        {
          document.getElementById('count1').innerHTML = "Characters left: " + (160 - this.value.length);
        };
      </script> -->
      <br>
      <!-- <div class="ibox-content">
        <h3 class="text-center"><i class="fa fa-users"></i> <i class="fa fa-mobile"></i> Send Bulk SMS </h3>
        <hr/>
        <br/>
        <form method="post" action="<?php echo site_url('chlorocomm/send_bulk')?>" class="form-horizontal">
          <?php //print_r($category);?>
          <div class="form-group">
            <label class="col-sm-2 control-label">To</label>
            <div class="col-sm-6">
              <select data-placeholder="Choose Recepients" name="bunch_receiver" multiple tabindex="3" class="form-control chosen-select ">
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
            <div class="col-sm-6">
              <textarea name="bulk_sms_body" rows="10"  id="bulk_sms_body" class="form-control" maxlength=160 required></textarea>
              <p id="count2"></p>
            </div>
          </div>
          <div class="hr-line-dashed"></div>
          <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
              <button class="btn btn-primary" type="submit">Send</button>
            </div>
          </div>
        </form>
      </div> -->
      <!-- <script type="text/javascript">
        document.getElementById('bulk_sms_body').onkeyup = function () 
        {
          document.getElementById('count2').innerHTML = "Characters left: " + (160 - this.value.length);
        };
      </script> -->
    </div>
  </div>
</div>
</div>
<?php $this->load->view('footer'); ?>
