# Desafio FullStack

Projeto desenvolvido em Laravel 10.2 com suporte a Docker, utilizando Bootstrap e DataTables para uma interface rica e responsiva.

---

## 📋 Visão Geral

- **Framework Principal:** Laravel 10.10
- **Frontend:** Bootstrap 5, DataTables (jQuery), jQuery
- **Ambiente de Container :** Docker
- **Banco de Dados:**  MySQL

---

## 🚀 Começando

### Pré-requisitos

Certifique-se de ter instalado:
- **Docker**: versão mais recente ([Instruções de instalação](https://docs.docker.com/get-docker/))
- **Docker Compose**: compatível com a sua versão do Docker
- **Composer**: para gerenciar dependências PHP

---

### Documentação API:
https://documenter.getpostman.com/view/30843249/2sAYBbd8Xp#75725fca-2cf8-409f-94f9-270927b5b86c

### Instalação

1. Clone este repositório:

```bash
git clone https://github.com/Marcelohgs/Desafio-FullStack.git
cd seu-repositorio
```
### Configuração .env
1. Configuração .env "USADO SOMENTE AMBIENTE DE DEV"
- Duplique o arquivo .env.example e o renomeio somente para .env
- no ".env" substitua as configurações do banco MYSQL por:
```bash
  DB_CONNECTION=mysql    
  DB_HOST=mysql  
  DB_PORT=3306  
  DB_DATABASE=dev  
  DB_USERNAME=root  
  DB_PASSWORD=password
``` 

- Execute o Script abaixo para subir os Containers
```bash
sh devstart.sh
``` 
- Acesse o container ***workspace_php*** via Bash:
- Execute o comando passando o ID do container como parâmetro sem aspas:
```bash
docker exec -it "id-container" bash
```
- Ainda dentro do container acesse o projeto "Api":
```bash
cd api
```
- Então execute:
```bash
composer install
npm install
```

---
- E para finalizar, dentro do container ***workspace_php*** execute os comandos abaixo para gerar a Key e rodar as Migration:
```bash
 php artisan key:generate
 php artisan migrate
 ```

---

### Projeto Pronto para Uso
Após a execução de todos os comandos, seu ambiente de desenvolvimento Laravel estará configurado e pronto para uso!
