<?php
/**
 * Agency sidebar.
 *
 * @since 3.5.0
 * @package    realhomes
 * @subpackage classic
 */

?>

<div class="span3 sidebar-wrap">
	<?php
	if ( is_active_sidebar( 'agency-sidebar' ) ) {
		?>
        <aside class="sidebar">
			<?php dynamic_sidebar( 'agency-sidebar' ); ?>
        </aside>
		<?php
	}
	?>
</div>
