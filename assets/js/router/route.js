/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

export default class Route {

    constructor(path, page) {
        this.path = path;
        this.page = page;
    }

    getPath() {
        return this.path;
    }

    getPage() {
        return this.page;
    }
}