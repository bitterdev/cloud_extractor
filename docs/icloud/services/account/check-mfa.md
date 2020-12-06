*Check multi factor authentication*
----
  Send a [request](../../definitions/requests/default-request.md) to check if multi factor authentication for the login process is required.

* **Endpoint**
  
  [Setup-Endpoint](../../definitions/icloud/endpoints/setup.md)
  
* **Method:**

  `POST`
  
* **Path**

  `/setup/ws/1/accountLogin`
  
* **Query Parameters**
 
   `clientBuildNumber=1923Hotfix2`
   
   `clientMasteringNumber=1923Hotfix2`
   
   `clientId=[HMAC]`
   
   You need to pass the dynamic parameter [[HMAC]](../../definitions/general/types/hmac.md).

* **Payload**

  ```json
  {
     "dsWebAuthToken":"[dsWebAuthToken]",
     "accountCountryCode":"[countryCode]",
     "extended_login":false
  }
  ```
   
   You need to pass the dynamic parameters [[countryCode]](../../definitions/general/types/country-code.md), [[dsWebAuthToken]](../../definitions/icloud/variables/x-apple-session-token.md).

* **Success Response:**

  * **Response Code:**
  
    `200`
    
    **Content:** 
    
    ```json
    {
       "dsInfo":{
          "lastName":"Lastname",
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
          "notificationId":"550ee52a-4380-4bc2-81ef-6ff19fa6249d",
          "primaryEmailVerified":true,
          "aDsID":"000543-08-44c28cc1-9e7f-45dc-8338-cdbbd772abd9",
          "locked":false,
          "hasICloudQualifyingDevice":true,
          "primaryEmail":"username@icloud.com",
          "appleIdEntries":[
             {
                "isPrimary":true,
                "type":"EMAIL",
                "value":"username@icloud.com"
             }
          ],
          "gilligan-enabled":"true",
          "fullName":"Mark Lastname",
          "languageCode":"de-de",
          "appleId":"username@icloud.com",
          "Mark":"Mark",
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
       "hsaTrustedBrowser":false,
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
       "pcsServiceIdentitiesIncluded":false,
       "hsaChallengeRequired":true,
       "requestInfo":{
          "country":"DE",
          "timeZone":"GMT+1",
          "region":"HE"
       },
       "pcsDeleted":false,
       "iCloudInfo":{
          "SafariBookMarksHasMigratedToCloudKit":true
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
    
    If `response.hsaChallengeRequired` is set to `true` you need to [submit the 2-factor-code](./submit-code.md) which was send in the background by the iCloud server while executing this request. 
 
* **ErrorResolver Response:**

  * **Response Code:**
  
    `(All other response codes then 200)`
    
  * **Content:**
  
    `(Empty)`
    
    Something went wrong.