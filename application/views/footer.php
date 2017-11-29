<!-- Mainly scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
<!-- <script src="<?php echo base_url();?>assets/js/jquery-2.1.1.js"></script> -->
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<!-- Custom and plugin javascript -->
<script src="<?php echo base_url();?>assets/js/inspinia.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/pace/pace.min.js"></script>
<!-- jQuery UI -->
<script src="<?php echo base_url();?>assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Data Tables -->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
<!-- Custom JS -->
<script src="<?php echo base_url();?>assets/js/custom_js/validate_email_category.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/custom_js/validate_mobile_info.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/sms_counter.min.js" type="text/javascript"></script>
<!-- Calculator -->
<script src="<?php echo base_url();?>assets/js/plugins/calculator/CalcSS3.js" type="text/javascript"></script>
<!-- Calender -->
<script src="<?php echo base_url();?>assets/js/moment.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.6.2/fullcalendar.min.js" type="text/javascript"></script>
<script>
	$(function() {
		$('#dashboard_calendar').fullCalendar({
		})
		oTableStaticFlow = $('#example1').DataTable({
			"aoColumnDefs": [{
				'bSortable': false,
				'aTargets': [-1,-2]
			}],
		});
		$("#select_all").click(function () {
			var cells = oTableStaticFlow.column(-1).nodes(), 
			state = this.checked;
			for (var i = 0; i < cells.length; i += 1) {
				cells[i].querySelector("input[type='checkbox']").checked = state;
			}
		});
		$('#bdel').on('submit', function(e){
			e.preventDefault();
			var result = confirm("Are you sure to delete?");
			if(result == true){
				var data = $('#bdel').serialize();
				$.post({
					type : 'POST',
					url  : '<?php echo site_url('chlorocomm/delete_contact'); ?>',
					data: data,
					success:function(data) {
						var result = $.parseJSON(data);
						if (result['success'] == 1){
							$('.del-alert').css('display','block');
							setTimeout(function(){location.reload();},2000);
						} 
					}
				});
			}else{
				return false;
			}
		});
		$('#pmobile').on('blur', function () {
			var mobile_no = $('#pmobile').val();
			$.post({
				type : 'POST',
				url  : '<?php echo site_url('chlorocomm/check_mobile_no'); ?>',
				data : {mobile_no,<?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash();?>'},
				success:function(data) {
					var result = $.parseJSON(data);
					if (result['length_error'] == 1) {
						$('#mobno_err').text('Please enter 10 digit valid mobile number.');
						$('.add-contact-btn').prop('disabled',true);
					} else {
						$('.add-contact-btn').prop('disabled',false);
					} 
					if (result['success'] == 1) {
						$('#mobno_err').text('This mobile number is already exist.');
						$('.add-contact-btn').prop('disabled',true);
					} if (result['success'] == 0) {
						$('#mobno_err').text('');
						$('.add-contact-btn').prop('disabled',false);
					}
				}
			});
		})
	});
</script>
<script src="<?php echo base_url();?>assets/js/chosen/chosen.jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
	var config = {
		'.chosen-select'           : {},
		'.chosen-select-deselect'  : {allow_single_deselect:true},
		'.chosen-select-no-single' : {disable_search_threshold:10},
		'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
		'.chosen-select-width'     : {width:"95%"}
	}
	for (var selector in config) {
		$(selector).chosen(config[selector]);
	}
	var select = <?php  echo json_encode(isset($ObjSchedule->sms) && !empty($ObjSchedule->sms) && $ObjSchedule->sms == 'individual'? unserialize($ObjSchedule->receivers) : ''); ?>;
	if (select) {
		$.each(select, function(i, val) {
			$('.chosen-select').append($('<option></option>').val(val).attr('selected', 'selected').html(val)).trigger('chosen:updated');
		});
	}

	var cat_select = <?php  echo json_encode(isset($ObjSchedule->sms) && !empty($ObjSchedule->sms) && $ObjSchedule->sms == 'bulk'? $ObjSchedule->receivers : ''); ?>;
	if (cat_select) {
		// $.each(cat_select, function(i, val) {
			$('.chosen-select').append($('<option></option>').val(cat_select).attr('selected', 'selected').html(cat_select)).trigger('chosen:updated');
		// });
	}	
</script>
<!-- Datepicker  -->
<script src="<?php echo base_url();?>assets/js/datepicker/datepicker.js"></script>
<script src="<?php echo base_url();?>assets/js/timepicki.min.js"></script>
<script type="text/javascript">
	$('#calc').on('load',function () {
		init_calc('calc');
	});
	$(document).ready(function () {
		if ($("input[name='msg_type']:checked").val()=="festival") {
			$('#bunch_receiver').hide();
		}
		$(".timepicker,#enq_time,#rem_time").timepicki();
		$(function() {
			$('input[name="schedule_sms"]').on('click', function() {
				if($("#schedule_sms").is(':checked')){
					$(".date_time_block").show();
					$(".schedule_sms_btn").show();
					$(".send_sms_btn").hide();
				} else {
					$(".date_time_block").hide();
					$(".send_sms_btn").show();
					$(".schedule_sms_btn").hide();
					$("#schedule_time").val('');
					$("#schedule_date").val('');
				}
			});
			$('input[name="msg_type"]').on('click', function() {
				if ($(this).val() == 'regular') {
					$('#bunch_receiver').show();
				}
				else {
					$('#bunch_receiver').hide();
				}
				var input  = $("input[name='msg_type']:checked").val();
				$.ajax({
					type: 'POST',
					url:'<?php echo site_url("chlorocomm/get_templates");?>',
					data:{type:input,<?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash();?>'},
					success:function(result){
						result = $.parseJSON(result);
						$('#sms_templateOne').find('option:gt(0)').remove();
						if(result.length > 0) {
							for(var i =0; i < result.length; i++) {
								$('<option>').val(result[i]['id']).text(result[i]['title']).appendTo('#sms_templateOne');
							}
						} else {
							$('<option>').text('No record found..!').appendTo('#sms_templateOne');
						}
					}
				});
			});
		});

		$('#email_date,#from_date,#to_date,#doa,#dob').datepicker({
			format: "dd-mm-yyyy",
			// startDate: "+0d"
		});
		$('#schedule_date,#enq_date,#rem_date').datepicker({
			format: "dd-mm-yyyy",
			startDate: "+0d"
		});  

		function printDiv() {
			var divToPrint=document.getElementById('areaToPrint');
			newWin= window.open("");
			newWin.document.write(divToPrint.outerHTML);
			newWin.print();
			newWin.close();
		}

		$('#sms_templateOne').on('change',function(){
			var data = $('#sms_templateOne').val();
			if (data == "") {
				$('#sms_body_one').val('');
				countChars();
			} else{
				$.post({
					type : 'POST',
					url  : '<?php echo site_url('chlorocomm/getTemplateMsg'); ?>',
					data : {id:data,<?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash();?>'},
					success:function(data) {
						var result = $.parseJSON(data);
					// console.log(result.message);
					if (result){
						$('#sms_body_one').val(result.message);
						countChars();
						$('#sms_count').val($('.messages').text());
					} 
				}
			});
			}
		});
		function countChars() {
			$('#sms_body_one').countSms('#count');
		}
		$('#sms_body_one').countSms('#count');
		$('#sms_body_one').keyup(function(){
			$('#sms_count').val($('.messages').text());
		});
	});

	function checkdatediff() {
		var sparts = document.getElementById("from_date").value.split("-");
		var sdate = new Date(sparts[2], sparts[1] - 1, sparts[0]);
		var eparts = document.getElementById("to_date").value.split("-");
		var edate = new Date(eparts[2], eparts[1] - 1, eparts[0]);
		if(sdate>edate){
			alert("Please ensure that the To Date is greater than or equal to the From Date.");
			return false;
		}
	}
</script>
</body>
</html>