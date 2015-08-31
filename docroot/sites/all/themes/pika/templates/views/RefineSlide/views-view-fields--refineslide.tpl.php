<?php 
$title = $fields['title']->content; 
$body = $fields['body']->content;
$image = $fields['field_rs_image']->content;
$link = $fields['field_pika_link']->content; 
?>
<li class="group"><a href="<?php print $link; ?>"><?php print $image;?></a>
				        <div class="rs-caption rs-bottom">
				            <a href="<?php print $link; ?>"><div class="caption tp-caption big_white rscapt rs-caption-t" ><?php print $title;?></div></a>
				            <div class="tp-caption medium_text rscapt rs-caption-d"><?php print $body; ?></div>
				        </div>
				    </li>
