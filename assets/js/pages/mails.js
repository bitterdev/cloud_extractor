/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

import Page from "./page";
import PageTemplate from "../../views/default.html";
import App from "../app";
import Helper from "../helper/helper";
import MailsTemplate from "../../views/content/mails.html";
import $ from "jquery";
import moment from "moment";

export default class Mails extends Page {
    static folders = [];
    static currentGuid = '';
    static currentPage = 0;

    static displayMessage(guid) {
        alert(guid);
    }

    static displayFolder(guid) {
        if (typeof guid === "undefined") {
            guid = Helper.getFirstItemInObject(Mails.folders).guid; // use the first folder
        }

        Mails.currentGuid = guid;
        Mails.currentPage = 0;

        Mails.displayMessages();
    }

    static displayMessages() {
        App.displayLoadingScreen(true);

        App.getServices().getMailService().getMessages(Mails.currentGuid, Mails.currentPage, 50).then((data) => {
            App.displayLoadingScreen(false);

            let messages = [];

            for(let message of data.messages) {
                message.sentDate = moment(message.sentDate).format('LLLL');
                messages.push(message);
            }

            Mails.renderContent(MailsTemplate, {
                currentGuid: Mails.currentGuid,
                currentPage: Mails.currentPage,
                folders: Mails.folders,
                hasPrevPage: Mails.hasPrevPage(),
                messages: messages
            });

            $(".mail-folders-list-item").bind("click", (e) => {
                e.preventDefault();

                let guid = $(e.target).data("guid");

                Mails.displayFolder(guid);

                return false;
            });

            $(".mobile-mail-folders-list").bind("change", (e) => {
                e.preventDefault();

                let guid = $(e.target).val();

                Mails.displayFolder(guid);

                return false;
            });

            $(".mail-prev-page").bind("click", (e) => {
                e.preventDefault();

                Mails.getPrevPage();

                return false;
            });

            $(".mail-next-page").bind("click", (e) => {
                e.preventDefault();

                Mails.getNextPage();

                return false;
            });

            $(".mail-messages-item").bind("click", (e) => {
                e.preventDefault();

                let guid = $(e.target).data("guid");

                Mails.displayMessage(guid);

                return false;
            });

        }).catch((errorMessage) => {
            App.displayLoadingScreen(false);
            App.displayErrorMessage(errorMessage);
        });
    }

    static hasPrevPage() {
        return (Mails.currentPage > 0);
    }

    static getPrevPage() {
        if (Mails.hasPrevPage()) {
            Mails.currentPage--;
            Mails.displayMessages();
        }
    }

    static getNextPage() {
        Mails.currentPage++;
        Mails.displayMessages();
    }

    static load() {
        this.validateSession().then(() => {
            moment.locale(App.getInternationalization().getLocale());

            Mails.render("Mails", PageTemplate, {
                "path": App.getRouter().getActiveRoute().getPath(),
                "title": App.getInternationalization().getMessage("defaultPage.menu.mails")
            });

            App.getServices().getMailService().getFolders().then((data) => {
                App.displayLoadingScreen(false);

                Mails.folders = data.folders;

                Mails.displayFolder();

            }).catch((errorMessage) => {
                App.displayLoadingScreen(false);
                App.displayErrorMessage(errorMessage);
            });

            App.displayLoadingScreen(false);
        });
    }
}