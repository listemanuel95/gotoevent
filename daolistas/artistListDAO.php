<?php

namespace daolistas;

use interfaces\IDAO as IDAO;

use model\Artist as Artist;

class ArtistListDAO extends SingletonDAO implements IDAO {

    private $datos;

    function __construct()
    {
        $this->datos = array();
    }

    public function create($instance)
    {
        if($instance instanceof Artist)
        {
            echo 'ESTOY CREANDO (INSERTANDO) EL ARTISTA';

            echo '<br>ARRAY DE ARTISTAS: ';

            array_push($this->datos, $instance);

            echo '<pre>';
            var_dump($this->datos);
            echo '</pre>';
        }
    }

    public function retrieve($instance)
    {
        if($instance instanceof Artist)
        {
            echo 'ESTOY DEVOLVIENDO EL ARTISTA';
        
            echo '<pre>';
            var_dump($instance);
            echo '</pre>';
        }
    }
    
    public function update($instance)
    {
        if($instance instanceof Artist)
        {
            echo 'ESTOY ACTUALIZANDO EL ARTISTA';
        
            echo '<pre>';
            var_dump($instance);
            echo '</pre>';
        }
    }

    public function delete($instance)
    {
        if($instance instanceof Artist)
        {
            echo 'ESTOY BORRANDO EL ARTISTA';
        
            echo '<pre>';
            var_dump($instance);
            echo '</pre>';
        }
    }
}

?>