## Fix 500: INTERNAL SERVER ERROR

### at /vendor/guzzlehttp/guzzle/http/src/Handler/CurlFactory.php

Change from this

```
$conf[\CURLOPT_SSL_VERIFYHOST] = 2;
$conf[\CURLOPT_SSL_VERIFYPEER] = true;
```

To this

```
$conf[\CURLOPT_SSL_VERIFYHOST] = 0;
$conf[\CURLOPT_SSL_VERIFYPEER] = false;
```
