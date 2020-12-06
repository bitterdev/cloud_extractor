*Get Folders*
----
  Send a [request](../../definitions/requests/default-request.md) to retrieve the mail folders from iCloud.

* **Endpoint**
  
  [Mail-Endpoint](../../definitions/icloud/endpoints/mail.md)
  
* **Method:**

  `POST`
  
* **Path**

  `/wm/folder`
  
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
   
   You need to pass the dynamic parameter [[requestCounterId]](../../definitions/icloud/variables/request-counter-id.md).

* **Success Response:**

  * **Response Code:**
  
    `200`
    
    **Content:** 
    
    ```json
    {
       "jsonrpc":"2.0",
       "id":"1579346572465/3",
       "result":[
          {
             "type":"CoreMail.Folder",
             "guid":"folder:INBOX",
             "role":"INBOX",
             "name":"INBOX"
          },
          {
             "type":"CoreMail.Folder",
             "guid":"folder:/VIP",
             "name":"VIP",
             "role":"VIP"
          },
          {
             "type":"CoreMail.Folder",
             "guid":"folder:Deleted Messages",
             "role":"TRASH",
             "name":"Deleted Messages"
          },
          {
             "type":"CoreMail.Folder",
             "guid":"folder:Drafts",
             "role":"DRAFTS",
             "name":"Drafts"
          },
          {
             "type":"CoreMail.Folder",
             "guid":"folder:Sent Messages",
             "role":"SENT",
             "name":"Sent Messages"
          },
          {
             "type":"CoreMail.Folder",
             "guid":"folder:Junk",
             "role":"JUNK",
             "name":"Junk"
          },
          {
             "type":"CoreMail.Folder",
             "guid":"folder:Archive",
             "role":"ARCH",
             "name":"Archive"
          }
       ]
    }
    ```
    
    Now you need to parse the results.
 
    | Value                              | Data Type |
    |------------------------------------|-----------|
    | `response.result[n].guid`          | String    |
    | `response.result[n].name`          | String    |

* **ErrorResolver Response:**

  * **Response Code:**
  
    `(All other response codes then 200)`
    
    **Content:** 
    
    `Empty`
    
    Something went wrong.