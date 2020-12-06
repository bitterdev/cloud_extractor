*Get Events*
----
  Send a request to fetch the events within a given date range from iCloud calendar.

* **Method:**

  `GET`
  
* **Path**

  `/events/get_events`
  
* **Query Parameters**
   
   `clientId`
   
   `from=YYYY-MM-DD`
   
   `to=YYYY-MM-DD`

* **Success Response:**
    
    ```json
    {
       "success":true,
       "data":{
          "events":[
             {
                "title":"Sunt nihil aut ut natus harum sit sed.",
                "allDay":false,
                "start":"1997-04-22T23:39:49+02:00",
                "end":"1997-04-22T23:39:49+02:00"
             }
          ]
       },
       "error":null
    }
    ```