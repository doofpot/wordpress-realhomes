<?php
/**
 * Single agent sidebar.
 *
 * @package    realhomes
 * @subpackage classic
 */

?>

<div class="span3 sidebar-wrap">
	<?php
	if ( is_active_sidebar( 'agent-sidebar' ) ) {
		?>
        <aside class="sidebar">
			<?php dynamic_sidebar( 'agent-sidebar' ); ?>
        </aside>
		<?php
	}
	?>
</div>
