## Order API

### Framework & tools

- Lumen 5.5 (PHP framework)
- MySQL (for storage engine)
- Composer (for installing dependencies)

Unit test cases: /tests/


### Installation
This is a dockerized application. Do the following

To do:

- `cd project_directory/` into the project root directory.
- add `GOOGLE_MAP_API_KEY` to .env file
- `sh ./start.sh`

- `sudo docker-compose exec php vendor/bin/phpunit` for PHPUnit test
 
 API base url `http://127.0.0.1:8080`.

 
 ### CheckList
 
 - [x] Place Order API
 - [x] Update Order API
 - [x] List Order API
 - [x] Instruction doc
 - [x] Install script
 
 #### Postman API collection
 https://www.getpostman.com/collections/5dcc4219e28cbdc8b05b
###### you may need to change base url
