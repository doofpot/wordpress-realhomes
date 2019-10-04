<?php if ( 'true' === get_option( 'inspiry_display_virtual_tour' ) ) : ?>
    <div class="virtual-tour-content-wrapper single-property-section">
        <div class="container">
			<?php get_template_part( 'assets/modern/partials/property/single/virtual-tour' ); ?>
        </div>
    </div>
<?php endif; ?>