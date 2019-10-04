<?php
/**
 * Sidebar: Contact
 *
 * @package realhomes
 * @subpackage classic
 */

?>
<div class="span3 sidebar-wrap">
	<?php
	if ( is_active_sidebar( 'contact-sidebar' ) ) {
		?>
        <aside class="sidebar">
			<?php dynamic_sidebar( 'contact-sidebar' ); ?>
        </aside>
		<?php
	}
	?>
</div>
