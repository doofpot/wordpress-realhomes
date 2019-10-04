<?php
/**
 * Footer Template
 *
 * @package realhomes
 */

?>
<?php
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
	get_template_part( 'assets/' . INSPIRY_DESIGN_VARIATION . '/partials/footer' );
}


inspiry_post_nav();

if ( INSPIRY_DESIGN_VARIATION == 'modern' ) {
	echo '</div>';
	//close .rh_wrap opened in header.php
}
$inspiry_scroll_to_top = get_option( 'inspiry_scroll_to_top', 'true' );
if ( $inspiry_scroll_to_top == 'true' ) {
	?>
    <a href="#top" id="scroll-top"><i class="fa fa-chevron-up"></i></a>
	<?php
}

wp_footer();
?>
</body>
</html>
