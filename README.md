# yii2real-template

[![N|Solid](https://camo.githubusercontent.com/bc297786b444bcfc0e70d18bdee8c503f7399e47/68747470733a2f2f7777772e7969696672616d65776f726b2e636f6d2f66696c65732f6c6f676f2f7969692e706e67)](https://nodesource.com/products/nsolid)

[![Build Status](https://travis-ci.org/joemccann/dillinger.svg?branch=master)](https://travis-ci.org/joemccann/dillinger)

Boosted Yii2 advanced template for quick starting projects with universal extensions and completed configurations.

  - Reliable framework
  - Advanced template
  - Quick start

# Features:

  - `yii init` executed.
  - `yii migrate` executed.
  -  advanced `htaccess` template added in frontend | backend | app
  - Pretty url enabled (no web/forntend in url)
  - Admin LTE installed for backend.
  - TinyMCE installed (asyncronously upload files on drag&drop)
  - Responsive Filemanager plugin installed and configured for TinyMCE
  - `kartik-v/yii2-widget-select2` Tag input widget installed.
  - `i18n` configured for @frontend
  - `codemix` pretty locale url installed and configured
  - News controller and model ready to use (also views are created) 
  - Categories controller and model ready to use (also views are created) 
  - Captcha action enabled for admin/login page
  - Compressing images with `Imagine` before upload configured/installed


### Installation

Yii2-Real Template requires [Apache](https://apache.org/) or [Ngnix](https://ngnix.org/) installed server to run.

1. Clone repository to your server
2. Import or create database template (/newspaper_db.sql)
4. Enjoy.

### For manually installing or updating extensions
Via composer:
```sh
$ composer require dmstr/yii2-adminlte-asset "2.*"
$ composer require 2amigos/yii2-tinymce-widget:~1.1
$ composer require codemix/yii2-localeurls
$ composer require mludvik/yii2-tags-input:"~1.0"
$ composer require kartik-v/yii2-widget-select2 "@dev"
$ composer require --prefer-dist yiisoft/yii2-imagine
```
### Additional information
The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

### Author
 - Abdirasulov Javohir 
 - Telegram: https://t.me/JavohirAB  
 - Gmail:    alienware7x@gmail.com 


License
----

**Free and open source project template for everyone, Good luck!**
