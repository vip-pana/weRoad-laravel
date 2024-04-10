#!/usr/bin/env bash

export UID

echo "Starting docker daemon"
sudo systemctl start docker

echo "Building containers"
docker-compose --project-name weroad --file ./docker/docker-compose.yaml build #--no-cache

echo "Starting up containers"
docker-compose --project-name weroad --file ./docker/docker-compose.yaml up --remove-orphans #-d

#echo "Enter php container as www-data"
#docker exec -it --user www-data weroad_php /bin/bash

#echo "Stop active containers"
#docker-compose --file ./docker/docker-compose.yaml stop
