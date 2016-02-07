<?php


class Cuadro {
    private $ruta,$nombreCuadro,$autor,$descripcion;
    function __construct($ruta=null, $nombreCuadro=null, $autor=null,$descripcion=null) {
      
        $this->ruta = $ruta;
        $this->nombreCuadro = $nombreCuadro;
        $this->autor = $autor;
        $this->descripcion=$descripcion;
    }
   

    function getRuta() {
        return $this->ruta;
    }

    function getNombreCuadro() {
        return $this->nombreCuadro;
    }

    function getAutor() {
        return $this->autor;
    }
    
    function getDescripcion() {
        return $this->descripcion;
    }

 

    function setRuta($ruta) {
        $this->ruta = $ruta;
    }

    function setNombreCuadro($nombreCuadro) {
        $this->nombreCuadro = $nombreCuadro;
    }

    function setAutor($autor) {
        $this->autor = $autor;
    }
    
    function setDescripcion($autor) {
        $this->descripcion = $descripcion;
    }

   public function getJson(){
        $r = '{';
        foreach ($this as $indice => $valor) {
            $r .= '"' .$indice . '":"' .$valor. '",';
        }
        $r = substr($r, 0,-1);
        $r .='}';
        return $r;
    }
   
    
    function set($valores, $inicio=0){
        $i = 0;
        foreach ($this as $indice => $valor) {
           $this->$indice = $valores[$i+$inicio];
           $i++;
        }
    }
    
    public function __toString() {
        $r ='';
        foreach ($this as $key => $valor) { 
            $r .= "$valor ";
        }
        return $r;
    }

}
