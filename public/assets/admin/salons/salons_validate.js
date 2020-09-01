$(document).ready(function() {
    $("#salons_form").validate({
        rules: {
            name: 'required',
            email: {
                required: true,
                pattern: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            },
            address: {
                required: true,
                maxlength: 100
            },
            city: 'required',
            state: 'required',
            country: 'required',
            postal_code: {
                required: true,
                digits: 6,
            },
            lat: {
                required: true,
                maxlength: 10,
                // currency: ['', false],
                number: true,
            },
            lng: {
                required: true,
                maxlength: 10,
                number: true,
            },
            open_at: {
                required: true,
                time: true
            },
            close_at: {
                required: true,
                time: true
            },
            lunch_from: {
                required: true,
                time: true
            },
            lunch_to: {
                required: true,
                time: true
            },
            logo: {
                required: false,
                accept: 'image/*',
            },
            banner: {
                required: false,
                accept: 'image/*',
            },
        },
        messages: {
            name: errors.name_required,
            email: {
                required: errors.email_required,
                pattern: errors.email_format,
                email: errors.email_format
            },
            address: {
                required: errors.address_required,
                maxlength: errors.address_maxlength,
            },
            city: errors.city_required,
            state: errors.state_required,
            country: errors.country_required,
            postal_code: {
                required: errors.postal_code_required,
                digits: errors.postal_code_digits
            },
            lat:{
                required: errors.lat_required,
                maxlength: errors.lng_format,
                number: errors.lat_format
            },
            lng: {
                required: errors.lng_required,
                maxlength: errors.lng_format,
                number: errors.lng_format
            },
            open_at: {
                required: errors.salon_opens_at_required,
                time: errors.salon_opens_at_format,
            },
            close_at: {
                required: errors.salon_close_at_required,
                time: errors.salon_close_at_format
            },
            lunch_from: {
                required: errors.salon_lunch_from_required,
                time: errors.salon_lunch_from_format
            },
            lunch_to: {
                required: errors.salon_lunch_to_required,
                time: errors.salon_lunch_to_format
            },
            logo: {
                accept: errors.image_format,
            },
            banner: {
                accept: errors.image_format,
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    $("#owner_details_form").validate({
        rules: {
            first_name: 'required',
            last_name: 'required',
            owner_email: {
                required: true,
                pattern: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            },
            owner_image: {
                required: false,
                // extension: 'jpg|jpeg|png',
                accept: 'image/*',
            },
            mobile: {
                required: true,
                number: true,
                minlength: 10
            },
            alt_mobile: {
                required: true,
                number: true,
                minlength: 10
            }
        },
        messages: {
            first_name: errors.first_name_required,
            last_name: errors.last_name_required,
            owner_email: {
                required: errors.email_required,
                pattern: errors.email_format,
            },
            owner_image: {
                required: errors.image_required,
                accept: errors.image_format,
            },
            mobile: {
                required: errors.mobile_no_required,
                number: errors.mobile_no_format,
                minlength: errors.mobile_no_length,
            },
            alt_mobile: {
                required: errors.alt_mobile_required,
                number: errors.mobile_no_format,
                minlength: errors.mobile_no_length,
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
