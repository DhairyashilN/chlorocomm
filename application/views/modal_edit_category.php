<?php 
$edit_category		=	$this->db->get_where('category' , array('cat_id' => $param2) )->result_array();
foreach ( $edit_category as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_category');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open('admin/agegroup/edit/do_update/'.$row['course_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('Category_Name');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="category" value="<?php echo $row['category'];?>"/>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('Description');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="description" value="<?php echo $row['description'];?>"/>
                    </div>
                </div>
				
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                      <button type="submit" class="btn btn-info"><?php echo get_phrase('update_category');?></button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>