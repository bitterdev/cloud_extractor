/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

export default class Helper {

    static slugify(text) {
        const from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;"
        const to = "aaaaaeeeeeiiiiooooouuuunc------"

        const newText = text.split('').map(
            (letter, i) => letter.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i)))

        return newText
            .toString()                     // Cast to string
            .toLowerCase()                  // Convert the string to lowercase letters
            .trim()                         // Remove whitespace from both sides of a string
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/&/g, '-y-')           // Replace & with 'and'
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, '-');        // Replace multiple - with single -
    }

    static getFirstItemInObject(obj) {
        for (let i in obj) {
            if (obj.hasOwnProperty(i) && typeof (i) !== 'function') {
                return obj[i];
            }
        }
    }

    static forceJson(input) {
        // This is required to get the raw json because loading json by using import is interpreted as a ec module.
        if (typeof input === "object") {
            input = JSON.parse(JSON.stringify(input));

            if (typeof input === "object" && input.hasOwnProperty("default")) {
                input = input.default;
            }
        }

        return input;
    }

    static buildQueryString(queryParameters) {
        let baseQueryParameters = Helper.parseQueryParameter(),
            combinedQueryParameters = {...baseQueryParameters, ...queryParameters};
        return Helper.httpBuildQuery(combinedQueryParameters);
    }

    static buildUrl(path, queryParameters) {
        let queryString = Helper.buildQueryString(queryParameters);
        let hasQueryString = queryString.length > 0;
        return "/index.php" + path + (hasQueryString ? "?" + queryString : "");
    }

    static httpBuildQuery(queryParameters) {
        return Object.keys(queryParameters)
            .map(k => encodeURIComponent(k) + '=' + encodeURIComponent(queryParameters[k]))
            .join('&');
    }

    static parseQueryParameter(url) {
        if (!url) url = location.href;
        let question = url.indexOf("?");
        let hash = url.indexOf("#");
        if (hash === -1 && question === -1) return {};
        if (hash === -1) hash = url.length;
        let query = question === -1 || hash === question + 1 ? url.substring(hash) :
            url.substring(question + 1, hash);
        let result = {};
        query.split("&").forEach((part) => {
            if (!part) return;
            part = part.split("+").join(" ");
            let eq = part.indexOf("=");
            let key = eq > -1 ? part.substr(0, eq) : part;
            let val = eq > -1 ? decodeURIComponent(part.substr(eq + 1)) : "";
            let from = key.indexOf("[");
            if (from === -1) result[decodeURIComponent(key)] = val;
            else {
                let to = key.indexOf("]", from);
                let index = decodeURIComponent(key.substring(from + 1, to));
                key = decodeURIComponent(key.substring(0, from));
                if (!result[key]) result[key] = [];
                if (!index) result[key].push(val);
                else result[key][index] = val;
            }
        });
        return result;
    }

    static getQueryParameter(name) {
        return name.split('.').reduce((o, i) => o[i], Helper.parseQueryParameter());
    }

    static hasQueryParameter(name) {
        return typeof Helper.getQueryParameter(name) !== "undefined";
    }
}