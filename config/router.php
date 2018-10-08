<?php 
namespace config;

class Router {

    /**
     * Se encarga de direccionar a la pagina solicitada
     * @param Request
     */
    public static function redirect(Request $request) 
    {
        // Dunkan was here
        $controller_str = ucfirst($request->get_controller()) . 'Controller';
        $method = $request->get_method();

        $params = $request->get_params();
        
        $objeto = "Controllers\\" . $controller_str;
        $controller = new $objeto();

        if(!isset($params)) 
            call_user_func(array($controller, $method));
        else 
            call_user_func_array(array($controller, $method), $params);
    }
}

?>
 