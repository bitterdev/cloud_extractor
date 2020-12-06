/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

import Internationalization from "../localization/internationalization";
import _ from "underscore";
import $ from "jquery";
import App from "../app";
import Helper from "../helper/helper";

export default class Page {
    static validateSession() {
        return new Promise((resolve) => {
            App.getServices().getAccountService().validateSession().then(() => {
                resolve();
            }).catch(() => {
                App.getRouter().navigateTo("/login");
            });
        });
    }

    static load() {
        App.displayLoadingScreen(false);
    }

    static renderContent(templateHtml, templateSettings) {
        let template = _.template(templateHtml);
        let baseTemplateSettings = {
            i18n: Internationalization.getMessages()
        };

        let combinedTemplateSettings = {...baseTemplateSettings, ...templateSettings};
        let generatedHtml = template(combinedTemplateSettings);

        $("#content").html(generatedHtml);

        // scroll to top
        $(window).scrollTop(0);
    }

    static render(title, templateHtml, templateSettings) {
        $(window).unbind("resize");

        let template = _.template(templateHtml);
        let baseTemplateSettings = {
            i18n: Internationalization.getMessages()
        };

        let combinedTemplateSettings = {...baseTemplateSettings, ...templateSettings};
        let generatedHtml = template(combinedTemplateSettings);

        $("#page-wrapper").html(generatedHtml);

        $("main").attr("class", Helper.slugify(title) + "-page");

        // Bind routing event handlers
        $("a.navigate-to").bind("click", (e) => {
            e.preventDefault();

            App.getRouter().navigateTo($(e.currentTarget).data("path"));

            return false;
        });

        // Bind the sign out event handler
        $("#sign-out").bind("click", (e) => {
            e.preventDefault();

            App.confirm(App.getInternationalization().getMessage("confirm.message")).then(() => {
                App.displayLoadingScreen(true);

                App.getServices().getAccountService().logout().then(() => {
                    App.getRouter().navigateTo("/login");
                }).catch((errorMessage) => {
                    App.displayLoadingScreen(false);
                    App.displayErrorMessage(errorMessage);
                    App.getRouter().navigateTo("/login");
                })
            }).catch(() => {
                // Do Nothing
            });

            return false;
        });

        // Bind the switch language link
        $(".switch-language-link").bind("click", (e) => {
            e.preventDefault();

            window.location.search = Helper.buildQueryString({
                "locale": $(e.currentTarget).data("locale")
            });

            return false;
        });

        // scroll to top
        $(window).scrollTop(0);
    }
}