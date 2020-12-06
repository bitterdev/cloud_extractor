*Get Friends*
----
  Send a request to get the friends from iCloud service.

* **Method:**

  `GET`
  
* **Path**

  `/friends/get_friends`
  
* **Query Parameters**
   
   `clientId`

* **Success Response:**
    
    ```json
    {
       "success":true,
       "data":{
          "friends":[
             {
                "personId":"",
                "location":{
                   "latitude":-34.028525,
                   "longitude":-112.922729
                }
             }
          ]
       },
       "error":null
    }
    ```