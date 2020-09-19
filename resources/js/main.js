/* Import libraries */
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

// Main js
Main = {
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
            invalidClass: 'is-invalid',
            validClass: 'is-valid'
        })
    },

    // Logout global
    logoutGlobal: () => {
        $('.form-logout').submit()
    },

    forgotPasswordValidate: () => {
        $('.form-forgot-password').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            invalidClass: 'is-invalid',
            validClass: 'is-valid'
        })
    }
}

// Run function
$(window).on('load', () => {
    Main.loginValidate()
    Main.forgotPasswordValidate()
})
