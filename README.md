# GoToEvent
TP Metodología de Sistemas I, Laboratorio IV y Bases de Datos I.

## Objetivo
El sistema permite a los usuarios comprar tickets para eventos musicales o teatrales a realizarse. Los usuarios deben registrarse para efectuar las compras, caso contrario sólo podrán ver la lista de eventos.
También hay un panel de administración para los usuarios con rol de administradores, que les permite gestionar los distintos eventos y calendarios, como así los artistas y fechas que corresponden a éstos.

## Ámbito
### Procesos del sistema:
#### Administradores
- Gestión de Eventos
- Gestión de Categorías
- Gestión de Lugares y Establecimientos
- Gestión de Artistas
- Gestión de Calendarios
- Consulta de Totales Vendidos y Remanentes
- Consulta de Disponibilidad de Plazas de Eventos
#### Invitados
- Registro de Usuario
- Consulta de Eventos
#### Usuarios
- Consulta de Eventos
- Consulta de Precios y Disponibilidades de Plazas de Evento
- Adhición de Plazas al Carrito
- Confirmación de Compra (Carrito)
- Consulta de Historial de Compras
#### Sistema
- Generación de Tickets con código QR para compras.
- Envío de mail de confirmación a los usuarios cuando se realiza una compra.

## Tabla de Requisitos Funcionales
| ID Requisito | Nombre | Descripción | Actor |
|:------------:|:------:|:-----------:|:-----:|
| RF-001 |  Consulta de Eventos | Todos los usuarios podrán consultar los eventos disponibles en todo momento | Todos |

## Requisitos No Funcionales
> Arquitectura de 3 capas (MVC): vistas, modelos y controladoras.
### Vistas
#### Todo lo que hace al frontend e interfaz de usuario de la aplicación.
- HTML5
- CSS, SASS ([Bootstrap](https://getbootstrap.com/))
- JavaScript ([jQuery](https://jquery.com/))
### Modelo
#### Diagrama de clases de la aplicación. Los modelos son los objetos del sistema.
- [PHP](http://php.net/) (sin frameworks)
### Controladoras
#### Manejan la lógica de la aplicación (modelo de negocios).
- [PHP](http://php.net/) (sin frameworks)
### Objetos de Acceso a Datos (DAOs)
#### Capa auxiliar para la persistencia de información.
- [MySQL](https://www.mysql.com/) (vía [PDO](http://php.net/manual/es/book.pdo.php))

## Diagrama de Casos de Uso
![Casos de Uso](https://i.imgur.com/5vMOr4z.png)

## Modelo Conceptual Base
![Modelo Conceptual](https://i.imgur.com/x68nj1Z.png)

## Theme
[Now UI Kit](https://www.creative-tim.com/product/now-ui-kit) (gratuito, [licencia MIT](https://opensource.org/licenses/MIT))

## D.E.R
![Diagrama Entidad-Relación](https://i.imgur.com/3CxUeDX.png)

## Imágenes
### - Index
![Index](https://i.imgur.com/tJoBZn9.jpg)

### - Panel de Administración
![Panel de Administración](https://i.imgur.com/XM15hAD.png)

### - Vista de Evento
![Vista de Evento](https://i.imgur.com/9uCajzW.png)

## Equipo
### Manuel Liste ([Bone](https://github.com/listemanuel95))
### Emanuel D'Urso ([Dunkan](https://github.com/dunkansdk))
### Juan Ignacio Borelli ([Nacho](https://github.com/nacho95))
### Natalia Brasesco ([Natu](https://github.com/natanga))

