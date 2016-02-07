<?php

require 'clases/AutoCarga.php';

class Controlador {

    function handle() {
        $op = Request::get("op");
        $metodo = "metodo" . $op;
        $bd=new DataBase();
        $gestor=new ManageArtista($bd);
        $gestorCuadro=new ManageCuadro($bd);
        if (method_exists($this, $metodo)) { //ucfirst pone la primera en mayuscula
            $this->$metodo($gestor);
        } else {
            $this->metodo0($gestor);
        }
    }

    function metodo0($gestor) {
        $contenidoParticular = Plantilla::cargarPlantilla("templates/_principal.html");
        $pagina = Plantilla::cargarPlantilla("templates/_plantilla.html");
        $datos = array(
            "contenidoParticular" => $contenidoParticular
        );
        echo Plantilla::sustituirDatos($datos,$pagina);
        }

    function metodo1($gestor) {
        $contenidoParticular = Plantilla::cargarPlantilla("templates/_signIn.html");
        $pagina = Plantilla::cargarPlantilla("templates/_plantilla.html");
        $datos = array(
            "contenidoParticular" => $contenidoParticular
                );
         echo Plantilla::sustituirDatos($datos,$pagina);
    }

    function metodo2($gestor) {
        $contenidoParticular = Plantilla::cargarPlantilla("templates/_signUp.html");
        $pagina = Plantilla::cargarPlantilla("templates/_plantilla.html");
        $datos = array(
            "contenidoParticular" => $contenidoParticular
        );
         echo Plantilla::sustituirDatos($datos,$pagina);
    }
   function metodoverArtistas($gestor){
        $listaArtistas=$gestor->getList2();
        $plantillaArtistas =Plantilla::cargarPlantilla("templates/_artistas.html");
        $artistas = "";
        foreach ($listaArtistas as $key => $value) {
            $artistai = str_replace("{contenido}", $value->getNombreArtistico(), $plantillaArtistas);
            $artistai = str_replace("{nombre}", $value->getNombreArtistico(), $artistai);
            $artistas .= $artistai;
            }
        $pagina = Plantilla::cargarPlantilla("templates/_plantilla.html");
        $datos = array(
            "contenidoParticular" => $artistas
            );
        echo Plantilla::sustituirDatos($datos,$pagina);
   }
   function metodoverLista($gestor){
       $bd=new DataBase();
       $gestorCuadro=new ManageCuadro($bd);
        $nombreArtistico=Request::get("nombre");
        $artista=$gestor->getPorNombreArtistico($nombreArtistico);
        $email=$artista->getEmail();
        $plantilla=$artista->getPlantilla();
        $condicion="autor='$email'";
        $listaObras = $gestorCuadro->getListWhere($condicion);
        $plantillaObras =Plantilla::cargarPlantilla("templates/_cuadros$plantilla.html");
        $obras = "";
        foreach ($listaObras as $key => $value) {
            $obrai = str_replace("{titulo}", $value->getNombreCuadro(), $plantillaObras);
            $obrai = str_replace("{ruta}", "../".$value->getruta(), $obrai);
            $obrai = str_replace("{descripcion}", $value->getDescripcion(), $obrai);
            $obras .= $obrai;
        }
        $pagina = Plantilla::cargarPlantilla("templates/_plantilla.cuadros1.html");
        if($plantilla==1){
            $contenedor='contenedor1';}
        else{
            if($plantilla==2){
                $contenedor='contenedor2';
            }
            else{$contenedor='contenedor3';}
            }
        $datos = array(
            "contenedor"=>$contenedor,
            "contenidoParticular" => $obras
            );
            echo Plantilla::sustituirDatos($datos,$pagina);
       }
   }
    

