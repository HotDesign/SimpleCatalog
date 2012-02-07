HotDesign SimpleCatalogBundle
========================

WARINING: Under development stage. 

Multilevel categorizable catalog. Multiple image upload. Thumbnails. Extensible.


1) Installation
---------------

soon...

* **git clone ....**
* **copy app/config/parameters.ini.disct into app/config/parameters.ini edit with your values**
* **php bin/vendors install**
* **sudo setfacl -R -m u:www-data:rwx -m u:usuario_consola:rwx app/cache app/logs**
* **sudo setfacl -dR -m u:www-data:rwx -m u:usuario_consola:rwx app/cache app/logs**
* **php app/console doctrine:database:create**
* **php app/console doctrine:schema:update --force**
* **php app/console doctrine:fixtures:load**
* **php app/console assets:install --symlink web**
* **sudo chmod -R 777 app/db**

2) Extend / Customization
-----------------------

soon...

Developers/Collaborators
---------------

* **marian0** - Mariano Peyregne
* **germanaz0** - German Bortoli 
* **fern17** - Fernando Nellmeldin