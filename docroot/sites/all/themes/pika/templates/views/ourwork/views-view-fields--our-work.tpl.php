

<?php $title = $fields['title']->content; $image = $fields['field_portfolio_image']->content; $client = $fields['field_portfolio_client']->content;?>
 <li>
  <div><?php print $image;?></div>
  <div class="our-work-text-wrap">
   <div class="block-portfolio-title"><?php print $title;?></div>
  	<div class="block-portfolio-client"><?php print $client;?></div>
    </div>
</li>

