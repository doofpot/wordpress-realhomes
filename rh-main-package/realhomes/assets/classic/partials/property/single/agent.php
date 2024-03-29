<?php
/**
 * Property agent.
 *
 * @package    realhomes
 * @subpackage classic
 */

global $post;

/**
 * A function that works as re-usable template
 *
 * @param array $args
 */
function display_agent_box( $args ) {
	global $post;   // property

	$theme_display_agent_contact_info     = get_option( 'theme_display_agent_contact_info', 'true' );
	$theme_display_agent_description      = get_option( 'theme_display_agent_description', 'true' );
	$theme_display_agent_detail_page_link = get_option( 'theme_display_agent_detail_page_link', 'true' );
	$inspiry_property_agent_form          = get_option( 'inspiry_property_agent_form', 'true' );

	$agent_section_classes = '';

	if ( 'false' === $theme_display_agent_contact_info ) {
		$agent_section_classes .= ' no-agent-contact-info';
	}

	if ( 'false' === $theme_display_agent_description ) {
		$agent_section_classes .= ' no-agent-description';
	}

	if ( 'false' === $theme_display_agent_detail_page_link ) {
		$agent_section_classes .= ' no-agent-know-more-btn';
	}

	if ( 'false' === $inspiry_property_agent_form ) {
		$agent_section_classes .= ' no-agent-contact-form';
	}
	?>
    <div class="agent-detail clearfix<?php echo esc_attr( $agent_section_classes ); ?>">

        <div class="left-box">
			<?php
			if ( isset( $args['agent_title_text'] ) && ! empty( $args['agent_title_text'] ) ) {
				?><h3><?php echo esc_html( $args['agent_title_text'] ); ?></h3><?php
			}

			if ( isset( $args['display_author'] ) && ( $args['display_author'] ) ) {
				if ( isset( $args['profile_image_id'] ) && ( 0 < $args['profile_image_id'] ) ) {
					?>
                    <figure><?php echo wp_get_attachment_image( $args['profile_image_id'], 'agent-image' ); ?></figure>
					<?php
				} elseif ( isset( $args['agent_email'] ) ) {
					?>
                    <figure><?php echo get_avatar( $args['agent_email'], '210' ); ?></figure>
					<?php
				}
			} else {
				if ( isset( $args['agent_id'] ) && has_post_thumbnail( $args['agent_id'] ) ) {
					?>
                    <figure>
                        <a href="<?php echo get_permalink( $args['agent_id'] ); ?>">
							<?php echo get_the_post_thumbnail( $args['agent_id'], 'agent-image' ); ?>
                        </a>
                    </figure>
					<?php
				}
			}
			?>
            <div class="agent-detail-inner-wrap clearfix">
                <?php if( 'true' === $theme_display_agent_contact_info ) : ?>
                    <ul class="contacts-list">
                        <?php
                        if ( isset( $args['agent_office_phone'] ) && ! empty( $args['agent_office_phone'] ) ) {
                            ?>
                            <li class="office">
                                <?php include INSPIRY_THEME_DIR . '/images/icon-phone.svg';
                                _e( 'Office', 'framework' ); ?> : <a href="tel:<?php echo esc_html( $args['agent_office_phone'] ); ?>"><?php echo esc_html( $args['agent_office_phone'] ); ?></a>
                            </li>
                            <?php
                        }
                        if ( isset( $args['agent_mobile'] ) && ! empty( $args['agent_mobile'] ) ) {
                            ?>
                            <li class="mobile">
                                <?php include INSPIRY_THEME_DIR . '/images/icon-mobile.svg';
                                _e( 'Mobile', 'framework' ); ?> : <a href="tel:<?php echo esc_html( $args['agent_mobile'] ); ?>"><?php echo esc_html( $args['agent_mobile'] ); ?></a>
                            </li>
                            <?php
                        }
                        if ( isset( $args['agent_office_fax'] ) && ! empty( $args['agent_office_fax'] ) ) {
                            ?>
                            <li class="fax">
                                <?php include INSPIRY_THEME_DIR . '/images/icon-printer.svg';
                                _e( 'Fax', 'framework' ); ?> : <a href="fax:<?php echo esc_html( $args['agent_office_fax'] ); ?>"><?php echo esc_html( $args['agent_office_fax'] ); ?></a>
                            </li>
                            <?php
                        }
                        if ( isset( $args['agent_whatsapp'] ) && ! empty( $args['agent_whatsapp'] ) ) {
                            ?>
                            <li class="whatsapp">
                                <?php include INSPIRY_THEME_DIR . '/images/icon-whatsapp.svg';
                                _e( 'WhatsApp', 'framework' ); ?> : <a href="tel:<?php echo esc_html( $args['agent_whatsapp'] ); ?>"><?php echo esc_html( $args['agent_whatsapp'] ); ?></a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                <?php endif; ?>
                <p>
                    <?php
                    if ( 'true' === $theme_display_agent_description ) :
                        echo esc_html( strip_tags( $args['agent_description'] ) );
                        ?><br/><?php
                    endif; ?>
                    <?php if ( 'true' === $theme_display_agent_detail_page_link ) {
	                    $theme_agent_detail_page_link_text = get_option( 'theme_agent_detail_page_link_text', esc_html__( 'Know More', 'framework' ) );
                        if ( isset( $args['display_author'] ) && ( $args['display_author'] ) ) {
                            ?>
                            <a class="real-btn"
                               href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo esc_html( $theme_agent_detail_page_link_text ); ?></a><?php
                        } else {
                            ?>
                            <a class="real-btn"
                               href="<?php echo get_permalink( $args['agent_id'] ); ?>"><?php echo esc_html( $theme_agent_detail_page_link_text ); ?></a><?php
                        }
                    }
                    ?>
                </p>
            </div>
        </div>
		<?php
        if ( 'true' === $inspiry_property_agent_form ) {
            if ( isset( $args['agent_email'] ) && ! empty( $args['agent_email'] ) ) {

                $agent_form_id = 'agent-form-id';
                if ( isset( $args['agent_id'] ) ) {
                    $agent_form_id .= $args['agent_id'];
                }

                ?>
                <div class="contact-form">
                    <h3><?php esc_html_e( 'Contact', 'framework' ); ?></h3>
                    <form id="<?php echo esc_attr( $agent_form_id ); ?>" class="agent-form contact-form-small"
                          method="post" action="<?php echo admin_url( 'admin-ajax.php' ); ?>">
                        <input type="text" name="name" placeholder="<?php esc_html_e( 'Name', 'framework' ); ?>"
                               class="required"
                               title="<?php esc_html_e( '* Please provide your name', 'framework' ); ?>">
                        <input type="text" name="email" placeholder="<?php esc_html_e( 'Email', 'framework' ); ?>"
                               class="email required"
                               title="<?php esc_html_e( '* Please provide valid email address', 'framework' ); ?>">
                        <input type="text" name="phone" placeholder="<?php esc_html_e( 'Phone', 'framework' ); ?>"
                               class="digits required"
                               title="<?php esc_html_e( '* Please provide valid phone number', 'framework' ); ?>">
                        <textarea name="message" class="required"
                                  placeholder="<?php esc_html_e( 'Message', 'framework' ); ?>"
                                  title="<?php esc_html_e( '* Please provide your message', 'framework' ); ?>"></textarea>
                        <?php

                        $is_gdpr_enabled = inspiry_is_gdpr_enabled();

                        if ( $is_gdpr_enabled ) {

                            $gdpr_agreement_text = inspiry_gdpr_agreement_content();

                            if ( ! empty( $gdpr_agreement_text ) ) {
                                ?>
                                <p class="gdpr-agreement clearfix">
                                    <?php

                                    $gdpr_agreement_label   = inspiry_gdpr_agreement_content( 'label' );
                                    $gdpr_agreement_val_msg = inspiry_gdpr_agreement_content( 'validation-message' );

                                    if ( ! empty( $gdpr_agreement_label ) ) {
                                        ?>
                                        <span class="gdpr-checkbox-label"><?php echo esc_html( $gdpr_agreement_label ); ?>
                                            <span class="required-label">*</span></span>
                                        <?php
                                    }

                                    ?>
                                    <input type="checkbox" id="inspiry-gdpr-<?php echo esc_attr( $agent_form_id ); ?>"
                                           class="required" name="gdpr"
                                           title="<?php echo esc_attr( $gdpr_agreement_val_msg ); ?>"
                                           value="<?php echo strip_tags( $gdpr_agreement_text ); ?>">
                                    <label for="inspiry-gdpr-<?php echo esc_attr( $agent_form_id ); ?>"><?php echo wp_kses( $gdpr_agreement_text, array(
		                                    'a' => array(
			                                    'id'     => array(),
			                                    'class'  => array(),
			                                    'href'   => array(),
			                                    'target' => array(),
			                                    'title'  => array()
		                                    ),
		                                    'em' => array(),
		                                    'strong' => array(),
	                                    ) ); ?></label>
                                </p>
                                <?php
                            }
                        }

                        get_template_part( 'common/google-reCAPTCHA/google-reCAPTCHA' );

                        ?>
                        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'agent_message_nonce' ); ?>"/>
                        <input type="hidden" name="target" value="<?php echo antispambot( $args['agent_email'] ); ?>">
                        <input type="hidden" name="action" value="send_message_to_agent"/>
                        <input type="hidden" name="property_id" value="<?php echo esc_attr( get_the_ID() ) ?>">
                        <?php
                        if ( ! empty( $args['agent_id'] ) ) {
                            ?>
                            <input type="hidden" name="agent_id" value="<?php echo esc_attr( $args['agent_id'] ); ?>">
                            <?php
                        }
                        if ( ! empty( $args['author_id'] ) ) {
                            ?>
                            <input type="hidden" name="author_id" value="<?php echo esc_attr( $args['author_id'] ) ?>">
                            <?php
                        }
                        if ( ! empty( $args['author_display_name'] ) ) {
                            ?>
                            <input type="hidden" name="author_name"
                                   value="<?php echo esc_attr( $args['author_display_name'] ) ?>">
                            <?php
                        }
                        ?>
                        <input type="hidden" name="property_title"
                               value="<?php echo esc_attr( get_the_title( $post->ID ) ); ?>"/>
                        <input type="hidden" name="property_permalink"
                               value="<?php echo esc_url_raw( get_permalink( $post->ID ) ); ?>"/>
                        <input type="submit" value="<?php esc_html_e( 'Send Message', 'framework' ); ?>" name="submit"
                               class="submit-button real-btn">
                        <img src="<?php echo INSPIRY_DIR_URI; ?>/images/ajax-loader.gif" class="ajax-loader"
                             alt="Loading...">
                        <div class="clearfix form-separator"></div>
                        <div class="error-container"></div>
                        <div class="message-container"></div>
                    </form>
                </div>
                <script type="text/javascript">
                    (function ($) {
                        "use strict";

                        if (jQuery().validate && jQuery().ajaxSubmit) {

                            var agentForm = $('#<?php echo esc_attr( $agent_form_id ); ?>');
                            var submitButton = agentForm.find('.submit-button'),
                                ajaxLoader = agentForm.find('.ajax-loader'),
                                messageContainer = agentForm.find('.message-container'),
                                errorContainer = agentForm.find(".error-container");

                            // Property detail page form
                            agentForm.validate({
                                errorLabelContainer: errorContainer, submitHandler: function (form) {
                                    $(form).ajaxSubmit({
                                        beforeSubmit: function () {
                                            submitButton.attr('disabled', 'disabled');
                                            ajaxLoader.fadeIn('fast');
                                            messageContainer.fadeOut('fast');
                                            errorContainer.fadeOut('fast');
                                        }, success: function (ajax_response, statusText, xhr, $form) {
                                            var response = $.parseJSON(ajax_response);
                                            ajaxLoader.fadeOut('fast');
                                            submitButton.removeAttr('disabled');
                                            if (response.success) {
                                                $form.resetForm();
                                                messageContainer.html(response.message).fadeIn('fast');

                                                // call reset function if it exists
                                                if (typeof inspiryResetReCAPTCHA == 'function') {
                                                    inspiryResetReCAPTCHA();
                                                }

                                            } else {
                                                errorContainer.html(response.message).fadeIn('fast');
                                            }
                                        }
                                    });
                                }
                            });

                        }

                    })(jQuery);
                </script>
                <?php
            }
        }
		?>
    </div>
	<?php
}


