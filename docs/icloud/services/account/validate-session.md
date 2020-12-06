**Validate Session**
----
  Send a [request](../../definitions/requests/default-request.md) to check if the current session is valid.

* **Endpoint**
  
  [Setup-Endpoint](../../definitions/icloud/endpoints/setup.md)
  
* **Method:**

  `GET`
  
* **Path**

  `/setup/ws/1/validate`
  
* **Query Parameters**
 
   `clientBuildNumber=1923Hotfix2`
   
   `clientMasteringNumber=1923Hotfix2`
   
   `clientId=[HMAC]`
   
   You need to pass the dynamic parameter [[HMAC]](../../definitions/general/types/hmac.md).

* **Payload**

  `(Empty)`

* **Success Response:**

  * **Response Code:**
  
    `200`
    
    **Content:** 
    
    ```json
    {
       "dsInfo":{
          "lastName":"Kloppendorf",
          "iCDPEnabled":false,
          "tantorMigrated":false,
          "dsid":"17097023400",
          "hsaEnabled":true,
          "ironcadeMigrated":true,
          "locale":"de-de_DE",
          "brZoneConsolidated":false,
          "isManagedAppleID":false,
          "gilligan-invited":"true",
          "appleIdAliases":[
    
          ],
          "hsaVersion":2,
          "isPaidDeveloper":false,
          "countryCode":"DEU",
          "notificationId":"9de12dc3-4f55-4ae2-9be6-471fce215de3",
          "primaryEmailVerified":true,
          "aDsID":"000543-08-44c28cc1-9e7f-45dc-8338-cdbbd772abd9",
          "locked":false,
          "hasICloudQualifyingDevice":true,
          "primaryEmail":"markkloppendorf@icloud.com",
          "appleIdEntries":[
             {
                "isPrimary":true,
                "type":"EMAIL",
                "value":"markkloppendorf@icloud.com"
             }
          ],
          "gilligan-enabled":"true",
          "fullName":"Mark Kloppendorf",
          "languageCode":"de-de",
          "appleId":"markkloppendorf@icloud.com",
          "firstName":"Mark",
          "iCloudAppleIdAlias":"",
          "notesMigrated":true,
          "hasPaymentInfo":false,
          "pcsDeleted":false,
          "appleIdAlias":"",
          "brMigrated":true,
          "statusCode":2,
          "familyEligible":true
       },
       "hasMinimumDeviceForPhotosWeb":true,
       "iCDPEnabled":false,
       "webservices":{
          "reminders":{
             "url":"https://p71-remindersws.icloud.com:443",
             "status":"active"
          },
          "notes":{
             "url":"https://p71-notesws.icloud.com:443",
             "status":"active"
          },
          "mail":{
             "url":"https://p71-mailws.icloud.com:443",
             "status":"active"
          },
          "ckdatabasews":{
             "pcsRequired":true,
             "url":"https://p71-ckdatabasews.icloud.com:443",
             "status":"active"
          },
          "photosupload":{
             "pcsRequired":true,
             "url":"https://p71-uploadphotosws.icloud.com:443",
             "status":"active"
          },
          "photos":{
             "pcsRequired":true,
             "uploadUrl":"https://p71-uploadphotosws.icloud.com:443",
             "url":"https://p71-photosws.icloud.com:443",
             "status":"active"
          },
          "drivews":{
             "pcsRequired":true,
             "url":"https://p71-drivews.icloud.com:443",
             "status":"active"
          },
          "uploadimagews":{
             "url":"https://p71-uploadimagews.icloud.com:443",
             "status":"active"
          },
          "schoolwork":{
    
          },
          "cksharews":{
             "url":"https://p71-ckshare.icloud.com:443",
             "status":"active"
          },
          "findme":{
             "url":"https://p71-fmipweb.icloud.com:443",
             "status":"active"
          },
          "ckdeviceservice":{
             "url":"https://p71-ckdevice.icloud.com:443"
          },
          "iworkthumbnailws":{
             "url":"https://p71-iworkthumbnailws.icloud.com:443",
             "status":"active"
          },
          "calendar":{
             "url":"https://p71-calendarws.icloud.com:443",
             "status":"active"
          },
          "docws":{
             "pcsRequired":true,
             "url":"https://p71-docws.icloud.com:443",
             "status":"active"
          },
          "settings":{
             "url":"https://p71-settingsws.icloud.com:443",
             "status":"active"
          },
          "ubiquity":{
             "url":"https://p71-ubiquityws.icloud.com:443",
             "status":"active"
          },
          "streams":{
             "url":"https://p71-streams.icloud.com:443",
             "status":"active"
          },
          "keyvalue":{
             "url":"https://p71-keyvalueservice.icloud.com:443",
             "status":"active"
          },
          "archivews":{
             "url":"https://p71-archivews.icloud.com:443",
             "status":"active"
          },
          "push":{
             "url":"https://p71-pushws.icloud.com:443",
             "status":"active"
          },
          "iwmb":{
             "url":"https://p71-iwmb.icloud.com:443",
             "status":"active"
          },
          "iworkexportws":{
             "url":"https://p71-iworkexportws.icloud.com:443",
             "status":"active"
          },
          "geows":{
             "url":"https://p71-geows.icloud.com:443",
             "status":"active"
          },
          "account":{
             "iCloudEnv":{
                "shortId":"p",
                "vipSuffix":"prod"
             },
             "url":"https://p71-setup.icloud.com:443",
             "status":"active"
          },
          "fmf":{
             "url":"https://p71-fmfweb.icloud.com:443",
             "status":"active"
          },
          "contacts":{
             "url":"https://p71-contactsws.icloud.com:443",
             "status":"active"
          }
       },
       "pcsEnabled":true,
       "configBag":{
          "urls":{
             "accountCreateUI":"https://appleid.apple.com/widget/account/?widgetKey=d39ba9916b7251055b22c7f910e2ea796ee65e98b2ddecea8f5dde8d9d1a815d#!create",
             "accountLoginUI":"https://idmsa.apple.com/appleauth/auth/signin?widgetKey=d39ba9916b7251055b22c7f910e2ea796ee65e98b2ddecea8f5dde8d9d1a815d",
             "accountLogin":"https://setup.icloud.com/setup/ws/1/accountLogin",
             "accountRepairUI":"https://appleid.apple.com/widget/account/?widgetKey=d39ba9916b7251055b22c7f910e2ea796ee65e98b2ddecea8f5dde8d9d1a815d#!repair",
             "downloadICloudTerms":"https://setup.icloud.com/setup/ws/1/downloadLiteTerms",
             "repairDone":"https://setup.icloud.com/setup/ws/1/repairDone",
             "accountAuthorizeUI":"https://idmsa.apple.com/appleauth/auth/authorize/signin?client_id=d39ba9916b7251055b22c7f910e2ea796ee65e98b2ddecea8f5dde8d9d1a815d",
             "vettingUrlForEmail":"https://id.apple.com/IDMSEmailVetting/vetShareEmail",
             "accountCreate":"https://setup.icloud.com/setup/ws/1/createLiteAccount",
             "getICloudTerms":"https://setup.icloud.com/setup/ws/1/getTerms",
             "vettingUrlForPhone":"https://id.apple.com/IDMSEmailVetting/vetSharePhone"
          },
          "accountCreateEnabled":"true"
       },
       "hsaTrustedBrowser":true,
       "appsOrder":[
          "mail",
          "contacts",
          "calendar",
          "photos",
          "iclouddrive",
          "notes3",
          "reminders",
          "pages",
          "numbers",
          "keynote",
          "newspublisher",
          "fmf",
          "find",
          "settings"
       ],
       "version":2,
       "isExtendedLogin":false,
       "pcsServiceIdentitiesIncluded":true,
       "hsaChallengeRequired":false,
       "requestInfo":{
          "country":"DE",
          "timeZone":"GMT+1",
          "region":"HE"
       },
       "pcsDeleted":false,
       "iCloudInfo":{
          "SafariBookmarksHasMigratedToCloudKit":true
       },
       "apps":{
          "calendar":{
    
          },
          "reminders":{
    
          },
          "keynote":{
             "isQualifiedForBeta":true
          },
          "settings":{
             "canLaunchWithOneFactor":true
          },
          "mail":{
    
          },
          "numbers":{
             "isQualifiedForBeta":true
          },
          "photos":{
    
          },
          "pages":{
             "isQualifiedForBeta":true
          },
          "notes3":{
    
          },
          "find":{
             "canLaunchWithOneFactor":true
          },
          "iclouddrive":{
    
          },
          "newspublisher":{
             "isHidden":true
          },
          "fmf":{
    
          },
          "contacts":{
    
          }
       }
    }
    ```
    
    The session is valid.
 
