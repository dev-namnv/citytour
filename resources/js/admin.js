/* Import libraries */
require('./bootstrap')
require('./toastr')
// require('./google-map')
window.PerfectScrollbar = require('perfect-scrollbar/dist/perfect-scrollbar.min')

// require('highlight.js/lib/highlight')
require('file-upload-with-preview/dist/file-upload-with-preview.min')
require('jquery-blockui/jquery.blockUI')
require('./validation')

/*
Code
 */

Admin = {
    // Validate form login
    loginValidate: () => {
        $('.form-login').validate({
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                username: {
                    required: getMessageValidation('required', {attribute: 'username'})
                },
                password: {
                    required: getMessageValidation('required', {attribute: 'password'})
                }
            },
            errorElement: 'span',
            errorClass: 'is-invalid invalid-feedback',
            validClass: 'is-valid'
        })
    },

    // Logout global
    logoutGlobal: () => {
        $('.form-logout').submit()
    },

    // Forgot password validate
    forgotPasswordValidate: () => {
        $('.form-forgot-password').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: {
                    required: getMessageValidation('required', {attribute: 'email'}),
                    email: getMessageValidation('email', {attribute: 'email'})
                }
            },
            errorElement: 'span',
            errorClass: 'is-invalid invalid-feedback',
            validClass: 'is-valid'
        })
    },

    // Validate create tour
    tourCreateValidate: () => {
        $('.form-service-create').validate({
            rules: {
                name: {
                    required: true,
                    minLength: 20,
                    maxLength: 255,
                    regex: /^[a-zA-Z0-9_\s&.-]*$/
                },
                slug: {
                    minLength: 20,
                    regex: /^[a-zA-Z0-9_.-]*$/
                },
                address: {
                    required: true,
                    regex: /^[a-zA-Z0-9_.-]*$/
                }
            },
            messages: {
                name: {
                    required: getMessageValidation('required', {attribute: 'name'}),
                    minLength: getMessageValidation('min', {attribute: 'name', min: 20, type: 'string'}),
                    maxLength: getMessageValidation('max', {attribute: 'name', max: 255, type: 'string'}),
                    regex: getMessageValidation('regex', {attribute: 'name'})
                },
                slug: {
                    minLength: getMessageValidation('min', {attribute: 'slug', min: 20, type: 'string'})
                }
            },
        })
    },

    /**
     * Tour action
     * All tour action
     */
    tourSetActive: (e) => {
        const tour_id = $(e).attr('tour-id')

        axios.put('/api/manager/tour/set-active', {tour_id: tour_id})
            .then(({data}) => {
                const tourClass = $(`.tour-status-${data.id}`)
                Toastr.show(data)
                if (data.active) {
                    $(e).text('Khóa dịch vụ')
                    tourClass.text('Đang mở')
                    tourClass.removeClass('badge-danger')
                    tourClass.addClass('badge-primary')
                } else {
                    $(e).text('Mở dịch vụ ')
                    tourClass.text('Ẩn')
                    tourClass.removeClass('badge-primary')
                    tourClass.addClass('badge-danger')
                }
            })
            .catch(err => console.log(err))
    },

    formContactValidate: () => {
        $('.form-contact').validate({
            rules: {
                subject: {
                    required: true,
                    minlength:10,
                    maxlength:255,
                },
                messages: {
                    required: true,
                    minlength: 20,
                },
            },
            messages: {
                subject: {
                    required: getMessageValidation('required', {attribute: 'subject'}),
                },
                messages: {
                    required: getMessageValidation('required', {attribute: 'message'}),
                },
            },
            invalidClass: 'is-invalid',
            validClass: 'is-valid'
        })
    }

}

// Run onload
$(window).on('load', function () {
    Admin.loginValidate()
    Admin.forgotPasswordValidate()
    Admin.formContactValidate()
    Admin.tourCreateValidate()
})
