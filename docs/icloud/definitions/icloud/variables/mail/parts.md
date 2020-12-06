*Parts*
----
  To get the parts you need to read out all message-specific part-guid's from `response.result[n].parts[m].guid` from the [get messages response](../../../../services/mail/get-messages.md).
  
  You need to build the parts array like this
  
  ```json
  [
     "messagepart:INBOX/12-2",
     "messagepart:INBOX/12-3"
  ]
  ```