---
created: 2024-09-13T11:27:36-04:00
modified: 2024-09-13T11:51:42-04:00
---

```js RunJS="{n:'Examples/Edit/Four Spaces: Insert',t:'s'}"
/**
 * Insert two spaces at the beginning of selected lines
 * 선택된 줄들의 첫 머리에 공백 두 개 넣기
 */
let view = this.app.workspace.getActiveFileView()
let editor = view?.editor

if (editor) {
  let listSelection = editor.listSelections()[0]

  let line_start
  let line_end
  if (listSelection.anchor.line > listSelection.head.line) {
    line_start = listSelection.head.line
    line_end = listSelection.anchor.line
  } else {
    line_start = listSelection.anchor.line
    line_end = listSelection.head.line
  }

  for (let line = line_start; line <= line_end; line++) {
    editor.setLine(line, "    " + editor.getLine(line))
  }
} else {
  new Notice("Error: No Editor.")
}
```

````js RunJS="{n:'Yohns/Fix CodeBlock',t:'s'}"
/**
 * Remove two spaces at the beginning of selected lines
 * 선택된 줄들의 첫 머리에 공백 두 개 지우기
 */
let view = this.app.workspace.getActiveFileView()
let editor = view?.editor

if (editor) {
  let listSelection = editor.listSelections()[0]

  let line_start
  let line_end
  if (listSelection.anchor.line > listSelection.head.line) {
    line_start = listSelection.head.line
    line_end = listSelection.anchor.line
  } else {
    line_start = listSelection.anchor.line
    line_end = listSelection.head.line
  }

  for (let line = line_start; line <= line_end; line++) {
    editor.setLine(line, editor.getLine(line).replace(/^\s{4}/, ""))
  }

  let selection = editor.getSelection()

  if (selection) {
    editor.replaceSelection("```php\n" + selection + "\n```")
  } else {
    new Notice("Error: Nothing Selected.")
  }
} else {
  new Notice("Error: No Editor.")
}
````

````js RunJS="{n:'Examples/Edit/Wrap PHP Code Block',t:'s'}"
//let view = app.workspace.getActiveViewOfType(MarkdownView);
let view = this.app.workspace.getActiveFileView()
let editor = view?.editor
if (editor) {
  let selection = editor.getSelection()

  if (selection) {
    editor.replaceSelection("```php\n" + selection + "\n```")
  } else {
    new Notice("Error: Nothing Selected.")
  }
} else {
  new Notice("Error: No Editor.")
}
````
