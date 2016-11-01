<h2><?php echo $title; ?></h2>

<?
	
$errors = validation_errors();
if(!empty($errors)):

?>
<div class="error validation"><?=$errors;?></div>
<? endif; ?>

<?php echo form_open('projects/create'); ?>

    <label for="title">Title</label>
    <input type="input" name="title" value="<?php echo H($form['title']); ?>" /><br />

    <label for="text">Text</label>
    <textarea name="text"><?php echo H($form['text']); ?></textarea><br />

    <input type="submit" name="submit" value="Create news item" />

</form>