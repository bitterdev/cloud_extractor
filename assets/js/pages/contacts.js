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
import ContactsTemplate from "../../views/content/contacts.html";
import $ from 'jquery';
import moment from "moment";

export default class Contacts extends Page {
    static contacts = [];

    static renderContact(contactId) {
        if (typeof contactId === "undefined") {
            contactId = Helper.getFirstItemInObject(Contacts.contacts).contactId; // use the first contact
        }

        $(".contact-details-item, .contact-list-item").each((e, item) => {
            $(item).removeClass("active");

            if ($(item).data("contactId") === contactId) {
                $(item).addClass("active");
            }
        });
    }

    static load() {
        this.validateSession().then(() => {
            Contacts.render("Contacts", PageTemplate, {
                "path": App.getRouter().getActiveRoute().getPath(),
                "title": App.getInternationalization().getMessage("defaultPage.menu.contacts")
            });

            App.getServices().getContactService().getContacts().then((data) => {
                App.displayLoadingScreen(false);

                moment.locale(App.getInternationalization().getLocale());

                Contacts.contacts = [];

                for(let contact of data.contacts) {
                    contact.birthday = moment(contact.birthday).format('LL');
                    Contacts.contacts.push(contact);
                }

                // sort contacts alphabetically
                Contacts.contacts.sort((a, b) => {
                    let textA = a.displayName.toUpperCase();
                    let textB = b.displayName.toUpperCase();
                    return (textA < textB) ? -1 : (textA > textB) ? 1 : 0;
                });

                // render the content
                Contacts.renderContent(ContactsTemplate, {
                    contacts: Contacts.contacts
                });

                // display the first contact
                Contacts.renderContact();

                // bind event handlers
                $(".contact-list-item").bind("click", (e) => {
                    e.preventDefault();

                    let contactId = $(e.target).data("contactId");

                    Contacts.renderContact(contactId);

                    return false;
                });

                $(".mobile-contact-list").bind("change", (e) => {
                    e.preventDefault();

                    let contactId = $(e.target).val();

                    Contacts.renderContact(contactId);

                    return false;
                });

            }).catch((errorMessage) => {
                App.displayLoadingScreen(false);
                App.displayErrorMessage(errorMessage);
            });
        });
    }
}