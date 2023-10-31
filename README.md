## Deploy Laravel Project Using Docker (QUICK SETUP)

#### Clone repo

    git clone https://github.com/primagiant/kurikulum.git

#### Go to the Project directory & copy the env file and make changes if you want i-e. (db name)

    cd /Path/to/Project && cp .env.example .env

#### Run Docker Compose to Install Dependency

    docker compose up -d

#### Open terminal and import database

    docker exec - it kurikulum-app bash

    php artisan migrate

    php artisan db:seed

#### APP & DB UI Acess

    APP : http://localhost/public

    DATABASE : http://localhost:8080
