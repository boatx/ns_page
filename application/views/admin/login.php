<div id="main">
    <div id="content" class="text">
        <?php echo validation_errors(); ?>
            <?php echo form_open('admin/go'); ?>
            <h5>Username</h5>
            <input type="text" name="username" value="" size="50" />
            <h5>Password</h5>
            <input type="text" name="password" value="" size="50" />
            <div><input type="submit" value="Submit" /></div>
        </form>
    </div>
</div>


