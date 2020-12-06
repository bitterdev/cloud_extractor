*Locate Friend*
----
  Send a request to locate a friend from iCloud service.

* **Method:**

  `GET`
  
* **Path**

  `/friends/locate_friend`
  
* **Query Parameters**
   
   `clientId`
   
   `friendId`

* **Success Response:**
    
    ```json
    {
       "success":true,
       "location":{
          "personId":"",
          "location":{
             "latitude":69.900357,
             "longitude":-23.432875
          }
       }
    }
    ```