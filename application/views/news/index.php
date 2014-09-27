<?php
    date_default_timezone_set('Europe/Warsaw');
    $mon = array(
        "01" => "sty",
        "02" => "lut",
        "03" => "mar",
        "04" => "kw",
        "05" => "maj",
        "06" => "cze",
        "07" => "lip",
        "08" => "sie",
        "09" => "wrz",
        "10" => "paz",
        "11" => "lis",
        "12" => "gru");
?>
<div id="main" class="text">
    <div class="news">
    <?php foreach ($news as $news_item): ?>
    <?php $d = new DateTime($news_item['date']) ?>
    <?php $url = site_url() . "/news/view/" . $news_item['slug']; ?>
        <div class="date">
            <div class="date_in">
                <div class="mont"><?php echo $mon[$d->format('m')] ?></div>
                <span class="day"><?php echo $d->format('d') ?></span>
                <div class="year"><?php echo $d->format('Y') ?></div>
            </div>
        </div>
        <div class="news_cont">
            <h2><?php echo $news_item['title']?></h2>
            <h4 class="date_inline"><?php echo $d->format('d') ?>, <?php echo $mon[$d->format('m')] ?>, <?php echo $d->format('Y') ?> </h4>
            <p>
                <?php echo $news_item['text'] ?>
            </p>
        </div>
    <?php endforeach ?>
    <?php if (!isset($no_pag)) {simple_pag($page_num,$pages,"news/");}?>
    </div>
</div>
