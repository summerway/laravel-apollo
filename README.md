# Laravel Apollo integration.
用[apollo](https://github.com/ctripcorp/apollo)实现配置和语言包的统一的管理和下发

## 安装
```bash
composer require maplesnow/laravel-apollo
```

添加 serviceProvider
```php
MapleSnow\Apollo\Providers\ApolloServiceProvider::class
```

添加 facade
```php
'Apollo' => MapleSnow\Apollo\Facades\Apollo::class
```

发布 ServiceProvider
```php
php artisan vendor:publish --provider="MapleSnow\Apollo\Providers\ApolloServiceProvider"
```

配置`.env`参数
```properties
APP_ID=your app id
CLUSTER=default
APOLLO_NAMESPACES="application, common_ns, others"
APOLLO_CONFIG_SERVER=http://apollometa:8090
```

开启**Apollo**agent
```bash
php artisan apollo.start-agent
```

## 发布配置
在apollo配置中心修改配置，点击发布,项目内的.env文件将被重写。

## 发布语言包
1.添加laravel支持  
将 **app/config/app.php** 中 `Illuminate\Translation\TranslationServiceProvider` 替换成 `Kaishiyoku\Core\Translation\TranslationServiceProvider`  
2. 在apollo配置中心添加前缀为`Lang`的namespace，默认是`en` ,若需其他语言需加上后缀,[多国语言参考](https://github.com/caouecs/Laravel-lang/blob/master/Source.md)  
3. 使用`yaml`格式编写语言包
    ```yaml
    # 用户自定义
    message:
        hello: '你好 :name'
        
    # Auth 认证
    auth:
        failed: '认证失败'
    ```
4. 修改完成后，点击发布
5. 项目中的用法
```php
dd(trans("lang.message.hello",['name','mapleSnow']),trans("lang.auth.failed"));
```

## License
laravel-apollo is free software distributed under the terms of the [MIT license](https://opensource.org/licenses/MIT).