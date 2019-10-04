<?php
/**
 * Sidebar: Property Listing
 *
 * @package    realhomes
 * @subpackage classic
 */

?>

<div class="span3 sidebar-wrap">
	<?php
	if ( is_active_sidebar( 'property-listing-sidebar' ) ) {
		?>
        <aside class="sidebar">
			<?php dynamic_sidebar( 'property-listing-sidebar' ); ?>
        </aside>
		<?php
	}
	?>
</div>
