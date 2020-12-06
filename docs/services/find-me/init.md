*Init*
----
  Send a request to initialize the find me service.

* **Method:**

  `GET`
  
* **Path**

  `/find_me/init`
  
* **Query Parameters**
   
   `clientId`

* **Success Response:**
    
    ```json
    {
       "success":true,
       "data":{
          "location":{
             "latitude":-84.415934,
             "longitude":6.019234
          }
       },
       "error":null
    }
    ```