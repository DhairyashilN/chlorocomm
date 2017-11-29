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
          <a href="<?php echo site_url('debtors');?>" class="btn btn-warning pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to List</a>
          <h2>Add Debt</h2>
        </div>
        <div class="ibox-content">
          <?php if (isset($ObjDebt) && !empty($ObjDebt)) { ?>
          <form method="post" action="<?php echo site_url('store_debt_details/'.$ObjDebt->id)?>" class="form-horizontal">
            <?php } else { ?>
            <form method="post" action="<?php echo site_url('store_debt_details')?>" class="form-horizontal">
              <?php } ?>
              <div style="display:none">
                <input type="hidden" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>">
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-8">
                  <input type="text" name="dname" id="dname" class="form-control" required="" value="<?php echo ( isset($ObjDebt->person_name) && !empty($ObjDebt->person_name))? $ObjDebt->person_name : '' ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Amount</label>
                <div class="col-sm-8">
                  <input type="text" name="amount" id="amount" class="form-control" required="" value="<?php echo ( isset($ObjDebt->debt_amount) && !empty($ObjDebt->debt_amount))? $ObjDebt->debt_amount : '' ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Details</label>
                <div class="col-sm-8">
                  <textarea name="due_details" id="due_details" class="form-control" required="" rows="7"><?php echo ( isset($ObjDebt->debt_details) && !empty($ObjDebt->debt_details))? $ObjDebt->debt_details : '' ?> </textarea>
                </div>
              </div>
              <div class="hr-line-dashed"></div>
              <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                  <button class="btn btn-primary" type="submit"><?php echo (isset($ObjDebt) && !empty($ObjDebt)) ? 'Update': 'Add Due' ?></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php $this->load->view('footer'); ?>
