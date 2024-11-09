---
created: 2024-10-22T00:15:21-04:00
modified: 2024-10-22T07:02:50-04:00
tags:
  - mysql
  - alter-table
  - procedure
  - convert-character-type
  - sql
---

If you want to update all tables and columns in a MySQL database to use the `utf8mb4` character set and a specific collation without manually listing each table, you can use a combination of SQL queries and scripting to automate the process.

Here's how to do it entirely within MySQL without fetching all tables explicitly:

### 1. Update the Database Default Character Set

First, ensure that the default character set for the database is set to `utf8mb4`, so any new tables and columns use it by default:

```sql
ALTER DATABASE your_database CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 2. Update All Tables and Columns Dynamically

You can use the `INFORMATION_SCHEMA` to dynamically generate `ALTER TABLE` statements for every table and text-based column in the database. The following query will generate the necessary SQL commands for each table and column.

**Steps:**

#### a. Automatically Alter All Tables

Use this SQL query to generate and run an `ALTER TABLE` command for every table, converting all tables to `utf8mb4`:

```sql
SELECT CONCAT('ALTER TABLE `', table_name, '` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;')
FROM information_schema.tables
WHERE table_schema = 'your_database'
AND table_type = 'BASE TABLE';
```

#### b. Execute Dynamically Generated SQL

After running the above query, it will generate `ALTER TABLE` commands for every table. You can manually execute the generated commands, or you can use a stored procedure to automatically execute them.

Here's an example stored procedure to do this:

```sql
DELIMITER //

CREATE PROCEDURE update_all_tables()
BEGIN
	DECLARE done INT DEFAULT 0;
	DECLARE table_name VARCHAR(255);
	DECLARE cur CURSOR FOR
		SELECT table_name
		FROM information_schema.tables
		WHERE table_schema = 'your_database' AND table_type = 'BASE TABLE';

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

	OPEN cur;

	read_loop: LOOP
		FETCH cur INTO table_name;
		IF done THEN
			LEAVE read_loop;
		END IF;

		SET @sql = CONCAT('ALTER TABLE `', table_name, '` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
		PREPARE stmt FROM @sql;
		EXECUTE stmt;
		DEALLOCATE PREPARE stmt;
	END LOOP;

	CLOSE cur;
END //

DELIMITER ;
```

Run the procedure:

```sql
CALL update_all_tables();
```

#### c. Automatically Alter All Columns

To modify every text-based column (`VARCHAR`, `TEXT`, `CHAR`, etc.) to `utf8mb4`, use this query to generate the appropriate `ALTER TABLE` statements:

```sql
SELECT CONCAT('ALTER TABLE `', table_name, '` MODIFY `', column_name, '` ', column_type,
              ' CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;')
FROM information_schema.columns
WHERE table_schema = 'your_database'
AND data_type IN ('varchar', 'text', 'char');
```

Again, you can either manually run the output or automate it using a similar stored procedure to the one above for altering columns.

#### d. Stored Procedure to Alter All Columns

If you want to automate the column conversion as well, here is another stored procedure that goes through each table and alters each text column to use `utf8mb4`:

```sql
DELIMITER //

CREATE PROCEDURE update_all_columns()
BEGIN
	DECLARE done INT DEFAULT 0;
	DECLARE tbl_name VARCHAR(255);
	DECLARE col_name VARCHAR(255);
	DECLARE col_type VARCHAR(255);
	DECLARE cur CURSOR FOR
		SELECT table_name, column_name, column_type
		FROM information_schema.columns
		WHERE table_schema = 'your_database'
		AND data_type IN ('varchar', 'text', 'char');

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

	OPEN cur;

	read_loop: LOOP
		FETCH cur INTO tbl_name, col_name, col_type;
		IF done THEN
			LEAVE read_loop;
		END IF;

		SET @sql = CONCAT('ALTER TABLE `', tbl_name, '` MODIFY `', col_name, '` ', col_type,
		                  ' CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
		PREPARE stmt FROM @sql;
		EXECUTE stmt;
		DEALLOCATE PREPARE stmt;
	END LOOP;

	CLOSE cur;
END //

DELIMITER ;
```

Run the procedure:

```sql
CALL update_all_columns();
```

### 3. Review the Changes

After updating the tables and columns, you can verify the changes by running a query on `INFORMATION_SCHEMA` to confirm the character sets and collations of your database tables:

```sql
SELECT table_name, column_name, character_set_name, collation_name
FROM information_schema.columns
WHERE table_schema = 'your_database';
```

This process will dynamically update the entire database, converting all tables and text columns to the `utf8mb4` character set and collation without requiring manual intervention.
