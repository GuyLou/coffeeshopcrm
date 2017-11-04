<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-cr" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title . ' '.$form_type; ?></h1>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $form_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-cr" class="form-horizontal">
			<?php if (isset($cr)) { echo '<input type="hidden" name="cr_id" value="'. $cr.'">'; } ?>
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <?php if (isset($cr)) { ?>
            <li><a href="#tab-history" data-toggle="tab"><?php echo $tab_history; ?></a></li>
            <?php } ?>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">

			
<div class="container-fluid">
	<div class="panel-heading">
		<div  class="panel panel-default" style="background : #eeeeee">

		<div class="row">
			<div  class="col-sm-2" ><label class="col-sm-2 control-label" for="input-type"><?php echo $form_cr_type; ?></label></div>
			<div  class="col-sm-2" ><input type="hidden" name="cr_type" value="<?php echo $cr_type; ?>"><?php echo $form_type; ?></div>
			<div  class="col-sm-2" ><label  for="input-stage"><?php echo $form_cr_stage; ?></label></div>
			<div  class="col-sm-2" ><div class="form-group"><select name="cr_stage" id="input-stage" class="form-control">
						<?php if($cr_type == 'sale') { $cr_type1 = 'order'; } else { $cr_type1 = 'service'; } ?>
							<?php foreach ($stages[$cr_type1] as $id => $descr) { ?>
							<option value="<?php echo $id; ?>" <?php if ($id == $stage_id && $cr_type1 == 'order') { echo 'selected="selected"'; } ?> ><?php echo $descr; ?></option>
							<?php } ?>
                  </select></div>
			</div>
			<div  class="col-sm-2"><label  for="input-orders"><?php echo $form_order_id; ?></label></div>
			<div  class="col-sm-2"><div class="form-group">
				<?php if (!isset($order_id) || ((int)$order_id == 0)) { ?>
					<select name="order_id" id="input-orders" class="form-control">
							<option value="<?php echo '0'; ?>"><?php echo $form_no_orders; ?></option>
							<?php if (isset($dorders)) { foreach ($dorders as $dorder) { ?>
							<option value="<?php echo $dorder; ?>"><?php echo $dorder; ?></option>
				<?php } } ?>
					</select>
				  <?php } else { ?>
				  <?php echo $order_id; ?>
				  <?php echo '<input type="hidden" name="order_id_set" value="'. $order_id.'">'; ?>
				  <?php } ?>
				  </div>
			</div>
		</div>
			
            <div class="row" >
              <div  class="col-sm-12" >
					<div class="form-group required" align="center">
					<textarea form_id="form-cr" style="height: 100%; width: 100%; max-width: 100%; min-height: 100px; display: block; margin-left: auto; margin-right: auto;" name="description"><?php echo $description; ?></textarea>
					<?php if ($error_name) { ?>
					<div class="text-danger"><?php echo $error_name; ?></div>
					<?php } ?>
				</div>
			  </div>

			</div>
			
			<div class="row" >
				<div  class="col-sm-2"><label for="input-creation_date"><?php echo $form_creation_date; ?></label></div>
				<div  class="col-sm-2"><?php echo $creation_date; ?></div>
				<div  class="col-sm-2"><label for="input-cr_status"><?php echo $form_cr_status; ?></label></div>
				<div  class="col-sm-2"><div class="form-group">
					<select name="cr_status" id="input-cr_status" class="form-control">
						<?php foreach ($cr_status as $sts) { ?>
							<option value="<?php echo $sts['name']; ?>" <?php if ($sts['name'] == $cr_status1) { echo 'selected="selected"'; } ?>><?php echo $sts['desc']; ?></option>
						<?php } ?>
                </select>
				</div></div>
				<div  class="col-sm-2"><label  for="input-due_date"><?php echo $form_due_date; ?></label></div>
				<div  class="col-sm-2">
					<div class="form-group required">
					<div class="input-group date">
					<input type="text" name="due_date" value="<?php echo $due_date; ?>" placeholder="<?php echo $due_date; ?>" data-date-format="YYYY-MM-DD" id="input-date_due" class="form-control" />
					<span class="input-group-btn">
						<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
					</span>
					</div>
					</div>
				</div>
			</div>

	</div>
	</div>
</div>

			 
					 
           </div>
            <div class="tab-pane" id="tab-history">
              <div id="history">
				<?php echo $cr_history; ?>
			  </div>
            </div>
          </div>
        </form>
      </div>
	  
    </div>
  </div>
  
  
  <?php if((!isset($order_id) || (int)$order_id == 0) && $cr_type == 'sale') { ?>
  <script type="text/javascript"><!--
	var crs = document.getElementById("input-stage");
	//var crt =  document.getElementById("input-type");
	var cro =  document.getElementById("input-orders");
	<?php foreach ($stages as $type => $stages_arr) {
				echo 'var '. $type .'_d = ["' .implode('","', $stages_arr) .'"];';
				echo 'var '. $type .'_id = ["' .implode('","', array_keys($stages_arr)) .'"];';
				} ?>
		 
	function stage_options() {
		j = crs.options.length;
	 	for (i = 0; i < j; i++) {
			crs.remove(0);
		}
		if (cro.value == "0") {
			var scrs_d = sale_d.slice();
			var scrs_id = sale_id.slice();
		} else {
			var scrs_d = order_d.slice();
			var scrs_id = order_id.slice();
		}
		for (i = 0; i < scrs_d.length; i++) {
			var option = document.createElement("option");
			option.value = scrs_id[i];
			option.text = scrs_d[i];
			crs.add(option);
		}
	
	}
	window.onload = function() {
			stage_options();
	};
	cro.onchange = function() {
		stage_options();
	
	}
//--></script> 
<?php } ?>


  <script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

//--></script>

    <script type="text/javascript"><!--
$('#history').delegate('.pagination a', 'click', function(e) {
	e.preventDefault();
	
	$('#history').load(this.href);
});			

$('#history').load('index.php?route=coffeeshopcrm/customerrelationships/history&token=<?php echo $token; ?><?php if(isset($cr)) { echo '&cr='.$cr; } ?>');//--></script>


</div>
<?php echo $footer; ?>