jQuery(document).ready(function () {
    jQuery('.lunar-search-button').click(function (e) {
        e.preventDefault();
        let wp_nonce = jQuery('input[name="_wpnonce"]');
        let data = {
            _wp_nonce: wp_nonce.val(),
            action: 'lvn_find_month',
            lunar_month: jQuery('.search-month').val(),
            lunar_year: jQuery('.search-year').val()
        };
        jQuery.ajax({
            type: 'POST',
            url: lvn_data.ajax_url,
            data: data,
            dataType: 'json',
            success: function (data) {
                switch (data.code) {
                    case 200:
                        jQuery('.lunar-widget .month').html(jQuery.parseHTML(data.content)[0].data);
                        wp_nonce.val(data._wp_nonce);
                        lunar_next_prev_month();
                        break;
                    case 404:
                    case 401:
                        alert(data.message);
                        break;
                    default:
                        alert('Có lỗi xảy ra. Vui lòng thử lại');
                }
            }
        })

    });
    lunar_next_prev_month();
    lunar_next_prev_day();

    /*Datepicker for input search date*/
    let lunar_find_day = jQuery('.lunar-find-day');
    lunar_find_day.datepicker(
        {
            nextText: '',
            prevText: '',
            dateFormat: 'dd-mm-yy'
        }
    );

    /* Onchange input choose lunar date */
    lunar_find_day.on('change', function (e) {
        let wp_nonce = jQuery('.lunar-widget input[name="_wpnonce"]');
        let data = {
            _wp_nonce: wp_nonce.val(),
            action: 'lvn_find_day',
            lunar_date: jQuery(this).val(),
            type: 'onchange'
        };
        lunar_send_ajax_find_day(lvn_data.ajax_url, data, jQuery(this));
    });
});

/* Next month in widget */
function lunar_next_prev_month() {
    jQuery('.month .navi-right .lunar-next,.month .navi-left .lunar-prev').click(function (e) {
        let lunar_month = jQuery(this).data('month');
        let lunar_year = jQuery(this).data('year');
        let wp_nonce = jQuery('.lunar-widget input[name="_wpnonce"]');
        let data = {
            _wp_nonce: wp_nonce.val(),
            action: 'lvn_find_month',
            lunar_month: lunar_month,
            lunar_year: lunar_year
        };
        jQuery.ajax({
            type: 'POST',
            url: lvn_data.ajax_url,
            data: data,
            dataType: 'json',
            success: function (data) {
                switch (data.code) {
                    case 200:
                        jQuery('.lunar-widget .month').html(jQuery.parseHTML(data.content)[0].data);
                        jQuery('.search-month').val(lunar_month);
                        jQuery('.search-year').val(lunar_year);
                        wp_nonce.val(data._wp_nonce);
                        lunar_next_prev_month();
                        break;
                    case 404:
                    case 401:
                        alert(data.message);
                        break;
                    default:
                        alert('Có lỗi xảy ra. Vui lòng thử lại');
                }
            }
        })
    })
}

/* Next day in widget */
function lunar_next_prev_day() {
    jQuery('.calendar-day .lunar-next,.calendar-day .lunar-prev').click(function () {
        let type = 'next';
        if (jQuery(this).hasClass('lunar-next')) {
            type = 'next';
        } else {
            type = 'prev';
        }
        let lunar_date = jQuery('.calendar-day .lunar-find-day');
        let wp_nonce = jQuery('.lunar-widget input[name="_wpnonce"]');
        let data = {
            _wp_nonce: wp_nonce.val(),
            action: 'lvn_find_day',
            lunar_date: lunar_date.val(),
            lunar_type: type
        };
        lunar_send_ajax_find_day(lvn_data.ajax_url, data, lunar_date);
    })
}

/* Send ajax find day */
function lunar_send_ajax_find_day(url, data, lunar_date) {
    jQuery.ajax({
        type: 'POST',
        url: url,
        data: data,
        dataType: 'json',
        success: function (data) {
            switch (data.code) {
                case 200:
                    jQuery('.calendar-day .day-content').html(jQuery.parseHTML(data.content)[0].data);
                    lunar_date.val(data.new_date);
                    break;
                case 404:
                case 401:
                    alert(data.message);
                    break;
                default:
                    alert('Có lỗi xảy ra. Vui lòng thử lại');
            }
        }
    })
}