<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><a href=" <?php echo $ca_link; ?>"><?php echo $heading_title; ?></a></h3>
  </div>
  <div class="panel-body" style="overflow-y: auto; max-height: 400px; ">
  <ul class="list-group">
    <?php if ($activities) { ?>
    <?php foreach ($activities as $activity) { ?>
    <li class="list-group-item"><?php echo $activity['comment']; ?>&nbsp;
      <small class="text-muted"><i class="fa fa-history"></i> <?php echo $activity['date_added']; ?></small></li>
    <?php } ?>
    <?php } else { ?>
    <li class="list-group-item text-center"><?php echo $text_no_results; ?></li>
    <?php } ?>
  </ul>
  </div>
</div>