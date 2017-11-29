<?php $this->load->view('header');?>
<div id="wrapper">
    <?php include('navigation.php');?>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <?php include('navbar.php');?>
        </div>
        <div class="wrapper wrapper-content">
            <div class="row">
                <?php if($this->session->flashdata('sentsuccess')){?>
                <div class="alert alert-success">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong><?php echo $this->session->flashdata('sentsuccess');?></strong> 
              </div>
              <?php }?>
              <?php if($this->session->flashdata('error')){?>
              <div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong><?php echo $this->session->flashdata('error');?></strong> 
              </div>
              <?php }?>
              <div>
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-bars"></i> Send Email</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="ibox-content">
                            <h3 class="text-center"><i class="fa fa-envelope-o"></i> Send  Email to unknown email id </h3>
                            <hr/>
                            <br/>
                            <form method="post" action="<?php echo site_url('chlorocomm/send_emails')?>" class="form-horizontal" enctype="multipart/form-data">
                                <?php //print_r($category);?>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">To</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="recepient" id="recepient" class="form-control" required> 
                                        <b></b>
                                    </div>
                                    <div class="col-sm-4">
                                        <h4> <i class="fa fa-info-circle"></i> Enter comma(,) seperated email address.</h4>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Subject</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="email_subject" id="email_subject" class="form-control" required>
                                        <label class="control-label">Add attachments</label> <input type="file" name="userfile"  class="form control" > 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email Body</label>
                                    <div class="col-sm-10">
                                        <textarea name="email_body" id="wysiwyg" rows="10" class="form-control" rows="5" required ></textarea>
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary" type="submit">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br/><br/>
                        <div class="ibox-content">
                            <h3 class="text-center"><i class="fa fa-envelope"></i> Send Email to individual email id</h3>
                            <hr/>
                            <br/>
                            <form method="post" action="<?php echo site_url('chlorocomm/send_emails1')?>" class="form-horizontal" enctype="multipart/form-data">
                                <?php //print_r($category);?>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">To</label>
                                    <div class="col-sm-6">
                                        <select data-placeholder="Choose Recepients" name="bunch_receiver[]"multiple  tabindex="3" class="form-control chosen-select ">
                                            <option value=""></option>
                                            <?php 
                                            $this->db->where('isdelete',0);
                                            $this->db->where('email !=','');
                                            $classes = $this->db->get('user_contacts_tbl')->result_array();
                                            foreach($classes as $row):
                                                ?>
                                                <option value="<?php echo $row['email'];?>"><?php echo $row['user_name'];?></option>
                                            <?php endforeach;?>
                                        </select>


                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Subject</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="email_subject" id="email_subject" class="form-control" required>
                                        <label class="control-label">Add attachments</label> <input type="file" name="userfile"  class="form control" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email Body</label>
                                    <div class="col-sm-10">
                                        <textarea name="email_body" rows="10"  id="wysiwyg2" class="form-control" required></textarea>
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary" type="submit">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br>
                        <div class="ibox-content">
                            <h3 class="text-center"><i class="fa fa-envelope"></i> Send Bulk Emails </h3>
                            <hr/>
                            <br/>
                            <form method="post" action="<?php echo site_url('chlorocomm/send_emails2')?>" class="form-horizontal" enctype="multipart/form-data">
                                <?php //print_r($category);?>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">To</label>
                                    <div class="col-sm-6">
                                        <select data-placeholder="Choose Recepients" name="bunch_receiver" multiple tabindex="3" class="form-control chosen-select ">
                                            <option value=""></option>
                                            <?php 
                                            $classes = $this->db->get('category_tbl')->result_array();
                                            foreach($classes as $row):
                                                ?>
                                                <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Subject</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="email_subject" id="email_subject" class="form-control" required>
                                        <label class="control-label">Add attachments</label> <input type="file" name="userfile"  class="form control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email Body</label>
                                    <div class="col-sm-10">
                                        <textarea name="email_body" rows="10"  id="wysiwyg3" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary" type="submit">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php $this->load->view('footer');?>