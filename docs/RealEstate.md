# Real estates

## Configure

```php
$realEstate = (new RealEstate())
  ->setPublishChannel(?string $publishChannel = null)
  ->setIncludeAttachments(bool $includeAttachments = false)
  ->setIncludeArchive(bool $includeArchive = false)
  ->setPageSize(int $pageSize = 100);
```

## Get all (or get by specific page)
**API reference**: https://api.immobilienscout24.de/api-docs/import-export/introduction/
<br><br>
```php
$realEstate->getAll(?int $page = null);
```

## Get all with details
```php
$realEstate->getAllWithDetails();
```
*We highly recommend caching this result.*

## Get a real estate by id
````php
$realEstate->getOneById();
````
