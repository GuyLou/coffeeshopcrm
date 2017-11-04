<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><?php echo $heading_title; ?>
		<a href="<?php echo $add; ?>" id="button_add" data-toggle="tooltip" title="<?php echo $button_add; ?>" ><i class="fa fa-plus-circle"></i></a>
	</h3>
  </div>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <td class="text-right"><?php echo $column_cr_id; ?></td>
          <td><?php echo $column_order_id; ?></td>
          <td><?php echo $column_creation_date; ?></td>
		  <td><?php echo $column_stage_desc; ?></td>
          <td class="text-right"><?php echo $column_description; ?></td>
          <td class="text-right"><?php echo $column_due_date; ?></td>
		  <td class="text-right"><?php echo $column_action; ?></td>
        </tr>
      </thead>
      <tbody>
        <?php if ($crs) { ?>
        <?php foreach ($crs as $cr) { ?>
        <tr>
          <td class="text-right"><?php echo $cr['cr_id']; ?></td>
          <td><?php echo $cr['order_id']; ?></td>
          <td><?php echo $cr['creation_date']; ?></td>
		  <td><?php echo $cr['cr_stage_desc']; ?></td>
          <td class="text-right"><?php echo trim(preg_replace('/\s+/', ' ', $cr['description'])); ?></td> 
		  <td><?php echo $cr['due_date']; ?></td>
          <td class="text-right"><a href="<?php echo $cr['edit']; ?>" id="button-edit<?php echo $cr['cr_id']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a></td>
        </tr>
        <?php } ?>
        <?php } else { ?>
        <tr>
          <td class="text-center" colspan="6"><?php echo $text_no_results; ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

