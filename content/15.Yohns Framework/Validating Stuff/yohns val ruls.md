---
created: 2024-10-29T20:30:06-04:00
modified: 2024-10-30T01:13:25-04:00
tags:
  - validation
  - form-validate
  - database
  - rules
  - parser
  - string-parser
  - validation-parser
---

## Rules I have in my validation rules

--- start-multi-column: Validations

```column-settings
	- number of columns: 2
	- border: off
```

##### Strings

| name           | notes                            |
| -------------- | -------------------------------- |
| alpha          | only letters                     |
| alphadash      | only letters and -               |
| alphanumeric   | only letters and numbers         |
| maxlength(x)   |                                  |
| minlength(x)   |                                  |
| endswith       | alphanumeric alpha numeric or \* |
| startswith     | alphanumeric alpha numeric or \* |
| regex(pattern) |                                  |
| ip             |                                  |
| json           |                                  |
| email          |                                  |
| url            |                                  |

---

##### Lists

| name                      | notes                                                                    |
| ------------------------- | ------------------------------------------------------------------------ |
| inlist(value1,value2,...) | checking to ensure the value is in t his list                            |
| multicollection           | calls another class to check if multiple values are found in other list  |
| singlecollection          | calls another class to check if this single value is found in other list |

---

##### Others

| name                      | notes |
| ------------------------- | ----- |
| confirmed(otherfieldname) |       |
| distinct                  |       |
| nullable                  |       |
| required                  |       |

--- end-column ---

##### Ints

| name                                      | notes                                  |
| ----------------------------------------- | -------------------------------------- |
| float float(<x) float(>x) float(min><max) | < for less than, > for greater then    |
| int int(<x) int(>x) int(min><max)         | for less than, > for greater then      |
| between(min,max)                          | min int or float, and max int or float |
| boolean                                   |                                        |

---

##### Files

| name                          | notes                                                       |
| ----------------------------- | ----------------------------------------------------------- |
| maxsize(x)                    | x is the size limit in kb                                   |
| file                          | Inspect rule, this should allow the mime types like below.. |
| mime(mimetype1,mimetype2,...) | different mime types to allow. **Depreicated**              |

---

##### Dates and Times

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

--- end-multi-column
