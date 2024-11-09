---
created: 2024-10-12T01:14:28-04:00
modified: 2024-11-04T19:58:37-05:00
tags:
  - ESLint
  - errors
  - vscode
  - error-handler
---

## Disabling the Errors

> [!hint]+ Recommended Way
> The most common and recommended approach is using `// eslint-disable-next-line` as it's explicit about which line you're disabling and can be specific about which rule you're disabling.

###### Disable a function saying error

```javascript
function someName() {
  // eslint-disable-line no-unused-vars
  // code
}
```

###### Disable class being unknown

Put this at the very top of the file

```javascript
/* global bootstrap:readonly, iModal:readonly, Sortable:readonly, Iconpicker:readonly */
```

where `bootstrap` `iModal` `Sortable` and `Iconpicker` were the classes used in the file

###### Disable ESLint for a single line

```js
// eslint-disable-next-line
const someCode = "that would trigger a warning"
```

###### Disable a specific rule for one line

```js
// eslint-disable-next-line no-unused-vars
const unusedVariable = "something"
```

###### Disable multiple rules for one line

```js
// eslint-disable-next-line no-unused-vars, no-empty
const anotherUnused = ""
```

###### Disable ESLint for a block of code

```js
/* eslint-disable */
const someCode = "disabled"
const moreCode = "still disabled"
/* eslint-enable */
```

###### Disable specific rules for a block

```js
/* eslint-disable no-unused-vars, no-empty */
const someUnusedVar = ""
const anotherOne = ""
/* eslint-enable no-unused-vars, no-empty */
```

###### Disable ESLint for entire file (put at top of file)

```js
/* eslint-disable */
```

###### Disable specific rule for entire file (put at top of file)

```js
/* eslint-disable no-unused-vars */
```

---

## Disable in eslint configs

> Yes, you can exclude files or directories from ESLint in your ESLint configuration file. There are a few ways to do this:

1. Using `.eslintignore` file (similar to .gitignore):

```text
dist/*
build/*
node_modules/*
*.min.js
specific-file.js
```

2. In your ESLint config file (`.eslintrc.js`, `.eslintrc.json`, etc):

```javascript
module.exports = {
  // ...other config
  ignorePatterns: ["dist/*", "build/*", "*.min.js", "specific-file.js"],
}
```

3. In your `package.json`:

```json
{
  "eslintConfig": {
    "ignorePatterns": ["dist/*", "build/*", "*.min.js", "specific-file.js"]
  }
}
```

You can use glob patterns like:

- `**/vendor/*.js` - ignore all .js files in vendor folders
- `*.test.js` - ignore all test files
- `!important.js` - negative pattern (don't ignore this file)

The `.eslintignore` file is generally considered the cleanest approach since it keeps your ignore patterns separate from your configuration.
