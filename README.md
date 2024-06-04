NO LEER


### pasos a seguir

# 1. Crear la migración
 ```bash
    composer update
```
# 2. Ejecutamos la migración (verificar si esa con conesion a bd en la nube no es necesario)
 ```bash
    php artisan migrate:fresh --seed
```

# 3. Ejecutamos servidor
 ```bash
    php artisan serve
```
