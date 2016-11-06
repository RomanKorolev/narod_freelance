<?

if ( !defined('application_helpers_mypager_helper') ):

define('application_helpers_mypager_helper', '1');

function pager($cat_path, $total_pages, $current_page = 0){
	$htm = '';
	$page_nums = array(0, $total_pages - 1, $current_page);

	for($n = 1; $n < $total_pages; $n <<= 1){
		$page = $current_page + $n;
		if($page < $total_pages){
			$page_nums[] = $page;
		}
		$page = $current_page - $n;
		if($page >= 0){
			$page_nums[] = $page;
		}
	}

	$page_nums = array_unique($page_nums);
	sort($page_nums);

#	for($page = 0; $page < $total_pages; $page++){
	$prev_page = -1;
	foreach($page_nums as $page){
		if($prev_page + 1 != $page){
			$htm .= '<span>&nbsp;...&nbsp;</span>';
		}
		$link = site_url("$cat_path/page-{$page}");
		$p = $page + 1;
		$htm .= <<<EOS
	<a href="$link" title="Фриланс проекты, страница $p">&nbsp;$p&nbsp;</a>
EOS;
		$prev_page = $page;
	}
	return $htm;
}

endif;
