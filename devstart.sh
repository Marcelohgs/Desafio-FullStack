sudo docker compose -f docker-compose.dev.yml down
sudo docker build --target dev .
sudo docker compose -f docker-compose.dev.yml up -d
sudo chmod -R ugo+rw api/storage
