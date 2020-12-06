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
import L from "leaflet";
import $ from "jquery";

export default class FindMe extends Page {
    static load() {
        this.validateSession().then(() => {
            FindMe.render("Find Me", PageTemplate, {
                "path": App.getRouter().getActiveRoute().getPath(),
                "title": App.getInternationalization().getMessage("defaultPage.menu.findMe")
            });

            let $map = $("<div></div>").attr("id", "map");

            $("#content").html("").append($map);

            let map = L.map("map");
            let points = [];

            App.getServices().getFindMeService().getLocations().then((data) => {

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: App.getInternationalization().getMessage("map.copyright")
                }).addTo(map);

                for (let location of data.locations) {
                    let point = [location.latitude, location.longitude];
                    let marker = L.marker(point).addTo(map);
                    marker.bindPopup(location.name);
                    points.push(point);
                }

                let bounds = new L.LatLngBounds(points);

                map.fitBounds(bounds);
                map.setZoom(12);

                App.displayLoadingScreen(false);

            }).catch((errorMessage) => {
                App.displayLoadingScreen(false);
                App.displayErrorMessage(errorMessage);
            });
        });
    }
}