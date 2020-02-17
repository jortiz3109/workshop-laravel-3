import * as rules from "vee-validate/dist/rules";
import { extend , localize } from "vee-validate";
import en from "vee-validate/dist/locale/en.json";
import es from "vee-validate/dist/locale/es.json";

let locales = {es, en};

function loadLocale(code) {
    let locale = {
        code: locales[code].code,
        messages: locales[code].messages,
        names: window.App.translations.names
    };

    localize(code, locale);
}

loadLocale(window.App.locale);

Object.keys(rules).forEach(rule => {
    extend(rule, rules[rule]);
});
