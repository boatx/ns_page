<div id="main">
    <div id="content" class="text">
<h2>Create a news item</h2>
<?php echo validation_errors(); ?>
    <?php echo form_open('gallery/create_subgallery'); ?>
    <h5>Nazwa Galerii</h5>
    <input type="text" name="name" value="" size="50" />
    <div><input type="submit" value="Submit" /></div>
</form>
    </div>
</div>
