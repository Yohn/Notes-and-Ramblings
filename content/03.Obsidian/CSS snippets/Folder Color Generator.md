---
created: 2024-08-24T22:54:31-04:00
modified: 2024-08-24T22:58:03-04:00
tags:
  - obsidian
  - rainbow
  - folders
  - classes
  - stylesheet
  - snippets
  - creator
  - generator
---

```php
<?php

$colors = [
	'00' =>	'--red',        //: #e22c3c',
	'01' =>	'--red-orange', //: #e9404b',
	'02' =>	'--orange',     //: #ee6748',
	'03' =>	'--amber',      //: #fa9f50',
	'04' =>	'--yellow',     //: #ffd85e',
	'05' =>	'--lime',       //: #97e768',
	'06' =>	'--mint',       //: #52eea3',
	'07' =>	'--cyan',       //: #51e1e9',
	'08' =>	'--cool-cyan',  //: #43cfea',
	'09' =>	'--light-blue', //: #54b6f8',
	'10' =>	'--blue',       //: #437cf3',
	'11' =>	'--blue-violet',//: #6f51f4',
	'12' =>	'--violet',     //: #9446f8',
	'13' =>	'--purple',     //: #c952ed',
	'14' =>	'--magenta',    //: #e54f9b',
	'15' =>	'--hot-red',    //: #e3365e',
];

$css = <<<CSS

/* ------------------------------- 00 Prefix -------------------------------- */
.nav-folder-title[data-path^="00"] {
  color: var(--mint);
  --nav-item-color-hover: color-mix(
    in srgb,
    var(--mint) var(--fg-contrast-amount),
    var(--contrast-color)
  );
  --nav-item-background-hover: color-mix(
    in srgb,
    var(--mint) var(--bg-contrast-amount),
    transparent
  );
  --background-modifier-border-focus: color-mix(
    in srgb,
    var(--mint) 40%,
    transparent
  );
  --nav-collapse-icon-color: color-mix(in srgb, var(--mint) 60%, transparent);
}
.nav-folder-title[data-path^="00"]:hover {
  --nav-collapse-icon-color: color-mix(
    in srgb,
    var(--mint) 60%,
    var(--contrast-color)
  );
}
.tree-item-children .nav-folder:has(.nav-folder-title[data-path^="00"]) {
  --nav-indentation-guide-color: color-mix(
    in srgb,
    var(--mint) var(--medium-contrast-amount),
    transparent
  );
}
.tree-item-children
  .nav-folder:has(.nav-folder-title[data-path^="00"])
  .nav-file-title {
  color: color-mix(
    in srgb,
    var(--mint) var(--medium-contrast-amount),
    var(--default-text-color)
  );
  --nav-item-background-hover: color-mix(
    in srgb,
    color-mix(in srgb, var(--mint) 50%, var(--highlight))
      var(--bg-contrast-amount),
    transparent
  );
  --background-modifier-border-focus: color-mix(
    in srgb,
    var(--mint) 40%,
    transparent
  );
  --nav-item-background-active: color-mix(
    in srgb,
    var(--mint) var(--active-contrast-amount),
    transparent
  );
}
CSS;

$output = '';
foreach($colors as $k => $id){
	$find = [
		'00', '--mint'
	];
	$replace = [
		$k, $id
	];
	$output .= str_replace($find, $replace, $css);
}
echo $output;
?>
```
