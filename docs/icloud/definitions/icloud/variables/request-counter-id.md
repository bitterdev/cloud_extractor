*HttpClient Counter Id*
----
  The request counter id is build by JavaScript Timestamp + "/" + a counter for each request. Remember that JavaScript Timestamps needs to be multiplied by 1000 from an unix timestamp. The counter needs to be incremented after each request and is beginning with 1.
  
  Here is the original JavaScript code of id generation:
  
  ```
  id = r.getTime() + "/" + this._recentsReqCount++
  ```