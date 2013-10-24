<div id="main">
    <div class="text">
    <?php var_dump($maps) ?>
    <ul>
    <?php foreach ($maps as $dir): ?>
    <li><a href=<?php echo site_url() . '/gallery/' . $dir['url_name']?> ><?php echo $dir['name'] ?></a></li>
    <?php endforeach ?>
    </ul>
    </div>
</div>
