---
created: 2024-10-30T10:17:16-04:00
modified: 2024-10-30T10:17:54-04:00
---

```ql
-- Step 1: Get a list of all tables and their columns
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
WHERE TABLE_SCHEMA = 'your_database_name'
  AND DATA_TYPE LIKE 'int%';

-- Step 2: Handle foreign key constraints
SET @fk_sql = NULL;
SELECT
  GROUP_CONCAT(CONCAT(
    'ALTER TABLE ',
    TABLE_NAME,
    ' DROP FOREIGN KEY ',
    CONSTRAINT_NAME,
    ';'
  )
  ) INTO @fk_sql
FROM information_schema.KEY_COLUMN_USAGE
WHERE CONSTRAINT_SCHEMA = 'your_database_name'
  AND REFERENCED_COLUMN_NAME IS NOT NULL;

-- Step 3: Execute the ALTER TABLE statements
IF @sql IS NOT NULL THEN
  PREPARE stmt FROM @sql;
  EXECUTE stmt;
  DEALLOCATE PREPARE stmt;
END IF;

-- Step 4: Re-add the foreign key constraints
IF @fk_sql IS NOT NULL THEN
  PREPARE stmt FROM @fk_sql;
  EXECUTE stmt;
  DEALLOCATE PREPARE stmt;
END IF;
```
