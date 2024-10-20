# Vetcamp Front (Front end Side for the platform)
Implementation for the new platform.
## Requirements
It is important that you are not running any version higher than the `7.3.33` php version
since it will generate some compatibility errors.

### Installing the correct PHP Version
You may use the Chocolatey package manager for **Windows** to install the PHP Version
by using the following command:
```bash
choco install php --version=7.3
```

If you have a newer version you must allow the downgrade by using the following flag:
```bash
choco install php --version=7.3 --allow-downgrade 
```
## Running the project
If you wish to run the project on a Windows 
machine, you may use [Laragon](https://laragon.org/download/) to run 
the Apache, Mysql and PHP installations.

Extract or clone this project under the `www/` folder before starting laragon. Once
you've placed the project on the correct folder you can run laragon, and it will provide a custom URL via dnsmasq. Simply type on the browser `vetcamp_front.test`

### Accessing the database
First, in order to access the database, **you must
create an `.ENV` file** following the `.ENV.EXAMPLE` located in the root folder of this project.

## Creating Models, Views and Controllers
You may generate automatically models, views
and controllers using the `craft` command.

### Creating a model via `craft`
```bash
php craft model User
```
This will generate a User model under the 
 `/app/models` folder.

 ### Creating a controller via `craft`
```bash
php craft controller UserController
```
This will generate a controller under the 
`app/controllers` folder.

The same will work for views.

*PD: Feel free to extend this script to autogenerate files*