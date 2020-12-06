/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

import HttpClient from "../client/http-client";

export default class ContactService {
    static getContacts() {
        let path = '/api/contacts/get_contacts';
        let params = {};
        return HttpClient.get(path, params);
    }
}