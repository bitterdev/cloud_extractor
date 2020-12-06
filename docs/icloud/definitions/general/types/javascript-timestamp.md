*JavaScript Timestamp*
----
  The timestamps from iCloud are JavaScript-formatted timestamps. You need to divide them by the value 1000 to convert them to [unix timestamps](https://en.wikipedia.org/wiki/Unix_time). This is because Javascript uses milliseconds internally, while normal UNIX timestamps are usually in seconds.