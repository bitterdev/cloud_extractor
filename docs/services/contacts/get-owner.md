*Get Owner*
----
  Send a request to fetch the contact card of the owner from iCloud.

* **Method:**

  `GET`
  
* **Path**

  `/contacts/get_owner`
  
* **Query Parameters**
   
   `clientId`

* **Success Response:**
    
    ```json
    {
       "success":true,
       "data":{
          "owner":{
             "contactId":"dc26c911-d765-367b-bf8a-53c689e0e139",
             "prefix":"",
             "suffix":"",
             "jobTitle":"",
             "firstName":"",
             "middleName":"",
             "lastName":"",
             "notes":"",
             "companyName":"",
             "isCompany":false,
             "birthday":"2020-01-31T11:29:43+01:00",
             "phoneNumbers":[
    
             ],
             "emailAddresses":[
    
             ]
          }
       },
       "error":null
    }
    ```