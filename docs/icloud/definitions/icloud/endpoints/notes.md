*Notes-Endpoint*
----
  To get the correct endpoint for the Notes-Service you need to read out the value from `response.webservices.notes.url` of the [validate session response](../../../services/account/validate-session.md) or from the [check multi factor authentication response](../../../services/account/check-mfa.md) in case of the session is invalidated. Both responses has the same structure.
  
  If you want to ensure that the service is running you can check if the value of `response.webservices.notes.status` is `active`.