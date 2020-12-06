*Get Messages*
----
  Send a request to retrieve the messages from a given mail folders.

* **Method:**

  `GET`
  
* **Path**

  `/mail/get_messages`
  
* **Query Parameters**
   
   `clientId`
   
   `folderId`
   
   `start=1`
   
   `count=50`

* **Success Response:**
    
    ```json
    {
       "success":true,
       "data":{
          "messages":[
             {
                "guid":"50f58617-33e0-362e-8fad-4e1300d620d3",
                "longHeader":"",
                "subject":"Molestiae aut quis adipisci totam dolorem aliquid.",
                "from":[
                   "marjolaine.schoen@zboncak.com"
                ],
                "to":[
                   "sgreen@hotmail.com"
                ],
                "content":"",
                "sentDate":"2010-10-15T00:53:53+02:00",
                "unread":true,
                "parts":[
                   {
                      "guid":"70a72205-a0b4-3c13-a515-b98cd19f4fc5",
                      "type":"text\/vnd.wap.wml",
                      "content":""
                   }
                ]
             },
             {
                "guid":"cd9c2d71-c04e-34d4-aa7e-f36fd7feb893",
                "longHeader":"",
                "subject":"Inventore magni maxime id.",
                "from":[
                   "angus.bins@gmail.com"
                ],
                "to":[
                   "beier.darrion@hammes.com"
                ],
                "content":"",
                "sentDate":"2015-12-08T22:32:33+01:00",
                "unread":false,
                "parts":[
                   {
                      "guid":"f8405570-2f58-3bae-ae5b-5892a5005c5d",
                      "type":"application\/vnd.sun.xml.writer.template",
                      "content":""
                   }
                ]
             }
          ]
       },
       "error":null
    }
    ```