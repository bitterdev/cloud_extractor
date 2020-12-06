*Get Contacts*
----
  Send a [request](../../definitions/requests/default-request.md) to fetch the contacts from iCloud.

* **Endpoint**
  
  [Contacts-Endpoint](../../definitions/icloud/endpoints/contacts.md)
  
* **Method:**

  `GET`
  
* **Path**

  `/co/startup`
  
* **Query Parameters**
 
   `clientBuildNumber=1923Hotfix2`
   
   `clientMasteringNumber=1923Hotfix2`
   
   `clientId=[HMAC]`
   
   `dsid=[dsid]`
   
   `lang=[lang]`
   
   `order=first,last`
   
   You need to pass the dynamic parameters [[HMAC]](../../definitions/general/types/hmac.md), [[dsid]](../../definitions/icloud/variables/session-id.md) and [[lang]](../../definitions/general/types/locale.md).

* **Payload**

  `Empty`

* **Success Response:**

  * **Response Code:**
  
    `200`
    
    **Content:** 
    
    ```json
    {
       "headerPositions":{
          "F":0,
          "G":1,
          "M":2
       },
       "syncToken":"HwoQEgwAAEcZWawBswAAAAEYARgAIhUIj53po6fg6vswEOeEx7Kys4meqgEoAA==",
       "contactsOrder":[
          "0E753C40-5F41-478E-9184-7CCA67E2355E",
          "1D9F939B-DF8B-42B8-B52A-44C3D1C3FE45",
          "FEC2E984-E859-4849-9283-F01722EE8C6B"
       ],
       "meCardId":"FEC2E984-E859-4849-9283-F01722EE8C6B",
       "collections":[
          {
             "groupsOrder":[
    
             ],
             "etag":"0000",
             "collectionId":"card"
          }
       ],
       "prefToken":"Zmlyc3QsbGFzdHxkZV9ERQ==",
       "groups":[
    
       ],
       "contacts":[
          {
             "birthday":"1922-01-01",
             "lastName":"Last",
             "notes":"Some Notes",
             "normalized":"first:first (spoken):middle:last:last (spoken):firstiii:company:work:private:other:custom:custom:company (spoken)",
             "prefix":"Dr.",
             "companyName":"Company",
             "jobTitle":"CEO",
             "phones":[
                {
                   "field":"mobile",
                   "label":"MOBILE"
                },
                {
                   "field":"iphone",
                   "label":"IPHONE"
                },
                {
                   "field":"private",
                   "label":"HOME"
                },
                {
                   "field":"work",
                   "label":"WORK"
                },
                {
                   "field":"default",
                   "label":"MAIN"
                },
                {
                   "field":"faxprivate",
                   "label":"HOME FAX"
                },
                {
                   "field":"faxwork",
                   "label":"WORK FAX"
                },
                {
                   "field":"pager",
                   "label":"PAGER"
                },
                {
                   "field":"other",
                   "label":"OTHER"
                },
                {
                   "field":"custom",
                   "label":"custom label"
                },
                {
                   "field":"custom2",
                   "label":"custom label 2"
                }
             ],
             "suffix":"Name suffix",
             "streetAddresses":[
                {
                   "field":{
                      "country":"Deutschland",
                      "city":"Zip",
                      "countryCode":"de",
                      "street":"Address 1\nAddress 2\nAddress 3\nAddress 4\nAddress 5\nAddress 6",
                      "postalCode":"12345"
                   },
                   "label":"WORK"
                },
                {
                   "field":{
                      "country":"Deutschland",
                      "city":"Zip",
                      "countryCode":"de",
                      "street":"Private Address 1\nPrivate Address 2",
                      "postalCode":"12345"
                   },
                   "label":"HOME"
                },
                {
                   "field":{
                      "country":"Deutschland",
                      "city":"Zip",
                      "countryCode":"de",
                      "street":"Other Address 1\nOther Address 2",
                      "postalCode":"12345"
                   },
                   "label":"OTHER"
                },
                {
                   "field":{
                      "country":"Deutschland",
                      "city":"Zip",
                      "countryCode":"de",
                      "street":"Custom Address 1\nCustom Address 2",
                      "postalCode":"12345"
                   },
                   "label":"Custom"
                }
             ],
             "IMs":[
                {
                   "field":{
                      "userName":"instant_message_private"
                   },
                   "label":"HOME"
                },
                {
                   "field":{
                      "userName":"instant_message_work"
                   },
                   "label":"WORK"
                },
                {
                   "field":{
                      "userName":"instant_message_other"
                   },
                   "label":"OTHER"
                },
                {
                   "field":{
                      "userName":"instant_message_custom"
                   },
                   "label":"custom label"
                }
             ],
             "phoneticLastName":"Last (spoken)",
             "urls":[
                {
                   "field":"http:\/\/www.example.com\/homepage",
                   "label":"HOMEPAGE"
                },
                {
                   "field":"http:\/\/www.example.com\/private",
                   "label":"HOME"
                },
                {
                   "field":"http:\/\/www.example.com\/work",
                   "label":"WORK"
                },
                {
                   "field":"http:\/\/www.example.com\/blog",
                   "label":"BLOG"
                },
                {
                   "field":"http:\/\/www.example.com\/other",
                   "label":"OTHER"
                },
                {
                   "field":"http:\/\/www.example.com\/custom",
                   "label":"custom"
                }
             ],
             "emailAddresses":[
                {
                   "field":"work",
                   "label":"WORK"
                },
                {
                   "field":"private",
                   "label":"HOME"
                },
                {
                   "field":"other",
                   "label":"OTHER"
                },
                {
                   "field":"custom",
                   "label":"custom 1"
                },
                {
                   "field":"custom",
                   "label":"custom 2"
                }
             ],
             "phoneticCompanyName":"Company (Spoken)",
             "department":"Bell Etage",
             "phoneticFirstName":"First (spoken)",
             "contactId":"0E753C40-5F41-478E-9184-7CCA67E2355E",
             "nickName":"Firstiii",
             "relatedNames":[
                {
                   "field":"farther",
                   "label":"FATHER"
                },
                {
                   "field":"mother",
                   "label":"MOTHER"
                },
                {
                   "field":"parents",
                   "label":"PARENT"
                },
                {
                   "field":"brother",
                   "label":"BROTHER"
                },
                {
                   "field":"sister",
                   "label":"SISTER"
                },
                {
                   "field":"child",
                   "label":"CHILD"
                },
                {
                   "field":"friend",
                   "label":"FRIEND"
                },
                {
                   "field":"partner",
                   "label":"SPOUSE"
                },
                {
                   "field":"partner",
                   "label":"PARTNER"
                },
                {
                   "field":"assistent",
                   "label":"ASSISTANT"
                },
                {
                   "field":"manager",
                   "label":"MANAGER"
                },
                {
                   "field":"other",
                   "label":"OTHER"
                },
                {
                   "field":"custom one",
                   "label":"custom"
                }
             ],
             "profiles":[
                {
                   "field":"http:\/\/twitter.com\/my_twitter",
                   "label":"TWITTER",
                   "user":"my_twitter"
                },
                {
                   "field":"http:\/\/facebook.com\/my_facebook",
                   "label":"FACEBOOK",
                   "user":"my_facebook"
                },
                {
                   "field":"http:\/\/www.linkedin.com\/in\/my_linkedin",
                   "label":"LINKEDIN",
                   "user":"my_linkedin"
                },
                {
                   "field":"http:\/\/www.flickr.com\/photos\/my_flickr\/",
                   "label":"FLICKR",
                   "user":"my_flickr"
                },
                {
                   "field":"http:\/\/www.myspace.com\/my_myspace",
                   "label":"MYSPACE",
                   "user":"my_myspace"
                },
                {
                   "field":"http:\/\/www.weibo.com\/n\/sina_weibo",
                   "label":"SINAWEIBO",
                   "user":"sina_weibo"
                },
                {
                   "field":"x-apple:username",
                   "label":"own"
                }
             ],
             "dates":[
                {
                   "field":"1923-01-01",
                   "label":"ANNIVERSARY"
                },
                {
                   "field":"1924-01-01",
                   "label":"OTHER"
                },
                {
                   "field":"1925-01-01",
                   "label":"Some Day"
                }
             ],
             "isCompany":false,
             "firstName":"First",
             "etag":"k5jhktet",
             "middleName":"Middle"
          },
          {
             "firstName":"Geheimer",
             "lastName":"Kontakt",
             "emailAddresses":[
                {
                   "field":"geheim@aol.com",
                   "label":"HOME"
                }
             ],
             "contactId":"1D9F939B-DF8B-42B8-B52A-44C3D1C3FE45",
             "normalized":"geheimer:::kontakt::::geheim@aol.com:",
             "phones":[
                {
                   "field":"0221 4453115",
                   "label":"HOME"
                }
             ],
             "etag":"k5hxoj7h",
             "isCompany":false
          },
          {
             "firstName":"My",
             "lastName":"Card",
             "contactId":"FEC2E984-E859-4849-9283-F01722EE8C6B",
             "normalized":"my:::card::::",
             "etag":"k5jhv0tn",
             "isCompany":false
          }
       ]
    }
    ```
    
    Now you need to parse the results.
 
    | Value                | Data Type         |
    |----------------------|-------------------|
    | `response.contacts[n].contactId`                  | String            |
    | `response.contacts[n].prefix`                  | String            |
    | `response.contacts[n].suffix`                  | String            |
    | `response.contacts[n].jobTitle`                | String            |
    | `response.contacts[n].firstName`               | String            |
    | `response.contacts[n].middleName`              | String            |
    | `response.contacts[n].lastName`                | String            |
    | `response.contacts[n].notes`                   | String            |
    | `response.contacts[n].isCompany`               | Boolean           |
    | `response.contacts[n].companyName`             | String            |
    | `response.contacts[n].emailAddresses[m].field` | String            |
    | `response.contacts[n].emailAddresses[m].label` | `WORK`, `HOME`, `OTHER` |
    | `response.contacts[n].phones[m].field`         | String            |
    | `response.contacts[n].phones[m].label`         | `MOBILE`, `IPHONE`, `HOME`, `WORK`, `MAIN`, `HOME FAX`, `WORK FAX`, `PAGER`, `OTHER` |
    | `response.contacts[n].birthday`                | [Date](../../definitions/general/types/date.md)              |

* **ErrorResolver Response:**

  * **Response Code:**
  
    `(All other response codes then 200)`
    
    **Content:** 
    
    `Empty`
    
    Something went wrong.