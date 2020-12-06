*Get Reminders*
----
  Send a [request](../../definitions/requests/default-request.md) to get the reminders from iCloud.

* **Endpoint**
  
  [Reminders-Endpoint](../../definitions/icloud/endpoints/reminders.md)
  
* **Method:**

  `GET`
  
* **Path**

  `/rd/startup`
  
* **Query Parameters**
 
   `clientBuildNumber=1923Hotfix2`
   
   `clientMasteringNumber=1923B31`
   
   `lang=[lang]`
   
   `usertz=[usertz]`
   
   `clientId=[HMAC]`
   
   `dsid=[dsid]`
   
   You need to pass the dynamic parameters [[usertz]](../../definitions/general/types/timezone.md), [[lang]](../../definitions/general/types/locale.md), [[HMAC]](../../definitions/general/types/hmac.md) and [[dsid]](../../definitions/icloud/variables/session-id.md).

* **Payload**

  `Empty`

* **Success Response:**

  * **Response Code:**
  
    `200`
    
    **Content:** 
    
    ```json
    {
       "Collections":[
          {
             "title":"Erinnerungen",
             "guid":"tasks",
             "order":3,
             "color":"#b14bc9",
             "symbolicColor":"purple",
             "enabled":true,
             "ctag":"FT=-@RU=89b5000e-7763-4e73-879c-c34712cec769@S=13",
             "createdDate":[
                20200116,
                2020,
                1,
                16,
                14,
                51,
                891
             ],
             "isFamily":false,
             "completedCount":0,
             "shouldShowJunkUIWhenAppropriate":false
          }
       ],
       "Reminders":[
          {
             "guid":"CC6BD4AD-1620-4723-8546-EBDD345B79AE",
             "pGuid":"tasks",
             "etag":"C=11@U=89b5000e-7763-4e73-879c-c34712cec769",
             "lastModifiedDate":[
                20200117,
                2020,
                1,
                17,
                15,
                42,
                942
             ],
             "createdDate":[
                20200117,
                2020,
                1,
                17,
                15,
                42,
                942
             ],
             "createdDateExtended":600968578,
             "title":"Meeting",
             "dueDateIsAllDay":true,
             "startDateIsAllDay":true,
             "alarms":[
    
             ]
          },
          {
             "guid":"D4A34A3D-7AD7-404F-9069-E29043D2E53B",
             "pGuid":"tasks",
             "etag":"C=13@U=89b5000e-7763-4e73-879c-c34712cec769",
             "lastModifiedDate":[
                20200117,
                2020,
                1,
                17,
                15,
                54,
                954
             ],
             "createdDate":[
                20200117,
                2020,
                1,
                17,
                15,
                53,
                953
             ],
             "createdDateExtended":600969201,
             "priority":1,
             "title":"Test",
             "description":"Notes",
             "dueDate":[
                20200117,
                2020,
                1,
                17,
                0,
                0,
                0
             ],
             "dueDateIsAllDay":true,
             "startDate":[
                20200117,
                2020,
                1,
                17,
                0,
                0,
                0
             ],
             "startDateIsAllDay":true,
             "recurrence":{
                "guid":"D4A34A3D-7AD7-404F-9069-E29043D2E53B*MME-RID",
                "pGuid":"D4A34A3D-7AD7-404F-9069-E29043D2E53B",
                "until":[
                   20400117,
                   2040,
                   1,
                   17,
                   0,
                   0,
                   0
                ],
                "freq":"monthly",
                "interval":3,
                "recurrenceMasterStartDate":[
                   20200117,
                   2020,
                   1,
                   17,
                   0,
                   0,
                   0
                ],
                "weekStart":"MO"
             },
             "alarms":[
                {
                   "messageType":"message",
                   "pGuid":"D4A34A3D-7AD7-404F-9069-E29043D2E53B",
                   "guid":"6C1F685A-A429-4170-8FEA-61260EE6520E",
                   "isLocationBased":true,
                   "structuredLocation":{
                      "address":"Köln\\nDeutschland",
                      "title":"Köln Hauptbahnhof",
                      "latitude":"50.943320",
                      "longitude":"6.958903",
                      "radius":"273.0336925884901",
                      "referenceFrame":"1"
                   },
                   "proximity":"ARRIVE"
                }
             ]
          }
       ]
    }
    ```
    
    Now you need to parse the results.
    
    | Field                                | Data Type |
    |--------------------------------------|-----------|
    | response.Reminders[n].dueDate        | [iCloud DataTime](../../definitions/icloud/types/datetime.md)    |
    | response.Reminders[n].title          | String    |
    | response.Reminders[n].description    | String   |
    | response.Reminders[n].priority       | `1`, `2`, `3`    |
    
* **ErrorResolver Response:**

  * **Response Code:**
  
    `(All other response codes then 200)`
    
    **Content:** 
    
    `Empty`
    
    Something went wrong.