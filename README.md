# TYPO3 SitePackage for typo3lexikon.de

Template extension for my own website

```
git clone git@github.com:froemken/typo3lexikon.git
ddev start
ddev composer install
...install/setup ssh keys...
ddev dep import-sql
```

DDEV installs its own AdditionalConfiguration.php which does not activate individual caches for Redis and APCu. Please have a look at AdditionalConfiguration.example.php and adapt the lines to your needs.
