<?
$errors = validation_errors("<p>", "</p>");
if(!empty($errors)):
?>
		<div class="error"><?=$errors;?></div>
<? endif; ?>

		<?=form_open('register', array('id' => 'reg_form')); ?>
			<input name="login" type="text"  placeholder="Логин"  value="<?=set_value('login'); ?>" required />
			<input name="email" type="email" placeholder="Емейл" value="<?=set_value('email'); ?>" required />
			<input name="password" type="password" placeholder="Пароль" value="" required />
			<input name="password_confirm" type="password" placeholder="Подтверждение пароля" value="" required />
			<input type="submit" class='submit' value="Регистрация" />
		</form>
