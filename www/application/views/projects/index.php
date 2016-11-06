<?

#var_dump( $this->session->login);

?>


<?php foreach ($projects as $project_item){
	$url = get_project_url($project_item['id'], $project_item['slug']);
	$_title = H($project_item['title']);
?>
	<div class="project">
        <h3><a href="<?php echo $url; ?>" title="<?php echo $_title; ?>"><?php echo $_title; ?></a></h3>
        <div class="project_desc">
		<?php echo H($project_item['desc']); ?>
        </div>
<?php 
#if($project_item['budget']){ 
#<div class="budget"> $project_item['budget'] руб</div>
#}
?>
        <p><a href="<?php echo $url; ?>" title="<?php echo $_title; ?>">перейти к проекту</a>
	</div>

<?php } ?>

<div class="pager">
	<?=$pager;?>
</div>
