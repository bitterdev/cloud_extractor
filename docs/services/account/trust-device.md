*Trust device*
----
  Send a request to trust the client. This will skip multi factor authorization in the future.

* **Method:**

  `GET`
  
* **Path**

  `/account/trust_device`
  
* **Query Parameters**
   
   `clientId`

* **Success Response:**
    
    ```json
    {
       "success":true,
       "data":null,
       "error":null
    }
    ```