/*
Require library
 */
require('./bootstrap')
window.PerfectScrollbar = require('perfect-scrollbar/dist/perfect-scrollbar.min')

// require('highlight.js/lib/highlight')
require('file-upload-with-preview/dist/file-upload-with-preview.min')
require('jquery-blockui/jquery.blockUI')

VueI18n = require('./vue-i18n-locales.generated');
locale = document.getElementsByTagName("html")[0].getAttribute("lang");

// Set lang js auto
LANG = VueI18n.default[locale]

// jQuery validate with Vietnamese
if (locale === 'vi') {
    require('jquery-validation/dist/localization/messages_vi.min')
} else {
    require('jquery-validation')
}

/*
Code
 */

Admin = {
    // Validate form login
    loginValidate: () => {
        $('.form-login').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
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
    }
}

// Run onload
$(window).on('load', function () {
    Admin.loginValidate()
})
