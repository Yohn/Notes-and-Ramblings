---
modified: 2024-10-24T21:03:24-04:00
---

filters look to be able to take an array and do something depending what the first key / args from the ()

Heres what we got

```php
$Yohn->Plugable()::addFilter('NavbarLinks', [
     'url'  => '/news/',
    'name' => l('News')
  ]
);
```

```php
$Yohn->Plugable()::addFilter('Ajax.TabLinks',[
    'url'      => '#news',
    'icon'     => 'edit',
    'txt'      => l('News'),
    'callback' => 'news_FromTabs'
  ]
);
```

Footer.addJSFiles
to add javascript files to the footer
