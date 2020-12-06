/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

import HttpClient from "../client/http-client";

export default class MailService {
    static getFolders() {
        let path = '/api/mail/get_folders';
        let params = {};
        return HttpClient.get(path, params);
    }

    static getMessages(folderId, start, count) {
        let path = '/api/mail/get_messages';
        let params = {
            "folderId": folderId,
            "start": start,
            "count": count
        };
        return HttpClient.get(path, params);
    }

    static getMessage(messageId, messageParts) {
        let path = '/api/mail/get_message';
        let params = {
            "messageId": messageId,
            "messageParts": messageParts
        };
        return HttpClient.get(path, params);
    }
}