/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

import Page from "./page";
import PageTemplate from '../../views/submit-code.html';
import $ from "jquery";
import App from "../app";

export default class SubmitCode extends Page {

    static lockForm() {
        $("form").addClass("loading");

        $(".form-control")
            .attr("disabled", "disabled")
            .attr("read-only", "read-only");
    }

    static unlockForm() {
        $("form").removeClass("loading");

        $(".form-control")
            .removeAttr("disabled")
            .removeAttr("read-only");
    }

    static reset() {
        $(".form-control").val("");
        $(".form-control[data-index='0']").focus();
    }

    static submit() {
        App.displayLoadingScreen(true);

        SubmitCode.lockForm();

        let code = '';

        for (let i = 0; i <= 5; i++) {
            code += $(".form-control[data-index='" + i + "']").val();
        }

        App.getServices().getAccountService().submitCode(code).then(() => {
            App.getServices().getAccountService().trustDevice().then(() => {
                App.getRouter().navigateTo("/calendar");
            }).catch((errorMessage) => {
                App.displayLoadingScreen(false);
                App.displayErrorMessage(errorMessage);
                SubmitCode.unlockForm();
                SubmitCode.reset();
            });
        }).catch((errorMessage) => {
            App.displayLoadingScreen(false);
            App.displayErrorMessage(errorMessage);
            SubmitCode.unlockForm();
            SubmitCode.reset();
        });
    }

    static load() {
        App.getServices().getAccountService().validateSession().then(() => {
            App.getRouter().navigateTo("/calendar");
        }).catch(() => {
            SubmitCode.render("Submit Code", PageTemplate);

            $(".form-control").bind("keyup",  (e) => {
                e.preventDefault();

                let $prev = $(".form-control[data-index='" + ($(e.currentTarget).data("index") - 1) + "']");
                let $next = $(".form-control[data-index='" + ($(e.currentTarget).data("index") + 1) + "']");
                let codeComplete = true;

                for (let i = 0; i <= 5; i++) {
                    if ($(".form-control[data-index='" + i + "']").val().length === 0) {
                        codeComplete = false;
                    }
                }

                if ($(e.currentTarget).val().length === 1) {
                    if (codeComplete) {
                        SubmitCode.submit();
                    } else {
                        if ($next.length) {
                            $next.focus();
                        }
                    }
                } else {
                    if ($prev.length) {
                        $prev.val("");
                        $prev.focus();
                    }
                }

                return false;
            });

            $("#backToLogin").bind("click", (e) => {
                e.preventDefault();

                App.getRouter().navigateTo("/login");

                return false;
            });

            SubmitCode.reset();

            App.displayLoadingScreen(false);
        });
    }
}