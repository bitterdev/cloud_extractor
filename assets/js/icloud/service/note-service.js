/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

import HttpClient from "../client/http-client";

export default class NoteService {
    static getNotes() {
        let path = '/api/notes/get_notes';
        let params = {};
        return HttpClient.get(path, params);
    }
}