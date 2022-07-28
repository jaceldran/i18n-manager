# Translations

La página principal donde se gestionan las traducciones en los distintos idiomas.

Las traducciones se presentan agrupadas en secciones plegables/desplegables.

Cada traducción se identifica por una **```key```** única compuesta por partes separadas mediante puntos. Así, por ejemplo, se pueden agrupar todos los textos de botones en el grupo **```button```** y la colección podría ser algo como:

* **```button.accept```**
* **```button.cancel```**
* **```button.confirm```**
* **```button.submit```**

Otras formas de agrupación puede referirse a apartados o secciones, con el detalle que interese.

* **```commercial.opportunities.won```**
* **```commercial.opportunities.lost```**
* **```commercial.activities.mail```**
* **```commercial.activities.phone```**
* **```commercial.activities.visit```**

En cualquier caso, la regla de agrupación toma la última parte de la ```key``` como el término de traducción mientras que el resto conforma la categoría para agrupar. Así, las entradas anteriores se mostrarían de esta forma:

* [-] **<u>```button```</u>**
	* **```cancel```**
	* **```confirm```**
	* **```submit```**
* [-] **<u>```commercial.opportunities```</u>**
	* **```won```**
	* **```lost```**
* [-] **<u>```commercial.activities```</u>**
	* **```mail```**
	* **```phone```**
	* **```visit```**

La sintáxis de puntos ayuda a mantener las entradas organizadas ya que éstas se muestran siempre por orden alfabético y evitan los duplicados.

## Open / Close

Estos botones sirven para abrir o cerrar todas los grupos de traducciones.

## Create

Cada grupo también se puede plegar/desplegar por separado haciendo clic en el nombre. En la parte derecha hay un botón con el signo + que abre un formulario para crear una nueva entrada con la *key* indicando el grupo actual, lista para introducir el nuevo término. Pero también se puede introducir nuevas *keys* para crear nuevos grupos.

## Edit

Las traducciones se pueden editar de 2 formas:

### Inmediata

La forma más inmediata de editar las traducciones es introducir directamente el valor de cada traducción en los inputs de idiomas editables. Los valores se guardan cada vez que se sale del input.

Este modo depende de los idiomas que estén activados como visibles y editables en el apartado de *Langs*.

### Completa
Para editar una traducción al completo se puede pulsar la *key* correspondiente. Se abrirá un formulario que permitirá editar tanto la *key*, por si se quiere cambiar el término o asignar a otro grupo, como todos los idiomas disponibles.

## Import

Permite la carga de un archivo CSV con traducciones en el formato descrito. Debe contener una columna llamada *key* y otras columnas con el código ISO del idioma y la traducción correspondiente.

## Export

Genera la exportación de archivos en las carpetas especificadas en la configuración en formatos adecuados para su consumo por las aplicaciones *frontend* o *backend*.

* Un archivo ```all.php```
* Un archivo ```all.json```
* Un archivo ```all.csv```
* Tantos archivos JSON como idiomas disponibles, uno por cada idioma.
* Tantos archivos PHP como idiomas disponibles, uno por cada idioma.


Así, si la aplicación está instalada en el mismo servidor que el *frontend* o el *backend*, se pueden configurar las rutas de exportación a las carpetas que estén usando las aplicaciones para su sistema multi-idioma.

## Download

Proporciona una descarga en formato de archivo comprimido de todos los archivos exportados.

# Langs

El apartado **Langs** gestiona la lista de idiomas de la aplicacion. Desde aquí se pueden añadir, activar o desactivar para edición y mostrar u ocultar en la vista de traducciones principal.

Los idiomas se pueden arrastrar y reordenar por filas para indicar el orden en el que deben aparecer en la página de traducciones.

## New

Se pedirá introducir el código ISO de un idioma. Una vez enviado el formulario, se recargará la lista de idiomas con la nueva incorporación. Si no se muestra una bandera de país es indicativo de que el idioma puede no existir o estar identificado con bandera pero no impide que se pueda gestionar igualmente.

## Visible / Editable

Cada idioma tiene 2 *switches* para activar o desactivar su estado de visibilidad y edición.

Si no está activado como visible, no aparecerá en las página de traducciones.

Si no está activado como editable, aparecerá en la página de traducciones pero no se podrá editar la traducción directamente, aunque siempre se puede editar de forma global pulsando en la *key*.

# Configuration

## Paths

Formulario para establecer las rutas de exportación de los archivos de traducciones.

Normalmente, estas rutas deberían apuntar a las carpetas que utilicen las soluciones *frontend* o *backend* para su gestión multi-idioma, en caso de que este gestor esté en el mismo servidor.

## Env

Una página informativa con datos del entorno de ejecución.