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
                },
                tags: {
                    required: true
                },

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
                },
                tags: {
                    required: getMessageValidation('required', {attribute: 'tags'}),
                },

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
                },
                tags: {
                    required: true
                },
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
                },
                tags: {
                    required: getMessageValidation('required', {attribute: 'tags'}),
                },
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

    /**
     * Tour action
     * All tour action
     */
    tourConfirmActive: (e) => {
        const tour_id = $(e).attr('tour-id')

        axios.put('/api/manager/tour/set-active', {tour_id: tour_id})
            .then(({data}) => {
                const tourClass = $(`.tour-status-${data.id}`)
                Toastr.show(data)
                if (data.active) {
                    $(e).text('Private')
                    tourClass.html('<div class="t-dot bg-success" data-toggle="tooltip" data-placement="top" data-original-title="Public"></div>')
                } else {
                    $(e).text('Public')
                    tourClass.html('<div class="t-dot bg-default" data-toggle="tooltip" data-placement="top" data-original-title="Private"></div>')
                }
            })
            .catch(err => console.log(err))
    },

}

// Run onload
$(window).on('load', function () {
    Admin.loginValidate()
    Admin.forgotPasswordValidate()
    Admin.tourCreateValidate()
    Admin.storeArticleValidate()
    Admin.updateArticleValidate()
    Admin.storeArticleCategoryValidate()
})