* **ErrorResolver Response:**

  * **Response Code:**
  
    `(All other response codes then 200)`
    
    **Content:** 
    
    ```json
    {
       "success":false,
       "trustTokens":[
          "HSARMTKNSRVXWFla0oUY/rWDgjhApk83Gy0ZiLvtmGDJzS7csN1XXDtOv5fQclKrZVrlhAYPo2Y0A7DCspVz6mpDw3cgqFRI7Q1Nvg6NHGxFGTEaNpcJzezoOl6cRGKgvtOcLLe0SRVX"
       ],
       "requestInfo":[
          {
             "country":"DE",
             "timeZone":"GMT+1",
             "region":"HE"
          }
       ],
       "configBag":{
          "urls":{
             "accountCreateUI":"https://appleid.apple.com/widget/account/?widgetKey=d39ba9916b7251055b22c7f910e2ea796ee65e98b2ddecea8f5dde8d9d1a815d#!create",
             "accountLoginUI":"https://idmsa.apple.com/appleauth/auth/signin?widgetKey=d39ba9916b7251055b22c7f910e2ea796ee65e98b2ddecea8f5dde8d9d1a815d",
             "accountLogin":"https://setup.icloud.com/setup/ws/1/accountLogin",
             "accountRepairUI":"https://appleid.apple.com/widget/account/?widgetKey=d39ba9916b7251055b22c7f910e2ea796ee65e98b2ddecea8f5dde8d9d1a815d#!repair",
             "downloadICloudTerms":"https://setup.icloud.com/setup/ws/1/downloadLiteTerms",
             "repairDone":"https://setup.icloud.com/setup/ws/1/repairDone",
             "accountAuthorizeUI":"https://idmsa.apple.com/appleauth/auth/authorize/signin?client_id=d39ba9916b7251055b22c7f910e2ea796ee65e98b2ddecea8f5dde8d9d1a815d",
             "vettingUrlForEmail":"https://id.apple.com/IDMSEmailVetting/vetShareEmail",
             "accountCreate":"https://setup.icloud.com/setup/ws/1/createLiteAccount",
             "getICloudTerms":"https://setup.icloud.com/setup/ws/1/getTerms",
             "vettingUrlForPhone":"https://id.apple.com/IDMSEmailVetting/vetSharePhone"
          },
          "accountCreateEnabled":"true"
       },
       "error":"Missing X-APPLE-WEBAUTH-TOKEN cookie"
    }
    ```
    
    The session is invalidated. You need to [login](./login.md) again. 