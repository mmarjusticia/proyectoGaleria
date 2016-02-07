<?php
require '../clases/AutoCarga.php';

class ControladorArtista {

    function handle() {
        $bd=new DataBase();
        $gestor=new ManageArtista($bd);
        $op = Request::get("op");
        $metodo = "metodo" . $op;
        if (method_exists($this, $metodo)) { //ucfirst pone la primera en mayuscula
            $this->$metodo(($gestor));
        } else {
            $this->metodoartista($gestor);
        }
    }
     function metodo0() {
        $contenidoParticular = Plantilla::cargarPlantilla("../templates/_principal.html");
        $pagina = Plantilla::cargarPlantilla("../templates/_plantilla.1.html");
        $datos = array(
            "contenidoParticular" => $contenidoParticular
        );
        echo Plantilla::sustituirDatos($datos,$pagina);
        }
     function metodo1() {
        $contenidoParticular = Plantilla::cargarPlantilla("../templates/_signIn.html");
          $pagina=Plantilla::cargarPlantilla("../templates/_plantilla.1.html");
        $datos = array(
            "contenidoParticular" => $contenidoParticular
                );
         echo Plantilla::sustituirDatos($datos,$pagina);
    }

    function metodo2() {
        $contenidoParticular = Plantilla::cargarPlantilla("../templates/_signUp.html");
         $pagina=Plantilla::cargarPlantilla("../templates/_plantilla.1.html");
        $datos = array(
            "contenidoParticular" => $contenidoParticular
        );
         echo Plantilla::sustituirDatos($datos,$pagina);
    }
    function metodoregistro($gestor){
        $email=Request::post('email');
        $clave=Request::post('clave');
        $claveR=Request::post('claveR');
        $consulta=$gestor->get($email)->getEmail();
        if($consulta!=null)
        {
            $contenidoParticular = Plantilla::cargarPlantilla("../templates/_mensaje.html");
            $datos = array(
            "mensaje" => "Error. Ya existe un artista para ese email",
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
            if($clave===$claveR){
                $nombreArtistico=$email;
                $claveCifrada=sha1($clave.Constant::SEMILLA);
                $artista= new Artista($email,$claveCifrada,$nombreArtistico,1,0);
                $gestor->insert($artista);
            
                $destino=$email;
                $sha1=sha1($destino.Constant::SEMILLA);
                $origen='mmarjusticia@gmail.com';
                $asunto="Validación";
                $mensaje="Confirme su registro a la galería pulsando el siguiente enlace: "."https://galeria-mmarjusticia.c9users.io/artista/index.php?op=activar&email=$destino&sha1=$sha1";
                require_once '../clases/Google/autoload.php';
                require_once '../clases/class.phpmailer.php';  //las últimas versiones también vienen con autoload
                $cliente = new Google_Client();
                $cliente->setApplicationName('enviar');
                $cliente->setClientId("270220163093-pe1ci6joub5ai7k0dgtlloukg764pclj.apps.googleusercontent.com");
                $cliente->setClientSecret('U-cIahmOQjJkR4Iyl-A1oL6-');
                $cliente->setRedirectUri('https://galeria-mmarjusticia.c9users.io/oauth/guardar.php');
                $cliente->setScopes('https://www.googleapis.com/auth/gmail.compose');
                $cliente->setAccessToken(file_get_contents('../oauth/token.conf'));
                if ($cliente->getAccessToken()) {
                 $service = new Google_Service_Gmail($cliente);
            try {
                $mail = new PHPMailer();
                $mail->CharSet = "UTF-8";
                $mail->From = $origen;
                $mail->FromName = $alias;
                $mail->AddAddress($destino);
                $mail->AddReplyTo($origen, $alias);
                $mail->Subject = $asunto;
                $mail->Body = $mensaje;
                $mail->preSend();
                $mime = $mail->getSentMIMEMessage();
                $mime = rtrim(strtr(base64_encode($mime), '+/', '-_'), '=');
                $mensaje = new Google_Service_Gmail_Message();
                $mensaje->setRaw($mime);
                $service->users_messages->send('me', $mensaje);
                $contenidoParticular = Plantilla::cargarPlantilla("../templates/_mensaje.html");
                $datos = array(
                "mensaje" => "Para finalizar el registro,verifique su correo electronico y active su cuenta",
                "ruta"=>"../index.php?op=0"
                );
                $contenidoParticular=Plantilla::sustituirDatos($datos,$contenidoParticular);
            
                $pagina=Plantilla::cargarPlantilla("../templates/_plantilla.1.html");
                $datos = array(
                "contenidoParticular" => $contenidoParticular
                );
                echo Plantilla::sustituirDatos($datos,$pagina);
                    
                } catch (Exception $e) {
                        print($e->getMessage());
                }   
            }
        else{
            $contenidoParticular = Plantilla::cargarPlantilla("../templates/_mensaje.html");
            $datos = array(
            "mensaje" => "Ha ocurrido un error con la conexión, por favor repita el proceso",
            "ruta"=>"../index.php?op=0"
            );
            $contenidoParticular=Plantilla::sustituirDatos($datos,$contenidoParticular);
            
            $pagina=Plantilla::cargarPlantilla("../templates/_plantilla.1.html");
            $datos = array(
            "contenidoParticular" => $contenidoParticular
            );
            echo Plantilla::sustituirDatos($datos,$pagina);
            }
            }   
            else  { 
            $contenidoParticular = Plantilla::cargarPlantilla("../templates/_mensaje.html");
            $datos = array(
            "mensaje" => "Error. Las contraseñas no coinciden",
            "ruta"=>"../index.php?op=0"
            
            );
            $contenidoParticular=Plantilla::sustituirDatos($datos,$contenidoParticular);
            
            $pagina=Plantilla::cargarPlantilla("../templates/_plantilla.1.html");
            $datos = array(
            "contenidoParticular" => $contenidoParticular
            );
            echo Plantilla::sustituirDatos($datos,$pagina);}}
        
    }
    
    function metodoactivar($gestor){
        $email=Request::get('email');
        $sha1=Request::get('sha1');
        $emailsha1=sha1($email.Constant::SEMILLA);
       
        if($sha1==$emailsha1){
            $artista=$gestor->get($email);
            $clave=$artista->getClave();
            $nombreArtistico=$artista->getNombreArtistico();
            $plantilla=$artista->getPlantilla();
            $activo=1;
            $artistaActivo= new Artista($email,$clave,$nombreArtistico,$plantilla,$activo); 
            $gestor->set($artistaActivo);
            //en este momento que ya esta activo vamos a crear una carpeta para que guarde sus obras
            $rutaCarpeta='../archivos/'.$email;
            
            if(!file_exists($rutaCarpeta)){
                
                mkdir($rutaCarpeta, 0777, true);
               
            } 
            header("Location:index.php");
            
    }
        else{   
            $contenidoParticular = Plantilla::cargarPlantilla("../templates/_mensaje.html");
            $datos = array(
                "mensaje" => "Ha habido un error en la activación de su cuenta",
                "ruta"=>"../index.php?op=0"
                );
            $contenidoParticular=Plantilla::sustituirDatos($datos,$contenidoParticular);
            
            $pagina=Plantilla::cargarPlantilla("../templates/_plantilla.1.html");
            $datos = array(
                "contenidoParticular" => $contenidoParticular
                );
                echo Plantilla::sustituirDatos($datos,$pagina);
       }
        }
        
    
    
    function metodoentrar($gestor){
       
        $email=Request::post("email");
        $clave=Request::post("clave");
        $artista=$gestor->get($email);
    
        
        if($artista==""){
            $contenidoParticular = Plantilla::cargarPlantilla("../templates/_mensaje.html");
            $datos = array(
                "mensaje" => "El email introducido no pertenece a la base de datos",
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
            $claveGuardada=$artista->getClave();
            $claveCifrada=sha1($clave.Constant::SEMILLA);
            if($claveCifrada!=$claveGuardada){
                $contenidoParticular = Plantilla::cargarPlantilla("../templates/_mensaje.html");
                $datos = array(
                    "mensaje" => "La contraseña es incorrecta",
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
                $sesion=new Session();
                $sesion->set('_email',$email);
                $sesion->set('_artista',$artista);
                header('Location:?op=artista');
            }
            
        }
    }
    function metodoartista($gestor){
        $sesion=new Session();
        $email=$sesion->get('_email');
        $artista=$gestor->get($email);
        $alias=$artista->getNombreArtistico();
        if($email!=""){
            $contenidoParticular = Plantilla::cargarPlantilla("../templates/_zonaArtista.html");
            $datos=array(
                "alias" =>$alias
                );
            $contenidoParticular=Plantilla::sustituirDatos($datos,$contenidoParticular);
            $pagina=Plantilla::cargarPlantilla("../templates/_plantilla.1.html");
            $datos = array(
                "contenidoParticular" => $contenidoParticular
                   );
            echo Plantilla::sustituirDatos($datos,$pagina);}
        else{
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
            
        }
         
         function metodocerrar($gestor){
             $sesion=new Session();
           
             header('Location:../index.php');
               $sesion->destroy();
         }
    
     
        function metodoviewCambiarNombre($gestor){
            $contenidoParticular=Plantilla::cargarPlantilla("../templates/_viewCambiarNombre.html");
            $pagina=Plantilla::cargarPlantilla("../templates/_plantilla.1.html");
            $datos = array(
                "contenidoParticular" => $contenidoParticular
                );
                echo Plantilla::sustituirDatos($datos,$pagina);
            
        }
    function metodophpCambiarNombre($gestor){
        $sesion=new Session();
        $nuevoNombre=Request::post("nombre");
        $consulta=$gestor->getPorNombreArtistico($nuevoNombre)->getEmail();
        if($consulta!=""){
            $contenidoParticular = Plantilla::cargarPlantilla("../templates/_mensaje.html");
                $datos = array(
                    "mensaje" => "Operación imposible.Ese nombre artístico ya existe en la base de datos",
                    "ruta"=>"../artista/index.php"
                    );
                $contenidoParticular=Plantilla::sustituirDatos($datos,$contenidoParticular);
            
                $pagina=Plantilla::cargarPlantilla("../templates/_plantilla.1.html");
                $datos = array(
                    "contenidoParticular" => $contenidoParticular
                    );
                    echo Plantilla::sustituirDatos($datos,$pagina);
        }
        else{
                $email=$sesion->get('_email');
                $artista=$gestor->get($email);
                $clave=$artista->getClave();
                $plantilla=$artista->getPlantilla();
                $activo=$artista->getActivo();
                $artista2=new Artista($email,$clave,$nuevoNombre,$plantilla,$activo);
                $gestor->set($artista2);
                header("Location:?op=artista");}}
        
        function metodoviewElegir($gestor){
            $sesion=new Session();
            $email=$sesion->get('_email');
            $artista=$gestor->get($email);
            $alias=$artista->getNombreArtistico();
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
                echo Plantilla::sustituirDatos($datos,$pagina);}
            $contenidoParticular = Plantilla::cargarPlantilla("../templates/_elegirPlantilla.html");
            $pagina=Plantilla::cargarPlantilla("../templates/_plantilla.1.html");
            $datos = array(
                    "contenidoParticular" => $contenidoParticular
                    );
            echo Plantilla::sustituirDatos($datos,$pagina);}
            
        
    function metodophpElegir($gestor){
            echo 'entro';
        $sesion=new Session;
        $plantilla=Request::get("pl");
        $artista=$sesion->get('_artista');
        $email=$artista->getEmail();
        $clave=$artista->getClave();
        $nombre=$artista->getNombreArtistico();
        $activo=$artista->getActivo();
        $artista2= new Artista($email,$clave,$nombre,$plantilla,$activo);
        $gestor->set($artista2);
        $sesion->set('_artista',$artista2);
        header('Location:../cuadro/index.php?op=verGaleria');
        }
   
 


        
    
}
 
    

        ?>