<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## CIA DATABASE 

The application is developed considering following:

- Dataset given
- Using Laravel, PostgreSQL, and Redis, implement a system that allows filtering the attached dataset by person's birth year, or birth month. or both.
- Matching results must be cached in Redis for 60 seconds. Following requests for the same combination of filtering parameters (birth year, birth month) must not query database before cache expires.
- If user changes filter parameters, Redis cache for old results must be invalidated.
- Design the database schema in a way that queries to PostgreSQL would not take longer than 250ms.
- Display results to the user in a paginated table, with 20 rows per page. Pagination must retrieve data from Redis cache if it is available.

NOTE: Page number must not be a part of cache key. Instead, all rows from the database that match filtering criteria (month, year) must be stored in Redis, and pagination should retrieve only the required rows from Redis.

## Database Migration

Run migration for person table

## Seed

Run seed PersonTableSeeder for person data

### Run project

- **[http://localhost/example-app/public/](http://localhost/example-app/public/)**

### Testing
Debug bar is enable. Please see left bottom of the page. you can use this to test the application.
## Developer
Zahidul Hossein Ripon
riponmailbox@gmail.com

## License
Personal non commercial use only
