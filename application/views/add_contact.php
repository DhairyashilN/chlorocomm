<?php $this->load->view('header');?>
<div id="wrapper">
  <?php include('navigation.php');?>
  <div id="page-wrapper" class="gray-bg">
    <div class="row border-bottom">
      <?php include('navbar.php');?>
    </div>
    <div class="wrapper wrapper-content">
      <div class="row">
        <?php if (validation_errors()) {
          echo '<div class="alert alert-danger" role="alert">';
          echo validation_errors();
          echo '</div>';
        } ?>
        <div class="page-heading">
          <a href="<?php echo site_url('contacts');?>" class="btn btn-warning pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to List</a>
          <h2>Add Contact</h2>
        </div>
        <div class="ibox-content">
          <?php if (isset($ObjContact) && !empty($ObjContact)) { ?>
          <?php echo form_open('store_contact/'.$ObjContact->id, array('method'=>'post','class'=>'form-horizontal','autocomplete'=>'off')); ?>
          <?php }else { ?>
          <?php echo form_open('store_contact', array('method'=>'post','class'=>'form-horizontal','autocomplete'=>'off')); ?>
          <?php } ?>
          <div class="form-group">
            <label class="col-sm-2 control-label">Select Category <i style="color:red">*</i></label>
            <div class="col-sm-6">
              <select class="form-control" name="category" id="category" required="" tabindex="1">
                <option value="">Select Category</option>
                <?php foreach($ArrCat as $row): ?>
                  <option value="<?php echo $row['id'];?>" <?php if(!empty($ObjContact->category_name) && $row['id'] == $ObjContact->category_name) { echo 'selected';} ?>><?php echo $row['name'];?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Select Type</label>
            <div class="col-sm-6">
              <select class="form-control" name="type" id="type" tabindex="2">
                <option value="">Select Type</option>
                <?php foreach($ArrType as $trow): ?>
                  <option value="<?php echo $trow['id'];?>" <?php if(!empty($ObjContact->type_name) && $trow['id'] == $ObjContact->type_name) { echo 'selected';} ?>><?php echo $trow['name'];?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Enter Name <i style="color:red">*</i></label>
            <div class="col-sm-6">
              <input type="text" name="person_name" id="pname" onkeypress= "validateAlphabet1()" value="<?php echo ( isset($ObjContact->user_name) && !empty($ObjContact->user_name))? $ObjContact->user_name : '' ?>" class="form-control"  tabindex="3" required>
              <p id="err1"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Enter Contact <i style="color:red">*</i></label>
            <div class="col-sm-6">
              <input type="text" name="person_mobile" id="pmobile" value="<?php echo ( isset($ObjContact->mobile_no) && !empty($ObjContact->mobile_no))? $ObjContact->mobile_no : '' ?>" class="form-control" maxlength="10" tabindex="4" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" required>
              <span style="color:red" id="mobno_err"></span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Enter Email</label>
            <div class="col-sm-6">
              <input type="email" name="person_email" id="pemail" class="form-control" value="<?php echo ( isset($ObjContact->email) && !empty($ObjContact->email))? $ObjContact->email : '' ?>" tabindex="5">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><abbr title="Date of Birth">DOB</abbr></label>
            <div class="col-sm-2">
              <input type="text" name="dob" id="dob" value="<?php echo ( isset($ObjContact->birth_date) && !empty($ObjContact->birth_date))? $ObjContact->birth_date : '' ?>" class="form-control" tabindex="6">
            </div>
            <label class="col-sm-2 control-label"><abbr title="Date of Anniversary">DOA</abbr></label>
            <div class="col-sm-2">
              <input type="text" name="doa" id="doa" value="<?php echo ( isset($ObjContact->anniversary_date) && !empty($ObjContact->anniversary_date))? $ObjContact->anniversary_date : '' ?>" class="form-control" tabindex="7">
            </div>
          </div>
          <div class="hr-line-dashed"></div>
          <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
              <button class="btn btn-white" type="reset" tabindex="8">Cancel</button>
              <button class="btn btn-primary add-contact-btn" type="submit" tabindex="9"><?php echo (isset($ObjContact) && !empty($ObjContact)) ? 'Update': 'Add Contact' ?></button>
            </div>
          </div>
          <?php form_close();?>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php $this->load->view('footer');?>