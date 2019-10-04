<?php
/**
 * Sidebar: Property
 *
 * @package    realhomes
 * @subpackage classic
 */

?>

<div class="span3 sidebar-wrap">
	<?php
	if ( is_active_sidebar( 'property-sidebar' ) ) {
		?>
        <aside class="sidebar">
			<?php dynamic_sidebar( 'property-sidebar' ); ?>
        </aside>
		<?php
	}
	?>
</div>
