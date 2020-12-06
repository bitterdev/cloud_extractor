/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

import Helper from "../../helper/helper";

export default class HttpClient {
    static get(path, queryParameters) {
        return new Promise((resolve, reject) => {
            let url = Helper.buildUrl(path, queryParameters);

            fetch(url)
                .then((response) => {
                    return response.json();
                })
                .then((json) => {
                    json = json || {};
                    json.success = json.success || false;
                    json.data = json.data || null;
                    json.error = json.error || null;

                    if (json.success) {
                        resolve(json.data);
                    } else {
                        let errorMessage = '';
                        // @todo: resolve error message
                        reject(errorMessage);
                    }
                })
                .catch((err) => {
                    reject(err);
                });
        });
    }
}