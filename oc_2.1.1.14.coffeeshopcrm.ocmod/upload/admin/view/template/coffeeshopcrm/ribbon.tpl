  <div class="navbar-header">
  <ul class="nav pull-left">
    <?php if ($buttons) { ?>
    <?php foreach ($buttons as $button) { ?>
    <li><a href="<?php echo $button['link']; ?>" id="<?php echo $button['name']; ?>" ><i class="<?php echo $button['icon']; ?>"></i></a></li>
    <?php } ?>
    <?php }  ?>
  </ul>
  </div>
