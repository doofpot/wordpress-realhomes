<?php
/**
 * Sidebar: Optima Express
 *
 * @package    realhomes
 * @subpackage classic
 */

?>

<div class="span3 sidebar-wrap">
	<?php
	if ( is_active_sidebar( 'optima-express-page-sidebar' ) ) {
		?>
        <aside class="sidebar">
			<?php dynamic_sidebar( 'optima-express-page-sidebar' ); ?>
        </aside>
		<?php
	}
	?>
</div>
