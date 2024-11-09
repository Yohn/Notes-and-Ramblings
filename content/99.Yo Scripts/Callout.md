---
created: 2024-09-03T23:52:44-04:00
modified: 2024-11-02T19:19:27-04:00
---

# Callout 0

> [!example]+

```js
//RunJS="{n:'Insert/insertCallout 0',t:'s'}"
import { insertCallout } from "Mods/Callouts"
insertCallout(this.app, 0)
```

# Callout 1

> [!note]+ Example Title Text
> Allows us to say if its foldable or not, and set title / contents

```js
//RunJS="{n:'Insert/insertCallout 1',t:'s'}"
import { insertCallout } from "Mods/Callouts"
insertCallout(this.app, 1)
```

# Callout 2

> [!question]+ Shows preview in modal
> with title and contents to be added easily, this is way better.

```js RunJS="{n:'Insert/insertCallout',t:'s'}"
import { insertCallout } from "Mods/Callouts"
insertCallout(this.app, 2)
```

# Callout 3

> [!tip]+ what chinese is this
> whoa
> After translating the text it looks the same as callout 1

```js
//RunJS="{n:'Insert/insertCallout 3',t:'s'}"
import { insertCallout } from "Mods/Callouts"
insertCallout(this.app, 3)
```
