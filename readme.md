为 PHP 类提供扩展的属性管理能力。

## 使用

使用 `composer` 添加依赖 `composer require biqiang/biphp-properties`


在类中使用 `PropertyOwner` 并在 `specs` 方法中首先属性描述：

```php
use Biphp\Properties\PropertyOwner;

class User
{
    use PropertyOwner;

    protected function specs(): array
    {
        return [
            'id'      => $this->IntegerSpec()->readOnly(),
            'name'    => $this->StringSpec(),
            'inviter' => $this->ObjectSpec()->setInstanceOf(User::class),
        ];
    }
}

```

访问定义的属性

```php
$user = new User();

// 访问只读属性
echo $user->id;

// 访问可读写属性
$user->name = 'name';
echo $user->name;
```

## 特性列表

* 为属性提供 `readOnly` 定义
* 提供属性 `manager` 定义，被定义为 `manager` 的类可以获得 `innerSet` 无视 `readOnly` 设置对属性进行修改。
* 为属性提供 `filter` 定义能力，在修改属性值前对输入值进行过滤。
* 为属性提供验证规则定义能力，在修改属性值前对输入值进行验证。
* 内置一些基础数据类型属性，提供对基础数据类型的输入检查。
* 提供属性修改监听，可以在属性被修改时执行一些回调操作。