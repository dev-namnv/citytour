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
    storeServiceValidate: () => {
        $('.form-service-create').validate({
            ignore: [],
            rules: {
                name: {
                    required: true,
                    minlength: 20,
                    maxlength: 255,
                    regex: "/^[a-zA-Z0-9_&.-]*$/"
                },
                slug: {
                    minlength: 20,
                    maxlength: 255,
                    regex: "/^[a-zA-Z0-9_&.-]*$/"
                },
                address: {
                    required: true,
                    minlength: 20,
                    maxLength: 255
                },
                description: {
                    required: function () {
                        CKEDITOR.instances.service_desc_editor.updateElement();
                    },
                    minlength: 50
                },
                content: {
                    required: function () {
                        CKEDITOR.instances.service_content_editor.updateElement();
                    },
                    minlength: 50
                }
            },
            messages: {
                name: {
                    required: getMessageValidation('required', {attribute: 'name'}),
                    minlength: getMessageValidation('min', {attribute: 'name', type: 'string', min: 20}),
                    maxlength: getMessageValidation('min', {attribute: 'name', type: 'string', min: 255}),
                    regex: getMessageValidation('regex', {attribute: 'name'}),
                },
                slug: {
                    minlength: getMessageValidation('min', {attribute: 'slug', type: 'string', min: 20}),
                    maxlength: getMessageValidation('min', {attribute: 'slug', type: 'string', min: 255}),
                    regex: getMessageValidation('regex', {attribute: 'slug'}),
                },
                address: {
                    required: getMessageValidation('required', {attribute: 'address'}),
                    minlength: getMessageValidation('min', {attribute: 'address', type: 'string', min: 20}),
                },
                description: {
                    required: getMessageValidation('required', {attribute: 'description'}),
                    minlength: getMessageValidation('min', {attribute: 'description', type: 'string', min: 50}),
                },
                content: {
                    required: getMessageValidation('required', {attribute: 'content'}),
                    minlength: getMessageValidation('min', {attribute: 'content', type: 'string', min: 50}),
                }
            },
            errorClass: 'is-invalid text-danger',
            validClass: 'is-valid',
            errorElement: 'span',
            pendingClass: 'div'
        })
    }
}

// Run onload
$(window).on('load', function () {
    Admin.loginValidate()
    Admin.forgotPasswordValidate()
    Admin.storeServiceValidate()
})
