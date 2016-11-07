<h2><?=H($project_item['title']);?></h2>
<?=H($project_item['desc']);?>
<?php if(!$project_item['user_id']): ?>
	Источник: <a href="<?=$project_item['link'];?>" rel="nofollow">перейти</a>
<?php endif; ?>