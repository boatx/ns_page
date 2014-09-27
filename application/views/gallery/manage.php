<?php
    $manage_url = site_url() . '/gallery/manage/';
    $rm_url = site_url() . '/gallery/manage/rm/';
?>
<div id="main">
    <div id="content" class="text">
        <h2>Manage Gallery</h2>
        <?php echo validation_errors(); ?>
        <?php var_dump($errors) ?>
        <?php echo form_open('gallery/manage/create_subgallery'); ?>
            <h5>Nazwa Galerii</h5>
            <input type="text" name="name" value="" size="50" />
            <div><input type="submit" value="Submit" /></div>
        </form>
        <?php foreach ($maps as $file): ?>
        <table>
            <tr>
                <td><a href=<?php echo $manage_url . $file ?> ><?php echo $file ?></a></td>
                <td><a href=<?php echo $rm_url . $file ?>>USUŃ</a></td>
            </tr>
        </table>
        <?php endforeach ?>
    </div>
</div>
