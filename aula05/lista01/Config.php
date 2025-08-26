<?php
<?php

class Config
{
    protected $parametros;

    public function __construct($parametros = []) {
        $this->parametros = $parametros;
    }
}

class AppConfig extends Config
{
    public function getParametro($chave) {
        return $this->parametros[$chave];
    }

    public function setParametro($chave, $valor) {
        $this->parametros[$chave] = $valor;
    }
}