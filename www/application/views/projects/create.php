<?=validation_errors();?>

<?=form_open('projects/create', array('id' => 'project_form')); ?>
	<label for="title">Название проекта</label><br />
	<input type="input" name="title" placeholder="Название проекта" value="<?=set_value('title'); ?>" /><br />

	<label for="budget">Бюджет</label><br />
	<input type="input" name="budget" placeholder="Бюджет проекта" value="<?=set_value('budget'); ?>" />Руб.<br />

	<label for="text">Описание проекта</label><br />
	<textarea name="desc" placeholder="Описание проекта, техническое задание, требования к проекту и исполнителю" style="width: 100%"><?=set_value('desc'); ?></textarea><br />

	<input type="submit" class='submit' value="Добавить проект" />

</form>
