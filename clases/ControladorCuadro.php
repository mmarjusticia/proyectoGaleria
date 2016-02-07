<?php
require '../clases/AutoCarga.php';

class ControladorCuadro {

         function handle() {
            $bd=new DataBase();
            $gestor=new ManageCuadro($bd);
            $op = Request::get("op");
            $metodo = "metodo" . $op;
            if (method_exists($this, $metodo)) { //ucfirst pone la primera en mayuscula
                $this->$metodo(($gestor));
            } else {
                $this->metodo0();
             }
            }
        function metodoviewSubir($gestor){
       
            $contenidoParticular=Plantilla::cargarPlantilla("../templates/_viewSubir.html");
            $pagina=Plantilla::cargarPlantilla("../templates/_plantilla.1.html");
            $datos = array(
                "contenidoParticular" => $contenidoParticular
                );
                echo Plantilla::sustituirDatos($datos,$pagina);
        }
    
        function metodophpSubir($gestor){
           
            $sesion = new Session();
            $email=$sesion->get('_email');
            if($email==""){
                $contenidoParticular = Plantilla::cargarPlantilla("../templates/_mensaje.html");
                $datos = array(
                "mensaje" => "No tiene permisos para acceder a este contenido. Por favor, primero regístrese",
                "ruta"=>"../index.php?op=0"
                );
                $contenidoParticular=Plantilla::sustituirDatos($datos,$contenidoParticular);
                $pagina=Plantilla::cargarPlantilla("../templates/_plantilla.1.html");
                $datos = array(
                "contenidoParticular" => $contenidoParticular
                );
                echo Plantilla::sustituirDatos($datos,$pagina);
            }
            else{
                $titulo= Request::post("titulo");
                $descripcion= Request::post("descripcion");
                $archivo= Request::post("archivo");
                $subir= new UploadFile("archivo");
                $subir->setPolitica(UploadFile::RENOMBRAR);
                $subir->setDestino("../archivos/$email/");
               
                if($subir->upload()){
                    $i++;
                    $nombre=$subir->getNombre();
                    $extension=$subir->getPath();
                    $ruta="archivos/$email/$nombre.$extension";
                    $cuadro=new Cuadro($ruta,$titulo,$email,$descripcion);
                    $gestor->insert($cuadro);
                    $sesion->set("_ruta",$ruta);
                     $contenidoParticular = Plantilla::cargarPlantilla("../templates/_mensaje.html");
                    $datos = array(
                        "mensaje" => "el cuadro ha sido insertado correctamente",
                        "ruta"=>"../artista/index.php"
                        );
                    $contenidoParticular=Plantilla::sustituirDatos($datos,$contenidoParticular);
                    $pagina=Plantilla::cargarPlantilla("../templates/_plantilla.1.html");
                    $datos = array(
                    "contenidoParticular" => $contenidoParticular
                        );
                    echo Plantilla::sustituirDatos($datos,$pagina);
                    
                        
                } else{
                    $contenidoParticular = Plantilla::cargarPlantilla("../templates/_mensaje.html");
                    $datos = array(
                        "mensaje" => "Ha habido un problema en la subida del cuadro. Inténtelo de nuevo",
                        "ruta"=>"../artista/index.php"
                        );
                    $contenidoParticular=Plantilla::sustituirDatos($datos,$contenidoParticular);
                    $pagina=Plantilla::cargarPlantilla("../templates/_plantilla.1.html");
                    $datos = array(
                    "contenidoParticular" => $contenidoParticular
                        );
                    echo Plantilla::sustituirDatos($datos,$pagina);
}
            }
                
            }
        function metodoeliminarCuadro($gestor){
             $sesion=new Session;
            $email=$sesion->get('_email');
            $condicion="autor='$email'";
            $listaObras = $gestor->getListWhere($condicion);
            $plantillaObras =Plantilla::cargarPlantilla("../templates/_obras.html");
            $obras = "";
            foreach ($listaObras as $key => $value) {
                $obrai = str_replace("{contenido}", $value->getNombreCuadro(), $plantillaObras);
                $obrai = str_replace("{ruta}", $value->getruta(), $obrai);
                $obras .= $obrai;
            }
            $pagina = Plantilla::cargarPlantilla("../templates/_plantilla.1.html");
            $datos = array(
            "contenidoParticular" => $obras
            );
            echo Plantilla::sustituirDatos($datos,$pagina);
      
    }
    function metodoborrar($gestor){
        $ruta=Request::get("ruta");
        $rutaCompleta="../$ruta";
        $gestor->delete($ruta);
        unlink($rutaCompleta);
        header("Location:?op=eliminarCuadro");
    }
    function metodoverGaleria($gestor){
            $sesion=new Session;
            $email=$sesion->get('_email');
            $artista=$sesion->get('_artista');
            $plantilla=$artista->getPlantilla();
            $condicion="autor='$email'";
            $listaObras = $gestor->getListWhere($condicion);
            $plantillaObras =Plantilla::cargarPlantilla("../templates/_cuadros$plantilla.html");
            $obras = "";
            foreach ($listaObras as $key => $value) {
                $obrai = str_replace("{titulo}", $value->getNombreCuadro(), $plantillaObras);
                $obrai = str_replace("{ruta}", "../".$value->getruta(), $obrai);
                $obrai = str_replace("{descripcion}", $value->getDescripcion(), $obrai);
                $obras .= $obrai;
            }
            $pagina = Plantilla::cargarPlantilla("../templates/_plantilla.cuadros1.html");
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
        
    
               
                
            

    
