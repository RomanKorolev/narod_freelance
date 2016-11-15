<h2><?=H($project_item['title']);?></h2>
<?=H($project_item['desc']);?><br />
<div class="tags">
<?php
	foreach($tags as $tag){
		$url = get_tag_url($tag['tag']);
		$t = $tag['tag'];
		?> <span><a href="<?=$url;?>" title="Все проекты с тегом <?=$t;?>"><?=$t;?></a></span><?
	}
?>
</div>
<?php if(!$project_item['user_id']): ?>
	Источник: <a href="<?=$project_item['link'];?>" rel="nofollow">перейти</a>
<?php endif; ?>
