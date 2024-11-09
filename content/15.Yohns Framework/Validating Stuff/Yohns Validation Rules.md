---
created: 2024-10-29T20:10:36-04:00
modified: 2024-10-29T20:27:15-04:00
tags:
  - yohns
  - validation
  - rules
  - form-validate
  - validation-parser
  - database
  - schema
---

## Rules I have in my validation rules

###### Strings

| name           | notes |
| -------------- | ----- |
| alpha          |       |
| alphadash      |       |
| alphanumeric   |       |
| maxlength(x)   |       |
| minlength(x)   |       |
| regex(pattern) |       |
| ip             |       |
| json           |       |
| email          |       |
| url            |       |

###### Others

| name                      | notes |
| ------------------------- | ----- |
| confirmed(otherfieldname) |       |
| distinct                  |       |
| nullable                  |       |
| required                  |       |

###### Lists

| name                      | notes |
| ------------------------- | ----- |
| inlist(value1,value2,...) |       |
| multicollection           |       |
| singlecollection          |       |

###### Ints

| name                                      | notes |
| ----------------------------------------- | ----- |
| float float(<x) float(>x) float(min><max) |       |
| int int(<x) int(>x) int(min><max)         |       |
| between(min,max)                          |       |
| boolean                                   |       |

###### Files

| name                          | notes                                                       |
| ----------------------------- | ----------------------------------------------------------- |
| maxsize(x)                    | x is the size limit in kb                                   |
| file                          | Inspect rule, this should allow the mime types like below.. |
| mime(mimetype1,mimetype2,...) |                                                             |

###### Dates and Times

| name                                            | notes |
| ----------------------------------------------- | ----- |
| afterdate (yyyy-mm-dd)                          |       |
| afterdatetime(yyyy-mm-dd hh:mm:ss)              |       |
| aftertime(hh:mm:ss)                             |       |
| age(>=x) age(>x) age(=x) age(<x) age(<=x)       |       |
| beforedate(yyyy-mm-dd)                          |       |
| beforedatetime (yyyy-mm-dd hh:mm:ss)            |       |
| beforetime (hh:mm:ss)                           |       |
| date                                            |       |
| datetime                                        |       |
| time                                            |       |
| withindaterange (startdate,enddate)             |       |
| withindatetimerange (startdatetime,enddatetime) |       |
| withintimerange (starttime,endtime)             |       |
| year                                            |       |
