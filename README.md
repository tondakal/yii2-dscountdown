Usage
================

```php
use \tondakal\widgets\Dscountdown;
echo Dscountdown::widget([
    'startDate'=>strtotime("now"),
    'endDate'=>strtotime('31.12.2015')),
    'theme'=>Dscountdown::THEME_BLACK,
    'events'=>[
        Dscountdown::EVENT_BEFORE_START=>'console.log('beforeStart')',
        Dscountdown::EVENT_CLOCKING=>'console.log('clocking')',
        Dscountdown::EVENT_FINISH=>'console.log('finish')',
    ]
])
```

Params
================

Plugin pages
================
Homepage - http://iwayanwirka.duststone.com/dscountdown/

GitHub - https://github.com/iwayanwirka/dscountdown