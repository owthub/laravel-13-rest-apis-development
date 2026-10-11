Phase 1: APIs Development in Laravel 13 without using any Auth

Laravel setup (13) -> php8.3+ , composer

Database connectivity

Migration, model, api controller 
phase-1-no-auth
Table: books

Routes
- Create Books
- List Books
- Single Book Information
- Update Book Information
- Delete Book Information


php artisan make:model Book -mc --api

Books
- id
- title -> string()
- author -> string()
- isbn -> string()
- description -> text()
- price -> decimal()
- published_year -> year()

API Resource Controller
- index -> List All Books API
- store -> Save Book API
- show -> Single Book Info API
- update -> Update Book API
- destroy

php artisan make:controller BookController --api

Resource Controller
- index
- create -> load html form 
- store
- show
- edit -> load edit html form of resource
- update
- destroy