*Get Notes*
----
  Send a request to retrieve the notes from iCloud.

* **Method:**

  `GET`
  
* **Path**

  `/notes/get_notes`
  
* **Query Parameters**
   
   `clientId`

* **Success Response:**
    
    ```json
    {
       "success":true,
       "data":{
          "notes":[
             {
                "recordName":"5bfac523-2522-352a-aa2a-e288f344e7a7",
                "createdAt":"1977-12-09T00:34:42+01:00",
                "modifiedAt":"1982-11-17T04:27:05+01:00",
                "text":"Sapiente qui veritatis quia culpa. Ut consequatur nam quia est magni.",
                "title":"Ut quis id quia vitae."
             }
          ]
       },
       "error":true
    }
    ```