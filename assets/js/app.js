/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

import Router from "./router/router";
import Route from "./router/route";
import Login from "./pages/login";
import SubmitCode from "./pages/submit-code";
import Contacts from "./pages/contacts";
import Calendar from "./pages/calendar";
import Drive from "./pages/drive";
import FindMe from "./pages/find-me";
import Mails from "./pages/mails";
import Notes from "./pages/notes";
import Photos from "./pages/photos";
import Reminders from "./pages/reminders";
import Home from "./pages/home";
import Services from "./icloud/services";
import Internationalization from "./localization/internationalization";
import $ from 'jquery';

import L from 'leaflet';
L.Icon.Default.mergeOptions({
    iconRetinaUrl: require('../../node_modules/leaflet/dist/images/marker-icon-2x.png'),
    iconUrl: require('../../node_modules/leaflet/dist/images/marker-icon.png'),
    shadowUrl: require('../../node_modules/leaflet/dist/images/marker-shadow.png'),
});

/* Import main css code */
import '../css/app.less';

export default class App {

    static getRouter() {
        return Router;
    }

    static getServices() {
        return Services;
    }

    static getInternationalization() {
        return Internationalization;
    }

    static displayErrorMessage(errorMessage) {
        alert(errorMessage);
    }

    static confirm(text) {
        return new Promise((resolve, reject) => {
            if (confirm(text)) {
                resolve();
            } else {
                reject();
            }
        });
    }

    static displayLoadingScreen(isVisible) {
        if (isVisible) {
            $("#page-wrapper").addClass("loading");
            $("#loading-screen").removeClass("hidden");
        } else {
            $("#page-wrapper").removeClass("loading");
            $("#loading-screen").addClass("hidden");
        }
    }

    static bootstrap() {
        // Define the routes
        App.getRouter().addRoute(new Route("/", Home));
        App.getRouter().addRoute(new Route("/login", Login));
        App.getRouter().addRoute(new Route("/submit-code", SubmitCode));
        App.getRouter().addRoute(new Route("/calendar", Calendar));
        App.getRouter().addRoute(new Route("/contacts", Contacts));
        App.getRouter().addRoute(new Route("/drive", Drive));
        App.getRouter().addRoute(new Route("/find-me", FindMe));
        App.getRouter().addRoute(new Route("/mails", Mails));
        App.getRouter().addRoute(new Route("/notes", Notes));
        App.getRouter().addRoute(new Route("/photos", Photos));
        App.getRouter().addRoute(new Route("/reminders", Reminders));

        // Let's go...
        App.getRouter().init();
    }

}

App.bootstrap();