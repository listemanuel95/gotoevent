<?php 
namespace config;
   
// parsea la URL
class Request
{
	/*atributos para almacenar todos los valores que vengan por url*/
	private $controller;
	private $method;
	private $params;

	function __construct()
	{
        // En el archivo htaccess se define una regla de reescritura para poder tomar la url tanto para todo method de petición.
        $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);

        // Convierto la url en un array tomando como separador la "/".
        $url_to_array = explode("/", $url);

        // Filtro el arreglo para eliminar datos vacios en caso de haberlos.
        $array_url = array_filter($url_to_array);

        /*
            Defino un controlador por defecto en el caso de que el arreglo llegue vacío
            Si el arreglo tiene datos, tomo como controlador el primer elemento.
        */
        if(empty($array_url)) {
            $this->controller = 'Index';
        } else {
            $this->controller = array_shift($array_url);
        }

        /*
            Defino un método por defecto en el caso de que el arreglo llegue vacío
            Si el arreglo tiene datos, tomo como método el primero elemento.
        */
        if(empty($array_url)) {
            $this->method = 'index';
        } else {
            $this->method = array_shift($array_url);
        }
        
        // Capturo el metodo de petición y lo guardo en una variable
        $metodoRequest = $this->get_request_method();

        /*
         * Si el método es GET, en caso de que el arreglo llegue con datos, 
         * lo guardo entero en el campo "parametros" de la  clase. 
         *
         * Si el método es POST, guardo todos los datos que llegaron por POST
         * en el campo "parametros"
         */
        if($metodoRequest == 'GET') {
            if(!empty($array_url)) {
                $this->params = $array_url;
            }
        } else {
            $this->params = $_POST;
        }
    }

    public static function get_instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new Request();
        }
        
        return $inst;
    }
        
    public static function get_request_method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
    
    public function get_controller() 
    {
        return $this->controller;
    }
    
    public function get_method() 
    {
        return $this->method;
    }
    
    public function get_params() 
    {
        return $this->params;
    }
}

?>