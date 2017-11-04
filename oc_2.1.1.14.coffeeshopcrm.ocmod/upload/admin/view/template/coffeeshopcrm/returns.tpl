<div class="panel panel-default">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <td><?php echo $t_return_id; ?></td>
          <td><?php echo $t_date_added; ?></td>
		  <td><?php echo $t_order_id; ?></td>
		  <td><?php echo $t_product_id; ?></td>
		  <td><?php echo $t_product; ?></td>
		  <td><?php echo $t_model; ?></td>
		  <td><?php echo $t_quantity; ?></td>
		  <td><?php echo $t_opened; ?></td>
		  <td><?php echo $t_reason; ?></td>
		  <td><?php echo $t_raction; ?></td>
		  <td><?php echo $t_status; ?></td>
		  <td><?php echo $t_comment; ?></td>
		  <td><?php echo $t_action; ?></td>

        </tr>
      </thead>
      <tbody>
        <?php if ($returns) { ?>
        <?php foreach ($returns as $return) { ?>
        <tr>
          <td class="text-right"><?php echo $return['return_id']; ?></td>
		  <td><?php echo $return['date_added']; ?></td>
          <td><?php echo $return['order_id']; ?></td>
		  <td><?php echo $return['product_id']; ?></td>
		  <td><?php echo $return['product']; ?></td>
		  <td><?php echo $return['model']; ?></td>
		  <td><?php echo $return['quantity']; ?></td>
		  <td><?php if($return['opened'] == '0') { echo $c_closed; } else { echo $c_opened; } ?></td>
		  <td><?php echo $return['reason']; ?></td>
		  <td><?php echo $return['raction']; ?></td>
		  <td><?php echo $return['rstatus']; ?></td>
          <td class="text-right"><?php echo trim(preg_replace('/\s+/', ' ', $return['comment'])); ?></td> 
		  <td class="text-right"><a href="<?php echo $return['edit']; ?>" data-toggle="tooltip" title="<?php echo $c_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
        </tr>
        <?php } ?>
        <?php } else { ?>
        <tr>
          <td class="text-center" colspan="13"><?php echo $text_no_results; ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

