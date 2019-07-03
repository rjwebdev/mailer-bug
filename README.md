# mailer-bug
Repo to reproduce bug in mailer


First, install all packages:
`composer install`

Then, create a Docker mailhog service for catching the emails:
`docker-compose up -d`

Mailhog can be found at http://localhost:8025/ after starting the Docker service

Run the server using Symfony CLI by running `symfony server:start -d`

Then, go to the homepage of this project and after the response is shown to you (page with hello world), go to mailhog and refresh.
