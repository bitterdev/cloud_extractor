*Continuation Marker*
----
  The iCloud API is build on top of CloudKit. In CloudKit there are continuation marker used if you want to retrieve multiple batches of records. If there are more records to load the response will return you a `continuationMarker`. This marker you need to add in your next request to retrieve the next batch of records. If you are sending the first request set the marker to `null`. 
  
  [Click here](https://developer.apple.com/library/archive/documentation/DataManagement/Conceptual/CloudKitWebServicesReference/QueryingRecords.html) to get advanced information about continuation markers.