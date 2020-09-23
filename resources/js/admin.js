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
                }
            }
        })
    }
}

// Run onload
$(window).on('load', function () {
    Admin.loginValidate()
    Admin.forgotPasswordValidate()
    Admin.tourCreateValidate()
})
