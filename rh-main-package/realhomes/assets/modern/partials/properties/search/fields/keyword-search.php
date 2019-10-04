<?php
/**
 * Field: Keyword
 *
 * Keyword field for advance property search.
 *
 * @since 	3.0.0
 * @package RH/modern
 */

$inspiry_keyword_label 			= get_option( 'inspiry_keyword_label' );
$inspiry_keyword_placeholder 	= get_option( 'inspiry_keyword_placeholder_text' )
?>
<div class="rh_prop_search__option">
	<label for="keyword-txt">
		<?php if ( $inspiry_keyword_label ) {
			echo esc_html( $inspiry_keyword_label );
		} else {
			esc_html_e( 'Keyword', 'framework' );
		} ?>
	</label>
	<input type="text" name="keyword" id="keyword-txt"
	       value="<?php echo isset( $_GET['keyword'] ) ? esc_attr( $_GET['keyword'] ) : ''; ?>"
           placeholder="<?php if ( ! empty( $inspiry_keyword_placeholder ) ) {
		       echo esc_attr( $inspiry_keyword_placeholder );
	       } else {
		       echo esc_attr( rh_any_text() );
	       } ?>"/>
</div>
