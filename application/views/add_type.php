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
          <a href="<?php echo site_url('contact_type');?>" class="btn btn-warning pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to List</a>
          <h2>Add Contact Type</h2>
        </div>
        <div class="ibox-content">
          <?php if (isset($ObjType) && !empty($ObjType)) { ?>
          <?php echo form_open('store_type/'.$ObjType->id, array('method'=>'post','class'=>'form-horizontal','autocomplete'=>'off')); ?>
          <?php }else { ?>
          <?php echo form_open('store_type', array('method'=>'post','class'=>'form-horizontal','autocomplete'=>'off')); ?>
          <?php } ?>
          <div class="form-group">
            <label class="col-sm-2 control-label">Type Name <i style="color:red">*</i></label>
            <div class="col-sm-6">
              <input type="text" name="type_name" id="type_name" class="form-control" value="<?php echo ( isset($ObjType->name) && !empty($ObjType->name))? $ObjType->name : '' ?>"  required/>
            </div>
          </div>
          <div class="hr-line-dashed"></div>
          <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
              <button class="btn btn-white" type="reset">Cancel</button>
              <button class="btn btn-primary" type="submit"><?php echo (isset($ObjType) && !empty($ObjType)) ? 'Update': 'Add Type' ?></button>
            </div>
          </div>
          <?php form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('footer');?>