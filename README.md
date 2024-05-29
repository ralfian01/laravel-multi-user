# laravel-multi-user
This repository is an example implementation of a multi-user system using Laravel. The system allows users to log in with multiple roles that have different access permissions.

## Features
- Multi-user login system with role-based authentication.
- Role and access management through the command line using `php artisan`.

<br><br>
## Installation
1. Clone this repository
2. Install all dependencies using Composer
   ```bash
   composer update
   ```
3. Rename file __*.env.example*__ to __*.env*__
4. Generate Laravel application key
   ```bash
   php artisan key:generate
   ```
5. Configure the __*.env*__ file according to your database settings
6. Run the migrations to create the necessary tables
   ```bash
   php artisan migrate
   ```
7. Start the development server
   ```bash
   php artisan serve
   ```

<br><br>
## Usage
### Show list of privileges
To show list of privileges, use the following command:
```bash
php artisan privilege:view
```
artisan will show list of privileges:
```
+----+--------------------------+-----------------------------+
| id | code                     | description                 |
+----+--------------------------+-----------------------------+
| 1  | ACCOUNT_MANAGE_VIEW      | Show account list           |
| 2  | ACCOUNT_MANAGE_SUSPEND   | Suspend or activate account |
...
```

### Adding new privilege
To add a new privilege, use the following command:
```bash
php artisan privilege:insert {code} {description}
```
example:
```bash
php artisan privilege:insert "ACCOUNT_SUSPEND" "Suspend account"
```

### Update privilege
To update privilege, use the following command:
```bash
php artisan privilege:update {id_or_code} --code --description
```
example:
```bash
php artisan privilege:update ACCOUNT_SUSPEND --code="ACCOUNT_SUSPEND" --description="Suspend account"
```

### Delete privilege
To delete privilege, use the following command:
```bash
php artisan privilege:delete {id_or_code}
```
example:
```bash
php artisan privilege:delete
```
