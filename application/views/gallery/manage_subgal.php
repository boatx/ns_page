<?php
    $dir_org = base_url() . 'assets/gallery/' . $name . '/orginals/';
    $dir_th = base_url() . 'assets/gallery/' . $name . '/thumbs/';
    $rm_url = site_url() . '/gallery/manage/rm/' . $name . '/';
?>
<div id="main">
    <div id="content" class="text">
        <h2>Manage Gallery</h2>
        <?php var_dump($error) ?>
        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('gallery/manage/upload_image'); ?>
            <h5>Dodaj Obraz do Galleri</h5>
            <input type="hidden" name="gallery_name" value=<?php echo $name?> />
            <input type="file" name="userfile" size="20"/>
            <div><input type="submit" value="Submit" /></div>
        </form>
        <?php foreach ($maps as $file): ?>
        <table>
            <tr>
                <td><a href=<?php echo $dir_org . $file ?> ><img src=<?php echo $dir_th . $file ?> ></a></td>
                <td><?php echo $file ?></td>
                <td><a href=<?php echo $rm_url . $file ?>>USUŃ</a></td>
            </tr>
        </table>
        <?php endforeach ?>
    </div>
</div>
