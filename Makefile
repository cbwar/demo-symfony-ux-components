# TODO: move to podman

build:
	docker build . -f Containerfile -t demo-shop:latest

run:
	docker run --rm --name demo-shop-cont -p 8080:80 -v .:/sources -v composer-cache:/composer-cache -v npm-cache:/npm-cache demo-shop:latest

bash:
	docker exec -it demo-shop-cont bash
