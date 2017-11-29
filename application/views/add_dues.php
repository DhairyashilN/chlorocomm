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
          <a href="<?php echo site_url('dues');?>" class="btn btn-warning pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to List</a>
          <h2>Add Due</h2>
        </div>
        <div class="ibox-content">
          <?php if (isset($ObjDue) && !empty($ObjDue)){ ?>
          <form method="post" action="<?php echo site_url('store_due_details/'.$ObjDue->id)?>" class="form-horizontal">
            <?php }else{ ?>
            <form method="post" action="<?php echo site_url('store_due_details')?>" class="form-horizontal">
              <?php } ?>
              <div style="display:none">
                <input type="hidden" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>">
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-8">
                  <input type="text" name="dname" id="dname" class="form-control" required="" value="<?php echo ( isset($ObjDue->person_name) && !empty($ObjDue->person_name))? $ObjDue->person_name : '' ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Amount</label>
                <div class="col-sm-8">
                  <input type="text" name="amount" id="amount" class="form-control" required="" value="<?php echo ( isset($ObjDue->due_amount) && !empty($ObjDue->due_amount))? $ObjDue->due_amount : '' ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Details</label>
                <div class="col-sm-8">
                  <textarea name="due_details" id="due_details" class="form-control" required="" rows="7"><?php echo ( isset($ObjDue->due_details) && !empty($ObjDue->due_details))? $ObjDue->due_details : '' ?> </textarea>
                </div>
              </div>
              <div class="hr-line-dashed"></div>
              <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                  <button class="btn btn-primary" type="submit"><?php echo (isset($ObjDue) && !empty($ObjDue)) ? 'Update': 'Add Due' ?></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php $this->load->view('footer'); ?>
