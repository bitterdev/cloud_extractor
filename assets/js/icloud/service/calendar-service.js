/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

import HttpClient from "../client/http-client";

export default class CalendarService {
    static getAll(from, to) {
        let path = '/api/calendar/get_events';
        let params = {
            "from": from.toISOString().split('T')[0],
            "to": to.toISOString().split('T')[0]
        };
        return HttpClient.get(path, params);
    }
}