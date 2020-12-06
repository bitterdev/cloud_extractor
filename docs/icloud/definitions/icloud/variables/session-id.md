*Session Id*
----
  To get the session id you need to read out the value from `response.dsInfo.dsid` of the [validate session response](../../../services/account/validate-session.md) or from the [check multi factor authentication response](../../../services/account/check-mfa.md) in case of the session is invalidated. Both responses has the same structure.