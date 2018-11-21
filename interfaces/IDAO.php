<?php

    namespace interfaces;

    interface IDAO 
    {
        public function create($instance);
        public function retrieve($instance);
        public function update($instance);
        public function delete($instance);
    }

?>