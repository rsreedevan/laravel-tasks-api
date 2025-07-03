# Laravel 11 API with Sanctum, Docker and Ngnix 
This project is a Laravel 11 Restfull API using Sanctum for Authentication, Docker for containerizations, and includes CURD functionality for tasks . It uses ngnix as webs server 

## Getting Started 
### Prerequisites 
 
[Doker] https://www.docker.com/products/docker-desktop/
[Docker Compose] https://docs.docker.com/compose/

### Clone the repository 
git clone https://github.com/rsreedevan/laravel-tasks-api.git

## Run the application 
Run the following command in the terminal 
docker compose up --build 

Then run the migrations inside the app container 

docker exec -it laravel-tasks-api php artisan migrate 

The application should be start working by now. Check by visitng the url http://localhost:80


## Authentication 

### Endpoint 
    POST /api/login 
Body 
    json{
        "email" : "user@example.com"
        "password" : "password"
    }
Response 
    {
        "token" : "your-api-token"
    }

## Test the API 

Register 
    curl -X POST http://localhost:80/api/register \
    -H "Content-Type: application/json" \
    -d '{"name":"Test user", "email":"user@example.com", "password";"password"}'

Login 
    curl -X POST http://localhost:80/api/login \
    -H "Content-Type: application/json" \
    -d '{"email":"user@example.com", "password";"password"}'

Get Authenticated User 
     curl -X GET http://localhost:80/api/user \
    -H "Authorization: Bearer your-token-here" \
    

## List of API End Points 


### Authentication Not Required 
Register New User: POST /api/register 

Login: POST /api/login 

### Authentication Required 
Get Current User: GET /api/users

Logout User:  POST /api/logout

Create a Task: POST /api/tasks 

List All Tasks: GET /api/tasks 

Get Details of a Task: GET api/tasks/{id}

Update a task: PUT api/tasks/{id}

Delete a task: DELETE api/tasks/{id}

