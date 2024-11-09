Hooks seem to look for a file to include..

```php
$Yohn->Plugable()::addHook('Route_news', 'news_display');
```

`Route_` is the prefix, and then whats next is the strong were looking for. Once that hits thats were you'll be after that `domain.com/news` and every subfolder will all be directed to the `news_display()` function.

I really need to add `class` to these tho so I dont have a bunch of `function()`s floating around..

```php
// Route for the pages fires the news_display() function
->addHook('Route_news', 'news_display');
// ajax, trigger aller, when NewsPost is the trigger
->addHook('Ajax.trigger_NewsPost', 'news_triggerNewsPost');
->addHook('Ajax.trigger_importNews', 'news_trigger_importNews');
// ajax, submitted form, going to newsPost
->addHook('Ajax.sub_newsPost', 'news_NewsSub');
->addHook('Ajax.sub_importNews', 'news_SubImport');
->addHook('Ajax.sub_removePost', 'news_removePost');
// ajax, do Imports, from fb or somewhere Idk?
->addHook('Ajax.do_Import', 'news_Imort');
// ajax, fromTabs caller / and news_fromTabs value
->addHook('Ajax.fromTabs', 'news_FromTabs');
```
