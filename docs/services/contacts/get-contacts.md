*Get Contacts*
----
  Send a request to fetch the contacts from iCloud.

* **Method:**

  `GET`
  
* **Path**

  `/contacts/get_contacts`
  
* **Query Parameters**
   
   `clientId`

* **Success Response:**
    
    ```json
    {
       "success":true,
       "data":{
          "contacts":[
             {
                "contactId":"edc11183-0e37-3ee6-b56b-88f9c31e02d1",
                "prefix":"Prof.",
                "suffix":"",
                "jobTitle":"eius",
                "firstName":"Bartholome",
                "middleName":"",
                "lastName":"Terry",
                "notes":"Minus vitae perspiciatis rerum repellendus.",
                "companyName":"Hagenes-Heathcote",
                "isCompany":false,
                "birthday":"1971-11-28T07:59:13+01:00",
                "phoneNumbers":[
                   {
                      "phoneNumber":"1-981-536-5432",
                      "label":"MOBILE"
                   },
                   {
                      "phoneNumber":"+1.587.378.7829",
                      "label":"IPHONE"
                   },
                   {
                      "phoneNumber":"503-295-4731 x228",
                      "label":"HOME"
                   },
                   {
                      "phoneNumber":"(389) 314-3819 x57088",
                      "label":"WORK"
                   },
                   {
                      "phoneNumber":"+1-534-788-7538",
                      "label":"MAIN"
                   },
                   {
                      "phoneNumber":"1-470-466-5926",
                      "label":"HOME FAX"
                   },
                   {
                      "phoneNumber":"(648) 479-9293 x487",
                      "label":"WORK FAX"
                   },
                   {
                      "phoneNumber":"1-498-822-3587",
                      "label":"PAGER"
                   },
                   {
                      "phoneNumber":"(635) 789-3739 x3343",
                      "label":"OTHER"
                   }
                ],
                "emailAddresses":[
                   {
                      "emailAddress":"dusty.emmerich@gmail.com",
                      "label":"WORK"
                   },
                   {
                      "emailAddress":"taya51@gmail.com",
                      "label":"HOME"
                   },
                   {
                      "emailAddress":"torp.caitlyn@dare.com",
                      "label":"OTHER"
                   }
                ]
             }
          ]
       },
       "error":null
    }
    ```