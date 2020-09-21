VueI18n = require('./vue-i18n-locales.generated');
locale = document.getElementsByTagName("html")[0].getAttribute("lang");

// Set lang js auto
LANG = VueI18n.default[locale]

// jQuery validate with Vietnamese
if (locale === 'vi') {
    require('jquery-validation/dist/localization/messages_vi.min')
} else if (locale === 'ja') {
    require('jquery-validation/dist/localization/messages_ja.min')
} else {
    require('jquery-validation')
}

getMessageValidation = (rule, options = {
    attribute: null,
    date: null,
    min: null,
    max: null,
    format: null,
    values: null,
    value: null,
    other: null
}) => {
    const validation = LANG.validation[rule];
    let message;

    if (options.attribute) {
        if (LANG.validation.attributes[options.attribute] === undefined) {
            message = validation.replace("{attribute}", options.attribute);
        } else {
            message = validation.replace("{attribute}", LANG.validation.attributes[options.attribute]);
        }
    }
    if (options.date) {
        message = validation.replace("{date}", options.date)
    }
    if (options.min) {
        message = validation.replace("{min}", options.min)
    }
    if (options.max) {
        message = validation.replace("{max}", options.max)
    }
    if (options.format) {
        message = validation.replace("{format}", options.format)
    }
    if (options.values) {
        message = validation.replace("{values}", options.values)
    }
    if (options.value) {
        message = validation.replace("{value}", options.value)
    }
    if (options.other) {
        message = validation.replace("{other}", options.other)
    }

    return message;
}

