jQuery( document ).ready( function() {

    jQuery( ".customize-control .th-responsive-switches button" ).on( "click", function () {
        var _this               = jQuery(this),
            switches            = jQuery( ".th-responsive-switches" ),
            device              = _this.data("device"),
            control             = jQuery( ".customize-control.th-has-switches" ),
            wp_overlay          = jQuery( ".wp-full-overlay" ),
            wp_overlay_devices  = jQuery( ".wp-full-overlay-footer .devices" );

        switches.find("button").removeClass("active");
        switches.find("button.preview-" + device ).addClass("active");
        control.find(".th-control-wrap").removeClass("active");
        control.find(".th-control-wrap." + device ).addClass("active");
        wp_overlay.removeClass("preview-desktop preview-tablet preview-mobile").addClass("preview-" + device);
        wp_overlay_devices.find("button").removeClass("active").attr("aria-pressed", !1);
        wp_overlay_devices.find("button.preview-" + device).addClass("active").attr("aria-pressed", !0);
    });

    jQuery(".wp-full-overlay-footer .devices button").on("click", function() {
        var _this       = jQuery(this),
            switches    = jQuery( ".customize-control.th-has-switches .th-responsive-switches" ),
            device      = _this.data("device"),
            control     = jQuery( ".customize-control.th-has-switches" );

        switches.find("button").removeClass("active");
        switches.find("button.preview-" + device).addClass("active");
        control.find(".th-control-wrap").removeClass("active");
        control.find(".th-control-wrap." + device).addClass("active");
    });

} );