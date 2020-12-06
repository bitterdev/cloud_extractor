*Get Owner*
----
  Send a [request](../../definitions/requests/default-request.md) to fetch the contact card of the owner from iCloud.

* **Endpoint**
  
  [Contacts-Endpoint](../../definitions/icloud/endpoints/contacts.md)
  
* **Method:**

  `GET`
  
* **Path**

  `/co/mecard`
  
* **Query Parameters**
 
   `clientBuildNumber=1923Hotfix2`
   
   `clientMasteringNumber=1923Hotfix2`
   
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
       "meCardId":"FEC2E984-E859-4849-9283-F01722EE8C6B",
       "contacts":[
          {
             "firstName":"My",
             "lastName":"Card",
             "contactId":"FEC2E984-E859-4849-9283-F01722EE8C6B",
             "etag":"k5jhv0tn",
             "isCompany":false
          }
       ]
    }
    ```
    
    The field `response.meCardId` contains the id of the owner contact.  

* **ErrorResolver Response:**

  * **Response Code:**
  
    `(All other response codes then 200)`
    
    **Content:** 
    
    `Empty`
    
    Something went wrong.