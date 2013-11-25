yii-passfield
=============
Yii widget for PassField (http://antelle.github.com/passfield)
demo - http://antelle.github.com/passfield/demo.html

Using
==
```php
$this->widget('ext.passfield.PassFieldWidget', array(
    'attribute' => 'field',
    'name' => 'input',
    'options'=>array(
        'isMasked'=>true,
        'showGenerate'=>false
    ),
));
