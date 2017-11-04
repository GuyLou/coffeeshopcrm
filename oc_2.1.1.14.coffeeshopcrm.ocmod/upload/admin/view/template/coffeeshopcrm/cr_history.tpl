<?php foreach ($crphistories as $crphistory) { ?>

<div class="container-fluid">
	<div class="panel-heading">
		<div  class="panel panel-default" style="background : #eeeeee">
		<div class="row">
			<div  class="col-sm-2"><label class="col-sm-2 control-label" for="input-type"><?php echo $form_cr_type; ?></label></div>
			<div  class="col-sm-2"><input type="hidden" name="cr_type" value="<?php echo $crphistory['cr_type']; ?>"><?php echo $crphistory['cr_type_desc']; ?></div>
			<div  class="col-sm-2"><label  for="input-stage"><?php echo $form_cr_stage; ?></label></div>
			<div  class="col-sm-2"><div class="form-group"><?php echo $crphistory['stage_desc']; ?></div>
			</div>
			<div  class="col-sm-2"><label  for="input-orders"><?php echo $form_order_id; ?></label></div>
			<div  class="col-sm-2"><?php echo $crphistory['order_id']; ?></div>
		</div>
			
            <div class="row">
              <div  class="col-sm-12">
					<div>
					<label style="height: 100%; width: 100%; max-width: 100%; min-height: 100px; border-style: solid; border-width: 1px; border-color: #444499; background: #ffffff;" name="description"><?php echo $crphistory['description']; ?></label>
				</div>
			  </div>

			</div>
			<div class="row">
				<div  class="col-sm-2"><label><?php echo $form_creation_date; ?></label></div>
				<div  class="col-sm-2"><?php echo $crphistory['creation_date']; ?></div>
				<div  class="col-sm-2"><label><?php echo $form_uname; ?></label></div>
				<div  class="col-sm-2"><?php echo $crphistory['uname']; ?></div>
				<div  class="col-sm-2"><label><?php echo $form_due_date; ?></label></div>
				<div  class="col-sm-2">
					<div><?php echo $crphistory['due_date']; ?></div>
				</div>
			</div>
		</div>
	</div>		
</div>

<?php } ?>

