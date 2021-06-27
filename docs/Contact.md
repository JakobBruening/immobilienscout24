# Contact
**API reference**: https://api.immobilienscout24.de/api-docs/import-export/contact/overview/
<br><br>

## Get all contacts
```php
$contact = new Contact();
$contact->getAll();
```

## Get a specific contact
```php
$contact->getOneById(int $id, bool $external = false);
```

