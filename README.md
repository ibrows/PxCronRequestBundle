Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require px/cron-request-bundle "~1"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Px\CronRequestBundle\PxCronRequestBundle(),
        );

        // ...
    }

    // ...
}
```

Configuration
=============

The bundle allows you to declare your adapters as services.

The configuration of the bundle is divided into two parts: the `contexts` and the `adapters`.

## Configuring the Cronjobs

``` yaml
# app/config/config.yml
px_cron_request:
  encryption_key: xST15zsayk611d0r5w8EeFv4y0A0iZyL
  cronjobs:
    - { job: 'any:command --env=prod', symfonyCommand: true,  name: 'myjob' }
    - { job: 'ping pwc-digital.ch',    symfonyCommand: false, name: 'myscript' }

```

## Configuring the routing

``` yaml
# app/config/routing.yml
px_cron_request:
    resource: "@PxCronRequestBundle/Resources/config/routing.xml"
    prefix: /
```
