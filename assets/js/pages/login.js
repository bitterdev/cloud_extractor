/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

import Page from "./page";
import PageTemplate from '../../views/login.html';
import $ from 'jquery';
import App from "../app";

export default class Login extends Page {

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
        $(".password .form-control").val("");
    }

    static submit() {
        App.displayLoadingScreen(true);

        let email = $(".email .form-control").val();
        let password = $(".password .form-control").val();

        if (email.length && password.length) {
            Login.lockForm();

            App.getServices().getAccountService().login(email, password).then(() => {
                App.getServices().getAccountService().checkMultiFactorAuthentication().then((data) => {
                    data = data || {};
                    data.requires2FA = data.requires2FA || {};

                    if (data.requires2FA) {
                        App.getRouter().navigateTo("/submit-code");
                    } else {
                        App.getServices().getAccountService().trustDevice().then(() => {
                            App.getRouter().navigateTo("/calendar");
                        }).catch((errorMessage) => {
                            App.displayLoadingScreen(false);
                            App.displayErrorMessage(errorMessage);
                            Login.unlockForm();
                            Login.reset();
                        });
                    }
                }).catch((errorMessage) => {
                    App.displayLoadingScreen(false);
                    App.displayErrorMessage(errorMessage);
                    Login.unlockForm();
                    Login.reset();
                });
            }).catch((errorMessage) => {
                App.displayLoadingScreen(false);
                App.displayErrorMessage(errorMessage);
                Login.unlockForm();
                Login.reset();
            });
        }
    }

    static load() {
        App.getServices().getAccountService().validateSession().then(() => {
            App.displayLoadingScreen(false);
            App.getRouter().navigateTo("/calendar");
        }).catch(() => {
            Login.render("Login", PageTemplate);

            $(".form-control")
                .on("keypress keyup keydown focus", (e) => {
                    if (e.which === 13) {
                        e.preventDefault();
                        Login.submit();
                        return false;
                    } else {
                        $(".form-control-wrapper").removeClass("active");

                        if ($(".email .form-control").val().length > 0) {
                            $(e.currentTarget).parent().parent().addClass("active");
                            $("form").addClass("password-visible");
                        } else {
                            $("form").removeClass("password-visible");
                        }
                    }

                });

            $(".form-control-wrapper.password")
                .on("mouseup", () => {
                    Login.submit();
                });

            $(".email .form-control").focus();

            App.displayLoadingScreen(false);
        });
    }
}