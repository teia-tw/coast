<?php
/**
 * @file views-isotope.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<style>

.isotope-element {
  width: 227.5px;
  height: 150px;
  margin: 10px -10px 0px 20px;
  float: left;
  overflow: hidden;
  position: relative;
  background: #bebebe;
  color: #fff;
}

.isotope-element img {
  width: 227.5px;
  margin: 0 auto;
  text-align: center;
}
</style>
<div class="row">
    <div id="isotope-container">
      <?php
        $count = 0;
        foreach ($rows as $row):
      ?>
        <div class="isotope-element <?php print @$isotope_filter_classes[$count]; ?>" data-category="<?php print @$isotope_filter_classes[$count]; ?>">
          <?php print $row; ?>
        </div>
      <?php
          $count++;
        endforeach;
      ?>
    </div>	    
</div>
