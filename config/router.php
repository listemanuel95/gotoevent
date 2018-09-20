<?php 
namespace config;

class Router {

    /**
     * Se encarga de direccionar a la pagina solicitada
     * @param Request
     */
    public static function direccionar(Request $request) 
    {
        $controller_str = $request->getControladora() . 'Controller';
        $method = $request->getMetodo();

        $params = $request->getParametros();

        // los archivos estan en camelCase pero las clases siempre arrancan en mayuscula, entonces pasamos el primer caracter del controller_str a mayus
        $controller_str = ucfirst($controller_str);
        
        $objeto = "Controllers\\" . $controller_str;
        $controller = new $objeto();

        if(!isset($params)) 
            call_user_func(array($controller, $method));
        else 
            call_user_func_array(array($controller, $method), $params);
    }
}

?>
 