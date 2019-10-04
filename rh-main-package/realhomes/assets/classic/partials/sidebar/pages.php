<?php
/**
 * Sidebar: Pages
 *
 * @package     realhomes
 * @subpackages classic
 */
?>

<div class="span3 sidebar-wrap">
	<?php
	if ( is_active_sidebar( 'default-page-sidebar' ) ) {
		?>
        <aside class="sidebar">
			<?php dynamic_sidebar( 'default-page-sidebar' ); ?>
        </aside>
		<?php
	}
	?>
</div>
