*Submit the 2-factor-code*
----
  Send a request to submitting the 2-factor-code to iCloud.

* **Method:**

  `GET`
  
* **Path**

  `/account/submit_code`
  
* **Query Parameters**
   
   `clientId`
   
   `code=123456`

* **Success Response:**
    
    ```json
    {
       "success":true,
       "data":null,
       "error":null
    }
    ```