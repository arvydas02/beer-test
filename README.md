# Beer Test
Data Dog [Beer Test](https://data.dog/beer-test) system

## Getting Started
- System is using MySQL RDS
- Before running system create new database and add to `.env.local` file
- Install all dependencies with composer `composer install`
- Run migrations `php bin/console doctrine:migrations:migrate`
- Add date to database `php bin/console doctrine:fixtures:load`
- To run on Web need create virtual host, point to public and update host file
- Run Unit test `php bin/phpunit`

### Prerequisites 
- PHP 7
- Symfony 4
- Composer
- MySQL

## Development steps
- Analysed given data from CSV 
- Created Entities and migrations
- Imported data from CSV files using Doctrine Data Fixtures module
- Created Services to load data from db and calculate travels data
- Wrote test for Distance calculation and Travel visit algorithm

## Notes
- Algorithm is based on travel distance. 
- It calculate all distance between all Geo Codes by given coordinates.
- After we new all distance it search for closet one and make travel.

## To Do
- Add relations between tables and update fixtures

## Authors
Arvydas Leikus
