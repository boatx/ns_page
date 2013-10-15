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
<div id="fb-root"></div>
<script>
window.fbAsyncInit = function() {
   FB.init({
     status: true, // check login status
     cookie: true, // enable cookies to allow server to access session,
     xfbml: true, // enable XFBML and social plugins
     oauth: true, // enable OAuth 2.0
     channelUrl: 'http://192.168.2.3/~lodka/ci/assets/channel.php' //custom channel
   });
    FB.api('/me', function(response) {
              console.log(response.name);
                  });
     };
     (function() {
             var e = document.createElement('script'); e.async = true;
                 e.src = document.location.protocol +
                           '//connect.facebook.net/en_US/all.js';
                 document.getElementById('fb-root').appendChild(e);
               }());
 </script>
<div id="main">
    <div class="text">
        <?php foreach ($news as $news_item): ?>
        <?php $d = new DateTime($news_item['date']) ?>
        <?php $url = site_url() . "/news/view/" . $news_item['slug']; ?>
        <div class="news">
            <div class="date">
                <div class="date_in">
                <div class="mont"><?php echo $mon[$d->format('m')] ?></div>
                <span class="day"><?php echo $d->format('d') ?></span>
                <div class="year"><?php echo $d->format('Y') ?></div>
                </div>
            </div>
            <div class="news_cont">
                <h2><?php echo $news_item['title']?></h2>
                <p>
                    <?php echo $news_item['text'] ?>
                </p>
                <div class="fb-like" data-href=<?php echo $url?> data-width="400" data-height="10" data-colorscheme="light" data-layout="standard" data-action="like" data-show-faces="true" data-send="false"></div>
                <br/>
                <div class="g-plusone" data-size="medium" data-annotation="inline" data-width="120"></div>
            </div>
        </div>
        <?php endforeach ?>
        <?php if (!isset($no_pag)) {simple_pag($page_num,$pages,"news/");}?>
    </div>
</div>
