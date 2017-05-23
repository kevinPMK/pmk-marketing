<?php

/*---------------------------------------------------------------
	BLOG HEADER
---------------------------------------------------------------*/


$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
global $wp_query;
$pages = $wp_query->max_num_pages;

?>


<?php if(is_archive()): ?>

	<div class="slide__copy">
		<div class="blog-overview__page-count">
			Page <?php echo $paged ?> / <?php echo $pages ?>
		</div>
		<h2>
			<?php echo single_term_title(); ?>
		</h2>
		<hr class="hr-gradient" />
	</div>

<?php elseif($paged != 1): ?>

<div class="slide__copy">
	<div class="blog-overview__page-count">
		Page <?php echo $paged ?> / <?php echo $pages ?>
	</div>
	<h2>Blog Archives</h2>
	<hr class="hr-gradient" />
</div>

<?php endif; ?>
