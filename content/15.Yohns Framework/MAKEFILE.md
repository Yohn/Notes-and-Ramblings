---
created: 2024-11-05T23:13:07-05:00
modified: 2024-11-05T23:13:07-05:00
---

It seems like you're encountering an issue because the `make` command is not recognized. On Windows systems, `make` is typically not available by default. To resolve this, you can do the following:

1. **Install Make**:

   - You can install Make for Windows from the following link: GNU Make for Windows.
   - Download and install the executable file. During installation, ensure that you add Make to your system's PATH so that it can be accessed from anywhere in the command prompt.

2. **Verify Installation**:

   - After installation, open a new command prompt window and type `make --version` to verify that Make is installed correctly and accessible.

Once Make is installed and verified, you can retry running `npm run test` to execute your tests without encountering the `'make' is not recognized` error.
