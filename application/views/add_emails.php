<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.2/dashboard_2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 25 Jul 2015 05:53:23 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CHLOROComm Admin | Add Emails</title>

    <link rel=" short icon" href="<?php echo base_url();?>img/chlorodots_logo.ico">

    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Morris -->
    <link href="<?php echo base_url();?>css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="<?php echo base_url();?>js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
	
	<!-- Data Tables -->
    <link href="<?php echo base_url();?>css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

    <link href="<?php echo base_url();?>css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/style.css" rel="stylesheet">
    <script src="<?php echo base_url();?>js/Validations/validate_email_category.js"></script>
<style>.pagination { border-top: 1px solid #EEEEEE; padding-top: 8px; display: inline-block; width: 100%; margin-bottom: 10px; text-align:right; }
.pagination1 .links { float: right; }
.pagination1 .links a { vertical-align:middle; display: inline-block; border: 1px solid #EEEEEE; padding: 4px 10px; text-decoration: none; color: #777; }
.pagination1 .links strong {vertical-align:middle; display: inline-block; border: 1px solid #d45c93; padding: 4px 10px; font-weight: normal; text-decoration: none; color: #fff; background: #d45c93; }
.pagination1 .links a:hover { color:#d45c93; border: 1px solid #ccc; }
.pagination1 .results { float: right; padding-top: -50px; }</style>
</head>

<body>
    <div id="wrapper">
    
<?php include('navigation.php');?>
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <?php include('navbar.php');?>
        </div>
            <div class="wrapper wrapper-content">
        
        <div class="row">
    		    <?php if($this->session->flashdata('insertsuccess')){?>
                    <div class="alert alert-success">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong><?php echo $this->session->flashdata('insertsuccess');?></strong> 
                    </div>
            <?php }?>

            <?php if($this->session->flashdata('updatesuccess')){?>
                    <div class="alert alert-success">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong><?php echo $this->session->flashdata('updatesuccess');?></strong> 
                    </div>
            <?php }?>

            <?php if($this->session->flashdata('deletesuccess')){?>
                    <div class="alert alert-success">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong><?php echo $this->session->flashdata('deletesuccess');?></strong> 
                    </div>
            <?php }?>

			<div><!-- Start Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#view" aria-controls="view" role="tab" data-toggle="tab"> <i class="fa fa-bars"></i> View Emails</a></li>
                <li role="presentation"><a href="#add_cat" aria-controls="add_cat" role="tab" data-toggle="tab"><i class="fa fa-plus-square"></i> Add Email Category</a></li>
                <li role="presentation"><a href="#add_email" aria-controls="add_email" role="tab" data-toggle="tab"><i class="fa fa-plus-square"></i> Add Emails</a></li>

              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="view">
                    <div class="ibox-content">
                        <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover dataTables-example">
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>

                                <?php 
                                $count=1;
                                foreach(@$emails_data as $row1):
                                   $edit_modelid = "mymodal1".$row1['id']; 
                                   $delete_modelid = "mymodal2".$row1['id'];     
                                ?>
                                <tr class="gradeX">
                                    <td><?php echo $count++;?></td>
                                    <td>
                                        <?php 
                                        $this->db->select('email_category_name');
                                        $this->db->where('id',$row1['email_category']);
                                        $a= $this->db->get('email_categories')->result_array();
                                        foreach ($a as $row2) {
                                            # code...
                                            echo $row2['email_category_name'];
                                        } ?>
                                    </td>
                                    <td><?php echo $row1['person_name'];?></td>
                                    <td><?php echo $row1['person_email_id'];?></td>
                                    <td>
                                        <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                          <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#<?php echo $edit_modelid;?>"><i class="fa fa-pencil"></i> Edit</button>
                                          <!--<a href="<?php echo site_url('chlorocomm/delete_email/'.$row['id'])?>"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button></a>-->
                                           <div class="modal fade" id="<?php echo $edit_modelid;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                  <h4 class="modal-title" id="myModalLabel">Edit </h4>
                                                </div>
                                                <div class="modal-body">
                                                  <form class="form-horizontal" action="<?php echo site_url('chlorocomm/edit_email/'.$row1["id"]);?>" method="POST" autocomplete="off">
                                                  <div class="form-group">
                                                  <label class="col-sm-3 control-label">Select Email Category <i style="color:red">*</i></label>
                                                  <div class="col-sm-9">
                                                      <select class="form-control" name="email_category" id="sms_category" >
                                                          <!--<option value="">Select SMS Category</option>-->
                                                           <?php $mail_cat=$this->db->get('email_categories')->result_array();
                                                           foreach($mail_cat as $row2){
                                                           ?>
                                                           <option <?php if($row1['email_category']==$row2['id']){?>selected="selected"<?php }?>value="<?php echo $row2['id'] ;?>"><?php echo $row2['email_category_name'];?></option>
                                                          
                                                          
                                                          <?php }?>
                                                      </select>
                                                  </div>
                                              </div>
                                            <div class="form-group">
                                              <label for="inputEmail3" class="col-sm-3 control-label">Enter Name <i style="color:red;">*</i> </label>
                                              <div class="col-sm-9">
                                                <input type="text" class="form-control" name="person_name" id="person_name" value="<?php echo $row1['person_name'];?>" placeholder="Name">
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label for="inputPassword3" class="col-sm-3 control-label">Email <i style="color:red;">*</i> </label>
                                              <div class="col-sm-9">
                                                <input type="text" class="form-control" name="person_email" id="person_email" value="<?php echo $row1['person_email_id'];?>" placeholder="Email">
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <div class="col-sm-offset-3 col-sm-9">
                                              <button type="submit" class="btn btn-primary" >Edit</button>
                                              </div>
                                            </div>
                                           
                                          </form>
                                                  
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>

                                          <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#<?php echo $delete_modelid?>" ><i class="fa fa-trash"></i> Delete</button>
                                        <div class="modal fade" id="<?php echo $delete_modelid?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-body text-center">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
                                               <br>
                                               <h3>Do you really want to delete this record?</h3><br/>
                                               <a href="<?php echo site_url('chlorocomm/delete_email/'.$row1['id']);?>"><button type="button" class="btn btn-danger" >Yes</button></a>&nbsp;&nbsp;
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">No</button> 
                                              </div>
                                              
                                            </div>
                                          </div>
                                        </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                              </table>
                              <div class="pagination" style="float:right; margin-right:50px;">
								<?php echo $this->pagination->create_links(); ?>
						    </div>
                            </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="add_cat">
                    
                    <div class="ibox-content">
                        <form method="post" action="<?php echo site_url('chlorocomm/add_email_category')?>" class="form-horizontal" onsubmit="return validate_email_category();" autocomplete="off">
                                <?php //print_r($category);?>
                                 
                                <div class="form-group"><label class="col-sm-2 control-label">Enter Category <i style="color:red">*</i></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="category" id="cat" onkeypress= "validateAlphabet()" class="form-control" ><i id="errmsg"></i>
                                      <p id="err"></p>
                                    </div>
                                </div>
                                
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-white" type="reset">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Add Category</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                            <br/>
                            <br/>


                            <div class="ibox-content">
                            <div class="table-responsive ">
                              <table class="table table-bordered">
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>

                                <?php 
                                $count=1;
                                foreach(@$category1 as $row):
                                $edit_email_cat_modal = "mymodal12".$row['id'];
                                $email_cat_id = "mymodal2".$row['id'];

                                ?>
                                <tr>
                                    <td><?php echo $count++;?></td>
                                    <td><?php echo $row['email_category_name'];?></td>
                                    <td>
                                        <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                          <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#<?php echo $edit_email_cat_modal;?>"><i class="fa fa-pencil"></i> Edit</button>
                                          <div class="modal fade" id="<?php echo $edit_email_cat_modal;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                  <h4 class="modal-title" id="myModalLabel">Edit </h4>
                                                </div>
                                                <div class="modal-body">
                                                  <form class="form-horizontal" method="POST" action="<?php echo site_url('chlorocomm/edit_email_category/'.$row['id']);?>" autocomplete="off">
                                                    <div class="form-group">
                                                      <label for="inputPassword3" class="col-sm-3 control-label">Enter Category <i style="color:red;">*</i> </label>
                                                      <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="category" value="<?php echo $row['email_category_name'];?>" placeholder="Email Category">
                                                      </div>
                                                    </div>
                                                    <div class="form-group">
                                                      <div class="col-sm-offset-3 col-sm-9">
                                                        <button type="submit" class="btn btn-primary">Edit</button>
                                                      </div>
                                                    </div>
                                                </form>
                                                  
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#<?php echo $email_cat_id?>" ><i class="fa fa-trash"></i> Delete</button>
                                        <div class="modal fade" id="<?php echo $email_cat_id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-body text-center">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
                                               <br>
                                               <h3>Are You want to delete?</h3><br/>
                                               <a href="<?php echo site_url('chlorocomm/delete_email_category/'.$row['id']);?>"><button type="button" class="btn btn-danger" >Yes</button></a>&nbsp;&nbsp;
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">No</button> 
                                              </div>
                                              
                                            </div>
                                          </div>
                                        </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                              </table>
                            </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="add_email">
                    <div class="ibox-content">
                        <form method="post" action="<?php echo site_url('chlorocomm/insert_email')?>" class="form-horizontal" onsubmit="return validate_add_email();" autocomplete="off">
                               
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label">Select Email Category <i style="color:red">*</i></label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="email_category" id="email_category" >
                                            <option value="">Select Email Category</option>
                                             <?php $mail_cat=$this->db->get('email_categories')->result_array();
                                             foreach($mail_cat as $row):
                                             ?>
                                            <option value="<?php echo $row['id'];?>"><?php echo $row['email_category_name'];?></option>
                                            
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Enter Name <i style="color:red">*</i></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="person_name" id="pname" onkeypress= "validateAlphabet1()" class="form-control" >
                                        <p id="err1"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Enter Email <i style="color:red">*</i></label>
                                    <div class="col-sm-6">
                                        <input type="email" name="person_email" id="pemail" class="form-control" >
                                    </div>
                                </div>
                                
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <p id="add_err_msg"></p><br/>
                                        <button class="btn btn-white" type="reset">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Add Email</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
              </div>

            </div><!-- End Nav tabs -->
                    </div>
                    </div>
                </div>
        </div>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url();?>js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url();?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    

    <script>
    </script>
</body>

<!-- Mirrored from webapplayers.com/inspinia_admin-v2.2/dashboard_2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 25 Jul 2015 05:53:30 GMT -->
</html>
