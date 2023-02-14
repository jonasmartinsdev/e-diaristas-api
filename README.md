## Projeto API da plataforma E-Diaristas

Desenvolvido no curso multi-stack da treinaweb

### Instalando o projeto

#### Clonar o repositório

```
git clone https://github.com/jonasmartinsdev/e-diaristas-api.git
```

#### Instalar as dependências

```
composer install
```

Ou em ambiente de desenvolvimento:

```
composer update
```

#### Criar arquivo de configurações de ambiente

Copiar o arquivo de exemplo `.env.example` para `.env` na raiz do projeto
configurar os detalhes da aplicação e conexão com o banco de dados.

#### Criar a estrutura no banco de dados

```
php artisan migrate
```

#### Iniciar o servidor de desenvolvimento

```
php artisan serve
```
