*Get Reminders*
----
  Send a request to get the reminders from iCloud.
  
* **Method:**

  `GET`
  
* **Path**

  `/reminders/get_reminders`
  
* **Query Parameters**
   
   `clientId`

* **Success Response:**
    
    ```json
    {
       "success":true,
       "data":{
          "reminders":[
             {
                "dueDate":"2013-09-19T09:11:58+02:00",
                "title":"Ut quo quas et eum odio sed.",
                "description":"Nisi molestias assumenda consequatur quis eaque voluptatem dolorem. Eveniet praesentium commodi consequatur aut voluptatem magni id totam. Aut distinctio est ab omnis eligendi. Dicta dolores sed corporis consequatur consectetur sunt.",
                "priority":3
             }
          ]
       },
       "error":null
    }
    ```