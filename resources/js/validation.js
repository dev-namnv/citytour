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

OptionMessage = {
    type: null,
    attribute: null,
    date: null,
    min: null,
    max: null,
    format: null,
    values: null,
    value: null,
    other: null
}

getMessageValidation = (rule, options = OptionMessage) => {
    let validation = LANG.validation[rule];

    if (options.type) {
       validation = LANG.validation[rule][options.type];
    }

    let message = validation;

    if (options.attribute !== null) {
        message = message.replace("{attribute}", LANG.validation.attributes[options.attribute]);
    }
    if (options.min !== null) {
        message = message.replace("{min}", options.min)
    }
    if (options.max !== null) {
        message = message.replace("{max}", options.max)
    }
    if (options.date !== null) {
        message = message.replace("{date}", options.date)
    }
    if (options.format !== null) {
        message = message.replace("{format}", options.format)
    }
    if (options.values !== null) {
        message = message.replace("{values}", options.values)
    }
    if (options.value !== null) {
        message = message.replace("{value}", options.value)
    }
    if (options.other !== null) {
        message = message.replace("{other}", options.other)
    }

    return message;
}

