
<div id="main">
    <div id="content" class="text">
        <p>
        <?php foreach ($news as $news_item): ?>
            <h2><?php echo $news_item['title']?></h2>
            <h5><?php echo $news_item['date'] ?></h5>
            <div>
                <?php echo $news_item['text'] ?>
            </div>
            <a href=<?php echo site_url("/news/edit_news") . "/" . $news_item['id'] ?>>Edytuj</a> 
            <a href=<?php echo site_url("/news/delete_news") . "/" . $news_item['id'] ?>>Usun</a> 
        <?php endforeach ?>
        <?php simple_pag($page_num,$pages,"news/edit/");?>
        </p>
    </div>
</div>
