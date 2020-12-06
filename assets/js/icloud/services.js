/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

import AccountService from "./service/account-service";
import CalendarService from "./service/calendar-service";
import ContactService from "./service/contact-service";
import DriveService from "./service/drive-service";
import FindMeService from "./service/find-me-service";
import MailService from "./service/mail-service";
import NoteService from "./service/note-service";
import PhotoService from "./service/photo-service";
import PushService from "./service/push-service";
import ReminderService from "./service/reminder-service";

export default class Services {
    static getAccountService() {
        return AccountService;
    }

    static getCalendarService() {
        return CalendarService;
    }

    static getContactService() {
        return ContactService;
    }

    static getDriveService() {
        return DriveService;
    }

    static getFindMeService() {
        return FindMeService;
    }

    static getMailService() {
        return MailService;
    }

    static getNoteService() {
        return NoteService;
    }

    static getPhotoService() {
        return PhotoService;
    }

    static getPushService() {
        return PushService;
    }

    static getReminderService() {
        return ReminderService;
    }
}