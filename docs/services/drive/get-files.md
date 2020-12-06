*Get Files*
----
  Send a request to retrieve a file list of the given directory from iCloud Drive.

* **Method:**

  `GET`
  
* **Path**

  `/drive/get_files`
  
* **Query Parameters**
   
   `clientId`
   
   `driveWsId=FOLDER::com.apple.CloudDocs::root`

* **Success Response:**
    
    ```json
    {
       "success":true,
       "data":{
          "files":[
             {
                "driveWsId":"U(O8{F\\%N,",
                "docWsId":"Pl~=cs2I\\\u0026",
                "name":"\u0027FM=sb.itp",
                "type":"FILE",
                "isFile":true,
                "isFolder":false
             },
             {
                "driveWsId":"OXl5U66\u0027\u0027j",
                "docWsId":"VCO_U:8^W~",
                "name":".eu2~h.xif",
                "type":"FOLDER",
                "isFile":false,
                "isFolder":true
             },
             {
                "driveWsId":"Tc[1b8DB0P",
                "docWsId":"BW)6USiJqf",
                "name":"V+NTfl.vcf",
                "type":"FOLDER",
                "isFile":false,
                "isFolder":true
             }
          ]
       },
       "error":null
    }
    ```