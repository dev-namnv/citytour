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
            ignore: [],
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
                    required: function () {
                        CKEDITOR.instances.articles_content_editor.updateElement();
                    },
                    minlength: 5
                }
            },
            messages: {
                title: {
                    required: getMessageValidation('required', {attribute: 'title'}),
                    minlength: getMessageValidation('min', {attribute: 'title', type: 'string', min: 5}),
                },
                image: {
                    required: getMessageValidation('required', {attribute: 'image'})
                },
                heading: {
                    required: getMessageValidation('required', {attribute: 'heading'}),
                    minlength: getMessageValidation('min', {attribute: 'heading', type: 'string', min: 5}),
                },
                content: {
                    required: getMessageValidation('required', {attribute: 'content'}),
                    minlength: getMessageValidation('min', {attribute: 'content', type: 'string', min: 5}),
                }
            },
            errorClass: 'is-invalid invalid-feedback',
            validClass: 'is-valid',
            errorElement: 'span',
        })
    },

    // Article Update Validate
    updateArticleValidate: () => {
        $('.form-article-edit').validate({
            ignore: [],
            rules: {
                title: {
                    required: true,
                    maxlength: 60,
                    minlength: 5
                },
                heading: {
                    required: true,
                    minlength: 5
                },
                content: {
                    required: function () {
                        CKEDITOR.instances.articles_content_editor.updateElement();
                    },
                    minlength: 5
                }
            },
            messages: {
                title: {
                    required: getMessageValidation('required', {attribute: 'title'}),
                    minlength: getMessageValidation('min', {attribute: 'title', type: 'string', min: 5}),
                    maxLength: getMessageValidation('max', {attribute: 'title', type: 'string', max: 5}),
                },
                heading: {
                    required: getMessageValidation('required', {attribute: 'heading'}),
                    minlength: getMessageValidation('min', {attribute: 'heading', type: 'string', min: 5}),
                },
                content: {
                    required: getMessageValidation('required', {attribute: 'content'}),
                    minlength: getMessageValidation('min', {attribute: 'content', type: 'string', min: 5}),
                }
            },
            errorClass: 'is-invalid invalid-feedback',
            validClass: 'is-valid',
            errorElement: 'span',
        })
    },

    // Article Category Store Validate
    storeArticleCategoryValidate: () => {
        $('.form-create-article-category').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 5,
                    maxlength: 60
                }
            },
            message: {
                name: {
                    required: getMessageValidation('required', {attribute: 'name'}),
                    minlength: getMessageValidation('min', {attribute: 'name', type: 'string', min: 5}),
                    maxLength: getMessageValidation('max', {attribute: 'name', type: 'string', max: 5}),
                }
            },
            errorClass: 'is-invalid invalid-feedback',
            validClass: 'is-valid',
            errorElement: 'span',
        })
    },


}

// Run onload
$(window).on('load', function () {
    Admin.loginValidate()
    Admin.forgotPasswordValidate()
    Admin.storeArticleValidate()
    Admin.updateArticleValidate()
    Admin.storeArticleCategoryValidate()
})
