*Get Message*
----
  Send a request to retrieve the message.

* **Method:**

  `GET`
  
* **Path**

  `/mail/get_message`
  
* **Query Parameters**
   
   `clientId`
   
   `messageId`
   
   `messageParts`

* **Success Response:**
    
    ```json
    {
       "success":true,
       "data":{
          "message":{
             "guid":"62cc29ff-359b-3907-b4ad-c571b8cdffed",
             "longHeader":"",
             "subject":"Dolores aliquid eum ea atque.",
             "from":[
                "ipollich@yahoo.com"
             ],
             "to":[
                "malachi56@hotmail.com"
             ],
             "content":"Possimus et voluptate quidem totam porro porro minus. Minima id temporibus cupiditate suscipit ullam quis. Occaecati rerum ut ipsam repellendus quod dolorem.",
             "sentDate":"1977-05-13T09:17:58+01:00",
             "unread":false,
             "parts":[
                {
                   "guid":"4b2a9f27-4749-36e2-ba0d-8832a5ef2392",
                   "type":"application\/vnd.openxmlformats-officedocument.presentationml.presentation",
                   "content":"Nihil dolores et nesciunt possimus vitae aut. Quia similique enim fugit facere vel. Hic qui optio deleniti rerum doloremque magnam odio porro. Voluptatem quia pariatur eaque."
                }
             ]
          }
       },
       "error":null
    }
    ```