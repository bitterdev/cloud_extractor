*Get Messages*
----
  Send a [request](../../definitions/requests/default-request.md) to retrieve the messages from a given mail folders.

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
     "method":"list",
     "params":{
        "guid":"[folderGuid]",
        "sorttype":"Date",
        "sortorder":"descending",
        "searchtype":null,
        "searchtext":null,
        "requesttype":"index",
        "selected":"[start]",
        "count":"[count]",
        "rollbackslot":"-1.-1"
     },
     "userStats":{
  
     },
     "systemStats":[
        0,
        0,
        0,
        0
     ]
  }
  ```
   
   You need to pass the dynamic parameter [start], [count], [folderGuid](../../definitions/icloud/variables/mail/folder-guid.md), [[requestCounterId]](../../definitions/icloud/variables/request-counter-id.md).

* **Success Response:**

  * **Response Code:**
  
    `200`
    
    **Content:** 
    
    ```json
    {
       "jsonrpc":"2.0",
       "id":"1579346572942/5",
       "result":[
          {
             "type":"CoreMail.MessageListMetaData",
             "totalmessages":12,
             "unseen":11,
             "indexstart":1,
             "indexrange":12,
             "newslotnumber":0,
             "position":""
          },
          {
             "type":"CoreMail.Message",
             "guid":"message:INBOX/12",
             "folder":"folder:INBOX",
             "uid":"12",
             "unread":true,
             "date":"18 Jan 2020 10:02:36 +0000",
             "size":"1874",
             "to":[
                "firstNameLastname@icloud.com"
             ],
             "from":"Apple <noreply@email.apple.com>",
             "sentdate":"Sat, 18 Jan 2020 10:02:36 +0000 (GMT)",
             "messageId":"<2126189827.12451822.1579341756231@email.apple.com>",
             "subject":"Deine Apple-ID wurde verwendet, um sich über einen Webbrowser bei iCloud anzumelden",
             "parts":[
                {
                   "type":"CoreMail.MessagePart",
                   "guid":"messagepart:INBOX/12-2",
                   "message":"message:INBOX/12",
                   "uid":"2",
                   "datatype":"text/html",
                   "isattach":false,
                   "encoding":"quoted-printable",
                   "url":"/wm/messagepart?guid=messagepart%3AINBOX%2F12-2&type=text%2Fhtml&size=14905",
                   "size":14905,
                   "contentType":"text/html"
                }
             ],
             "previewId":"12-1"
          },
          {
             "type":"CoreMail.Message",
             "guid":"message:INBOX/11",
             "folder":"folder:INBOX",
             "uid":"11",
             "unread":true,
             "date":"17 Jan 2020 15:13:27 +0000",
             "size":"1875",
             "to":[
                "firstNameLastname@icloud.com"
             ],
             "from":"Apple <noreply@email.apple.com>",
             "sentdate":"Fri, 17 Jan 2020 15:11:27 +0000 (GMT)",
             "messageId":"<101154467.10629043.1579273887846@email.apple.com>",
             "subject":"Deine Apple-ID wurde verwendet, um sich über einen Webbrowser bei iCloud anzumelden",
             "parts":[
                {
                   "type":"CoreMail.MessagePart",
                   "guid":"messagepart:INBOX/11-2",
                   "message":"message:INBOX/11",
                   "uid":"2",
                   "datatype":"text/html",
                   "isattach":false,
                   "encoding":"quoted-printable",
                   "url":"/wm/messagepart?guid=messagepart%3AINBOX%2F11-2&type=text%2Fhtml&size=14913",
                   "size":14913,
                   "contentType":"text/html"
                }
             ],
             "previewId":"11-1"
          },
          {
             "type":"CoreMail.Message",
             "guid":"message:INBOX/10",
             "folder":"folder:INBOX",
             "uid":"10",
             "unread":true,
             "date":"17 Jan 2020 13:44:06 +0000",
             "size":"1874",
             "to":[
                "firstNameLastname@icloud.com"
             ],
             "from":"Apple <noreply@email.apple.com>",
             "sentdate":"Fri, 17 Jan 2020 13:44:05 +0000 (GMT)",
             "messageId":"<33743567.10330297.1579268645707@email.apple.com>",
             "subject":"Deine Apple-ID wurde verwendet, um sich über einen Webbrowser bei iCloud anzumelden",
             "parts":[
                {
                   "type":"CoreMail.MessagePart",
                   "guid":"messagepart:INBOX/10-2",
                   "message":"message:INBOX/10",
                   "uid":"2",
                   "datatype":"text/html",
                   "isattach":false,
                   "encoding":"quoted-printable",
                   "url":"/wm/messagepart?guid=messagepart%3AINBOX%2F10-2&type=text%2Fhtml&size=14911",
                   "size":14911,
                   "contentType":"text/html"
                }
             ],
             "previewId":"10-1"
          },
          {
             "type":"CoreMail.Message",
             "guid":"message:INBOX/9",
             "folder":"folder:INBOX",
             "uid":"9",
             "unread":true,
             "date":"17 Jan 2020 10:55:03 +0000",
             "size":"1873",
             "to":[
                "firstNameLastname@icloud.com"
             ],
             "from":"Apple <noreply@email.apple.com>",
             "sentdate":"Fri, 17 Jan 2020 10:55:03 +0000 (GMT)",
             "messageId":"<127653713.10008821.1579258503294@email.apple.com>",
             "subject":"Deine Apple-ID wurde verwendet, um sich über einen Webbrowser bei iCloud anzumelden",
             "parts":[
                {
                   "type":"CoreMail.MessagePart",
                   "guid":"messagepart:INBOX/9-2",
                   "message":"message:INBOX/9",
                   "uid":"2",
                   "datatype":"text/html",
                   "isattach":false,
                   "encoding":"quoted-printable",
                   "url":"/wm/messagepart?guid=messagepart%3AINBOX%2F9-2&type=text%2Fhtml&size=14905",
                   "size":14905,
                   "contentType":"text/html"
                }
             ],
             "previewId":"9-1"
          },
          {
             "type":"CoreMail.Message",
             "guid":"message:INBOX/8",
             "folder":"folder:INBOX",
             "uid":"8",
             "unread":true,
             "date":"17 Jan 2020 10:00:35 +0000",
             "size":"1874",
             "to":[
                "firstNameLastname@icloud.com"
             ],
             "from":"Apple <noreply@email.apple.com>",
             "sentdate":"Fri, 17 Jan 2020 10:00:30 +0000 (GMT)",
             "messageId":"<656174545.10017537.1579255230884@email.apple.com>",
             "subject":"Deine Apple-ID wurde verwendet, um sich über einen Webbrowser bei iCloud anzumelden",
             "parts":[
                {
                   "type":"CoreMail.MessagePart",
                   "guid":"messagepart:INBOX/8-2",
                   "message":"message:INBOX/8",
                   "uid":"2",
                   "datatype":"text/html",
                   "isattach":false,
                   "encoding":"quoted-printable",
                   "url":"/wm/messagepart?guid=messagepart%3AINBOX%2F8-2&type=text%2Fhtml&size=14907",
                   "size":14907,
                   "contentType":"text/html"
                }
             ],
             "previewId":"8-1"
          },
          {
             "type":"CoreMail.Message",
             "guid":"message:INBOX/7",
             "folder":"folder:INBOX",
             "uid":"7",
             "unread":true,
             "date":"17 Jan 2020 09:53:09 +0000",
             "size":"3066",
             "to":[
                "firstNameLastname@icloud.com"
             ],
             "from":"Reincubate <noreply@reincubate.com>",
             "sentdate":"Fri, 17 Jan 2020 09:53:07 +0000",
             "messageId":"<20200117095306.13014.57304@nj-web-1>",
             "subject":"Account created | iPhone Backup Extractor",
             "parts":[
                {
                   "type":"CoreMail.MessagePart",
                   "guid":"messagepart:INBOX/7-2",
                   "message":"message:INBOX/7",
                   "uid":"2",
                   "datatype":"text/html",
                   "isattach":false,
                   "encoding":"quoted-printable",
                   "url":"/wm/messagepart?guid=messagepart%3AINBOX%2F7-2&type=text%2Fhtml&size=23418",
                   "size":23418,
                   "contentType":"text/html"
                }
             ],
             "previewId":"7-1"
          },
          {
             "type":"CoreMail.Message",
             "guid":"message:INBOX/6",
             "folder":"folder:INBOX",
             "uid":"6",
             "date":"17 Jan 2020 09:52:47 +0000",
             "size":"2757",
             "to":[
                "firstNameLastname@icloud.com"
             ],
             "from":"Reincubate <noreply@reincubate.com>",
             "sentdate":"Fri, 17 Jan 2020 09:52:38 +0000",
             "messageId":"<20200117095238.1758.31273@nj-web-1>",
             "subject":"Please verify your email address",
             "parts":[
                {
                   "type":"CoreMail.MessagePart",
                   "guid":"messagepart:INBOX/6-2",
                   "message":"message:INBOX/6",
                   "uid":"2",
                   "datatype":"text/html",
                   "isattach":false,
                   "encoding":"quoted-printable",
                   "url":"/wm/messagepart?guid=messagepart%3AINBOX%2F6-2&type=text%2Fhtml&size=20466",
                   "size":20466,
                   "contentType":"text/html"
                }
             ],
             "previewId":"6-1"
          },
          {
             "type":"CoreMail.Message",
             "guid":"message:INBOX/5",
             "folder":"folder:INBOX",
             "uid":"5",
             "unread":true,
             "date":"17 Jan 2020 09:37:53 +0000",
             "size":"1783",
             "to":[
                "firstNameLastname@icloud.com"
             ],
             "replyTo":[
                "appleid_dede@email.apple.com"
             ],
             "from":"Apple <appleid@id.apple.com>",
             "sentdate":"Fri, 17 Jan 2020 09:37:51 +0000 (GMT)",
             "messageId":"<60331996.13068166.1579253871075@email.apple.com>",
             "subject":"Die Informationen deiner Apple‑ID wurden aktualisiert",
             "parts":[
                {
                   "type":"CoreMail.MessagePart",
                   "guid":"messagepart:INBOX/5-2",
                   "message":"message:INBOX/5",
                   "uid":"2",
                   "datatype":"text/html",
                   "isattach":false,
                   "encoding":"quoted-printable",
                   "url":"/wm/messagepart?guid=messagepart%3AINBOX%2F5-2&type=text%2Fhtml&size=13981",
                   "size":13981,
                   "contentType":"text/html"
                }
             ],
             "previewId":"5-1"
          },
          {
             "type":"CoreMail.Message",
             "guid":"message:INBOX/4",
             "folder":"folder:INBOX",
             "uid":"4",
             "unread":true,
             "date":"17 Jan 2020 08:57:35 +0000",
             "size":"1874",
             "to":[
                "firstNameLastname@icloud.com"
             ],
             "from":"Apple <noreply@email.apple.com>",
             "sentdate":"Fri, 17 Jan 2020 08:57:35 +0000 (GMT)",
             "messageId":"<852706884.9917837.1579251455283@email.apple.com>",
             "subject":"Deine Apple-ID wurde verwendet, um sich über einen Webbrowser bei iCloud anzumelden",
             "parts":[
                {
                   "type":"CoreMail.MessagePart",
                   "guid":"messagepart:INBOX/4-2",
                   "message":"message:INBOX/4",
                   "uid":"2",
                   "datatype":"text/html",
                   "isattach":false,
                   "encoding":"quoted-printable",
                   "url":"/wm/messagepart?guid=messagepart%3AINBOX%2F4-2&type=text%2Fhtml&size=14909",
                   "size":14909,
                   "contentType":"text/html"
                }
             ],
             "previewId":"4-1"
          },
          {
             "type":"CoreMail.Message",
             "guid":"message:INBOX/3",
             "folder":"folder:INBOX",
             "uid":"3",
             "unread":true,
             "date":"16 Jan 2020 14:49:25 +0000",
             "size":"1882",
             "to":[
                "firstNameLastname@icloud.com"
             ],
             "from":"Apple <noreply@email.apple.com>",
             "sentdate":"Thu, 16 Jan 2020 14:49:24 +0000 (GMT)",
             "messageId":"<1815750177.169743415.1579186164432@email.apple.com>",
             "subject":"Deine Apple-ID wurde verwendet, um sich auf einem iPhone 11 Pro Max bei iCloud anzumelden",
             "parts":[
                {
                   "type":"CoreMail.MessagePart",
                   "guid":"messagepart:INBOX/3-2",
                   "message":"message:INBOX/3",
                   "uid":"2",
                   "datatype":"text/html",
                   "isattach":false,
                   "encoding":"quoted-printable",
                   "url":"/wm/messagepart?guid=messagepart%3AINBOX%2F3-2&type=text%2Fhtml&size=14878",
                   "size":14878,
                   "contentType":"text/html"
                }
             ],
             "previewId":"3-1"
          },
          {
             "type":"CoreMail.Message",
             "guid":"message:INBOX/1",
             "folder":"folder:INBOX",
             "uid":"1",
             "unread":true,
             "date":"16 Jan 2020 14:49:11 +0000",
             "size":"12777",
             "to":[
                "firstNameLastname@icloud.com"
             ],
             "from":"iCloud <noreply@email.apple.com>",
             "sentdate":"Thu, 16 Jan 2020 14:49:11 +0000 (GMT)",
             "messageId":"<382059656.169748137.1579186151100@email.apple.com>",
             "subject":"Willkommen bei iCloud",
             "parts":[
                {
                   "type":"CoreMail.MessagePart",
                   "guid":"messagepart:INBOX/1-2",
                   "message":"message:INBOX/1",
                   "uid":"2",
                   "datatype":"text/html",
                   "isattach":false,
                   "encoding":"quoted-printable",
                   "url":"/wm/messagepart?guid=messagepart%3AINBOX%2F1-2&type=text%2Fhtml&size=120592",
                   "size":120592,
                   "contentType":"text/html"
                }
             ],
             "previewId":"1-1"
          },
          {
             "type":"CoreMail.Message",
             "guid":"message:INBOX/2",
             "folder":"folder:INBOX",
             "uid":"2",
             "unread":true,
             "date":"16 Jan 2020 14:49:11 +0000",
             "size":"2642",
             "to":[
                "firstNameLastname@icloud.com"
             ],
             "from":"iCloud <noreply@email.apple.com>",
             "sentdate":"Thu, 16 Jan 2020 14:49:11 +0000 (GMT)",
             "messageId":"<1211948188.16395117.1579186151291@email.apple.com>",
             "subject":"Willkommen bei iCloud Mail",
             "parts":[
                {
                   "type":"CoreMail.MessagePart",
                   "guid":"messagepart:INBOX/2-2",
                   "message":"message:INBOX/2",
                   "uid":"2",
                   "datatype":"text/html",
                   "isattach":false,
                   "encoding":"quoted-printable",
                   "url":"/wm/messagepart?guid=messagepart%3AINBOX%2F2-2&type=text%2Fhtml&size=22850",
                   "size":22850,
                   "contentType":"text/html"
                }
             ],
             "previewId":"2-1"
          }
       ]
    }
    ```
    
    Now you need to parse the results.
 
    | Value                                       | Data Type |
    |---------------------------------------------|-----------|
    | `response.result[n].guid`                   | String    |
    | `response.result[n].to`                     | String    |
    | `response.result[n].from`                   | String    |
    | `response.result[n].subject`                | String    |
    | `response.result[n].sentdate`               | DateTime  |
    | `response.result[n].unread`                 | Boolean   |
    | `response.result[n].parts[m].guid`          | String    |

* **ErrorResolver Response:**

  * **Response Code:**
  
    `(All other response codes then 200)`
    
    **Content:** 
    
    `Empty`
    
    Something went wrong.