# Laravel 4 zurb foundation 4.x helper

This package does not include the framework. It requires the official framework composer package from zurb and provides command line tools to setup foundation for development with laravel and compass.


## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `aheissenberger/foundation`

	"require": {
	    "laravel/framework": "4.0.*",
	    "aheissenberger/foundation": "dev-master"
	}

Next, update Composer from Terminal

	$ composer update

Once this operation completes, the final step is to add the service provider. Open `app/config/app.php`, and add a new item to the providers array.

	'Aheissenberger\Foundation\FoundationServiceProvider',


## Setup

Run `$ php artisan foundation:setup` to create a basic skeleton to start:

	app/assets
		/sass
		/sprites
		/js
		/img

Run `$ php artisan asset:publish aheissenberger/foundation` to copy all needed Javascripts to `/public`

### Optional:
Run `$ php artisan foundation:demo` to create a demofile /foundation.html of all foundation features in /public

## Usage

In terminal an run `$ compass watch app/assets/sass`
This will create and update `/public/css/app.css`

You can use `/app/assets/sass/_settings.scss` to configure foundation and `/app/assets/sass/_main.scss` for your app specific css.
And to remove compression by compass change settings in `/app/assets/sass/config.rb`

## Update

Run `$ composer update` to update foundation and `$ php artisan asset:publish aheissenberger/foundation` to copy the new javascript files to `/public`


## ToDo

* config foundation with a native Laravel config file
* automatic include minified and combined version of javascript files