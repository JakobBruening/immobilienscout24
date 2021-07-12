# OnTop placement

**API reference**: https://api.immobilienscout24.de/api-docs/import-export/ontop-placement/overview/
<br><br>

## Get all Ontop placed real estates

```php
$otPlacement = new OnTopPlacement();
$otPlacement->getAll();

// placement is "showcaseplacement" (OnTopPlacement::SHOW_CASE) by default
// but you can change that of course!
$otPlacement->setPlacement(OnTopPlacement::PREMIUM);
$otPlacement->setPlacement(OnTopPlacement::TOP);
```

## Get information about OnTop placement of real estate

```php
$otPlacement->getOneById(int $id);
```

