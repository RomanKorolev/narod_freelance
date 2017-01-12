<div class="pubdate" style="float: right;">Дата публикации: <?=date('d.m.Y H:i:s', $project_item['ts']); ?></div><br />

<? if($project_item['budget']): ?>
<div class="budget" style="float: right;">Бюджет: <?=$project_item['budget'];?> руб</div>
<? endif; ?>
<?=H($project_item['desc']);?><br />
<?php 
if(count($tags)){
?>
<div class="tags">Теги: 
<?php
	foreach($tags as $tag){
		$url = get_tag_url($tag['tag']);
		$t = $tag['tag'];
		?> <span><a href="<?=$url;?>" title="Все проекты с тегом <?=$t;?>"><?=$t;?></a></span><?
	}
?>
</div>
<?
}
?>
<br />
<?php if(!$project_item['user_id']): ?>
	Источник: <a href="<?=$project_item['link'];?>" rel="nofollow">перейти</a>
<?php endif; ?>
