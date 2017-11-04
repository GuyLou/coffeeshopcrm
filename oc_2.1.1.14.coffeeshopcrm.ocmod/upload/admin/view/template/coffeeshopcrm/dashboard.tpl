	         <div class="table-condensed">
          <table class="table table-bordered table-hover" >
            <thead>
			  <tr>
                <td class="text-center" colspan="4"><?php echo $tcr_type; ?></td>			  
			  </tr>
              <tr>
                <td class="text-left"><?php echo $tstage; ?></td>
				<td class="text-center"><?php echo $tpast_due_dates; ?></td>
				<td class="text-center"><?php echo $tcurrent_due_dates; ?></td>
				<td class="text-center"><?php echo $tfuture_due_dates; ?></td>
              </tr>
            </thead>
            <tbody>

			  <tr>
        <?php if ($crs) { ?>
        <?php foreach ($crs as $cr) { ?>
				<td class="text-center"><?php echo $cr['stage']; ?></td>
				<td class="text-center"><a href="<?php echo $cr['past_crs']; ?>"><?php echo $cr['past_due_dates']; ?></a></td>
				<td class="text-center"><a href="<?php echo $cr['current_crs']; ?>"><?php echo $cr['current_due_dates']; ?></a></td>
				<td class="text-center"><a href="<?php echo $cr['future_crs']; ?>"><?php echo $cr['future_due_dates']; ?></a></td>
			  </tr>
		<?php } ?>
        <?php } else { ?>
        <tr>
          <td class="text-center" colspan="4"><?php echo $text_no_results; ?></td>
        </tr>
        <?php } ?>
            </tbody>
          </table>
        </div>