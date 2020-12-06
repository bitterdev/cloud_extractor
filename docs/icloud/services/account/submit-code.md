*Submit the 2-factor-code*
----
  Send a [request](../../definitions/requests/default-request.md) to submitting the 2-factor-code to iCloud.

* **Endpoint**
  
  [Idmsa-Endpoint](../../definitions/icloud/endpoints/idmsa.md)
  
* **Method:**

  `POST`
  
* **Path**

  `/appleauth/auth/verify/trusteddevice/securitycode`
  
* **Query Parameters**

  `(Empty)`

* **Payload**
   
   ```json
   {
      "securityCode":{
         "code":"[code]"
      }
   }
   ```
   
   You need to pass the dynamic parameter [code].

* **Success Response:**

  * **Response Code:**
  
    `200`

  * **Content:**
  
    `(Empty)`
    
    The login process is complete. You should [trust the device](./trust-device.md) now to skip multi factor authorization for the next login.
 
* **ErrorResolver Response:**

  * **Response Code:**
  
    `(All other response codes then 200)`

  * **Content:**
  
    ```json
    {
       "service_errors":[
          {
             "code":"-21669",
             "title":"Falscher Bestätigungscode",
             "message":"Falscher Bestätigungscode"
          }
       ],
       "hasError":true
    }
    ```
    
    Something went wrong.