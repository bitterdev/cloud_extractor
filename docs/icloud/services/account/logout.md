*Logout*
----
  Send a [request](../../definitions/requests/default-request.md) to logout from iCloud.

* **Endpoint**
  
  [Setup-Endpoint](../../definitions/icloud/endpoints/setup.md)
  
* **Method:**

  `POST`
  
* **Path**

  `/setup/ws/1/logout`
  
* **Query Parameters**

   `clientBuildNumber=1923Hotfix2`
   
   `clientMasteringNumber=1923Hotfix2`
   
   `clientId=[HMAC]`
   
   `dsid=[dsid]`
   
   You need to pass the dynamic parameter [[HMAC]](../../definitions/general/types/hmac.md) and [[dsid]](../../definitions/icloud/variables/session-id.md).

* **Payload**

  ```json
  {
     "trustBrowser":false,
     "allBrowsers":false
  }
  ```

* **Success Response:**

  * **Response Code:**
  
    `200`
    
    **Content:** 

    `(Empty)`
    
    You are successfully logged out from iCloud. 
 
* **ErrorResolver Response:**

  * **Response Code:**
  
    `(All other response codes then 200)`
    
    **Content:** 

    `(Empty)`
    
    Something went wrong.