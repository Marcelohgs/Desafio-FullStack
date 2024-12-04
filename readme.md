# Desafio FullStack

Projeto desenvolvido em Laravel 10.2 com suporte a Docker, utilizando Bootstrap e DataTables para uma interface rica e responsiva.

---

## 📋 Visão Geral

- **Framework Principal:** Laravel 10.2
- **Frontend:** Bootstrap 5, DataTables (jQuery), jQuery
- **Ambiente de Contêiner:** Docker
- **Banco de Dados:**  MySQL

---

## 🚀 Começando

### Pré-requisitos

Certifique-se de ter instalado:
- **Docker**: versão mais recente ([Instruções de instalação](https://docs.docker.com/get-docker/))
- **Docker Compose**: compatível com a sua versão do Docker
- **Composer**: para gerenciar dependências PHP
- **Node.js**: para compilar os assets do frontend

---

### Instalação

1. Clone este repositório:

```bash
git clone https://github.com/Marcelohgs/Desafio-FullStack.git
cd seu-repositorio
```
- Após clonar o repositório execute o script devstart.sh com o comando "sh devstart.sh"
- Após a execução do script acesse o container "dev_workspace_php" via Bash, acesse o projeto Laravel "api" e rode os comandos:
- composer install 
- npm install
- caso de tudo certo, execute a migration com o comando:
- php artisan migrate

---

### Projeto Pronto para Uso
  Após a execução de todos os comandos, seu ambiente de desenvolvimento Laravel estará configurado e pronto para uso!
