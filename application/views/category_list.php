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
        <div class="page-heading">
          <h2>Contact Categories</h2>
        </div>
        <div class="ibox-content">
          <div class="text-right" style="margin-bottom:20px;">
            <a href="<?php echo site_url('add_category');?>" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
          </div>
          <div  class="table-responsive ">
            <table id="example1" class="table table-bordered">
              <thead>
                <tr>
                  <th>Sr.No.</th>
                  <th>Category</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $count=1;
                foreach(@$category as $row):
                  $email_cat_id = "mymodal2".$row['id'];
                  ?>
                  <tr>
                    <td><?php echo $count++;?></td>
                    <td><?php echo $row['name'];?></td>
                    <td>
                      <a href="<?php echo site_url('edit_category/'.$row['id']);?>" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
                      <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#<?php echo $email_cat_id?>" title="Delete" ><i class="fa fa-trash"></i></button>
                      <div class="modal fade" id="<?php echo $email_cat_id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-body text-center">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
                              <br>
                              <h3 style="color:red">If you delete the category, mobile no.s and emails under the category will be deleted.</h3>
                              <h2>Are you want to delete?</h2><br/>
                              <a href="<?php echo site_url('delete_category/'.$row['id']);?>"><button type="button" class="btn btn-danger" >Yes</button></a>&nbsp;&nbsp;
                              <button type="button" class="btn btn-warning" data-dismiss="modal">No</button> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('footer');?>