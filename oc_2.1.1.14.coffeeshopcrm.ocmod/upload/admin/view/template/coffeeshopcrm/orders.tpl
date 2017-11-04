<div class="panel panel-default">
  <?php /*
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-shopping-cart"></i> <?php echo $heading_title; ?></h3>
  </div>*/ ?>
<div class="table-responsive">
<table class="table">

</table>
</div>
  <div class="table-responsive" style="overflow-y: auto; max-height: 400px; ">
    <table class="table">
	      <thead>
        <tr>
          <td class="text-left"><?php echo $column_order_id; ?></td>
          <td class="text-left"><?php echo $column_status; ?></td>
		  <td class="text-left"><?php echo $column_description; ?></td>
          <td class="text-left"><?php echo $column_date_added; ?></td>
		  <td class="text-left"><?php echo $column_date_modified; ?></td>
		  <td class="text-left"><?php echo $column_due_date; ?></td>
          <td class="text-left"><?php echo $column_total; ?></td>
          <td class="text-left"><?php echo $column_action; ?></td>
        </tr>
      </thead>
      <tbody>
        <?php if (isset($orders)) { ?>
        <?php foreach ($orders as $order) { ?>
        <tr>
          <td class="text-left"><?php echo $order['order_id']; ?></td>
          <td><?php echo $order['status']; ?></td>
		  <td><?php echo $order['description']; ?></td>
          <td><?php echo $order['date_added']; ?></td>
		  <td><?php echo $order['date_modified']; ?></td>
		  <td><?php echo $order['due_date']; ?></td>
          <td class="text-left"><?php echo $order['total']; ?></td>
          <td class="text-left">
				<a href="<?php echo $order['view']; ?>" data-toggle="tooltip" title="<?php echo $button_view; ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
				<a href="<?php echo $order['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
				<a href="<?php echo $order['delete']; ?>" id="button-delete<?php echo $order['order_id']; ?>" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
				<?php if (is_null($order['cr_id'])) { ?>
					<a href="<?php echo $order['addedit']; ?>" id="button-add<?php echo $order['cr_id']; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-warning"><i class="fa fa-coffee"></i></a>
				<?php } else { ?>
					<a href="<?php echo $order['addedit']; ?>" id="button-edit<?php echo $order['cr_id']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-warning"><i class="fa fa-coffee"></i></a>
				<?php } ?>
			</td>
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

