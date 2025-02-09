# PHP Messaging Server

## Components
* Apache/PHP Server: Hosts web pages and provides an HTTP interface on port 8080.
* PHP Script: Synchronizes data with the database and cache.
* MariaDB Container: Provides a relational database for storing data on port 3306.
* Redis Container: Provides a key-value database for caching data on port 6379.
* PhpMyAdmin Container: Provides an interface for administering the database on port 8085.

## Architecture
The components interact with each other as follows:
* The client sends HTTP requests to the Apache/PHP server.
* The Apache/PHP server interacts with the MariaDB database via Redis.
* The PHP script interacts with the Redis cache and MariaDB database using SQL queries and Redis commands.
* The client also interacts with PhpMyAdmin using HTTP requests to administer the database.

## Getting Started
To run the project, follow these steps:
1. Clone the repository: `git clone https://github.com/your-username/php-server-container.git`
3. Run the containers: `docker-compose up -d`
4. Access the Apache/PHP server: `http://localhost:8080`
5. Access PhpMyAdmin: `http://localhost:8085`

## Contributing
To contribute to this project, please fork the repository and submit a pull request with your changes. Make sure to follow the project's coding standards and testing conventions.

## Versions
* v1.0.0: Initial release

## Authors
* [VILA Loris](https://github.com/lorisvila)
* BOUDOUR Yacine 
* LESCURE Maël
* LAURIE Téo
* LAHOUSSE Matthieu
* NELLENBACH Quentin

