*Get Message*
----
  Send a [request](../../definitions/requests/default-request.md) to retrieve the message.

* **Endpoint**
  
  [Mail-Endpoint](../../definitions/icloud/endpoints/mail.md)
  
* **Method:**

  `POST`
  
* **Path**

  `/wm/message`
  
* **Query Parameters**
 
   `clientBuildNumber=1923Project60`
   
   `clientMasteringNumber=1923B31`
   
   `clientId=[HMAC]`
   
   `dsid=[dsid]`
   
   You need to pass the dynamic parameters [[HMAC]](../../definitions/general/types/hmac.md) and [[dsid]](../../definitions/icloud/variables/session-id.md).

* **Payload**

  ```json
  {
     "jsonrpc":"2.0",
     "id":"[requestCounterId]",
     "method":"get",
     "params":{
        "guid":"[messageGuid]",
        "parts":"[parts]"
     },
     "userStats":{
  
     },
     "systemStats":[
        0,
        3436,
        0,
        0
     ]
  }
  ```
   
   You need to pass the dynamic parameter [messageGuid](../../definitions/icloud/variables/mail/guid.md), [messageParts](../../definitions/icloud/variables/mail/parts.md), [[requestCounterId]](../../definitions/icloud/variables/request-counter-id.md).

* **Success Response:**

  * **Response Code:**
  
    `200`
    
    **Content:** 
    
    ```json
    {
       "jsonrpc":"2.0",
       "id":"1579346786697/7",
       "result":[
          {
             "recordType":"CoreMail.MessageDetail",
             "guid":"message:INBOX/12",
             "longHeader":"Return-path: <noreply@email.apple.com>\r\nOriginal-recipient: rfc822;MarkLastname@icloud.com\r\nReceived: from ms11p71im-hyfv28053801 by ms11p71ic-hygi28060601 (mailgateway 1923B118)\twith SMTP id b928e5c9-8980-4c76-98aa-eba42ad47d6c \tfor <MarkLastname@icloud.com>; Sat, 18 Jan 2020 10:02:36 GMT\r\nReceived: from 17.58.36.177 by 17.58.36.166 (mailnotify 1916B19:01:660:10:02:36:1E); Sat, 18 Jan 2020 10:02:36 GMT\r\nX-Apple-MoveToFolder: INBOX  modseq 0\r\nX-Apple-Action: MOVE_TO_FOLDER/INBOX\r\nX-Apple-UUID: b928e5c9-8980-4c76-98aa-eba42ad47d6c\r\nReceived: from rn2-txn-msbadger06106.apple.com (unknown [17.111.110.101])\tby ms11p00im-qufv17090401.me.com (Postfix) with ESMTPS id 404A6C0131\tfor <MarkLastname@icloud.com>; Sat, 18 Jan 2020 10:02:36 +0000 (UTC)\r\nDKIM-Signature: v=1; a=rsa-sha256; c=relaxed/relaxed; d=email.apple.com;\ts=email0517; t=1579341756;\tbh=SHiwLTz75NSiFojA+4KyU95PzfitXn5ZRY0yrEqSvGY=;\th=Date:From:To:Message-ID:Subject:Content-Type;\tb=Pig8ZCH+1uC98C4aHbE8JIkvYE/Y/tJEzUtIdtFyfam1SKY9MjcUD14vxbbZnHp8F\t h20wPni/9RBCeETlRpWGCl6JqvnxlvPF6MHLIgusuzLEdX+X5buf39UMb+VRgCqHtx\t W8YMFR6YU59AAjzi+s4NtY6+TauBZ8sbaEuGfgtZzbFGUGjHC9Rk0DVLgRPO+Sfwio\t ehV1W+f+d3dJut1fJT/bBwJGJBKkmMB86y1X3J/G7RAVPTwrJ8/lJoIq1oICtliyZN\t sThr5NbZf5R+LWse3xd3NYeYHneIzItTuaVIM1I1+i25/gRrXJAMY3bHKkkf33nrR8\t c6NVm7+B0jiaA==\r\nDate: Sat, 18 Jan 2020 10:02:36 +0000 (GMT)\r\nFrom: Apple <noreply@email.apple.com>\r\nTo: MarkLastname@icloud.com\r\nMessage-ID: <2126189827.12451822.1579341756231@email.apple.com>\r\nSubject: =?ISO-8859-1?Q?Deine_Apple-ID_wurde_verwendet,_um_sich_=FC?= =?ISO-8859-1?Q?ber_einen_Webbrowser_bei_iCloud_anzumelden?=\r\nMIME-Version: 1.0\r\nContent-Type: multipart/alternative; \tboundary=\"----=_Part_12451820_1469217298.1579341756231\"\r\nX-Attach-Flag: N\r\nX-Sent-To: MarkLastname@icloud.com,2,OM5aez6bIHhmg4f%2FzdLKazIhmYcIDP2p2ppuGgaJaLpo9iaOwytrCAwT8cty%2BaFJpm51s2NyT7OTLoCDdDhFZnY7sjShyTGDxRcKBh1qXcffM0dKJfKB7l%2BZKojej9JxyDxjVytAOF%2Bva0rYzA%2BEpsR8rqQadBCv%2Fpv7FucZgK%2F6X%2Fbg0j1hrqPAIHijTT2qFUrqcvs5WIOoWu7%2B1PQVe46N3EH7KlSqyzO1L5YyCMKyKRm4cI7HMT0W4HiqQBGf06co%2FaDZgYrQKUC9Rhuqv9vWjixSrvzkEUNstGRBDKs%2FUg6wLZlXzeR4VUk6xOROfpGy9oi%2FjJhxpBWlrdvbix4nJjTOBuQEjDDMgnr%2BCcXtcJcIcfUR0D4FL5ObXgiyJEH8gGPDBqB6C%2Fhv%2Bd%2FdFJ0nIElgnHs9yNtkutGEbrvpyH%2FqX%2BmbzCqpRdd6Z%2FlggCI%2F0%2B3FjM6CQLZGsNc36uiIxrGGHNlEcsKPugtMe%2Fs%3D\r\nX-TXN_ID: 86b5ce74-e964-4031-b380-5a737f5e7697\r\nX-DKIM_SIGN_REQUIRED: YES\r\nX-EmailType-Id: 1000104071\r\nX-Business-Group: iCloud\r\n",
             "from":[
                "Apple <noreply@email.apple.com>"
             ],
             "to":[
                "firstNameLastname@icloud.com"
             ],
             "contentType":"multipart/alternative",
             "parts":[
                {
                   "type":"CoreMail.MessagePart",
                   "guid":"messagepart:INBOX/12-2",
                   "content":"<html>\r\n    \r\n    <head>\r\n      \r\n      <meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">\r\n      <meta name=\"viewport\" content=\"width=device-width\">\r\n      <meta name=\"format-detection\" content=\"address=no\" />\r\n      <meta name=\"format-detection\" content=\"telephone=no\" />\r\n      <meta name=\"format-detection\" content=\"email=no\" />\r\n        \r\n        \r\n        \r\n        <style type=\"text/css\">\r\n          \r\n          body { margin: 0 !important; padding: 0 !important; }\r\n          a:visited { color: #08c !important; text-decoration: none !important; }\r\n          a:hover { text-decoration: underline !important; }\r\n          a:active { text-decoration: underline !important; }\r\n          a:hover.linkbutton { color: #2b2b2b !important; text-decoration: none !important; font-weight: 500 !important; }\r\n          a:active.linkbutton { color: #2b2b2b !important; text-decoration: none !important; font-weight: 500 !important; }\r\n          a:visited.linkbutton { color: #2b2b2b !important; text-decoration: none !important; font-weight: 500 !important; }\r\n          .nobr {  white-space: nowrap; }\r\n\r\n          @media only screen and (min-device-width : 320px) and (max-device-width : 568px) {\r\n            body[yahoo] {\r\n            overflow: hidden;\r\n            width: auto !important;\r\n            text-align: center !important;\r\n            margin: 0;\r\n            -webkit-text-size-adjust:100% !important;\r\n            }\r\n            body[yahoo] .mainTable {\r\n              margin: 0 10px !important;\r\n            }\r\n\r\n            body[yahoo] .heading_logo {\r\n              text-align: right !important;\r\n            }\r\n\r\n            body[yahoo] .heading_logo img {\r\n              width: 17px !important;\r\n              height: 21px !important;\r\n            }\r\n\r\n          \r\n            \r\n            body[yahoo] .content_margin {\r\n            width: 15px !important;\r\n            }\r\n            body[yahoo] .footer {\r\n              background-size: 100%;\r\n            }\r\n            body[yahoo] .footer .bottomContent {\r\n            padding-top: 15px !important;\r\n            display: block !important;\r\n            }\r\n\r\n            body[yahoo] .footer.content {\r\n            padding: 0px 10px !important;\r\n            }\r\n\r\n            body[yahoo] .footer .service {\r\n            display: block !important;\r\n            }\r\n\r\n            body[yahoo] .iPhone_font {\r\n              font-family: 'Helvetica Neue' !important;\r\n            }\r\n\r\n          }\r\n\r\n          @media only screen and (max-device-width: 768px) {\r\n            body[yahoo] .iPhone_font {\r\n              font-family: 'Helvetica Neue' !important;\r\n            }\r\n          }\r\n\r\n          @media only screen and (-webkit-min-device-pixel-ratio: 2) {\r\n            body[yahoo] .iPhone_font {\r\n              font-family: 'Helvetica Neue' !important;\r\n            }\r\n          }\r\n\r\n        </style>\r\n    </head>\r\n    \r\n     \r\n          <body style=\"margin: 0; padding: 0; -webkit-text-size-adjust: 100%;\">\r\n            <div class=\"mailwrapper\" style=\"background-color:rgb(255, 255, 255);font-size: 14px; color: #333; font-smooth: always; -webkit-font-smoothing: antialiased; \"  >\r\n\r\n              <table style=\"table-layout: fixed;width: 100%;\"><tr><td>\r\n\r\n              <table class=\"mainTable\" align=\"center\" style=\"margin: 0 auto;font-size: inherit; line-height: inherit; text-align: center; border-spacing: 0; border-collapse: collapse; -premailer-cellpadding: 0; -premailer-cellspacing: 0; padding: 0; border: 0;\" cellpadding=\"0\" cellspacing=\"0\" >\r\n                <tr><td class=\"topPadding\" style=\"font-family: 'Lucida Grande', Helvetica, Arial, sans-serif; height: 16px; -premailer-height: 16;\" height=\"16\"></td></tr>\r\n                <tr>\r\n                  <td class=\"centerColumn\" style=\"width: 685px; -premailer-width: 685;\">\r\n                    <table class=\"iPhone_font\" style=\"font-family: 'Lucida Grande', Helvetica, Arial, sans-serif; font-size: inherit; line-height: 18px; padding: 0px; border: 0px;\" >\r\n                      <tr>\r\n                        <td class=\"content_margin\" style=\"width: 40px;\"></td>\r\n                        <td class=\"heading_logo\" style=\"                                 text-align: right;\r\n                           width: 600px;\"><img width=\"22\" height=\"26\"  src=\"https://statici.icloud.com/emailimages/v4/common/apple_logo_web@2x.png\" style=\"width: 22px; height: 26px;\" /></td>\r\n                        <td class=\"content_margin\" style=\"width: 40px;\"></td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td class=\"content_margin\" style=\"width: 40px;\"></td>\r\n                        \r\n                        \r\n                            \r\n                            <td class=\"iPhone_font\" style=\"font-family: 'Lucida Grande', Helvetica, Arial, sans-serif; line-height: 18px; padding-top: 44px;                                 text-align: left;\r\n                               font-size: 14px; color: #333; font-smooth: always; -webkit-font-smoothing: antialiased;\">\r\n                              Hallo Mark Lastname,\r\n                              </td>\r\n                            \r\n                          \r\n                        <td class=\"content_margin\" style=\"width: 40px;\"></td>\r\n                        </tr>\r\n                        <tr>\r\n                          <td class=\"content_margin\" style=\"width: 40px;\"></td>\r\n                          <td class=\"iPhone_font\" style=\"font-family: 'Lucida Grande', Helvetica, Arial, sans-serif; line-height: 18px;                                  text-align: left;\r\n                             font-size: 14px; color: #333; padding: 17px 0 0 0; font-smooth: always; -webkit-font-smoothing: antialiased;\">\r\n                            \r\n                              deine Apple-ID (<span><a href=\"mailto:MarkLastname@icloud.com\" style=\"color: #2b2b2b; text-decoration: none;\"><nobr><b>MarkLastname@icloud.com</b></nobr></a></span>) wurde verwendet, um sich mit einem Webbrowser bei iCloud anzumelden.\r\n                              </td>\r\n                          <td class=\"content_margin\" style=\"width: 40px;\"></td>\r\n                          </tr>\r\n                          <tr>\r\n                            <td class=\"content_margin\" style=\"width: 40px;\"></td>\r\n                            <td class=\"iPhone_font\" style=\"font-family: 'Lucida Grande', Helvetica, Arial, sans-serif; line-height: 18px;                                  text-align: left;\r\n                               font-size: 14px; color: #333; padding: 18px 0 0 0; font-smooth: always; -webkit-font-smoothing: antialiased;\"><div><span  >\r\n                              \r\n                            \r\n                                Datum und Zeit:\r\n                                </span><span >\r\n                                  \r\n                                    18. Januar 2020, 10:01 Uhr UTC\r\n                                    </span></div>\r\n                                    \r\n                                    \r\n                                    \r\n                                    </td>\r\n                            <td class=\"content_margin\" style=\"width: 40px;\"></td>\r\n                            </tr>\r\n                              <tr>\r\n                                <td class=\"content_margin\" style=\"width: 40px;\"></td>\r\n                                <td class=\"iPhone_font\" style=\"font-family: 'Lucida Grande', Helvetica, Arial, sans-serif; line-height: 18px; font-smooth: always; -webkit-font-smoothing: antialiased;                                  text-align: left;\r\n                                   font-size: 14px; color: #333; padding: 18px 0 0 0;\">\r\n                                  \r\n                                    Wenn dir die oben aufgef&#252;hrten Informationen bekannt vorkommen, kannst du diese Nachricht ignorieren.\r\n                                    </td>\r\n                                <td class=\"content_margin\" style=\"width: 40px;\"></td>\r\n                                </tr>\r\n                          <tr>\r\n                            <td class=\"content_margin\" style=\"width: 40px;\"></td>\r\n                            \r\n                            <td class=\"letter_content iPhone_font\" style=\"font-family: 'Lucida Grande', Helvetica, Arial, sans-serif; line-height: 18px; font-smooth: always; -webkit-font-smoothing: antialiased;                                  text-align: left;\r\n                               font-size: 14px; color: #333; padding: 18px 0 15px 0;\">\r\n                              Falls du dich nicht vor kurzem bei iCloud angemeldet hast und der Meinung bist, dass jemand anderes versucht hat, auf deinen Account zuzugreifen, solltest du dein Passwort unter Apple-ID zur&#252;cksetzen (<a href=\"https://appleid.apple.com/de\" style=\"color: #333; text-decoration: none;\"><nobr>https://appleid.apple.com</nobr></a>).</td>\r\n                            <td class=\"content_margin\" style=\"width: 40px;\"></td>\r\n                            </tr>\r\n                            \r\n                            \r\n                            \r\n                            <tr>\r\n                              <td class=\"content_margin\" style=\"width: 40px;\"></td>\r\n                              <td class=\"iPhone_font\" style=\"                                 text-align: left;\r\n                                 font-family: 'Lucida Grande', Helvetica, Arial, sans-serif; line-height: 18px; font-smooth: always; -webkit-font-smoothing: antialiased; color: #333; padding: 3px 0 19px 0; font-size: 14px;\">\r\n                                Mit freundlichen Gr&#252;&#223;en\r\n                                  </td>\r\n                              <td class=\"content_margin\" style=\"width: 40px;\"></td>\r\n                              </tr>\r\n                            \r\n                           \r\n                            \r\n                            <tr>\r\n                              <td class=\"content_margin\" style=\"width: 40px;\"></td>\r\n                              <td class=\"iPhone_font\" style=\"                                 text-align: left;\r\n                                 font-family: 'Lucida Grande', Helvetica, Arial, sans-serif; line-height: 18px; font-size: 14px; font-smooth: always; -webkit-font-smoothing: antialiased; color: #333; padding: 17px 0 13px 0;\">\r\n                                \r\n                                  Apple&#160;Support\r\n                                  </td>\r\n                              <td class=\"content_margin\" style=\"width: 40px;\"></td>\r\n                              </tr>\r\n                              </table>\r\n                            </td>\r\n                          </tr>\r\n                          \r\n                          <tr class=\"footerTopPadding iPhone_font\" style=\"height: 17px; -premailer-height: 17;\" height=\"17\"><td style=\"font-family: 'Geneva', Helvetica, Arial, sans-serif;\"></td></tr>\r\n                          <tr>\r\n                            <td class=\"footer background iPhone_font\" colspan=\"3\" background=\"https://statici.icloud.com/emailimages/v4/common/footer_gradient_web.png\" style=\"font-family: 'Geneva', Helvetica, Arial, sans-serif; font-smooth: always; -webkit-font-smoothing: antialiased; width: 685px; font-size: 11px; line-height: 14px; color: #888; text-align: center; background-repeat: no-repeat; background-position: center top; padding: 15px 0 12px; -webkit-text-size-adjust:100%;\" align=\"center\">\r\n                              <span class=\"footer1\" style=\"white-space: nowrap;\" >\r\n                                <a href=\"https://appleid.apple.com/choose-your-country/\" style=\"color: #08c; text-decoration: none;\">\r\n                                Apple-ID\r\n                              </a>\r\n                            </span>&#32;&#124;&#32; \r\n                            <span class=\"footer1\" style=\"white-space: nowrap;\">\r\n                              <a href=\"https://www.apple.com/support/country/\" style=\"color: #08c; text-decoration: none;\">\r\n                              Support\r\n                            </a>\r\n                          </span>&#32;&#124;&#32;\r\n                        <span class=\"footer1\" style=\"white-space: nowrap;\">\r\n                          <a href=\"https://www.apple.com/legal/privacy/de/\" style=\"color: #08c; text-decoration: none;\">\r\n                          Datenschutz\r\n                        </a>\r\n                      </span>\r\n                      <br/>\r\n                    \r\n                      <span class=\"bottomContent\" colspan=\"3\">\r\n                        <span class=\"footer1\" style=\"white-space: nowrap;\">\r\n                          Copyright &#169; 2020\r\n                        </span>\r\n                        <span> \r\n                          Apple Distribution International, <span class= \"nobr\"><a href=\"#address\" id=\"address\" style=\"color: #888888; text-decoration: none;cursor:text;\">Hollyhill Industrial Estate, Hollyhill, Cork, Ireland.</a></span>\r\n                        </span>\r\n                        <span class=\"footer1\" style=\"white-space: nowrap;\">\r\n                          Alle Rechte vorbehalten.\r\n                        </span>\r\n                      </span>\r\n                    \r\n                    </td>\r\n                  </tr>\r\n                  <tr class=\"footerBottomPadding iPhone_font\" style=\"height: 50px; -premailer-height: 50;\" height=\"50\"><td style=\"font-family: 'Geneva', Helvetica, Arial, sans-serif;\">\r\n                  </td>\r\n                </tr>\r\n              </table>\r\n\r\n              </td></tr></table>\r\n            </div>\r\n          </body>\r\n        <img src='https://outsideapple.apple.com/img/APPLE_EMAIL_LINK/spacer4.gif?v=2&a=OM5aez6bIHhmg4f%2FzdLKazIhmYcIDP2p2ppuGgaJaLpo9iaOwytrCAwT8cty%2BaFJpm51s2NyT7OTLoCDdDhFZnY7sjShyTGDxRcKBh1qXcffM0dKJfKB7l%2BZKojej9JxyDxjVytAOF%2Bva0rYzA%2BEpsR8rqQadBCv%2Fpv7FucZgK%2F6X%2Fbg0j1hrqPAIHijTT2qFUrqcvs5WIOoWu7%2B1PQVe46N3EH7KlSqyzO1L5YyCMKyKRm4cI7HMT0W4HiqQBGf06co%2FaDZgYrQKUC9Rhuqv9vWjixSrvzkEUNstGRBDKs%2FUg6wLZlXzeR4VUk6xOROfpGy9oi%2FjJhxpBWlrdvbix4nJjTOBuQEjDDMgnr%2BCcXtcJcIcfUR0D4FL5ObXgiyJEH8gGPDBqB6C%2Fhv%2Bd%2FdFJ0nIElgnHs9yNtkutGEbrvpyH%2FqX%2BmbzCqpRdd6Z%2FlggCI%2F0%2B3FjM6CQLZGsNc36uiIxrGGHNlEcsKPugtMe%2Fs%3D'/>\r\n</html>"
                }
             ]
          },
          {
             "guid":"firstNameLastname@icloud.com",
             "recordType":"CoreMail.EmailAddress",
             "name":"",
             "email":"firstNameLastname@icloud.com",
             "nameAndEmailAddress":"firstNameLastname@icloud.com"
          },
          {
             "guid":"Apple <noreply@email.apple.com>",
             "recordType":"CoreMail.EmailAddress",
             "name":"Apple",
             "email":"noreply@email.apple.com",
             "nameAndEmailAddress":"Apple <noreply@email.apple.com>"
          }
       ]
    }
    ```
    
    Now you need to parse the results.
 
    | Value                                       | Data Type |
    |---------------------------------------------|-----------|
    | `response.result[n].guid`                   | String    |
    | `response.result[n].longHeader`             | String    |
    | `response.result[n].from[m]`                | String    |
    | `response.result[n].to[m]`                  | String    |
    | `response.result[n].parts[m].type`          | `CoreMail.MessagePart`    |
    | `response.result[n].parts[m].content`       | String    |
    
    Emails are [MIME multi-part messages](../../definitions/general/types/mime.md). You need to parse them correctly.

* **ErrorResolver Response:**

  * **Response Code:**
  
    `(All other response codes then 200)`
    
    **Content:** 
    
    `Empty`
    
    Something went wrong.