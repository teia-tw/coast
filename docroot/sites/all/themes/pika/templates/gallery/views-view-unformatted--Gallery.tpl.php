<style>
<?php if(theme_get_setting('gallery-columns', 'pika') == 5){?>
	.gallery-image-4 img {width: 192px;height: 128px; }
<?php } ?>
<?php if(theme_get_setting('gallery-columns', 'pika') == 4){?>
	.gallery-image-4 img {width: 240px;height: 160px;}
<?php } ?>
<?php if(theme_get_setting('gallery-columns', 'pika') == 3){?>
	.gallery-image-4 img {width: 320px;height: 200px;}
<?php } ?>
<?php if(theme_get_setting('gallery-columns', 'pika') == 2){?>
	.gallery-image-4 img {width: 480px;height: 320px;}
<?php } ?>	
</style>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php foreach ($rows as $id => $row): ?>
  <div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] .'"';  } ?>>
    <?php print $row; ?>
  </div>
<?php endforeach; ?>

