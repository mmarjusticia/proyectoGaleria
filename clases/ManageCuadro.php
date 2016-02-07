<?php
class ManageCuadro {
  private $bd = null;
    private $tabla = "cuadro";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

    function get($ruta) {
        //devuelve un objeto de la clase city
        $parametros = array();
        $parametros['ruta'] = $ruta;
        $this->bd->select($this->tabla, "*", "ruta=:ruta", $parametros);
        $fila = $this->bd->getRow();
        $cuadro = new Cuadro();
        $cuadro->set($fila);
        return $cuadro;
    }

    
    function getListWhere($condicion, $pagina = 1, $nrpp = Constant::NRPF) {
        
        $registroInicial = ($pagina - 1) * $nrpp;
         
        $this->bd->select($this->tabla, "*", $condicion, array(), "ruta, nombreCuadro", "", $registroInicial, $nrpp);
        $r = array();
        while ($fila = $this->bd->getRow()) {
            $cuadro = new Cuadro();
            $cuadro->set($fila);
            $r[] = $cuadro;
        }
        return $r;
    }

  
    function getList($proyeccion = '*', $orden = 'nombreCuadro', $criterio = '1', $pagina = 1, $nrpp = Constant::NRPF) {
        $registroInicial = ($pagina - 1) * $nrpp;
        $this->bd->select($this->tabla, $proyeccion, "1=1", array(), $orden, $criterio, "$registroInicial, $nrpp");
        $r = array();
        while ($fila = $this->bd->getRow()) {
            $cuadro = new Cuadro();
            $cuadro->set($fila);
            $r[] = $cuadro;
        }
        return $r;
    }

    function delete($ruta) {
        $parametros = array();
        $parametros['ruta'] = $ruta;
        return $this->bd->delete($this->tabla, $parametros);
    }

    function deleteCuadros($parametros) {
        return $this->bd->delete($this->tabla, $parametros);
    }

    function erase(Cuadro $cuadro) {
        return $this->delete($cuadro->getCodigo());
    }

    function set(Cuadro $cuadro) {
        //Update de todos los campos menos el id, el id se usara como el where para el update numero de filas modificadas
        $parametrosSet = array();
        $parametrosSet['ruta'] = $cuadro->getRuta();
        $parametrosSet['nombreCuadro'] = $cuadro->getNombreCuadro();
        $parametrosSet['autor'] = $cuadro->getAutor();
        $parametrosSet['descripcion'] = $cuadro->getDescripcion();
        $parametrosWhere = array();
        $parametrosWhere['ruta'] = $cuadro->getRuta();
        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
    }

    function insert(Cuadro $cuadro) {
        //Se pasa un objeto autor y se inserta, se devuelve el id del elemento con el que se ha insertado
        $parametrosSet = array();
        $parametrosSet['ruta'] = $cuadro->getRuta();
        $parametrosSet['nombreCuadro'] = $cuadro->getNombreCuadro();
        $parametrosSet['autor'] = $cuadro->getAutor();
        $parametrosSet['descripcion'] = $cuadro->getDescripcion();
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
        $this->bd->select($this->tabla, "*", "1=1", array(), "nombreCuadro", "$registroInicial, $nrpp");
        $r = array();
        while ($fila = $this->bd->getRow()) {
            $cuadro = new Cuadro();
            $cuadro->set($fila);
            $r[] = $cuadro;
        }
        return $r;
    }
}
