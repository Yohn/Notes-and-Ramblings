---
created: 2024-10-26T01:17:54-04:00
modified: 2024-10-26T01:22:29-04:00
tags:
  - mysql
  - modify-mysql
  - information_schema
  - CHARACTER-SET
  - utf8mb4
  - utf8mb4_unicode_ci
  - TABLE_SCHEMA
  - COLUMN_SCHEMA
---

## get table info

```sql
SELECT *
FROM information_schema.COLUMNS
WHERE TABLE_SCHEMA = '2025_db_tester'
AND TABLE_NAME = 'datatypes_tweaked';
```

## convert charset type

```sql
SELECT CONCAT('ALTER TABLE `', table_name, '` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;')
FROM information_schema.tables
WHERE table_schema = 'your_database'
AND table_type = 'BASE TABLE';
```
