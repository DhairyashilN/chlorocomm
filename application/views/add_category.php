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
          <a href="<?php echo site_url('category');?>" class="btn btn-warning pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to List</a>
          <h2>Add Category</h2>
        </div>
        <div class="ibox-content">
          <?php if (isset($ObjCat) && !empty($ObjCat)) { ?>
          <?php echo form_open('store_category/'.$ObjCat->id, array('method'=>'post','class'=>'form-horizontal','autocomplete'=>'off')); ?>
          <?php }else { ?>
          <?php echo form_open('store_category', array('method'=>'post','class'=>'form-horizontal','autocomplete'=>'off')); ?>
          <?php } ?>
          <div class="form-group">
            <label class="col-sm-2 control-label">Category Name <i style="color:red">*</i></label>
            <div class="col-sm-6">
              <input type="text" name="category_name" id="cat" class="form-control" value="<?php echo ( isset($ObjCat->name) && !empty($ObjCat->name))? $ObjCat->name : '' ?>"  required/>
            </div>
          </div>
          <div class="hr-line-dashed"></div>
          <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
              <button class="btn btn-white" type="reset">Cancel</button>
              <button class="btn btn-primary" type="submit"><?php echo (isset($ObjCat) && !empty($ObjCat)) ? 'Update': 'Add Category' ?></button>
            </div>
          </div>
          <?php form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('footer');?>