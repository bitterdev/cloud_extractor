*Get Download Link*
----
  Send a request to retrieve the download link of a given document id from iCloud Drive.

* **Method:**

  `GET`
  
* **Path**

  `/drive/get_download_link`
  
* **Query Parameters**
   
   `clientId`
   
   `docWsId`

* **Success Response:**
    
    ```json
    {
       "success":true,
       "data":{
          "downloadLink":"https:\/\/lorempixel.com\/640\/480\/?25743"
       },
       "error":null
    }
    ```