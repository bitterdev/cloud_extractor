*Login*
----
  Send a [request](../../definitions/requests/default-request.md) to submitting login credentials to iCloud.

* **Endpoint**
  
  [Idmsa-Endpoint](../../definitions/icloud/endpoints/idmsa.md)
  
* **Method:**

  `POST`
  
* **Path**

  `/appleauth/auth/signin`
  
* **Query Parameters**

  `(Empty)`

* **Payload**

  ```json
  {
     "accountName":"[username]",
     "rememberMe":false,
     "password":"[password]",
     "trustTokens":[
        "[trustToken]"
     ]
  }
  ```
   
   You need to pass the dynamic parameters [username], [password], [[trustToken]](../../definitions/icloud/variables/trust-token.md).

* **Success Response:**

  * **Response Code:**
  
    `200`
    
    **Content:** 
    
    ```json
    {
      "authType" : "hsa2"
    }
    ```
    
    Now you need to check if [multi factor authentication](./check-mfa.md) is required to continue with the login process. 
 
* **ErrorResolver Response:**

  * **Response Code:**
  
    `(All other response codes then 200)`
    
    **Content:** 
    
    ```json
    {
       "serviceErrors":[
          {
             "code":"-20209",
             "message":"Diese Apple-ID wurde aus Sicherheitsgründen deaktiviert. Du kannst deinen Account mit iForgot zurücksetzen (http://iforgot.apple.com)."
          }
       ]
    }
    ```
    
    Something went wrong.