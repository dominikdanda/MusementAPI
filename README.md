# Musement API


#### Configuration
set the correct weatherApi's Api Key in `config.inc.php`
```
composer install
composer dump-autoload
```

#### Tests
```
phpunit
```


#### Usage (CLI)
```
php example.php
```


#### Example output
```
Processed city Amsterdam | Partly cloudy - Partly cloudy
Processed city Paris | Light rain - Overcast
Processed city Rome | Partly cloudy - Overcast
Processed city Milan | Partly cloudy - Partly cloudy
Processed city Barcelona | Partly cloudy - Partly cloudy
Processed city Nice | Partly cloudy - Sunny
Processed city Dubai | Overcast - Partly cloudy
Processed city New York | Partly cloudy - Partly cloudy
Processed city Lyon | Partly cloudy - Partly cloudy
Processed city Bordeaux | Light rain - Patchy rain possible
```


### API design

- musement-weather-api-1.0.0.json

*Endpoints:*

```
POST /api/v3/weather/{cityId}
GET /api/v3/weather/{cityId}
GET /api/v3/weather/{cityId}/{date}
PUT /api/v3/weather/{cityId}/{date}
```
