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
          <h2>Scheduled SMS</h2>
        </div>
        <div class="ibox-content">
          <div  class="table-responsive ">
            <table id="example1" class="table table-bordered">
              <thead>
                <tr>
                  <th>Sr.No.</th>
                  <th>SMS Recepients</th>
                  <th>Message</th>
                  <th>Scheduled Date</th>
                  <th>Scheduled Time</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                if (isset($ArrSMS) && !empty($ArrSMS)):
                  $count=1;
                  foreach($ArrSMS as $row): ?>
                  <tr>
                    <td><?php echo $count++;?></td>
                    <td>
                      <?php 
                      if ($row['sms'] == 'bulk') {
                        $this->db->select('id,name');
                        $this->db->from('category_tbl');
                        $ArrCategory = $this->db->get()->result_array();
                        foreach ($ArrCategory as $cat) {
                          if ($cat['id'] == $row['receivers']) {
                            echo $cat['name'].' Category Contacts';
                          }
                        }
                      } else{
                        echo implode(',', unserialize($row['receivers']));
                      }
                      ?>
                    </td>
                    <td><?php echo $row['sms_body'];?></td>
                    <td><?php echo $row['scheduled_date'];?></td>
                    <td><?php echo date('h:i A',$row['scheduled_time']);?></td>
                    <td>
                      <a href="<?php echo site_url('edit_sms_shedule/'.$row['id']);?>" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
                      <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#<?php echo $row['id'];?>" title="Delete" ><i class="fa fa-trash"></i></button>
                      <div class="modal fade" id="<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-body text-center">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
                              <br>
                              <h2>Are you want to delete?</h2><br/>
                              <a href="<?php echo site_url('delete_scheduled_sms/'.$row['id']);?>"><button type="button" class="btn btn-danger" >Yes</button></a>&nbsp;&nbsp;
                              <button type="button" class="btn btn-warning" data-dismiss="modal">No</button> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; 
              endif;
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php $this->load->view('footer');?>