/**
 * Logic behind displaying agents / author information
 */
$display_agent_info   = get_option( 'theme_display_agent_info' );
$agent_display_option = get_post_meta( $post->ID, 'REAL_HOMES_agent_display_option', true );

if ( ( $display_agent_info == 'true' ) && ( $agent_display_option != "none" ) ) {

	if ( $agent_display_option == "my_profile_info" ) {

		$profile_args                       = array();
		$profile_args['display_author']     = true;
		$profile_args['author_id'] = get_the_author_meta('ID');
		$profile_args['author_display_name']     = get_the_author_meta( 'display_name' );
		$profile_args['agent_title_text']   = esc_html__( 'Submitted by', 'framework' ) . " " . get_the_author_meta( 'display_name' );
		$profile_args['profile_image_id']   = intval( get_the_author_meta( 'profile_image_id' ) );
		$profile_args['agents_count']       = 1;
		$profile_args['agent_mobile']       = get_the_author_meta( 'mobile_number' );
		$profile_args['agent_whatsapp']     = get_the_author_meta( 'whatsapp_number' );
		$profile_args['agent_office_phone'] = get_the_author_meta( 'office_number' );
		$profile_args['agent_office_fax']   = get_the_author_meta( 'fax_number' );
		$profile_args['agent_email']        = get_the_author_meta( 'user_email' );
		$profile_args['agent_description']  = get_framework_custom_excerpt( get_the_author_meta( 'description' ), 20 );
		display_agent_box( $profile_args );

	} else {

		$property_agents = get_post_meta( $post->ID, 'REAL_HOMES_agents' );
		// remove invalid ids
		$property_agents = array_filter( $property_agents, function ( $v ) {
			return ( $v > 0 );
		} );
		// remove duplicated ids
		$property_agents = array_unique( $property_agents );
		if ( ! empty( $property_agents ) ) {
			$agents_count = count( $property_agents );
			foreach ( $property_agents as $agent ) {
				if ( 0 < intval( $agent ) ) {
					$agent_args                       = array();
					$agent_args['agent_id']           = intval( $agent );
					$agent_args['agents_count']       = $agents_count;
					$agent_args['agent_title_text']   = esc_html(get_option('inspiry_property_agent_label','Agent')) . " " . get_the_title( $agent_args['agent_id'] );
					$agent_args['agent_mobile']       = get_post_meta( $agent_args['agent_id'], 'REAL_HOMES_mobile_number', true );
					$agent_args['agent_whatsapp']     = get_post_meta( $agent_args['agent_id'], 'REAL_HOMES_whatsapp_number', true );
					$agent_args['agent_office_phone'] = get_post_meta( $agent_args['agent_id'], 'REAL_HOMES_office_number', true );
					$agent_args['agent_office_fax']   = get_post_meta( $agent_args['agent_id'], 'REAL_HOMES_fax_number', true );
					$agent_args['agent_email']        = get_post_meta( $agent_args['agent_id'], 'REAL_HOMES_agent_email', true );

					/*
					 * Excerpt for agent is bit tricky as we have to get excerpt if available otherwise post contents
					 */
					$temp_agent_excerpt = get_post_field( 'post_excerpt', $agent_args['agent_id'] );
					if ( empty( $temp_agent_excerpt ) || is_wp_error( $temp_agent_excerpt ) ) {
						$agent_args['agent_excerpt'] = get_post_field( 'post_content', $agent_args['agent_id'] );
					} else {
						$agent_args['agent_excerpt'] = $temp_agent_excerpt;
					}

					$agent_args['agent_description'] = get_framework_custom_excerpt( $agent_args['agent_excerpt'], 20 );
					display_agent_box( $agent_args );
				}
			}
		}

	}

}
