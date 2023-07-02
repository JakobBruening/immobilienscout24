# Authorization

**API reference**: https://api.immobilienscout24.de/api-docs/authentication/three-legged/
<br><br>

To access the api, you have to be registered on https://api.immobilienscout24.de.
<br>
You can then request a permanent token using Consumer Key & Secret to authenticate your account. An example of how to
get this token can be found here: https://api.immobilienscout24.de/api-docs/postman/postman-collections/. This package
only supports authentication via three-legged oAuth, as authentication via three-legged oAuth is required for user
endpoints.

There are two ways bringing your auth keys into the code!

1. Write it into your env-file:

```dotenv
IMSC_CONSUMER_KEY=YOUR_CONSUMER_KEY
IMSC_CONSUMER_SECRET=YOUR_CONSUMER_SECRET
IMSC_TOKEN=YOUR_TOKEN
IMSC_TOKEN_SECRET=YOUR_TOKEN_SECRET
```

2. Add it to your code

```php
// set auth data
$authData = [
    'consumer_key'      => 'YOUR_CONSUMER_KEY',
    'consumer_secret'   => 'YOUR_CONSUMER_SECRET',
    'token'             => 'YOUR_TOKEN',
    'token_secret'      => 'YOUR_TOKEN_SECRET'
];

// now you can pass it to every class
$realEstate = new RealEstate($authData);
$contact = new Contact($authData);
...
```

You can find all information about the authentication system in
the [ImmoScout24 API documentation](https://api.immobilienscout24.de/api-docs/authentication/introduction/).

<hr>

### Change the user

You can also pass a custom user. 
The username must be he username which the user uses for logging in to www.immobilienscout24.
You can configure the user either via .env-file

```dotenv
IMSC_USERNAME=yourusername
```

or by passing it to the class constructor

```php
// with auth data
$realEstate = new RealEstate($authData, 'yourusername');

// without auth data
$contact = new RealEstate(null, 'yourusername');
```

Per default, the username is set to "me" (the profile that created the auth data).
<br>
**Important**: Keep in mind, that additional users must be authenticated via oAuth!
