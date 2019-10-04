jQuery(document).ready(function ($) {
    "use strict";

    var $inspiry_plugin_cards = $(".inspiry-plugin-card-wrapper"),
        inspiryPlugins = $('.inspiry-plugins-content-wrap .plugin-action-buttons');

    /**
    * Plugin activate, deactivate and install ajax request
    */
    inspiryPlugins.on('click', '.button', function (event) {
        var $this = jQuery(this);
        if ($this.hasClass('activate-now') || $this.hasClass('deactivate-now')) {
            event.preventDefault();
            var $button_label = '',
                $add_button_class = '',
                $remove_button_class = '',
                $button_class = 'updating-message',
                data = {
                    action: 'inspiry_activate_deactivate_plugin',
                    rh_plugin: $this.data('plugin'),
                };

            if ($this.hasClass('activate-now')) {
                data.rh_action = 'rh-activate-plugin';
                $button_label = 'Deactivate';
                $add_button_class = 'button-primary deactivate-now';
                $remove_button_class = 'activate-now';
            }

            if ($this.hasClass('deactivate-now')) {
                data.rh_action = 'rh-deactivate-plugin';
                $button_label = 'Activate';
                $add_button_class = 'activate-now';
                $remove_button_class = 'button-primary deactivate-now';
            }

            data.rh_nonce = $this.data('nonce');

            $this.addClass($button_class);

            jQuery.get(ajaxurl, data, function (response) {
                if (response.error) {
                    console.log(response.error);
                } else {
                    $this.html($button_label).addClass($add_button_class).removeClass($remove_button_class);
                }
                $this.removeClass($button_class);
            }, 'json');
        }
    });

    /**
    * Script for plugin filters
    */
    $("#inspiry-plugin-filter").on('click', 'a', function (event) {
        var $this = $(this);
        var $filter = $this.data('filter');

        $('#inspiry-plugin-filter').find('a').removeClass('active');
        $this.addClass('active');
        $inspiry_plugin_cards.hide();
        $inspiry_plugin_cards.filter($filter).show();
        event.preventDefault();
    });

    /**
     * Feedback from ajax request
     */
    $("#inspiry-feedback-form").on('click', '.button', function (event) {
        event.preventDefault();

        var $response_msg = $("#inspiry-feedback-form-success"),
            $error_msg = $("#inspiry-feedback-form-error"),
            $email = $("#inspiry-feedback-form-email").val(),
            $feedback = $("#inspiry-feedback-form-textarea").val(),
            data = {
                action: 'inspiry_send_feedback',
                inspiry_feedback_form_nonce: $("#inspiry_feedback_form_nonce").val(),
            },
            clear = function () {
                setTimeout(function () {
                    $response_msg.html('');
                    $error_msg.html('');
                }, '3000');
            };

        $response_msg.html('');
        $error_msg.html('');

        if ( $email ) {
            data.inspiry_feedback_form_email = $email;

            if ($feedback) {
                data.inspiry_feedback_form_textarea = $feedback;
            } else {
                $error_msg.html('Please add your feedback before send.');
            }
        } else {
            $error_msg.html('Please provide a valid email address.');
        }

        if ($email && $feedback) {
            jQuery.post(ajaxurl, data, function (response) {
                if (response.success) {
                    document.getElementById("inspiry-feedback-form").reset();
                    $response_msg.html(response.message);
                } else {
                    $error_msg.html(response.message);
                }
                clear();
            }, 'json');
        }
    });
});