/* Import libraries */
require('./bootstrap')
require('./toastr')
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

    // Article Store Validate
    storeArticleValidate: () => {
        $('.form-article-create').validate({
            rules: {
                title: {
                    required: true,
                    maxlength: 60,
                    minlength: 5
                },
                image: {
                    required: true,
                },
                heading: {
                    required: true,
                    minlength: 5
                },
                content: {
                    required: true,
                    minlength: 5
                }
            },
            messages: {
                title: {
                    required: getMessageValidation('required', {attribute: 'title'}),
                    // minlength: getMessageValidation('required', {attribute: 'title'}),
                },
                image: {
                    required: getMessageValidation('required', {attribute: 'image'})
                },
                heading: {
                    required: getMessageValidation('required', {attribute: 'heading'})
                },
                content: {
                    required: getMessageValidation('required', {attribute: 'content'})
                }
            },
            errorClass: 'is-invalid invalid-feedback',
            validClass: 'is-valid',
            errorElement: 'span',
        })
    }


}

// Run onload
$(window).on('load', function () {
    Admin.loginValidate()
    Admin.forgotPasswordValidate()
    Admin.storeArticleValidate()
})
