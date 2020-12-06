/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

import Page from "./page";
import PageTemplate from "../../views/default.html";
import NotesTemplate from "../../views/content/notes.html";
import App from "../app";
import moment from "moment";

export default class Notes extends Page {

    static load() {
        this.validateSession().then(() => {
            Notes.render("Notes", PageTemplate, {
                "path": App.getRouter().getActiveRoute().getPath(),
                "title": App.getInternationalization().getMessage("defaultPage.menu.notes")
            });

            App.getServices().getNoteService().getNotes().then((data) => {
                App.displayLoadingScreen(false);

                moment.locale(App.getInternationalization().getLocale());

                let notes = [];

                for(let note of data.notes) {
                    notes.push({
                        title: note.title,
                        createdAt: moment(note.createdAt).fromNow()
                    });
                }

                Notes.renderContent(NotesTemplate, {
                    notes: notes
                });

            }).catch((errorMessage) => {
                App.displayLoadingScreen(false);
                App.displayErrorMessage(errorMessage);
            });

        });
    }
}