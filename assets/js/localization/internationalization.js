/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

import * as German from '../locales/german.json';
import * as English from '../locales/english.json';
import Helper from "../helper/helper";

export default class Internationalization {
    static fallbackLocale = 'de';
    static locale = null;
    static locales = {
        "de": German,
        "en": English
    };

    static getFallbackLocale() {
        return Internationalization.fallbackLocale;
    }

    static getLocale() {
        if (Internationalization.locale === null) {
            if(Helper.hasQueryParameter("locale")) {
                let requestedLocale = Helper.getQueryParameter("locale");

                if (Internationalization.locales.hasOwnProperty(requestedLocale)) {
                    return requestedLocale;
                }
            }

            let browserLocale = navigator.language.substr(0, 2);

            if (Internationalization.locales.hasOwnProperty(browserLocale)) {
                return browserLocale;
            } else {
                return Internationalization.getFallbackLocale();
            }
        } else {
            return Internationalization.locale;
        }
    }

    static getMessages() {
        return Helper.forceJson(Internationalization.locales[Internationalization.getLocale()]);
    }

    static getMessage(messageId) {
        return messageId.split('.').reduce((o, i) => o[i], Internationalization.getMessages());
    }
}