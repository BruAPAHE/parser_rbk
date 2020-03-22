list:
	@echo ""
	@echo "Useful targets:"
	@echo ""
	@echo "  - 'make image.build.php' > Build app images"
	@echo "  - 'make image.push.php > Push app images"
	@echo "  - 'make image.build.nginx > Push nginx images"
	@echo "  - 'make image.push.nginx > Push nginx images"
	@echo ""



image.build.php:
	docker build -t apahe/php . -f ./docker/php/Dockerfile
image.push.php:
	docker push apahe/php
image.build.nginx:
	docker build -t apahe/nginx . -f ./docker/nginx/Dockerfile
image.push.nginx:
	docker push apahe/nginx