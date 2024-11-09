---
created: 2024-10-30T10:10:18-04:00
modified: 2024-10-30T12:22:43-04:00
---

## First get all foreign key restraints

```mysql
SELECT
	CONCAT('ALTER TABLE ', TABLE_NAME, ' ADD CONSTRAINT ', CONSTRAINT_NAME, ' FOREIGN KEY (', COLUMN_NAME, ') REFERENCES ', REFERENCED_TABLE_NAME, '(', REFERENCED_COLUMN_NAME, ');')
	AS add_statement
FROM
	INFORMATION_SCHEMA.KEY_COLUMN_USAGE
WHERE
	CONSTRAINT_SCHEMA = '2025_yohns_back'
	AND REFERENCED_COLUMN_NAME IS NOT NULL;
```

##### Save those results

We will need them again after we edit all the tables

## Now lets dump the restraints

```mysql
SELECT
    CONCAT('ALTER TABLE ', TABLE_NAME, ' MODIFY ', COLUMN_NAME, ' INT UNSIGNED;') AS sql_statement
FROM
    information_schema.COLUMNS
WHERE
    TABLE_SCHEMA = '2025_yohns_back'
    AND DATA_TYPE IN ('int', 'bigint', 'smallint', 'mediumint', 'tinyint')
    AND COLUMN_TYPE NOT LIKE '%unsigned%';
```

---

I dont think these did it.. the above got the queries tho

```ql
SET @sql = NULL;
SELECT
  GROUP_CONCAT(CONCAT(
    'ALTER TABLE ',
    TABLE_NAME,
    ' MODIFY COLUMN ',
    COLUMN_NAME,
    ' ',
    DATA_TYPE,
    ' UNSIGNED;'
  )
  ) INTO @sql
FROM information_schema.COLUMNS
WHERE TABLE_SCHEMA = '2025_yohns_back'
  AND DATA_TYPE LIKE 'int%';
```

```ql
SELECT
	CONCAT('ALTER TABLE ', TABLE_NAME, ' ADD CONSTRAINT ', CONSTRAINT_NAME, ' FOREIGN KEY (', COLUMN_NAME, ') REFERENCES ', REFERENCED_TABLE_NAME, '(', REFERENCED_COLUMN_NAME, ');')
	AS add_statement
FROM
	INFORMATION_SCHEMA.KEY_COLUMN_USAGE
WHERE
	CONSTRAINT_SCHEMA = '2025_yohns_back'
	AND REFERENCED_COLUMN_NAME IS NOT NULL;
```
