*Check multi factor authentication*
----
  Send a request to check if multi factor authentication for the login process is required.

* **Method:**

  `GET`
  
* **Path**

  `/account/check_mfa`
  
* **Query Parameters**
   
   `clientId`

* **Success Response:**
    
    ```json
    {
       "success":true,
       "data":{
          "requires2FA":true
       },
       "error":null
    }
    ```