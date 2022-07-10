## Volteric Cloud PHP Wrapper
Welcome to the home of the Volteric Cloud API PHP wrapper, our in-house development team maintains this for public use.

In order to get started, you need to download the `VoltericCloud.php` file and require it in your desired file. 
To initialize a session, take a look below:

```php
require('VoltericCloud.php');
$api_id = "YOUR_API_ID";
$api_token = "YOUR_API_TOKEN";

$volteric = new VoltericCloud();
$volteric->login($api_id, $api_token);
```

Once the session has been initialized, you can use the `$volteric` variable as you would with our [API](https://docs.volteric.cloud) making sure you remove the `/v1` from your request.
Feel free to reach out to us at **admin@tomas.systems** if you run into any problems.
