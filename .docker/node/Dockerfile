FROM node:8

RUN apt-get update && \
	apt-get install -y \
		curl \
		apt-transport-https

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - && \
	echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN apt-get update && apt-get install yarn  -y
RUN groupadd dev -g 999
RUN useradd dev -g dev -d /home/dev -m
WORKDIR /home/wwwroot/app
