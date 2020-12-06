/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

import Page from "./page";
import PageTemplate from "../../views/default.html";
import PhotosTemplate from "../../views/content/photos.html";
import App from "../app";

export default class Photos extends Page {
    static load() {
        this.validateSession().then(() => {
            App.displayLoadingScreen(true);

            Photos.render("Photos", PageTemplate, {
                "path": App.getRouter().getActiveRoute().getPath(),
                "title": App.getInternationalization().getMessage("defaultPage.menu.photos")
            });

            App.getServices().getPhotoService().getPhotos().then((data) => {
                App.displayLoadingScreen(false);

                let photos = [];

                for (let photo of data.photos) {
                    // noinspection JSUnresolvedVariable
                    photos.push({
                        downloadUrl: App.getServices().getDriveService().downloadUrl(photo.originalFileDownloadUrl.replace("${f}", photo.name)),
                        thumbnailUrl: App.getServices().getDriveService().downloadUrl(photo.thumbnailFileDownloadUrl)
                    });
                }

                Photos.renderContent(PhotosTemplate, {
                    photos: photos
                });

            }).catch((errorMessage) => {
                App.displayLoadingScreen(false);
                App.displayErrorMessage(errorMessage);
            });
        });
    }
}