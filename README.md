HotDesign SimpleCatalogBundle
========================

WARINING: Under development stage. 

Multilevel categorizable catalog. Multiple image upload. Thumbnails. Extensible.


1) Installation
---------------

soon...

* **git clone ....**
* **copy app/config/parameters.ini.disct into app/config/parameters.ini edit with your values**
* **mkdir app/cache app/logs app/db**
* **sudo setfacl -R -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs**
* **sudo setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs**
* **php bin/vendors install**
* **php app/console doctrine:database:create**
* **php app/console doctrine:schema:update --force**
* **php app/console doctrine:fixtures:load**
* **php app/console assets:install --symlink web**
* **sudo chmod -R 777 app/db**

2) Extend / Customization
-----------------------

WARINING: Under development stage. WARINING: Under development stage. 

La customización de las BaseEntities está en desarrollo. Pero básicamente funciona así:

Cada categoría de SimpleCatalog se le asigna un Tipo... Este Tipo, se refiere al tipo de entidades que va a contener, por ejemplo un Inmueble.
Los tipos se manejan desde una clase estática en src/HotDesign/Entity/ItemTypes.php y aquí se define qué clases son las que extienden este tipo de objetos, por ejemplo para Inmueble extenderán a Geografico (Maps) y Housing (Cant de baños, cant de dormitorios, etc, etc).

Cuando agreguemos un nuevo Item dentro de ésta categoría, se crearán objetos de los tipos que extiende, por ejemplo en inmueble se creará la BaseEntity con los datos que ingresó el Usuario, un Geografico y un Housing con valores por defecto y en enabled=false (ambos relacionados a la base entity).

El usuario ahora sí puede editar estos valores por defecto por medio de un popup/lightbox al formulario de edición y poner enable=true para que sea visto en un futuro frontend.

**TIPS**

* Crear la entidad hija. Crear atributos. Crear valores por defecto (para todo lo NO NULL). Crear un atributo enabled = false. El nombre en CamelCase debe ser ScNombreEntidadExt. Debe tener una relación ManyToOne a BaseEntity.
* Crear el formulario correspondiente ScNombreEntidadExtType.
* Crear en Resources/view/ScNombreEntidadExt/show_backend.html.twig una vista la cual se inscrustará en el backend (BaseEntity edit).
* Crear el controlador ScNombreEntidadController el cuál solo usaremos los métodos para edit y update.
* Las vistas necesarias son las de edit.html.twig y show_backend.html.twig solamente. 

WARINING: Under development stage. 

Developers/Collaborators
---------------

* **marian0** - Mariano Peyregne - Idea. Responsable. Administrator.
* **germanaz0** - German Bortoli - Collaborator.
* **fern17** - Fernando Nellmeldin - Collaborator.
* **cordoval** - Luis Cordova - Collaborator.
