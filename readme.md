# BigBanging your li3 Applications 

![Laboratory](http://i.imgur.com/08Omtoe.png)

## Requirement !

This library requires the [lithium unofficial library](https://github.com/jails/lithium).

## Installation

```
git clone https://github.com/jails/li3_bigbang myapp
cd myapp
composer install
chmod -R 777 atoms/app/resources
chmod -R 777 atoms/admin/resources
```
We assume [composer](http://getcomposer.org/doc/00-intro.md) is already installed on your system.

## Why I need this ?

First the name is awesome ! That's not enough ? Ok, so this application framework is intended to take profit of the new `Router` class and tends to put together libraries like forum, blog, etc. thanks to the attachement feature.

This invovles to move the default `app` library in `atoms` and considering it as a standard library. Atoms are libraries, it has just been separated from `libraries` for a `.gitignore` concern since `libraries` is simply git ignored.

## Why I need this ?
- `atoms`: atoms are libraries, and as libraries, it can contain routes (a good practice is to scope the routes using the name of the library as scoping name.)
- `config`: contains the bootstrap files (no routes are allowed here, only attachement must be done.)
- `libraries`: the libraries
- `webroot`: the entry point of your application.

For using `webroot` assets of others libraries, the simplest way is to add a symlink in `webroot` to the libraries `webroot` and next defining the corresponding `Media::attach()` in the `attachements.php` bootstrap files.

And dependencies should be delegated to composer.json

## Something more I should take into consideration ?

Yeah, when you are writing library's views, all references to assets must be `root based`. This way you'll be able to change the moint point attachement more easily.

## Defaults !

Application's routes has no prefix so the splash should be screen is located at:

```
http://localhost/myapp/
```

If you prefer `http://localhost/myapp/i/love/that`, edit `config/boostrap/attachements.php` and change the `Router` attachement to app to:

```
Router::attach('app', ['prefix' => 'i/love/that']);
```

## Special note

This repository intended be push forced don't expect to fetch on it.

[![Build Status](https://secure.travis-ci.org/jails/li3_bigbang.png?branch=master)](http://travis-ci.org/jails/li3_bigbang)