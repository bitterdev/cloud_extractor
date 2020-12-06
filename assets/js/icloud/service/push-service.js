/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

import HttpClient from "../client/http-client";

export default class PushService {
    static registerDevice(deviceToken) {
        let path = '/api/push/register_device';
        let params = {
            "deviceToken": deviceToken
        };
        return HttpClient.get(path, params);
    }
}