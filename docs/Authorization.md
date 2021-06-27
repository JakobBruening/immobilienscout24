# Authorization

**API reference**: https://api.immobilienscout24.de/api-docs/import-export/attachment/overview/
<br><br>

To access the api, you have to be registered on https://api.immobilienscout24.de.

There are two ways bringing your auth keys into the code!

1. Write it into your env-File:

```dotenv
IMSC_CONSUMER_KEY=YOUR_CONSUMER_KEY
IMSC_CONSUMER_SECRET=YOUR_CONSUMER_SECRET
IMSC_TOKEN=YOUR_TOKEN
IMSC_TOKEN_SECRET=YOUR_TOKEN_SECRET
```

2. Add it in your code

````php
// set auth data
$authData = [
    'consumer_key' => 'YOUR_CONSUMER_KEY',
    'consumer_secret' => 'YOUR_CONSUMER_SECRET',
    'token' => 'YOUR_TOKEN',
    'token_secret' => 'YOUR_TOKEN_SECRET'
];

// now you can pass it to every class
$realEstate = new RealEstate($authData);
$contact = new Contact($authData);
...
````

You can find all information about the authentication system in
the [ImmoScout24 API documentation](https://api.immobilienscout24.de/api-docs/authentication/introduction/).