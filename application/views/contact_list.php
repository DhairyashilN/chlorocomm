<?php $this->load->view('header');?>
<div id="wrapper">
  <?php include('navigation.php');?>
  <div id="page-wrapper" class="gray-bg">
    <div class="row border-bottom">
      <?php include('navbar.php');?>
    </div>
    <div class="wrapper wrapper-content">
      <div class="row">
        <?php if($this->session->flashdata('success')){?>
        <div class="alert alert-success">
          <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong><?php echo $this->session->flashdata('success');?></strong> 
        </div>
        <?php }?>
        <div class="alert alert-success del-alert" style="display:none">
          <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Contacts deleted successfully.</strong> 
        </div>
        <div class="page-heading">
          <h2>Contacts</h2>
        </div>
        <div class="ibox-content" style="padding-bottom: 55px;">
          <div class="col-lg-9" style="display:inline-flex;">
            <form method="post" action="getByCategory" class="form-inline">
              <div style="display:none">
                <input type="hidden" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>">
              </div>
              <div class="form-group">
                <select class="form-control" name="category" id="category">
                  <option value="">Select Category</option>
                  <?php if (isset($ArrCategory) && !empty($ArrCategory)): ?>
                    <?php foreach ($ArrCategory as $value): ?>
                      <option value="<?php echo $value['id'];?>" <?php if(isset($_POST['category']) && $_POST['category'] == "".$value['id']."") echo 'selected="selected"';?>><?php echo $value['name'];?></option>
                    <?php endforeach ?>
                  <?php endif ?>
                </select>
              </div>
              <button type="submit" class="btn btn-warning">Search</button>
            </form>
             &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo site_url('vcard_export');?>" class="btn btn-success">Export as VCF</a>
          </div>
          <div class="col-lg-3">
            <div class="text-right" style="margin-bottom:20px;">
              <a href="<?php echo site_url('add_contact');?>" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <?php echo form_open('delete_contact', array('id'=>'bdel')); ?>
        <!-- <form name="bulk_action_form" onsubmit="return deleteConfirm();" id="bdel"/> -->
        <div class="ibox-content">
          <?php if (isset($CatContacts) && !empty($CatContacts)): ?>
              <h3 class="text-success"><b>Total <?php echo count($ArrContacts);?> contact(s) found.</b></h3>
            <?php endif; ?> 
          <div class="table-responsive">
            <table id="example1" class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>Sr.No.</th>
                  <th>Category</th>
                  <th>Type</th>
                  <th>Name</th>
                  <th>Contact</th>
                  <th>Email</th>
                  <th>Birth Date</th>
                  <th>Anniversary Date</th>
                  <th>Action</th>
                  <th><input type="checkbox" name="select_all" id="select_all" value=""/>
                    <button type="submit" class="btn btn-danger btn-xs" name="bulk_delete_submit"><i class="fa fa-trash"></i></button></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $count=1;
                  foreach(@$ArrContacts as $row1): ?>
                  <tr class="gradeX">
                    <td><?php echo $count++;?></td>
                    <td>
                      <?php 
                      $this->db->select('name');
                      $this->db->where('id',$row1['category_name']);
                      $a= $this->db->get('category_tbl')->result_array();
                      foreach ($a as $row2) {
                        echo $row2['name'];
                      } ?>
                    </td>
                    <td>
                      <?php 
                      $this->db->select('name');
                      $this->db->where('id',$row1['type_name']);
                      $a= $this->db->get('type_tbl')->result_array();
                      foreach ($a as $row2) {
                        echo $row2['name'];
                      } ?>
                    </td>
                    <td><?php echo $row1['user_name'];?></td>
                    <td><?php echo $row1['mobile_no'];?></td>
                    <td><?php echo $row1['email'];?></td>
                    <td><?php echo $row1['birth_date'];?></td>
                    <td><?php echo $row1['anniversary_date'];?></td>
                    <td>
                      <a href="<?php echo site_url('edit_contact/'.$row1['id']);?>" class="btn btn-primary btn-xs" title="edit"><i class="fa fa-pencil"></i></a>
                      <div class="modal fade" id="<?php echo $delete_modelid?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-body text-center">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
                              <br>
                              <h3>Do you really want to delete this record?</h3><br/>
                              <a href="<?php echo site_url('chlorocomm/delete_contact/'.$row1['id']);?>"><button type="button" class="btn btn-danger" >Yes</button></a>&nbsp;&nbsp;
                              <button type="button" class="btn btn-warning" data-dismiss="modal">No</button> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td><input type="checkbox" name="checked_id[]" class="checkbox" value="<?php echo $row1['id']; ?>" multiple/> </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- </form> -->
        <?php form_close(); ?>
      </div>
    </div>
  </div>
</div>
</div>
<?php $this->load->view('footer');?>