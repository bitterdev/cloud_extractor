/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

import Page from "./page";
import PageTemplate from "../../views/default.html";
import ReminderTemplate from "../../views/content/reminders.html";
import App from "../app";
import moment from "moment";

export default class Reminders extends Page {
    static load() {
        this.validateSession().then(() => {
            Reminders.render("Reminders", PageTemplate, {
                "path": App.getRouter().getActiveRoute().getPath(),
                "title": App.getInternationalization().getMessage("defaultPage.menu.reminders")
            });

            App.getServices().getReminderService().getReminders().then((data) => {
                App.displayLoadingScreen(false);

                moment.locale(App.getInternationalization().getLocale());

                let reminders = [];

                for(let reminder of data.reminders) {
                    // noinspection JSUnresolvedVariable
                    reminders.push({
                        title: reminder.title,
                        description: reminder.description,
                        dueAt: moment(reminder.dueDate).fromNow()
                    });
                }

                Reminders.renderContent(ReminderTemplate, {
                    reminders: reminders
                });

            }).catch((errorMessage) => {
                App.displayLoadingScreen(false);
                App.displayErrorMessage(errorMessage);
            });
        });
    }
}