# Attachments
**API reference**: https://api.immobilienscout24.de/api-docs/import-export/attachment/overview/
<br><br>

## Get all attachments

To get all attachments, you need to pass a real estate id.

```php
$attachment = new Attachments();
$attachment->getAllByRealEstate(int $id);
```

## Get a specific attachments
```php
$attachment->getOneById(int $realEstateId, int $id);
```

## Get visible contacts
Get all contacts, that are visible on the profile page
```php
$attachment->getVisibleContacts(int $realEstateId, int $id);
```