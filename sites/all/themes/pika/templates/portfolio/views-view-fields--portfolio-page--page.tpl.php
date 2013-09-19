<?php $title = $fields['title']->content; $image = $fields['uri']->content; $client = $fields['field_portfolio_client']->content;?>
<li class="ch-item">
  <div class="ch-item" style="background-image: url(<?php print $image;?>); background-size:cover;">
    <div class="ch-info">
      <h3><?php print $title;?> </h3>
      <p><?php print $client;?></p>
    </div>
  </div>
</li>

