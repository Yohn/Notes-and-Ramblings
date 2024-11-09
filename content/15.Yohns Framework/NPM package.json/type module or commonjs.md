---
created: 2024-11-03T18:55:19-05:00
modified: 2024-11-07T22:32:14-05:00
tags:
  - npm
  - module
  - commonjs
  - import
  - require
  - javascript
---

### Whats Allowed

The `"type"` field in `package.json` currently only accepts two values recognized by Node.js:

```json
{"type": "module"}
// vs
{"type": "commonjs"}
```

### Explanation of Each `"type"` Value with Examples

#### 1\. `"type": "module"`

- **Description**: When `"type": "module"` is specified, `.js` files are treated as ES modules by default. To use CommonJS syntax, files should have a `.cjs` extension.
- **Usage**: This type allows for ES module imports and exports, uses `import` and `export` syntax, and requires asynchronous dynamic imports.

**Example usage**:

```json
{
  "name": "my-esm-package",
  "type": "module"
}
```

- **ES Module File (`index.js`)**:

  ```javascript
  // index.js (treated as ES module)
  import { myFunction } from "./utils.js"
  export const myValue = 42
  ```

- **CommonJS File (`utils.cjs`)**:

  ```javascript
  // utils.cjs (treated as CommonJS)
  module.exports = {
    myFunction: () => console.log("Hello from CommonJS!"),
  }
  ```

- **Example Usage**:

  ```javascript
  import { myValue } from "./index.js" // Works with ES module syntax
  const { myFunction } = require("./utils.cjs") // Works with CommonJS syntax
  ```

#### 2\. `"type": "commonjs"`

- **Description**: When `"type": "commonjs"` is specified (or if `"type"` is omitted, as CommonJS is the default), `.js` files are treated as CommonJS modules. To use ES module syntax, files should have a `.mjs` extension.
- **Usage**: This type allows for CommonJS `require` syntax, synchronous `require` imports, and uses `module.exports` for exports.

**Example usage**:

```json
{
  "name": "my-commonjs-package",
  "type": "commonjs"
}
```

- **CommonJS File (`index.js`)**:

  ```javascript
  // index.js (treated as CommonJS)
  const { myFunction } = require("./utils.js")
  module.exports.myValue = 42
  ```

- **ES Module File (`utils.mjs`)**:

  ```javascript
  // utils.mjs (treated as ES module)
  export const myFunction = () => console.log("Hello from ES Module!")
  ```

- **Example Usage**:

  ```javascript
  const { myValue } = require("./index.js") // Works with CommonJS syntax
  import { myFunction } from "./utils.mjs" // Works with ES module syntax
  ```

### Summary Table of Differences

| `"type"` Value | Default `.js` Type | ES Module Extensions | CommonJS Extensions | Use Case                            |
| -------------- | ------------------ | -------------------- | ------------------- | ----------------------------------- |
| `"module"`     | ES Module          | `.js`, `.mjs`        | `.cjs`              | Projects primarily using ES modules |
| `"commonjs"`   | CommonJS           | `.mjs`               | `.js`, `.cjs`       | Projects primarily using CommonJS   |

### When to Choose Each Type

- **Use `"type": "module"`** if:
  - You are writing modern JavaScript projects that primarily use ES module syntax (`import`/`export`).
  - You want `.js` files to default to ES modules and `.cjs` files to handle any legacy CommonJS code.
- **Use `"type": "commonjs"`** if:
  - You are working in a legacy codebase or primarily need `require` and `module.exports`.
  - You prefer `.js` files to default to CommonJS, with `.mjs` for ES modules where needed.

---

> [!question]- How to use both?
> Is there a way I can use both import and require?

Yes, you can use both `import` and `require()` in a Node.js project, but it requires a few specific configurations due to the differences between ES modules and CommonJS. Here are some ways to work with both:

### 1. Set `"type": "module"` and Use Dynamic `import()` for CommonJS Files

If you set `"type": "module"` in your `package.json`, `.js` files will be treated as ES modules. In this setup, you can still use CommonJS modules, but you'll need to load them dynamically with `import()`.

##### Example setup:

```json
{
  "type": "module"
}
```

- **For ES module files**: Use `import` and `export` syntax as usual.
- **For CommonJS files**: Use `import()` as a dynamic import to load them conditionally.

#### Example code:

```js
// main.js (ES module, due to "type": "module")
import { myFunc } from "./myModule.js" // Static import for ES modules
const commonJSModule = await import("./commonjsModule.cjs") // Dynamic import for CommonJS  myFunc();
commonJSModule.default()
```

### 2. Use `"type": "commonjs"` and Use `import()` for ES Modules

If you set `"type": "commonjs"` in your `package.json`, `.js` files will be treated as CommonJS by default, allowing you to use `require()`. To import ES modules, use `import()` dynamically.

**Example setup:**

```json
{
  "type": "commonjs"
}
```

- **For CommonJS files**: Use `require()` as usual.
- **For ES module files**: Use `import()` to load `.mjs` files dynamically.

##### Example code:

```js
// main.js (CommonJS module, due to "type": "commonjs")
const { myFunc } = require("./myCommonJSModule.js")
// CommonJS
require(async () => {
  const esModule = await import("./myESModule.mjs") // Dynamic import for ES module
  esModule.default()
})()
```

### 3. Use `.cjs` and `.mjs` Extensions with No `"type"` Field

If you omit the `"type"` field from `package.json`, you can differentiate modules by file extension:

- `.mjs` for ES modules
- `.cjs` for CommonJS modules

##### Example file structure:

- `index.mjs` (ES module)
- `helper.cjs` (CommonJS module)

##### Example usage in `index.mjs`:

```js
import { myFunc } from './anotherESModule.mjs';
const helper = require('./helper.cjs'); // Allowed since helper.cjs is CommonJS
myFunc(); helper.default();`
```

### 4. Use Babel or Webpack for Mixed Projects

If you need both ES modules and CommonJS in a larger project or front-end application, a bundler like Webpack or a transpiler like Babel can help unify the syntax, allowing you to freely mix `import`/`export` and `require()`/`module.exports`.
