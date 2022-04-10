FROM php:7.3.0-apache
COPY src/ /var/www/html
EXPOSE 80
RUN docker pull php:7.3.0-apache
RUN docker build -t flightpro .
RUN pull mysql
RUN docker run --name flights-mysql -v flights.sql:/docker-entrypoint-initdb.d -p 3306 -e MYSQL_ROOT_PASSWORD=3068145 -e MYSQL_DATABASE=flights -d mysql:latest
RUN docker run --name flightusers-mysql -v flight_users.sql:/docker-entrypoint-initdb.d -p 3306 -e MYSQL_ROOT_PASSWORD=3068145 -e MYSQL_DATABASE=flights -d mysql:latest
RUN docker network create flight-app 
RUN docker run -d --network todo-app --network-alias mysql -v flight-mysql-data:/var/lib/mysql -e MYSQL_ROOT_PASSWORD=3068145 -e MYSQL_DATABASE=flights
