# haikoshi-gongbing
(private) Haikoshi Webspace

## Project init

```sh
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'c8b085408188070d5f52bcfe4ecfbee5f727afa458b2573b8eaaf77b3419b0bf2768dc67c86944da1544f06fa544fd47') { echo 'Installer verified'.PHP_EOL; } else { echo 'Installer corrupt'.PHP_EOL; unlink('composer-setup.php'); exit(1); }"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

## Play around with PHEditor

GitHub - pheditor/pheditor: A lightweight PHP-based file editor and manager
https://github.com/pheditor/pheditor

* easy to install, but no separate data dir and MANY/all commands in the directory tree available
* [problem with outdated assets](https://github.com/pheditor/pheditor/issues/84)
* php composer.phar create-project pheditor/pheditor
