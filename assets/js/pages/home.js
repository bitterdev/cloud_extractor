/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

import Page from "./page";
import App from "../app";

export default class Home extends Page {
    static load() {
        this.validateSession().then(() => {
            App.getRouter().navigateTo("/calendar");
        });
    }
}