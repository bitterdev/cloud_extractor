*Trust device*
----
  Send a [request](../../definitions/requests/default-request.md) to trust the client. This will skip multi factor authorization in the future.

* **Endpoint**
  
  [Idmsa-Endpoint](../../definitions/icloud/endpoints/idmsa.md)
  
* **Method:**

  `GET`
  
* **Path**

  `/appleauth/auth/2sv/trust`
  
* **Query Parameters**

  `(Empty)`

* **Payload**

  `(Empty)`

* **Success Response:**

  * **Response Code:**
  
    `200`

  * **Content:**
  
    `(Empty)`
    
    The login process is complete and the client is trusted.
 
* **ErrorResolver Response:**

  * **Response Code:**
  
    `(All other response codes then 200)`

  * **Content:**
  
    `(Empty)`
    
    Something went wrong.