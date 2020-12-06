*Locate Friend*
----
  Send a [request](../../definitions/requests/default-request.md) to locate a friend from iCloud service.

* **Endpoint**
  
  [Friends-Endpoint](../../definitions/icloud/endpoints/friends.md)
  
* **Method:**

  `POST`
  
* **Path**

  `/fmipservice/client/fmfWeb/refreshClient`
  
* **Query Parameters**
 
   `clientBuildNumber=1923Project40`
   
   `clientMasteringNumber=1923B31`
   
   `clientId=[HMAC]`
   
   `dsid=[dsid]`
   
   You need to pass the dynamic parameters [[HMAC]](../../definitions/general/types/hmac.md) and [[dsid]](../../definitions/icloud/variables/session-id.md).

* **Payload**

  ```json
  {
     "dataContext":"[dataContext]",
     "serverContext":"[serverContext]",
     "clientContext":{
        "productType":"fmfWeb",
        "appVersion":"1.0",
        "contextApp":"com.icloud.web.fmf",
        "userInactivityTimeInMS":2327,
        "windowInFocus":false,
        "windowVisible":true,
        "mapkitAvailable":true,
        "tileServer":"Apple",
        "selectedFriend":"[selectedFriend]"
     }
  }
  ```
   
   You need to pass the dynamic parameters [selectedFriend], [[dataContext]](../../definitions/icloud/variables/friends/data-context.md) and [[serverContext]](../../definitions/icloud/variables/friends/server-context.md).

* **Success Response:**

  * **Response Code:**
  
    `200`
    
    **Content:** 
    
    ```json
    {
       "serverContext":{
          "minCallbackIntervalInMS":5000,
          "res":null,
          "clientId":"Y2xpZW50L2ZtZldlYn5+MTQzNjgyNjcwMn5+MTU3OTM3MDA5MDQ0Nw==",
          "showAirDropImportViewOniCloudAlert":true,
          "authToken":null,
          "maxCallbackIntervalInMS":10000,
          "prsId":1436826702,
          "callbackTimeoutIntervalInMS":0,
          "heartbeatIntervalInSec":543600,
          "transientDataContext":{
             "0":0,
             "1":0,
             "2":1,
             "3":1,
             "4":1579370599842
          },
          "sendMyLocation":true,
          "notificationToken":null,
          "iterationNumber":38
       },
       "modelVersion":"1",
       "fetchStatus":"200",
       "discovery":{
          "lastRunStartTimestamp":1579370617294,
          "lastRunEndTimestamp":0,
          "allowed":false,
          "completed":false,
          "allowAutoTrigger":false,
          "results":[
    
          ],
          "updateTimestamp":1579370617294,
          "status":"205"
       },
       "dataContext":{
          "11":0,
          "22":0,
          "12":0,
          "13":0,
          "18":157937059644100,
          "19":1,
          "0":1579370014849,
          "1":1466782460167,
          "2":0,
          "5":0,
          "6":33,
          "8":1546718875554,
          "9":"3FA7E0067784BF399556D3B948DF4CA4",
          "20":0,
          "21":0,
          "10":1579370617292
       },
       "locations":[
          {
             "locationStatus":null,
             "location":{
                "isInaccurate":false,
                "altitude":0.0,
                "address":{
                   "formattedAddressLines":[
                      "Address",
                      "ZIP City",
                      "Deutschland"
                   ],
                   "country":"Deutschland",
                   "streetName":"Streetname",
                   "streetAddress":"Streetaddress",
                   "countryCode":"DE",
                   "locality":"City",
                   "administrativeArea":"State"
                },
                "locSource":null,
                "latitude":50.89548481457377,
                "floorLevel":0,
                "horizontalAccuracy":65.0,
                "labels":[
    
                ],
                "tempLangForAddrAndPremises":null,
                "verticalAccuracy":10.0,
                "batteryStatus":null,
                "locationId":"7165df8d-0d6c-4a05-a07c-b4254564a6f1",
                "locationTimestamp":0,
                "longitude":6.900793798080435,
                "timestamp":1579369995893
             },
             "id":"MTcwOTcwMjM0MDA~",
             "status":null
          }
       ],
       "locateInProgress":[
          {
             "id":"MTcwOTcwMjM0MDA~",
             "status":"none"
          }
       ],
       "contactDetails":[
    
       ]
    }
    ```
    
    Now you need to parse the results.
 
    | Value                                        | Data Type |
    |----------------------------------------------|-----------|
    | `response.locations[n].location.latitude`    | Float     |
    | `response.locations[n].location.longitude`   | Float     |
    | `response.locations[n].id`                   | String    |

* **ErrorResolver Response:**

  * **Response Code:**
  
    `(All other response codes then 200)`
    
    **Content:** 
    
    `Empty`
    
    Something went wrong.