/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

import Page from "./page";
import App from "../app";
import PageTemplate from "../../views/default.html";
import $ from 'jquery';
import 'fullcalendar';

export default class Calendar extends Page {

    static resizeCalendar() {
        let isMobile = $(window).width() < 600;

        if (isMobile) {
            $('#content').fullCalendar('changeView', 'listWeek');
        } else {
            $('#content').fullCalendar('changeView', 'month');
        }
    }

    static load() {
        this.validateSession().then(() => {
            Calendar.render("Calendar", PageTemplate, {
                "path": App.getRouter().getActiveRoute().getPath(),
                "title": App.getInternationalization().getMessage("defaultPage.menu.calendar")
            });

            $("#content").fullCalendar({
                header: {
                    left: 'prev,next',
                    center: 'title',
                    right: ''
                },
                height: () => {
                    return $(window).height() - 50 - 15;
                },
                locale: App.getInternationalization().getLocale(),
                navLinks: true,
                eventLimit: true,
                startDate: 'today',
                events: (start, end, timezone, callback) => {
                    App.displayLoadingScreen(true);

                    App.getServices().getCalendarService().getAll(start, end).then((data) => {
                        App.displayLoadingScreen(false);
                        callback(data.events);
                    }).catch((errorMessage) => {
                        App.displayLoadingScreen(false);
                        App.displayErrorMessage(errorMessage);
                        callback([]);
                    });
                }
            });

            Calendar.resizeCalendar();

            $(window).bind("resize", () => {
                Calendar.resizeCalendar();
            });

            App.displayLoadingScreen(false);
        });
    }
}