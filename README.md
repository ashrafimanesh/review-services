

## Test Project to review and vote products

The project has 5 services under `/services` folder and each related services can call each other with `Facade` pattern.

##### Example:
To check user has bought product to insert comment or vote in `Review` service.
```php
 Shop::hasBought($productKey, $userKey)
```

#### Installation

```composer
composer install
```
```
php artisan migrate
```

