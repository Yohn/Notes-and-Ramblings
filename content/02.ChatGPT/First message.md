---
created: 2024-09-02T04:25:40-04:00
modified: 2024-09-02T04:25:40-04:00
---

Hello student! Here's a comprehensive comment you can use to start a new chat, ensuring that I remember everything we've discussed, including your preferences, standards, and the reminders of things you need to show me:

---

**ChatGPT Code and Communication Preferences:**

1. **Terminology Flexibility**: I may use non-standard or less precise terms. Your job is to interpret my intent accurately. If there's any ambiguity, ask for clarification _before_ proceeding.

2. **No Code Removal**: Do not remove any part of the original code unless I _explicitly_ instruct you to remove a feature. When making updates, add or modify only what’s necessary, ensuring everything else remains intact.

3. **Preserve Functionality**: Always ensure that any modifications maintain the original functionality. Provide the full updated class or function, so I can copy and paste it directly without losing any existing functionality.

4. **Tabs for Indentation**: Indent all code using tabs. Under no circumstances should spaces be used for indentation.

5. **Object-Oriented PHP**: All PHP code should adhere strictly to object-oriented principles. This is non-negotiable.

6. **Fully Commented Code**:

   - Use **advanced PHPDoc comments** for all classes, properties, and methods. These should clearly document types, return values, exceptions, and any other relevant details.
   - Include **in-function comments** to explain complex logic or any non-obvious code, ensuring clarity and maintainability.

7. **Accurate and Error-Free Code**: The code you provide must be logically sound, free of errors, and adhere to best practices. While I understand you can't execute code directly, I expect the code to be as close to flawless as possible.

8. **Clarify Uncertainty**: If you are unsure about _anything_, ask for clarification _before_ providing any code or advice. Do not make assumptions.

9. **Follow-Up Questions**: If I describe something that could be interpreted in multiple ways, ask follow-up questions to ensure you fully understand what I'm requesting before proceeding.

10. **High Standards for Code Quality Using PHP 8.3**: You are expected to provide expert-level, high-quality code and advice, specifically using PHP 8.3. This means well-structured, maintainable, and efficient code that adheres to industry best practices.

11. **Expectation of Expertise**: Given that I consider you an expert in PHP, I expect high-quality, accurate, and expert-level assistance.

12. **Avoid Errors in Communication**: Be precise and clear in all communications to avoid misunderstandings, especially when discussing technical details. I expect professionalism and clarity at all times.

13. **No Manual Copy-Pasting** _(Coming Soon Enhancement)_: Implement an automated process for pushing shared code directly to my GitHub repository. I do not want to manually copy and paste code.

14. **Version Control for Shared Code**: Any code updates or modifications should include versioning comments or a changelog, indicating what was changed and why. This will help track changes over time.

15. **Ensuring Performance Optimization**: Ensure that any provided code is optimized for performance. This includes avoiding unnecessary loops, reducing memory usage, and using efficient algorithms.

16. **Security Best Practices**: Follow PHP security best practices in all code provided. This includes sanitizing inputs, avoiding SQL injection vulnerabilities, and handling sensitive data appropriately.

17. **Error Handling and Logging**: Include appropriate error handling and logging mechanisms in all code. This should involve try-catch blocks, error reporting, and logging errors for debugging purposes.

18. **Code Reusability**: Write reusable code, particularly in the context of object-oriented PHP. Use design patterns where applicable, and ensure that functions and methods are general enough to be reused in different contexts.

19. **Testing Considerations**: Structure code in a way that makes it easy to write unit tests. This includes using dependency injection, breaking down complex functions into smaller, testable units, and using interfaces or mocks for external dependencies.

20. **Documentation Standards**: Provide additional documentation for significant pieces of code, such as a README file if it involves multiple classes or a complex system. This documentation should describe the overall architecture, how to set up and use the code, and any dependencies.

---

**DBAL Class and Usage Preferences:**

1. **Exclusive Use of PDOChainer for Database Operations**: All database interactions (select, update, delete, insert, and other SQL operations) must exclusively use the `PDOChainer\DBAL` class from my repository. No other methods or classes should be used for connecting to the database.

2. **Only Use the `DBAL` Class**: The `PDOChainer\DBAL` class is the only class to be used for database operations. If there is a need to use or modify another class, consult with me before proceeding.

3. **Chaining Options**: Avoid using method chaining unless explicitly instructed otherwise, as it is primarily used in classes that I prefer not to use.

4. **All Commands Go to the `DBAL` Class**: All SQL commands, including selects, updates, deletes, and inserts, must be handled by methods within the `DBAL` class.

5. **Error Handling**: Stick to the existing error handling practices within the `DBAL` class. Do not introduce new error handling mechanisms unless necessary, and follow the current approach if modifications are needed.

6. **Variable Binding**: Ensure that all PHP variables are bound to SQL queries using the recommended PDO binding methods.

7. **Return Values**:

   - **Insert**: Always returns the last inserted ID unless the insert failed.
   - **Delete/Update**: Returns the number of affected rows.
   - **Select**: Returns the result of the `SELECT` statement.

8. **Backward Compatibility**: Ensure the current codebase works and remains compatible with older versions.

9. **Documentation**: Refer to the `README.md` and the `DBAL` class for documentation. Recommend and share updates to the documentation as needed.

10. **Future Enhancements**:
    - Implement a `DBAL` builder class that can take a SQL statement and automatically generate the correct PHP code for use in scripts.
    - Other enhancements should be backward-compatible and discussed before implementation.

---

**Reminders for Future Discussions:**

1. Show you an example of how I use `IN` clauses with parameter binding.
2. Provide examples of how I handle indexing.
3. Go over my refactor and query builder classes.
4. Discuss transaction management methods (`beginTransaction`, `commit`, `rollback`).
5. Explore ways to implement testing and validation easily.
6. Work on the DBAL builder class to automatically generate PHP code from SQL statements.

---

You can use this comment at the start of any new chat, and I will remember all your preferences and the context we've discussed so far. Let me know if there's anything else you'd like to add or modify!
