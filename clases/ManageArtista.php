<?php

class ManageArtista {

    private $bd = null;
    private $tabla = "artista";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

    function get($email) {
        //devuelve un objeto de la clase city
        $parametros = array();
        $parametros['email'] = $email;
        $this->bd->select($this->tabla, "*", "email=:email", $parametros);
        $fila = $this->bd->getRow();
        $artista = new Artista();
        $artista->set($fila);
        return $artista;
    }

    function getPorNombreArtistico($nombreArtistico) {//pasandole el alias convierto una fila de mi tabla en un objeto usuario
        $parametros['nombreArtistico'] = $nombreArtistico;
        $this->bd->select($this->tabla, "*", "nombreArtistico=:nombreArtistico", $parametros);
        $fila = $this->bd->getRow();
        $artista = new Artista();
        $artista->set($fila);
        //echo 'ha entrado';
        return $artista;
    }

    function getListWhere($condicion, $pagina = 1, $nrpp = Constant::NRPF) {
        $registroInicial = ($pagina - 1) * $nrpp;
        $this->bd->select($this->tabla, "*", $condicion, array(), "email, nombreArtisco", "", $registroInicial, $nrpp);
        $r = array();
        while ($fila = $this->bd->getRow()) {
            $artista = new Artista();
            $artista->set($fila);
            $r[] = $artista;
        }
        return $r;
    }

    function getListOrder($orden = 'email', $criterio = 'asc', $pagina = 1, $nrpp = Constant::NRPP) {
        $registroInicial = ($pagina - 1) * $nrpp;
        $this->bd->select2($this->tabla, "*", "1=1", array(), $orden, $criterio, "", $registroInicial, $nrpp);
        $r = array();
        while ($fila = $this->bd->getRow()) {
            $artista = new Artista();
            $artista->set($fila);
            $r[] = $artista;
        }
        return $r;
    }

    function getListProyeccion($proyeccion, $orden, $criterio, $pagina = 1, $nrpp = Constant::NRPP) {
        $registroInicial = ($pagina - 1) * $nrpp;
        $this->bd->select($this->tabla, $proyeccion, "1=1", array(), $orden, $criterio, "$registroInicial, $nrpp");
        $r = array();
        while ($fila = $this->bd->getRow()) {
            $artista = new Artista();
            $artista->set($fila);
            $r[] = $artista;
        }
        return $r;
    }

    function getList($proyeccion = '*', $orden = 'email', $criterio = '1', $pagina = 1, $nrpp = Constant::NRPF) {
        $registroInicial = ($pagina - 1) * $nrpp;
        $this->bd->select($this->tabla, $proyeccion, "1=1", array(), $orden, $criterio, "$registroInicial, $nrpp");
        $r = array();
        while ($fila = $this->bd->getRow()) {
            $artista = new Usuario();
            $artista->set($fila);
            $r[] = $artista;
        }
        return $r;
    }

    function delete($email) {
        $parametros = array();
        $parametros['email'] = $email;
        return $this->bd->delete($this->tabla, $parametros);
    }

    function deleteArtistas($parametros) {
        return $this->bd->delete($this->tabla, $parametros);
    }

    function erase(Artista $artista) {
        return $this->delete($artista->getEmail());
    }

    function set(Artista $artista) {
        //Update de todos los campos menos el id, el id se usara como el where para el update numero de filas modificadas
        $parametrosSet = array();
        $parametrosSet['email'] = $artista->getEmail();
        $parametrosSet['clave'] = $artista->getClave();
        $parametrosSet['nombreArtistico'] = $artista->getNombreArtistico();
        $parametrosSet['plantilla'] = $artista->getPlantilla();
        $parametrosSet['activo'] = $artista->getActivo();
        $parametrosWhere = array();
        $parametrosWhere['email'] = $artista->getEmail();
        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
    }

    function set2(Artista $artista) {
        //Update de todos los campos menos el id, el id se usara como el where para el update numero de filas modificadas
        $parametrosSet = array();
        $parametrosSet['email'] = $artista->getEmail();
        $parametrosSet['clave'] = $artista->getClave();
        $parametrosSet['nombreArtistico'] = $artista->getNombreArtistico();
        $parametrosSet['plantilla'] = $artista->getPlantilla();
        $parametrosSet['activo'] = $artista->getActivo();

        $parametrosWhere = array();
        $parametrosWhere['nombreArtistico'] = $artista->getNombreArtistico();
        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
    }

    function insert(Artista $artista) {
        //Se pasa un objeto autor y se inserta, se devuelve el id del elemento con el que se ha insertado
        $parametrosSet = array();
        $parametrosSet['email'] = $artista->getEmail();
        $parametrosSet['clave'] = $artista->getClave();
        $parametrosSet['nombreArtistico'] = $artista->getNombreArtistico();
        $parametrosSet['plantilla'] = $artista->getPlantilla();
        $parametrosSet['activo'] = $artista->getActivo();
        return $this->bd->insert($this->tabla, $parametrosSet);
    }

    function getValuesSelect($proyeccion, $orden) {
        $this->bd->query($this->tabla, $proyeccion, array(), $orden);
        $array = array();
        while ($fila = $this->bd->getRow()) {
            $array[$fila[0]] = $fila[0];
        }
        return $array;
    }

    function getValuesSelect2($proyeccion, $orden) {
        $this->bd->query($this->tabla, $proyeccion, array(), $orden);
        $array = array();
        $i = 0;
        while ($fila = $this->bd->getRow()) {
            $array[$i] = $fila[0];
            $i++;
        }
        return $array;
    }

    function count($condicion = "1 = 1", $parametros = array()) {
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }

    function getList2($pagina = 1, $nrpp = Constant::NRPF) {
        $registroInicial = ($pagina - 1) * $nrpp;
        $this->bd->select($this->tabla, "*", "1=1", array(), "email, nombreArtistico", "$registroInicial, $nrpp");
        $r = array();
        while ($fila = $this->bd->getRow()) {
            $artista = new Artista();
            $artista->set($fila);
            $r[] = $artista;
        }
        return $r;
    }

}
