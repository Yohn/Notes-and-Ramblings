---
created: 2024-09-06T05:14:09-04:00
modified: 2024-09-06T05:16:23-04:00
tags:
  - laravel
  - laravel11
  - docs
  - Documentation
---

> [!info]+ VSCode Find n Replace
> To fix the links at the top of the files to point to the sections within the note

###### Find

    \[(.+?)\]\(#.+?\)

###### Replace with:

    [$1](<#$1>)
