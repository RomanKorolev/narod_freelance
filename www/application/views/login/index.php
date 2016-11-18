<?=validation_errors();?>
		<?=form_open('login', array('id' => 'reg_form')); ?>
			<input name="login" type="text"  placeholder="Логин"  value="<?=set_value('login'); ?>" required />
			<input name="password" type="password" placeholder="Пароль" value="" required />
			<input name="redir" type="hidden" value="<?=$redir;?>" />
			<input type="submit" class='submit' value="Войти" />
		</form>
