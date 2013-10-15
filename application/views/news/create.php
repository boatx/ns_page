
<div id="main">
    <div id="content" class="text">
<h2>Create a news item</h2>
<?php echo validation_errors(); ?>
    <?php echo form_open('news/create'); ?>
    <h5>Tytuł</h5>
    <input type="text" name="title" value="" size="50" />
    <h5>Treść</h5>
    <textarea name="text" cols="50" rows="10"></textarea> 
    <div><input type="submit" value="Submit" /></div>
</form>
    </div>
</div>
