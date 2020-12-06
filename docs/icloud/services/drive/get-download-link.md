*Get Download Link*
----
  Send a [request](../../definitions/requests/default-request.md) to retrieve the download link of a given document id from iCloud Drive.

* **Endpoint**
  
  [Documents-Endpoint](../../definitions/icloud/endpoints/docs.md)
  
* **Method:**

  `POST`
  
* **Path**

  `/ws/com.apple.CloudDocs/download/batch`
  
* **Query Parameters**
 
   `clientBuildNumber=1923Hotfix2`
   
   `clientMasteringNumber=1923Hotfix2`
   
   `clientId=[HMAC]`
   
   `dsid=[dsid]`
   
   `token=[token]`
   
   You need to pass the dynamic parameters [[HMAC]](../../definitions/general/types/hmac.md), [[dsid]](../../definitions/icloud/variables/session-id.md) and [[token]](../../definitions/icloud/variables/x-apple-session-token.md).

* **Payload**

  ```json
  [
     {
        "document_id":"[docwsid]"
     }
  ]
  ```
   
   You need to pass the dynamic parameter [docwsid].

* **Success Response:**

  * **Response Code:**
  
    `200`
    
    **Content:** 
    
    ```json
    [
       {
          "document_id":"8C3C0E05-FBBA-48CB-8B82-2EEE9DD923E2",
          "data_token":{
             "url":"https://cvws.icloud-content.com/B/AS65OxsHrquZjQkYOq6_If4LTFsuAcT5ChhzhX5G7ggACNZz4dP1VZJr/Gescanntes+Dokument.pdf?o=AkO8HHfCkMAzm3Rp7WczQtFs4yoldViNY7L7DXwn9J5n&v=1&x=3&a=CAogh4RyaBPXMqr0SMODTAl6qH5aIxbkvttpweQTAseNMI8SHRChtJPy-y0YwavK8vstIgEAUgQLTFsuWgT1VZJr&e=1579446080&k=VqG4R4tD75v5RuR7cH2UVw&fl=&r=fad080d4-3ba5-47b3-ba12-65bb4680f807-1&ckc=com.apple.clouddocs&ckz=com.apple.CloudDocs&p=71&s=O0Uus8Ktksr_n0w6AgZH2QwpDfc",
             "token":"CAogh4RyaBPXMqr0SMODTAl6qH5aIxbkvttpweQTAseNMI8SHRChtJPy+y0YwavK8vstIgEAUgQLTFsuWgT1VZJr",
             "signature":"AS65OxsHrquZjQkYOq6/If4LTFsu",
             "wrapping_key":"VqG4R4tD75v5RuR7cH2UVw==",
             "reference_signature":"AcT5ChhzhX5G7ggACNZz4dP1VZJr"
          },
          "thumbnail_token":{
             "url":"https://cvws.icloud-content.com/B/Abf1S88Waeh0TcyejClQn0-pxuBZAbbx63gQPisIoleueUec_426Ez_j/Gescanntes+Dokument.jpg?o=Au7Y4F_5LDX3DlITEB414K2o-zCTqsHFm6nLz9p2UUBh&v=1&x=3&a=CAogWntklRpErH7LCRIEUjaEF5pAlP0ocuB_lee6Lbn7zxsSHRCgtJPy-y0YwKvK8vstIgEAUgSpxuBZWgS6Ez_j&e=1579446080&k=tT_kAcWmXVPYEJPFzA5-hw&fl=&r=fad080d4-3ba5-47b3-ba12-65bb4680f807-1&ckc=com.apple.clouddocs&ckz=com.apple.CloudDocs&p=71&s=l2vnzpK1pHGkRLJuVkRd65pr6Ow",
             "token":"CAogWntklRpErH7LCRIEUjaEF5pAlP0ocuB/lee6Lbn7zxsSHRCgtJPy+y0YwKvK8vstIgEAUgSpxuBZWgS6Ez/j",
             "signature":"Abf1S88Waeh0TcyejClQn0+pxuBZ",
             "wrapping_key":"tT/kAcWmXVPYEJPFzA5+hw==",
             "reference_signature":"Abbx63gQPisIoleueUec/426Ez/j"
          },
          "double_etag":"i::h"
       }
    ]
    ```
    
    The download url is located at `response[0].data_token.url`.

* **ErrorResolver Response:**

  * **Response Code:**
  
    `(All other response codes then 200)`
    
    **Content:** 
    
    `Empty`
    
    Something went wrong.