       		
<style>

	#sidebar {display:none;} #content {width:100%;}

<?php if(theme_get_setting('portfolio-columns', 'pika') == 5){?>
	.isotope-element, .ch-item { width: 392px; height: 140px;}	
<?php } ?>
<?php if(theme_get_setting('portfolio-columns', 'pika') == 4){?>
	.isotope-element, .ch-item { width: 240px; height: 160px;}	
<?php } ?>
<?php if(theme_get_setting('portfolio-columns', 'pika') == 3){?>
	.isotope-element, .ch-item { width: 320px; height: 200px;}	
<?php } ?>
<?php if(theme_get_setting('portfolio-columns', 'pika') == 2){?>
	.isotope-element, .ch-item { width: 480px; height: 320px;}	
<?php } ?>	

</style>           
<!--[if lte IE 8]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
<div class="row">
    <div id="isotope-container">
      <?php
        $count = 0;
        foreach ($rows as $row):
      ?>
       <li>
        <ul class="isotope-element <?php print @$isotope_filter_classes[$count]; ?> ch-grid" data-category="<?php print @$isotope_filter_classes[$count]; ?>">
             <?php print $row; ?>
        </ul>
        </li>
      <?php
          $count++;
        endforeach;
      ?>
    </div>	    
</div>