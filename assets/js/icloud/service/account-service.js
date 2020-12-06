/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

import HttpClient from "../client/http-client";

export default class AccountService {
    static login(email, password) {
        let path = '/api/account/login';
        let params = {
            "email": email,
            "password": password
        };
        return HttpClient.get(path, params);
    }

    static checkMultiFactorAuthentication() {
        let path = '/api/account/check_mfa';
        let params = {};
        return HttpClient.get(path, params);
    }

    static submitCode(code) {
        let path = '/api/account/submit_code';
        let params = {
            "code": code
        };
        return HttpClient.get(path, params);
    }

    static logout() {
        let path = '/api/account/logout';
        let params = {};
        return HttpClient.get(path, params);
    }

    static validateSession() {
        let path = '/api/account/validate_session';
        let params = {};
        return HttpClient.get(path, params);
    }

    static trustDevice() {
        let path = '/api/account/trust_device';
        let params = {};
        return HttpClient.get(path, params);
    }
}