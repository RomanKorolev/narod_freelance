<?php foreach ($tags as $tag_item){
	if(!$tag_item['count']) continue;
	$url = get_tag_url($tag_item['tag']);
	$_tag = H($tag_item['tag']);
?>
        <span class="tag"><a href="<?=$url;?>" title="Все проекты с тегом <?=$_tag;?>"><?=$_tag;?> <?=$tag_item['count'];?></a></span>

<?php } ?>
