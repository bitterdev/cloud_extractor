*Get Friends*
----
  Send a [request](../../definitions/requests/default-request.md) to get the friends from iCloud service.

* **Endpoint**
  
  [Friends-Endpoint](../../definitions/icloud/endpoints/friends.md)
  
* **Method:**

  `POST`
  
* **Path**

  `/fmipservice/client/fmfWeb/initClient`
  
* **Query Parameters**
 
   `clientBuildNumber=1923Project40`
   
   `clientMasteringNumber=1923B31`
   
   `clientId=[HMAC]`
   
   `dsid=[dsid]`
   
   You need to pass the dynamic parameters [[HMAC]](../../definitions/general/types/hmac.md) and [[dsid]](../../definitions/icloud/variables/session-id.md).

* **Payload**

  ```json
  {
     "dataContext":null,
     "serverContext":null,
     "clientContext":{
        "productType":"fmfWeb",
        "appVersion":"1.0",
        "contextApp":"com.icloud.web.fmf",
        "userInactivityTimeInMS":903,
        "windowInFocus":false,
        "windowVisible":true,
        "mapkitAvailable":true,
        "tileServer":"Apple"
     }
  }
  ```

* **Success Response:**

  * **Response Code:**
  
    `200`
    
    **Content:** 
    
    ```json
    {
       "labelledLocations":[
    
       ],
       "devices":[
          {
             "deviceIsFencable":true,
             "name":"iPhone",
             "idsDeviceId":"",
             "id":"ZGFiNmI3OWIxYTEzMzdkNmYwZjkzMTg5NGI5YjJiOTk4ODBiYWRiZg~~",
             "autoMeCapable":false
          },
          {
             "deviceIsFencable":true,
             "name":"iPhone von Fabian Bitter",
             "idsDeviceId":"97D787C1-5089-49AE-9569-D70421A384B1",
             "id":"ZWNmNTEyYTQwNDdlODM2MjhlZTExNDY5ZTA3Nzk0ODUyMzBkNmNmOA~~",
             "autoMeCapable":false
          },
          {
             "deviceIsFencable":true,
             "name":"iPad von Fabian",
             "idsDeviceId":"4790E017-DDC2-4953-BECF-0E1BAD78EAA1",
             "id":"MGM4NGI5ZDVmYjFiOWEyYzZhNThhYTJlNzU5YjcxNWZkZmFkOWU3Mg~~",
             "autoMeCapable":false
          },
          {
             "deviceIsFencable":true,
             "name":"",
             "idsDeviceId":"",
             "id":"NDNlNGIwMGNmMjczNWZlODgyOGQ0ZGMyZTRhOGVhNzk~",
             "autoMeCapable":false
          }
       ],
       "modelVersion":"1",
       "fetchStatus":"200",
       "dataContext":{
          "11":0,
          "22":0,
          "12":0,
          "13":0,
          "18":157687723503711,
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
          "10":1579370090451
       },
       "myFencesISet":[
    
       ],
       "futureFollowing":[
    
       ],
       "contactDetails":[
    
       ],
       "prefs":{
          "allowFriendRequests":"Yes",
          "fenceNotification":"EVERYONE",
          "hideLocation":"No",
          "shouldReceiveEmails":"Yes",
          "primaryEmail":"someaccount@me.com",
          "favorites":null
       },
       "labels":[
    
       ],
       "myFencesOthersSet":[
    
       ],
       "futureFollowers":[
    
       ],
       "features":{
          "addEventFriends":true,
          "airDropOffer":true,
          "viewFollowers":true,
          "removeFriends":true,
          "removeDevice":true,
          "notifyOthers":true,
          "canChangeGeoFenceAlerts":true,
          "actOnRequest":true,
          "actOnEventRequests":true,
          "createEvent":true,
          "viewFriends":true,
          "changeMyLabel":true,
          "deleteEvent":true,
          "changeMeDevice":true,
          "changeHideLocation":true,
          "offerLocation":true,
          "editEvent":true,
          "viewEvents":true,
          "leaveEvent":true,
          "discoverContacts":true,
          "changeAllowFriendRequests":true,
          "removeEventFriends":true,
          "removeFollowers":true,
          "sendRequest":true,
          "notifyMe":true
       },
       "followers":[
          {
             "invitationSentToEmail":"+491233434",
             "expires":0,
             "expiresByGroupId":{
                "kFMFGroupIdOneToOne":0
             },
             "invitationAcceptedByEmail":"+491233434",
             "invitationId":"8dac45a4-6a17-4c1b-ad2f-cd22f467f062",
             "tkPermission":false,
             "source":"APP_OFFER",
             "onlyInEvent":false,
             "updateTimestamp":1466782460167,
             "invitationFromHandles":[
                "+494234234",
                "fssdfsdfsdf@icloud.com"
             ],
             "invitationFromEmail":"+495345345",
             "personIdHash":"7f0c7c760e668bc0cc098faf5aa9f0391c68c0f74d5adb10b074034273e517c5",
             "invitationAcceptedHandles":[
                "+491233434"
             ],
             "offerId":"",
             "personId":"10054546659",
             "id":"MTAwNTQ1NDY2NTk~"
          }
       ],
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
             "4":1579370014908
          },
          "sendMyLocation":true,
          "notificationToken":null,
          "iterationNumber":1
       },
       "discovery":{
          "lastRunStartTimestamp":1579370090452,
          "lastRunEndTimestamp":0,
          "allowed":true,
          "completed":false,
          "allowAutoTrigger":true,
          "results":[
    
          ],
          "updateTimestamp":1579370090452,
          "status":"205"
       },
       "myInfo":{
          "emails":[
             "someaccount@icloud.com",
             "someaccount@me.com"
          ],
          "firstName":"Fabian",
          "meDeviceId":"ZWNmNTEyYTQwNDdlODM2MjhlZTExNDY5ZTA3Nzk0ODUyMzBkNmNmOA~~",
          "imessageSupported":true,
          "deviceTimeStamp":0,
          "deviceId":null,
          "eligibleAutoMe":false,
          "companionDeviceId":null
       },
       "following":[
          {
             "invitationSentToEmail":"firstNameLastname@icloud.com",
             "optedNotToShare":false,
             "expires":0,
             "expiresByGroupId":{
                "kFMFGroupIdOneToOne":0
             },
             "invitationAcceptedByEmail":"firstNameLastname@icloud.com",
             "source":"APP_OFFER",
             "invitationId":"e1c32032-f5b1-48da-8606-b194ba50168d",
             "tkPermission":false,
             "onlyInEvent":false,
             "updateTimestamp":1579370014849,
             "createTimestamp":1579370014849,
             "invitationFromHandles":[
                "someaccount@me.com"
             ],
             "invitationFromEmail":"someaccount@me.com",
             "personIdHash":"19bcc9c1e1b5b9c25a0e17048a5c6a60778178435a236f6758c54dbccb3d7138",
             "invitationAcceptedHandles":[
                "firstNameLastname@icloud.com"
             ],
             "friendPrefs":null,
             "personId":"17097023400",
             "id":"MTcwOTcwMjM0MDA~"
          }
       ],
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
       "config":{
          "maxFollowers":100,
          "maxCharLimitForInviteText":140,
          "sessionLifeSpan":3600000,
          "distanceForNearbyInMeters":16093.44,
          "myLocationMaxIntervalMS":60000,
          "maxInvites":10,
          "allowMigrationV2":false,
          "maxEvents":10,
          "maxLabels":200,
          "maxMyLabelledLocations":200,
          "maxWaitTimeForRegisterMS":12000,
          "myLocationMinIntervalMS":5000,
          "locationShareExpiryDefaultInSec":21600,
          "barONOverride":true,
          "locationTTL":7200000,
          "eLGraceTimeMin":2,
          "accuracyThresholdForLabeling":100,
          "deepLocateMinGapMs":60000,
          "maxNotifyOtherFences":20,
          "userLocateWaitIntervalInMS":100,
          "maxLocatingIntervalInMS":22000,
          "maxFriends":100,
          "minAccuracyForMyLocation":500,
          "usePlaceMarkRadiusFromOSVersion":"7.0",
          "eventExpiryDefaultInSec":86400,
          "maxCharLimitForEventName":35,
          "maxCharLimitForLabelName":35,
          "familyPhotoCheckIntervalInSecs":345600,
          "maxInEvent":50,
          "maxPeopleInNotifyOtherFence":10,
          "barLocEnabled":false,
          "allowMigration":false,
          "maxFriendsLabelledLocations":200,
          "eventExpiryMaxInSec":86400,
          "maxTriesToRegisterDevice":1,
          "maxPeopleInOfferLocation":10,
          "notifyMeFenceStaleAfterMinutes":1051200
       },
       "events":[
    
       ],
       "futureEvents":[
    
       ]
    }
    ```
    
    Now you need to parse the results.
 
    | Value                              | Data Type |
    |------------------------------------|-----------|
    | `response.following[n].personId`   | String    |

* **ErrorResolver Response:**

  * **Response Code:**
  
    `(All other response codes then 200)`
    
    **Content:** 
    
    `Empty`
    
    Something went wrong.