<?=validation_errors();?>
<style>
#project_form .desc{
	width: 100%;
	height: 200px;
}
#project_form .title{
	width: 50%;
}

</style>
<?=form_open('projects/create', array('id' => 'project_form')); ?>
	<label for="title">Название проекта</label><br />
	<input class="title" type="input" name="title" placeholder="Название проекта" value="<?=set_value('title'); ?>" required /><br />

	<label for="budget">Бюджет</label><br />
	<input type="input" name="budget" placeholder="Бюджет проекта" value="<?=set_value('budget'); ?>" required />Руб.<br />

	<label for="text">Описание проекта</label><br />
	<textarea class="desc" name="desc" placeholder="Описание проекта, техническое задание, требования к проекту и исполнителю (необходимые навыки), стоимость, срок исполнения, контакты/способ связи" required><?=set_value('desc'); ?></textarea><br />

	<input type="submit" class='submit' value="Добавить проект" />

</form>
