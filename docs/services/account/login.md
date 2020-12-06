*Login*
----
  Send a request to submitting login credentials to iCloud.

* **Method:**

  `GET`
  
* **Path**

  `/account/login`
  
* **Query Parameters**
   
   `clientId`
   
   `email=example@example.com`
   
   `password=secret`

* **Success Response:**
    
    ```json
    {
       "success":true,
       "data":null,
       "error":null
    }
    ```