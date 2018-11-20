# GoToEvent
TP Metodología de Sistemas I, Laboratorio IV y Bases de Datos I.

## Objetivo
El sistema permite a los usuarios comprar tickets para eventos musicales o teatrales a realizarse. Los usuarios deben registrarse para efectuar las compras, caso contrario sólo podrán ver la lista de eventos.
También hay un panel de administración para los usuarios con rol de administradores, que les permite gestionar los distintos eventos y calendarios, como así los artistas y fechas que corresponden a éstos.

## Ámbito
### Procesos del sistema:
> #### Administradores
>> - Gestión de Eventos
>> - Gestión de Categorías
>> - Gestión de Lugares y Establecimientos
>> - Gestión de Artistas
>> - Gestión de Calendarios
>> - Consulta de Totales Vendidos y Remanentes
>> - Consulta de Disponibilidad de Plazas de Eventos
> #### Invitados
>> - Registro de Usuario
>> - Consulta de Eventos
> #### Usuarios
>> - Consulta de Eventos
>> - Consulta de Precios y Disponibilidades de Plazas de Evento
>> - Adhición de Plazas al Carrito
>> - Confirmación de Compra (Carrito)
>> - Consulta de Historial de Compras
> #### Sistema
>> - Generación de Tickets con código QR para compras.
>> - Envío de mail de confirmación a los usuarios cuando se realiza una compra.

## Tabla de Requisitos Funcionales
| ID Requisito | Nombre | Descripción | Usuario |
|:------------:|:------:|:-----------:|:-----:|
| RF-001 |  Sistema de Registro | Los clientes deberán poder registrar una cuenta en el sitio, con su email y una clave | Clientes |
| RF-002 |  Sistema de Login | Los clientes y administradores deberán poder ingresar a su cuenta previamente creada | Clientes, Administradores |
| RF-003 |  Sistema de Login vía Facebook | También se proporcionará un sistema de logeo vía cuenta de Facebook | Clientes, Administradores |
| RF-004 |  Sistema de Eventos | Los administradores podrán cargar nuevos eventos al sistema, detallando de éstos: categoría, calendarios, artistas, fechas, establecimiento/s y plazas. Esto incluye también la edición y cancelación (borrado) de eventos | Administradores |
| RF-005 |  Sistema de Calendarios | Los eventos estarán compuestos por uno o más calendarios, a detallar por el administrador | Administradores |
| RF-006 |  Sistema de Artistas | Los eventos se corresponderán con uno o más artistas, a detallar por el administrador | Administradores |
| RF-007 |  Sistema de Plazas | Los eventos tendran una cierta disponibilidad de plazas, de distintos tipos, a detallar por el administrador | Administradores |
| RF-008 |  Sistema de Establecimientos | Los eventos ocurrirán en uno o más establecimientos (según sus fechas), a detallar por el administrador. Dichos establecimientos tendrán una provincia y ciudad donde están ubicados, además de su dirección exacta. | Administradores |
| RF-009 |  Totales Vendidos y Remanentes | Los administradores podrán consultar en todo momento, desde el panel de administración, los totales que se han vendido hasta el momento y los remanentes obtenidos | Administradores |
| RF-010 |  Consulta de Eventos | Tanto clientes registrados como usuarios invitados podrán investigar los eventos disponibles y filtrarlos por género y categoría de evento | Clientes, Invitados |
| RF-011 |  Compra de Tickets | Los clientes registrados podrán seleccionar un evento y comprar plazas. Cada plaza genera un ticket | Clientes |
| RF-012 |  Sistema de QR de Tickets | Todos los tickets generados en RF-011 tendrán un código QR único asociado | Clientes |
| RF-013 |  Mail de Confirmación | Una vez confirmada la compra, se enviará un mail al cliente con todos los tickets (Rf-011) adquiridos, junto a su código QR (RF-012) | Clientes |
| RF-014 |  Sistema de Carrito | La compra de plazas (y por ende generación de tickets) se hará por medio de un sistema de carrito, donde el cliente podrá confirmar el total de la compra al final de la operación | Clientes |
| RF-015 |  Consulta de Tickets Adquiridos | Los clientes podrán, en todo momento, consultar los tickets que llevan adquiridos (historial de tickets), filtrados por fecha de eventos (y separados según si el evento ya ocurrió o no) | Clientes |

## Requisitos No Funcionales
> Arquitectura de 3 capas (MVC): vistas, modelos y controladoras.
> ### Vistas
>> #### Todo lo que hace al frontend e interfaz de usuario de la aplicación.
>>> - HTML5
>>> - CSS, SASS ([Bootstrap](https://getbootstrap.com/))
>>> - JavaScript ([jQuery](https://jquery.com/))
> ### Modelo
>> #### Diagrama de clases de la aplicación. Los modelos son los objetos del sistema.
>>> - [PHP](http://php.net/) (sin frameworks)
> ### Controladoras
>> #### Manejan la lógica de la aplicación (modelo de negocios).
>>> - [PHP](http://php.net/) (sin frameworks)
> ### Objetos de Acceso a Datos (DAOs)
>> #### Capa auxiliar para la persistencia de información.
>>> - [MySQL](https://www.mysql.com/) (vía [PDO](http://php.net/manual/es/book.pdo.php))

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

