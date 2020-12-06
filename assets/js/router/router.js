/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

import App from "../app";

export default class Router {
    static defaultRoute = "/";
    static routes = [];
    static activeRoute;

    static addRoute(route) {
        Router.routes.push(route);
    }

    /**
     * @returns {Route}
     */
    static getActiveRoute() {
        return Router.activeRoute;
    }

    static getRoutes() {
        return Router.routes;
    }

    /**
     * @returns {Route|boolean}
     */
    static getRouteByPath(path) {
        for (let route of Router.getRoutes()) {
            if (route.getPath() === path) {
                return route;
            }
        }

        return false;
    }

    static init() {
        window.addEventListener("hashchange", (e) => {
            e.preventDefault();

            let path = window.location.hash.substr(1);

            let route = Router.getRouteByPath(path);

            if (route === false) {
                route = Router.getRouteByPath(Router.defaultRoute);
            }

            if (route !== false) {
                Router.activeRoute = route;
                route.getPage().load();
            }

            return false;
        });

        Router.navigateTo();
    }

    static navigateTo(path) {
        App.displayLoadingScreen(true);

        if (typeof path === "undefined") {
            path = window.location.hash.substr(1);
        }

        let route = Router.getRouteByPath(path);

        if (route === false) {
            route = Router.getRouteByPath(Router.defaultRoute);
        }

        if (route !== false) {
            if (window.location.hash.substr(1) === route.getPath()) {
                // refresh
                Router.activeRoute = route;
                route.getPage().load();
            } else {
                window.location.hash = route.getPath();
            }
        }
    }
}