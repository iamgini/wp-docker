(function ($) {
    $(document).ready(function () {
        $('.mo-select-optin-type').on('click', function (e) {
            e.preventDefault();
            // remove all active tab class.
            $('.mo-select-optin-type').removeClass('mailoptin-type-active');
            $(this).addClass('mailoptin-type-active');
            // show spinner
            $('.mailoptin-new-toolbar i.fa-spinner').css('opacity', 1);

            var ajaxData = {
                action: 'mailoptin_optin_type_selection',
                nonce: mailoptin_globals.nonce,
                'optin-type': $(this).attr('data-optin-type').trim()
            };

            $.post(ajaxurl, ajaxData, function (response) {
                    if (typeof response === 'string') {
                        $('.mailoptin-optin-themes').replaceWith(response);
                    }
                    $('.mailoptin-new-toolbar i.fa-spinner').css('opacity', 0);
                }
            );

        });
    });
})(jQuery);