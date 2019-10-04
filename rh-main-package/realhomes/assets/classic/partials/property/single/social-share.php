<div class="share-networks clearfix">
	<span class="share-label"><?php esc_html_e( 'Share this', 'framework' ); ?></span>
	<span><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook fa-lg"></i><?php esc_html_e( 'Facebook', 'framework' ); ?></a></span>
	<span><a target="_blank" href="https://twitter.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-twitter fa-lg"></i><?php esc_html_e( 'Twitter', 'framework' ); ?></a></span>
<!--	<span><a target="_blank" href="https://plus.google.com/share?url=--><?php //the_permalink(); ?><!--"><i class="fa fa-google-plus fa-lg"></i>--><?php //esc_html_e( 'Google', 'framework' ); ?><!--</a></span>-->
    <span><a target="_blank" href="<?php if(wp_is_mobile()){echo 'https://api.whatsapp.com/send?text=';}else{echo 'https://api.whatsapp.com/send?text=';} echo  get_the_title() .  '&nbsp;' . get_the_permalink();?>"><i class="fa fa-whatsapp"></i><?php esc_html_e( 'WhatsApp', 'framework' ); ?></a></span>
</div>