*Get Folders*
----
  Send a request to retrieve the mail folders from iCloud.

* **Method:**

  `GET`
  
* **Path**

  `/mail/get_folders`
  
* **Query Parameters**
   
   `clientId`

* **Success Response:**
    
    ```json
    {
       "success":true,
       "data":{
          "folders":[
             {
                "guid":"08c6c0cf-1b3a-364c-b73f-8ddb21215559",
                "name":"INBOX"
             },
             {
                "guid":"c428498a-0719-3588-8117-60c866efb5ba",
                "name":"DRAFTS"
             },
             {
                "guid":"2a0bc627-bcca-390a-84f8-7755c1f71f24",
                "name":"TRASH"
             },
             {
                "guid":"4559a10e-ca7c-3f7f-9990-ab09e88c2a57",
                "name":"SENT"
             }
          ]
       },
       "error":null
    }
    ```