<?php
/**
 * Sidebar: dsIDX
 *
 * @package    realhomes
 * @subpackage classic
 */

?>

<div class="span3 sidebar-wrap">
	<?php
	if ( is_active_sidebar( 'dsidx-sidebar' ) )  {
		?>
        <aside id="dsidx-sidebar" class="sidebar">
			<?php dynamic_sidebar( 'dsidx-sidebar' ); ?>
        </aside>
		<?php
	}
	?>
</div>
