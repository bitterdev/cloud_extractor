*Refresh*
----
  Send a [request](../../definitions/requests/default-request.md) to refresh to location from the find me service.

* **Endpoint**
  
  [Find-Me-Endpoint](../../definitions/icloud/endpoints/find-me.md)
  
* **Method:**

  `POST`
  
* **Path**

  `/fmipservice/client/web/refreshClient`
  
* **Query Parameters**
 
   `clientBuildNumber=1923Project36`
   
   `clientMasteringNumber=1923B31`
   
   `clientId=[HMAC]`
   
   `dsid=[dsid]`
   
   You need to pass the dynamic parameters [[HMAC]](../../definitions/general/types/hmac.md) and [[dsid]](../../definitions/icloud/variables/session-id.md).

* **Payload**

  ```json
  {
     "serverContext":"[serverContext]",
     "clientContext":{
        "appName":"iCloud Find (Web)",
        "appVersion":"2.0",
        "timezone":"[timezone]",
        "inactiveTime":1082,
        "apiVersion":"3.0",
        "deviceListVersion":1,
        "fmly":true
     }
  }
  ```
   
   You need to pass the dynamic parameters [[timezone]](../../definitions/general/types/timezone.md) and [[serverContext]](../../definitions/icloud/variables/find-me/server-context.md).

* **Success Response:**

  * **Response Code:**
  
    `200`
    
    **Content:** 
    
    ```json
    {
       "userInfo":{
          "accountFormatter":0,
          "firstName":"firstName",
          "lastName":"Lastname",
          "membersInfo":null,
          "hasMembers":false
       },
       "serverContext":{
          "minCallbackIntervalInMS":5000,
          "enable2FAFamilyActions":false,
          "preferredLanguage":"de-de",
          "lastSessionExtensionTime":null,
          "enableMapStats":true,
          "callbackIntervalInMS":2000,
          "validRegion":true,
          "timezone":{
             "currentOffset":-28800000,
             "previousTransition":1572771599999,
             "previousOffset":-25200000,
             "tzCurrentName":"Pacific Standard Time",
             "tzName":"US/Pacific"
          },
          "authToken":null,
          "maxCallbackIntervalInMS":60000,
          "classicUser":false,
          "isHSA":true,
          "trackInfoCacheDurationInSecs":86400,
          "imageBaseUrl":"https://statici.icloud.com",
          "minTrackLocThresholdInMts":100,
          "maxLocatingTime":90000,
          "sessionLifespan":900000,
          "info":"drtwu2MDGK4928Hs2cMfX7U+k62X0YOJ4eroL90d4EXXk8qMrM74dYzwbHmbpZHa",
          "prefsUpdateTime":0,
          "useAuthWidget":true,
          "clientId":"Y2xpZW50XzE3MDk3MDIzNDAwXzE1Nzk0NDE0OTcyNDg=",
          "enable2FAFamilyRemove":false,
          "serverTimestamp":1579441499842,
          "deviceImageVersion":"4",
          "macCount":0,
          "deviceLoadStatus":"200",
          "maxDeviceLoadTime":60000,
          "prsId":17097023400,
          "showSllNow":false,
          "cloudUser":true,
          "enable2FAErase":false
       },
       "alert":null,
       "userPreferences":null,
       "content":[
          {
             "msg":null,
             "canWipeAfterLock":true,
             "baUUID":"DD92D6AC-009D-473F-BFF9-E1D94B49F9D8",
             "wipeInProgress":false,
             "lostModeEnabled":false,
             "activationLocked":true,
             "passcodeLength":6,
             "deviceStatus":"200",
             "deviceColor":"1-4-0",
             "features":{
                "MSG":true,
                "LOC":true,
                "LLC":false,
                "CLK":false,
                "TEU":true,
                "LMG":false,
                "SND":true,
                "CLT":false,
                "LKL":false,
                "SVP":false,
                "LST":true,
                "LKM":false,
                "WMG":true,
                "SPN":false,
                "XRM":false,
                "PIN":false,
                "LCK":true,
                "REM":false,
                "MCS":false,
                "CWP":false,
                "KEY":false,
                "KPD":false,
                "WIP":true
             },
             "lowPowerMode":false,
             "rawDeviceModel":"iPhone12,5",
             "id":"dYgDxjNDw6CHiOuNHtutNK+yjEtFCgUMi7mxiFvihSk=",
             "remoteLock":null,
             "isLocating":false,
             "modelDisplayName":"iPhone",
             "lostTimestamp":"",
             "batteryLevel":0.6100000143051147,
             "mesg":null,
             "locationEnabled":true,
             "lockedTimestamp":null,
             "locFoundEnabled":false,
             "snd":null,
             "fmlyShare":false,
             "lostDevice":null,
             "lostModeCapable":true,
             "wipedTimestamp":null,
             "deviceDisplayName":"iPhone 11 Pro Max",
             "prsId":null,
             "audioChannels":[
    
             ],
             "locationCapable":true,
             "batteryStatus":"NotCharging",
             "trackingInfo":null,
             "name":"iPhone von firstName",
             "isMac":false,
             "thisDevice":false,
             "deviceClass":"iPhone",
             "location":{
                "isOld":false,
                "isInaccurate":false,
                "altitude":0.0,
                "positionType":"GPS",
                "latitude":50.89543626647016,
                "floorLevel":0,
                "horizontalAccuracy":7.91304209609737,
                "locationType":"",
                "timeStamp":1579441498848,
                "locationFinished":true,
                "verticalAccuracy":0.0,
                "longitude":6.900429592510515
             },
             "deviceModel":"iphone11ProMax-1-4-0",
             "maxMsgChar":160,
             "darkWake":false,
             "remoteWipe":null
          }
       ],
       "statusCode":"200"
    }
    ```
    
    Now you need to parse the results.
 
    | Value              | Data Type |
    |--------------------|-----------|
    | `response.serverContext.content.location.latitude`   | Float    |
    | `response.serverContext.content.location.longitude`   | Float    |

* **ErrorResolver Response:**

  * **Response Code:**
  
    `(All other response codes then 200)`
    
    **Content:** 
    
    `Empty`
    
    Something went wrong.