# **************************************************************************** #
#                                                                              #
#                                                         :::      ::::::::    #
#    Makefile                                           :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: gozsertt <gozsertt@student.42.fr>          +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2020/03/31 12:18:06 by gozsertt          #+#    #+#              #
#    Updated: 2020/05/04 19:41:03 by gozsertt         ###   ########.fr        #
#                                                                              #
# **************************************************************************** #

SHELL = /bin/sh
IMAGE := ft_server
DOCKER_NAME := ft_server1

docker-build:
	docker build -t $(IMAGE) .

docker-run:
	docker run -it -p 80:80 -p 443:443 --name $(DOCKER_NAME) $(IMAGE)

.PHONY: up
up: docker-build docker-run

docker-stop:
	docker stop $(DOCKER_NAME)

docker-rm: docker-stop
	docker rm $(DOCKER_NAME)

docker-rmi:
	docker rmi $(IMAGE)

.PHONY: clean
clean: docker-rm docker-rmi

autoindex-on:
	docker exec $(DOCKER_NAME) bash /scripts/switch_autoindex.sh on

autoindex-off:
	docker exec $(DOCKER_NAME) bash /scripts/switch_autoindex.sh off
