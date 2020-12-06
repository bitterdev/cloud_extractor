
*Get Photos*
----
  Send a request to fetch photos and videos from the iCloud photo service.

* **Method:**

  `GET`
  
* **Path**

  `/photos/get_photos`
  
* **Query Parameters**
   
   `clientId`

* **Success Response:**
    
    ```json
    {
       "success":true,
       "data":{
          "photos":[
             {
                "name":"pj~!3H.jpg",
                "originalFileDownloadUrl":"https:\/\/lorempixel.com\/640\/480\/?67456",
                "originalFileSize":977249355,
                "thumbnailFileDownloadUrl":"https:\/\/lorempixel.com\/640\/480\/?85187",
                "thumbnailFileSize":1674038297
             }
          ]
       },
       "error":null
    }
    ```