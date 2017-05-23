<?php

/*---------------------------------------------------------------
	BLOG FOOTER
---------------------------------------------------------------*/

?>


<?php

$prev_link = get_previous_posts_link(__('&laquo; Older Entries'));
$next_link = get_next_posts_link(__('Newer Entries &raquo;'));
// as suggested in comments
if ($prev_link || $next_link):

?>

<footer class="blog-overview__footer">
	<div class="paged-links">
		<?php posts_nav_link(' ','<svg class="icon icon-32-larrow icon--32" aria-hidden="true" role="img"> <use href="#svg-icon-32-larrow" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-icon-32-larrow"></use> </svg> Previous ','Next <svg class="icon icon-32-rarrow icon--32" aria-hidden="true" role="img"> <use href="#svg-icon-32-rarrow" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-icon-32-rarrow"></use> </svg>'); ?>
	</div>
</footer>

<?php endif; ?>
