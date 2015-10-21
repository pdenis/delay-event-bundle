delay-event-bundle
==================

[![Build Status](https://travis-ci.org/itkg/delay-event-bundle.svg?branch=master)](https://travis-ci.org/itkg/delay-event-bundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/itkg/delay-event-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/itkg/delay-event-bundle/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/itkg/delay-event-bundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/itkg/delay-event-bundle/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/4255ae9a-d8ae-43df-a4dd-6b1a51f8585c/small.png)](https://insight.sensiolabs.com/projects/4255ae9a-d8ae-43df-a4dd-6b1a51f8585c)

# About

Provide a way to delay events & process them asynchronously

# Installation

## Installation by Composer

If you use composer, add ItkgDelayEventBundle bundle as a dependency to the composer.json of your application

```json

    "require": {
        "itkg/delay-event-bundle": "dev-master"
    },

```

* Add ItkgDelayEventBundle to your application kernel.

```php

// app/AppKernel.php
<?php
    // ...
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Itkg\DelayEventBundle\ItkgDelayEventBundle(),
        );
    }

```

# Usage 

TODO
