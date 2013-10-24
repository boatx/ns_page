<?php
    $dir_org = base_url() . 'assets/gallery/' . $name . '/orginals/';
    $dir_th = base_url() . 'assets/gallery/' . $name . '/thumbs/';
?>
<div id="main">
    <div class="text">
    <ul>
        <?php foreach ($maps as $file): ?>
        <li><a href=<?php echo $dir_org . $file ?> >
            <img src=<?php echo $dir_th . $file ?> >
        </a></li>
        <?php endforeach ?>
    </ul>
    </div>
</div>
