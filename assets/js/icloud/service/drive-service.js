/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

import HttpClient from "../client/http-client";
import Helper from "../../helper/helper";

export default class DriveService {
    static downloadUrl(url) {
        let path = '/api/drive/download_url';
        let params = {
            url: url
        };
        return Helper.buildUrl(path, params);
    }

    static getFiles(driveWsId) {
        let path = '/api/drive/get_files';
        let params = {
            driveWsId: driveWsId
        };
        return HttpClient.get(path, params);
    }

    static getDownloadLink(docWsId) {
        let path = '/api/drive/get_download_link';
        let params = {
            docWsId: docWsId
        };
        return HttpClient.get(path, params);
    }
}