<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
		<?php if(isset($insert_sale) && isset($insert_service)) { ?>
      <div class="pull-right">
		<a href="<?php echo $insert_sale; ?>" data-toggle="tooltip" title="<?php echo $button_insert_sale; ?>" class="btn btn-primary"><i class="fa fa-coffee icon-stack-base"></i><i class="fa fa-tag"></i></a>
		<a href="<?php echo $insert_service; ?>" data-toggle="tooltip" title="<?php echo $button_insert_service; ?>" class="btn btn-success"><i class="fa fa-coffee icon-stack-base"></i><i class="fa fa-tag"></i></a>
      </div>
		<?php  } ?>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
	  <form method="get" action="<?php echo $form_action; ?>" id="form-cr">
		<input type="hidden" name="route" value="<?php echo $route; ?>" class="form-control" />
		<input type="hidden" name="token" value="<?php echo $token; ?>" class="form-control" />
	     <div class="well">
          <div class="row">
            <div class="col-sm-4">
			
              <div class="form-group">
                <label class="control-label" for="input-order-id"><?php echo $form_customer_id; ?></label>
                <input type="text" name="filter_customer_id" value="<?php echo $filter_customer_id; ?>" placeholder="<?php echo $form_customer_id; ?>" id="input-customer_id" class="form-control" />
              </div>
			
              <div class="form-group">
                <label class="control-label" for="input-order-id"><?php echo $form_cr_id; ?></label>
                <input type="text" name="filter_cr_id" value="<?php echo $filter_cr_id; ?>" placeholder="<?php echo $form_cr_id; ?>" id="input-cr_id" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-customer"><?php echo $form_order_id; ?></label>
                <input type="text" name="filter_order_id" value="<?php echo $filter_order_id; ?>" placeholder="<?php echo $form_order_id; ?>" id="input-order_id" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-cr_type"><?php echo $form_cr_type; ?></label>
                 <select name="filter_cr_type" id="input-cr_type" class="form-control">
					<option value="" <?php if (!isset($filter_cr_type)) { echo 'selected="selected"'; } ?>></option>
                  <?php foreach ($cr_types as $type) { ?>
                    <option value="<?php echo $type['name']; ?>" <?php if ($type['name'] == $filter_cr_type) { echo 'selected="selected"'; } ?>><?php echo $type['desc']; ?></option>
                  <?php } ?>
                </select>               
              </div>
              <div class="form-group">
                <label class="control-label" for="input-stage"><?php echo $form_stage; ?></label>
                <select name="filter_stage" id="input-stage" class="form-control">
                  <option value=""></option>
                </select>
              </div>
			 <div class="form-group">
                <label class="control-label" for="input-status"><?php echo $form_cr_status; ?></label>
                <select name="filter_cr_status" id="input-cr_status" class="form-control">
					<option value=""></option>
                  <?php foreach ($cr_status as $sts) { ?>
                    <option value="<?php echo $sts['name']; ?>" <?php if ($sts['name'] == $filter_cr_status) { echo 'selected="selected"'; } ?>><?php echo $sts['desc']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-4">
			    <div class="form-group">
				<label class="control-label" for="input-date_added"><?php echo $form_date_added; ?></label>
			   <div class="form-inline">
                

				<!-- span class="input-group addon" -->
					<select name="filter_date_added_op" id="input-due_date_op" class="selectpicker form-control">
						<option value=""></option>
						<?php foreach ($ops as $op) { ?>
								<option value="<?php echo $op; ?>" <?php if ($op == html_entity_decode($filter_date_added_op)) { echo 'selected="selected"'; } ?>><?php echo $op; ?></option>
						<?php } ?>
					
					</select>
					<!-- /span -->
					                <div class="input-group date">
                  <input type="text" name="filter_date_added" value="<?php echo $filter_date_added; ?>" placeholder="<?php echo $form_date_added; ?>" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
              </div></div>
			  <div class="form-group">
			  <label class="control-label" for="input-due_date"><?php echo $form_due_date; ?></label>
              <div class="form-inline">
                
                
				<!-- span class="input-group-btn" -->
					<select name="filter_due_date_op" id="input-due_date_op" class="selectpicker form-control">
					<option value=""></option>
						<?php foreach ($ops as $op) { ?>
								<option value="<?php echo $op; ?>" <?php if ($op == html_entity_decode($filter_due_date_op)) { echo 'selected="selected"'; } ?>><?php echo $op; ?></option>
						<?php } ?>
					</select>
					<!-- /span -->
					<div class="input-group date">
                  <input type="text" name="filter_due_date" value="<?php echo $filter_due_date; ?>" placeholder="<?php echo $form_due_date; ?>" data-date-format="YYYY-MM-DD" id="input-date-modified" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
				
              </div></div>
			  <div class="form-group">
			  
			  <label class="control-label" for="input-due_date"></label>
			  <div>
			  <button type="submit" id="button-filter" class="btn btn-primary " <?php // pull-right ?>><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
			  </div>
			  </div>
            </div>
          </div>
        </div>
		</form>
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
	        <thead>
			<tr>
			<td class="text-left"><a href="<?php echo $sort_cr_id; ?>"><?php echo $column_cr_id; ?></a></td>
			<td class="text-left"><a href="<?php echo $sort_cr_type; ?>"><?php echo $column_cr_type; ?></a></td>
			<td><a href="<?php echo $sort_order_id; ?>"><?php echo $column_order_id; ?></a></td>
			<td><a href="<?php echo $sort_creation_date; ?>"><?php echo $column_creation_date; ?></a></td>
			<td><a href="<?php echo $sort_cr_stage_desc; ?>"><?php echo $column_stage_desc; ?></a></td>
			<td class="text-left"><?php echo $column_description; ?></a></td>
			<td class="text-left"><a href="<?php echo $sort_due_date; ?>"><?php echo $column_due_date; ?></a></td>
			<td class="text-left"><?php echo $column_action; ?></a></td>
        </tr>
      </thead>
              <tbody>
                <?php if ($crs) { ?>
                <?php foreach ($crs as $cr) { ?>
				  <tr>
					<td class="text-left"><?php echo $cr['cr_id']; ?></td>
					<td class="text-left"><?php echo $cr['cr_type']; ?></td>
					<td><?php echo $cr['order_id']; ?></td>
					<td><?php echo $cr['creation_date']; ?></td>
					<td><?php echo $cr['cr_stage_desc']; ?></td>
					<td class="text-left"><?php echo trim(preg_replace('/\s+/', ' ', $cr['description'])); ?></td> 
					<td><?php echo $cr['due_date']; ?></td>
					<td class="text-left"><a href="<?php echo $cr['edit']; ?>" id="button-edit<?php echo $cr['cr_id']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a></td>
				</tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
  
 

  <script type="text/javascript"><!--
	var crs = document.getElementById("input-stage");
	var crt =  document.getElementById("input-cr_type");
	<?php foreach ($stages as $type => $stages_arr) {
				echo 'var '. $type .'_d = ["' .implode('","', $stages_arr) .'"];';
				echo 'var '. $type .'_id = ["' .implode('","', array_keys($stages_arr)) .'"];';
				} ?>
		 
	function stage_options() {
		j = crs.options.length;
	 	for (i = 0; i < j; i++) {
			crs.remove(0);
		}
		
	switch(crt.value) {
		case 'sale':
			var scrs_d = sale_d.slice();
			var scrs_id = sale_id.slice();
			break;
		case 'service':
			var scrs_d = service_d.slice();
			var scrs_id = service_id.slice();
			break;
		case 'order':
			var scrs_d = order_d.slice();
			var scrs_id = order_id.slice();
			break;
		default:
			var scrs_d = '';
			var scrs_id = '';
}

		var option = document.createElement("option");
		option.value = '';
		option.text = '';
		crs.add(option);
		for (i = 0; i < scrs_d.length; i++) {
			var option = document.createElement("option");
			option.value = scrs_id[i];
			option.text = scrs_d[i];
			if (scrs_id[i] == '<?php echo $filter_stage; ?>') {
				option.selected = true;
			}
			crs.add(option);
		}
	
	}
	window.onload = function() {
			stage_options();
	};
	crt.onchange = function() {
		stage_options();
	
	}
//--></script> 

  <script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

//--></script>

</div>

<?php echo $footer; ?>