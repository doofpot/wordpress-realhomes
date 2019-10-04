<?php
/**
 * Sidebar
 *
 * @package    realhomes
 * @subpackage classic
 */

?>
<div class="span4 sidebar-wrap">
    <?php
    if ( is_active_sidebar( 'default-sidebar' ) )  {
        ?>
        <aside class="sidebar">
		    <?php dynamic_sidebar( 'default-sidebar' ); ?>
        </aside>
        <?php
    }
    ?>
</div>
