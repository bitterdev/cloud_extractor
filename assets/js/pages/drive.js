/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

import Page from "./page";
import PageTemplate from "../../views/default.html";
import App from "../app";
// noinspection ES6CheckImport
import {createTree} from 'jquery.fancytree';
import 'jquery.fancytree/dist/modules/jquery.fancytree.glyph';
import $ from 'jquery';

export default class Drive extends Page {

    static displayNoResults() {
        let $p = $("<p></p>").html(App.getInternationalization().getMessage("noResults"));
        $("#content").html("").append($p);
    }

    static load() {
        this.validateSession().then(() => {
            Drive.render("Drive", PageTemplate, {
                "path": App.getRouter().getActiveRoute().getPath(),
                "title": App.getInternationalization().getMessage("defaultPage.menu.drive")
            });

            App.getServices().getDriveService().getFiles("FOLDER::com.apple.CloudDocs::root").then((data) => {
                let sourceList = [];

                if (typeof data.files === "undefined" || data.files.length === 0) {
                    Drive.displayNoResults();
                    return;
                }

                for (let file of data.files) {
                    sourceList.push({
                        title: file.name,
                        key: (file.isFile ? file.docWsId : file.driveWsId),
                        folder: file.isFolder,
                        lazy: file.isFolder
                    });
                }

                // noinspection JSUnusedGlobalSymbols
                createTree('#content', {
                    aria: true,
                    autoActivate: false,
                    autoCollapse: false,
                    autoScroll: false,
                    focusOnSelect: true,
                    keyboard: true,
                    extensions: ["glyph"],
                    glyph: {
                        preset: "awesome4",
                    },
                    source: sourceList,
                    lazyLoad: (event, data) => {
                        let node = data.node;

                        let dfd = new $.Deferred();

                        data.result = dfd.promise();

                        App.getServices().getDriveService().getFiles(node.key).then((data) => {
                            sourceList = [];

                            for (let file of data.files) {
                                sourceList.push({
                                    title: file.name,
                                    key: (file.isFile ? file.docWsId : file.driveWsId),
                                    folder: file.isFolder,
                                    lazy: file.isFolder
                                });
                            }

                            dfd.resolve(sourceList);

                        }).catch((errorMessage) => {
                            App.displayErrorMessage(errorMessage);
                        });
                    },
                    dblclick: (event, data) => {
                        let node = data.node;

                        if (!node.folder) {
                            let docWsId = node.key;

                            App.getServices().getDriveService().getDownloadLink(docWsId).then((data) => {
                                data.downloadLink = data.downloadLink || "";
                                window.location.href = App.getServices().getDriveService().downloadUrl(data.downloadLink);
                            }).catch((errorMessage) => {
                                App.displayErrorMessage(errorMessage);
                            });
                        }
                    }
                });

                App.displayLoadingScreen(false);

            }).catch(() => {
                App.displayLoadingScreen(false);
                Drive.displayNoResults();
            });
        });
    }
}