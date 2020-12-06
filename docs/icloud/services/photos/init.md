*Init*
----
  Send a [request](../../definitions/requests/default-request.md) to initialize the photo service.

* **Endpoint**
  
  [Database-Endpoint](../../definitions/icloud/endpoints/database.md)
  
* **Method:**

  `GET`
  
* **Path**

  `/database/1/com.apple.photos.cloud/production/private/zones/list`
  
* **Query Parameters**
 
   `clientBuildNumber=1923Hotfix3`
   
   `clientMasteringNumber=1923Hotfix3`
   
   `ckjsBuildVersion=1923ProjectDev34`
   
   `ckjsVersion=2.6.1`
   
   `remapEnums=true`
   
   `getCurrentSyncToken=true`
   
   `clientId=[HMAC]`
   
   `dsid=[dsid]`
   
   You need to pass the dynamic parameters [[HMAC]](../../definitions/general/types/hmac.md) and [[dsid]](../../definitions/icloud/variables/session-id.md).

* **Payload**

  `Empty`

* **Success Response:**

  * **Response Code:**
  
    `200`
    
    **Content:** 
    
    ```json
    {
       "zones":[
          {
             "zoneID":{
                "zoneName":"PrimarySync",
                "ownerRecordName":"_84c0953cf1f8d777d6cfbf8746cbe1df",
                "zoneType":"REGULAR_CUSTOM_ZONE"
             },
             "syncToken":"AQAAAAAAAAAWf/////////99HRncaPpJbKk54wBlO1X+",
             "atomic":true
          }
       ]
    }
    ```
    
    You find the zone in `response.zones[n].zoneID`.

* **ErrorResolver Response:**

  * **Response Code:**
  
    `(All other response codes then 200)`
    
    **Content:** 
    
    `Empty`
    
    Something went wrong.