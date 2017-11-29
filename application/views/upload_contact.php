<?php $this->load->view('header');?>
<div id="wrapper">
  <?php include('navigation.php');?>
  <div id="page-wrapper" class="gray-bg">
    <div class="row border-bottom">
      <?php include('navbar.php');?>
    </div>
    <div class="wrapper wrapper-content">
      <div class="row">
        <?php if($this->session->flashdata('failure')){?>
        <div class="alert alert-danger">
          <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong><?php echo $this->session->flashdata('failure');?></strong> 
        </div>
        <?php }?>
        <div class="page-heading">
          <a href="<?php echo site_url('contacts');?>" class="btn btn-warning pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to List</a>
          <h2>Import VCARD Contacts</h2>
        </div>
        <div class="ibox-content">
          <?php echo form_open('upload_vcf_contact', array('method'=>'post','class'=>'form-horizontal','autocomplete'=>'off','enctype'=>'multipart/form-data'));?>
          <div class="form-group">
            <label class="col-sm-2 control-label">Select Category <i style="color:red">*</i></label>
            <div class="col-sm-6">
              <select class="form-control" name="category" id="category" required="">
                <option value="">Select Category</option>
                <?php $mail_cat=$this->db->get('category_tbl')->result_array();
                foreach($mail_cat as $row):
                 ?>
                 <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
               <?php endforeach;?>
             </select>
           </div>
         </div>
         <div class="form-group"><label class="col-sm-2 control-label">Select VCF / VCARD File<i style="color:red">*</i></label>
          <div class="col-sm-6">
            <input type="file" name="file" class="form-control" required/>
            <p id="err"></p>
          </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
          <div class="col-sm-4 col-sm-offset-2">
            <button class="btn btn-white" type="reset">Cancel</button>
            <button class="btn btn-primary" type="submit">Add Contacts</button>
          </div>
        </div>
        <?php form_close();?>
      </div>
    </div>
  </div>
</div>
</div>
<?php $this->load->view('footer');?>