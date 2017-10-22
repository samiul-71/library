## Medicine Library Web Application for the Medicine API

`master` : [![build status](https://gitlab.com/hc4u/medicine-library/badges/master/build.svg)](https://gitlab.com/hc4u/medicine-library/commits/master) `development` : [![build status](https://gitlab.com/hc4u/hc4umembers/badges/development/build.svg)](https://gitlab.com/hc4u/medicine-library/commits/development)

### Wiki

All the related doc and info will be recorded at the [wiki](https://gitlab.com/hc4u/medicine-library/wikis/home).

### Issues

[Project Issue Tracker](https://gitlab.com/hc4u/medicine-library/issues) will be used for all the time.


### Contributing

We need to follow a number of rules to contribute to this project
* No one will push any commit directly to the `master` branch
* `development` branch should have the latest working copy
* It is better to use seperate branch to each indivitual/ feature/ issue
* Each `merge request` to `development`branch musy have mentioned the issue number(s)
* `Code Indentation` is a must
* Try to write `comments` within the code as much as possible


### Instalation

Follow the instruction below to install the project

* Clone the repository using `git@gitlab.com:hc4u/medicine-library.git`
* `composer install`
* Create `.env` by copying the `env.example` file
* `php artisan key:generate`
* `php artisan migrate`
* Set administrator info in `UserTableSeeder.php`
* `php artisan db:seed`