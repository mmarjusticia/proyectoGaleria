{"changed":true,"filter":false,"title":"Controlador.php","tooltip":"/clases/Controlador.php","value":"<?php\n\nrequire 'clases/AutoCarga.php';\n\nclass Controlador {\n\n    function handle() {\n        $op = Request::get(\"op\");\n        $metodo = \"metodo\" . $op;\n        $bd=new DataBase();\n        $gestor=new ManageArtista($bd);\n        $gestorCuadro=new ManageCuadro($bd);\n        if (method_exists($this, $metodo)) { //ucfirst pone la primera en mayuscula\n            $this->$metodo($gestor);\n        } else {\n            $this->metodo0($gestor);\n        }\n    }\n\n    function metodo0($gestor) {\n        $contenidoParticular = Plantilla::cargarPlantilla(\"templates/_principal.html\");\n        $pagina = Plantilla::cargarPlantilla(\"templates/_plantilla.html\");\n        $datos = array(\n            \"contenidoParticular\" => $contenidoParticular\n        );\n        echo Plantilla::sustituirDatos($datos,$pagina);\n        }\n\n    function metodo1($gestor) {\n        $contenidoParticular = Plantilla::cargarPlantilla(\"templates/_signIn.html\");\n        $pagina = Plantilla::cargarPlantilla(\"templates/_plantilla.html\");\n        $datos = array(\n            \"contenidoParticular\" => $contenidoParticular\n                );\n         echo Plantilla::sustituirDatos($datos,$pagina);\n    }\n\n    function metodo2($gestor) {\n        $contenidoParticular = Plantilla::cargarPlantilla(\"templates/_signUp.html\");\n        $pagina = Plantilla::cargarPlantilla(\"templates/_plantilla.html\");\n        $datos = array(\n            \"contenidoParticular\" => $contenidoParticular\n        );\n         echo Plantilla::sustituirDatos($datos,$pagina);\n    }\n   function metodoverArtistas($gestor){\n        $listaArtistas=$gestor->getList2();\n        $plantillaArtistas =Plantilla::cargarPlantilla(\"templates/_artistas.html\");\n        $artistas = \"\";\n        foreach ($listaArtistas as $key => $value) {\n            $artistai = str_replace(\"{contenido}\", $value->getNombreArtistico(), $plantillaArtistas);\n            $artistai = str_replace(\"{nombre}\", $value->getNombreArtistico(), $artistai);\n            $artistas .= $artistai;\n            }\n        $pagina = Plantilla::cargarPlantilla(\"templates/_plantilla.html\");\n        $datos = array(\n            \"contenidoParticular\" => $artistas\n            );\n        echo Plantilla::sustituirDatos($datos,$pagina);\n   }\n   function metodoverLista($gestor){\n       $bd=new DataBase();\n       $gestorCuadro=new ManageCuadro($bd);\n        $nombreArtistico=Request::get(\"nombre\");\n        $artista=$gestor->getPorNombreArtistico($nombreArtistico);\n        $email=$artista->getEmail();\n        $plantilla=$artista->getPlantilla();\n        $condicion=\"autor='$email'\";\n        $listaObras = $gestorCuadro->getListWhere($condicion);\n        $plantillaObras =Plantilla::cargarPlantilla(\"templates/_cuadros$plantilla.html\");\n        $obras = \"\";\n        foreach ($listaObras as $key => $value) {\n            $obrai = str_replace(\"{titulo}\", $value->getNombreCuadro(), $plantillaObras);\n            $obrai = str_replace(\"{ruta}\", \"../\".$value->getruta(), $obrai);\n            $obrai = str_replace(\"{descripcion}\", $value->getDescripcion(), $obrai);\n            $obras .= $obrai;}\n        $pagina = Plantilla::cargarPlantilla(\"templates/_plantilla.cuadros1.html\");\n        if($plantilla==1){\n            $contenedor='contenedor1';}\n        else{\n            if($plantilla==2){\n                $contenedor='contenedor2';}\n            else{$contenedor='contenedor3';}\n            }\n        $datos = array(\n            \"contenedor\"=>$contenedor,\n            \"contenidoParticular\" => $obras\n            );\n            echo Plantilla::sustituirDatos($datos,$pagina); }\n   }\n    \n\n","undoManager":{"mark":71,"position":100,"stack":[[{"start":{"row":62,"column":34},"end":{"row":62,"column":35},"action":"remove","lines":["i"],"id":719}],[{"start":{"row":62,"column":33},"end":{"row":62,"column":34},"action":"remove","lines":["t"],"id":720}],[{"start":{"row":62,"column":32},"end":{"row":62,"column":33},"action":"remove","lines":["r"],"id":721}],[{"start":{"row":62,"column":31},"end":{"row":62,"column":32},"action":"remove","lines":["A"],"id":722}],[{"start":{"row":62,"column":31},"end":{"row":62,"column":32},"action":"insert","lines":["C"],"id":723}],[{"start":{"row":62,"column":25},"end":{"row":62,"column":32},"action":"remove","lines":["ManageC"],"id":724},{"start":{"row":62,"column":25},"end":{"row":62,"column":37},"action":"insert","lines":["ManageCuadro"]}],[{"start":{"row":62,"column":37},"end":{"row":62,"column":39},"action":"insert","lines":["()"],"id":725}],[{"start":{"row":62,"column":38},"end":{"row":62,"column":39},"action":"insert","lines":["$"],"id":726}],[{"start":{"row":62,"column":39},"end":{"row":62,"column":40},"action":"insert","lines":["b"],"id":727}],[{"start":{"row":62,"column":40},"end":{"row":62,"column":41},"action":"insert","lines":["d"],"id":728}],[{"start":{"row":62,"column":42},"end":{"row":62,"column":43},"action":"insert","lines":[";"],"id":729}],[{"start":{"row":67,"column":29},"end":{"row":67,"column":30},"action":"insert","lines":["C"],"id":730}],[{"start":{"row":67,"column":22},"end":{"row":67,"column":30},"action":"remove","lines":["$gestorC"],"id":731},{"start":{"row":67,"column":22},"end":{"row":67,"column":35},"action":"insert","lines":["$gestorCuadro"]}],[{"start":{"row":67,"column":44},"end":{"row":67,"column":45},"action":"remove","lines":["2"],"id":732},{"start":{"row":67,"column":44},"end":{"row":67,"column":45},"action":"insert","lines":["W"]}],[{"start":{"row":67,"column":45},"end":{"row":67,"column":46},"action":"insert","lines":["h"],"id":733}],[{"start":{"row":67,"column":46},"end":{"row":67,"column":47},"action":"insert","lines":["e"],"id":734}],[{"start":{"row":67,"column":47},"end":{"row":67,"column":48},"action":"insert","lines":["r"],"id":735}],[{"start":{"row":67,"column":48},"end":{"row":67,"column":49},"action":"insert","lines":["e"],"id":736}],[{"start":{"row":66,"column":8},"end":{"row":66,"column":9},"action":"insert","lines":["$"],"id":737}],[{"start":{"row":66,"column":9},"end":{"row":66,"column":10},"action":"insert","lines":["c"],"id":738}],[{"start":{"row":66,"column":10},"end":{"row":66,"column":11},"action":"insert","lines":["o"],"id":739}],[{"start":{"row":66,"column":11},"end":{"row":66,"column":12},"action":"insert","lines":["n"],"id":740}],[{"start":{"row":66,"column":12},"end":{"row":66,"column":13},"action":"insert","lines":["d"],"id":741}],[{"start":{"row":66,"column":13},"end":{"row":66,"column":14},"action":"insert","lines":["i"],"id":742}],[{"start":{"row":66,"column":14},"end":{"row":66,"column":15},"action":"insert","lines":["c"],"id":743}],[{"start":{"row":66,"column":15},"end":{"row":66,"column":16},"action":"insert","lines":["i"],"id":744}],[{"start":{"row":66,"column":16},"end":{"row":66,"column":17},"action":"insert","lines":["o"],"id":745}],[{"start":{"row":66,"column":17},"end":{"row":66,"column":18},"action":"insert","lines":["n"],"id":746}],[{"start":{"row":66,"column":18},"end":{"row":66,"column":19},"action":"insert","lines":["="],"id":747}],[{"start":{"row":64,"column":66},"end":{"row":65,"column":0},"action":"insert","lines":["",""],"id":748},{"start":{"row":65,"column":0},"end":{"row":65,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":65,"column":8},"end":{"row":65,"column":9},"action":"insert","lines":["$"],"id":749}],[{"start":{"row":65,"column":9},"end":{"row":65,"column":10},"action":"insert","lines":["e"],"id":750}],[{"start":{"row":65,"column":10},"end":{"row":65,"column":11},"action":"insert","lines":["m"],"id":751}],[{"start":{"row":65,"column":11},"end":{"row":65,"column":12},"action":"insert","lines":["a"],"id":752}],[{"start":{"row":65,"column":12},"end":{"row":65,"column":13},"action":"insert","lines":["i"],"id":753}],[{"start":{"row":65,"column":13},"end":{"row":65,"column":14},"action":"insert","lines":["l"],"id":754}],[{"start":{"row":65,"column":14},"end":{"row":65,"column":15},"action":"insert","lines":["="],"id":755}],[{"start":{"row":65,"column":15},"end":{"row":65,"column":16},"action":"insert","lines":["$"],"id":756}],[{"start":{"row":65,"column":16},"end":{"row":65,"column":17},"action":"insert","lines":["g"],"id":757}],[{"start":{"row":65,"column":16},"end":{"row":65,"column":17},"action":"remove","lines":["g"],"id":758}],[{"start":{"row":65,"column":16},"end":{"row":65,"column":17},"action":"insert","lines":["a"],"id":759}],[{"start":{"row":65,"column":17},"end":{"row":65,"column":18},"action":"insert","lines":["r"],"id":760}],[{"start":{"row":65,"column":18},"end":{"row":65,"column":19},"action":"insert","lines":["t"],"id":761}],[{"start":{"row":65,"column":19},"end":{"row":65,"column":20},"action":"insert","lines":["i"],"id":762}],[{"start":{"row":65,"column":20},"end":{"row":65,"column":21},"action":"insert","lines":["s"],"id":763}],[{"start":{"row":65,"column":15},"end":{"row":65,"column":21},"action":"remove","lines":["$artis"],"id":764},{"start":{"row":65,"column":15},"end":{"row":65,"column":23},"action":"insert","lines":["$artista"]}],[{"start":{"row":65,"column":23},"end":{"row":65,"column":24},"action":"insert","lines":["-"],"id":765}],[{"start":{"row":65,"column":24},"end":{"row":65,"column":25},"action":"insert","lines":[">"],"id":766}],[{"start":{"row":65,"column":25},"end":{"row":65,"column":26},"action":"insert","lines":["g"],"id":767}],[{"start":{"row":65,"column":26},"end":{"row":65,"column":27},"action":"insert","lines":["e"],"id":768}],[{"start":{"row":65,"column":27},"end":{"row":65,"column":28},"action":"insert","lines":["t"],"id":769}],[{"start":{"row":65,"column":28},"end":{"row":65,"column":29},"action":"insert","lines":["E"],"id":770}],[{"start":{"row":65,"column":29},"end":{"row":65,"column":30},"action":"insert","lines":["a"],"id":771}],[{"start":{"row":65,"column":29},"end":{"row":65,"column":30},"action":"remove","lines":["a"],"id":772}],[{"start":{"row":65,"column":29},"end":{"row":65,"column":30},"action":"insert","lines":["m"],"id":773}],[{"start":{"row":65,"column":30},"end":{"row":65,"column":31},"action":"insert","lines":["a"],"id":774}],[{"start":{"row":65,"column":31},"end":{"row":65,"column":32},"action":"insert","lines":["i"],"id":775}],[{"start":{"row":65,"column":32},"end":{"row":65,"column":33},"action":"insert","lines":["l"],"id":776}],[{"start":{"row":65,"column":33},"end":{"row":65,"column":35},"action":"insert","lines":["()"],"id":777}],[{"start":{"row":65,"column":35},"end":{"row":65,"column":36},"action":"insert","lines":[";"],"id":778}],[{"start":{"row":67,"column":19},"end":{"row":67,"column":49},"action":"insert","lines":["  $condicion=\"autor='$email'\";"],"id":779}],[{"start":{"row":67,"column":8},"end":{"row":67,"column":21},"action":"remove","lines":["$condicion=  "],"id":780}],[{"start":{"row":68,"column":50},"end":{"row":68,"column":51},"action":"insert","lines":["$"],"id":781}],[{"start":{"row":68,"column":51},"end":{"row":68,"column":52},"action":"insert","lines":["c"],"id":782}],[{"start":{"row":68,"column":52},"end":{"row":68,"column":53},"action":"insert","lines":["o"],"id":783}],[{"start":{"row":68,"column":53},"end":{"row":68,"column":54},"action":"insert","lines":["n"],"id":784}],[{"start":{"row":68,"column":54},"end":{"row":68,"column":55},"action":"insert","lines":["d"],"id":785}],[{"start":{"row":68,"column":55},"end":{"row":68,"column":56},"action":"insert","lines":["i"],"id":786}],[{"start":{"row":68,"column":56},"end":{"row":68,"column":57},"action":"insert","lines":["c"],"id":787}],[{"start":{"row":68,"column":57},"end":{"row":68,"column":58},"action":"insert","lines":["i"],"id":788}],[{"start":{"row":68,"column":58},"end":{"row":68,"column":59},"action":"insert","lines":["o"],"id":789}],[{"start":{"row":68,"column":59},"end":{"row":68,"column":60},"action":"insert","lines":["n"],"id":790}],[{"start":{"row":82,"column":42},"end":{"row":83,"column":0},"action":"remove","lines":["",""],"id":793}],[{"start":{"row":82,"column":42},"end":{"row":82,"column":43},"action":"remove","lines":[" "],"id":794}],[{"start":{"row":82,"column":42},"end":{"row":82,"column":43},"action":"remove","lines":[" "],"id":795}],[{"start":{"row":82,"column":42},"end":{"row":82,"column":43},"action":"remove","lines":[" "],"id":796}],[{"start":{"row":82,"column":42},"end":{"row":82,"column":43},"action":"remove","lines":[" "],"id":797}],[{"start":{"row":82,"column":42},"end":{"row":82,"column":43},"action":"remove","lines":[" "],"id":798}],[{"start":{"row":82,"column":42},"end":{"row":82,"column":43},"action":"remove","lines":[" "],"id":799}],[{"start":{"row":82,"column":42},"end":{"row":82,"column":43},"action":"remove","lines":[" "],"id":800}],[{"start":{"row":82,"column":42},"end":{"row":82,"column":43},"action":"remove","lines":[" "],"id":801}],[{"start":{"row":82,"column":42},"end":{"row":82,"column":43},"action":"remove","lines":[" "],"id":802}],[{"start":{"row":82,"column":42},"end":{"row":82,"column":43},"action":"remove","lines":[" "],"id":803}],[{"start":{"row":82,"column":42},"end":{"row":82,"column":43},"action":"remove","lines":[" "],"id":804}],[{"start":{"row":82,"column":42},"end":{"row":82,"column":43},"action":"remove","lines":[" "],"id":805}],[{"start":{"row":75,"column":29},"end":{"row":76,"column":0},"action":"remove","lines":["",""],"id":806}],[{"start":{"row":75,"column":29},"end":{"row":75,"column":30},"action":"remove","lines":[" "],"id":807}],[{"start":{"row":75,"column":29},"end":{"row":75,"column":30},"action":"remove","lines":[" "],"id":808}],[{"start":{"row":75,"column":29},"end":{"row":75,"column":30},"action":"remove","lines":[" "],"id":809}],[{"start":{"row":75,"column":29},"end":{"row":75,"column":30},"action":"remove","lines":[" "],"id":810}],[{"start":{"row":75,"column":29},"end":{"row":75,"column":30},"action":"remove","lines":[" "],"id":811}],[{"start":{"row":75,"column":29},"end":{"row":75,"column":30},"action":"remove","lines":[" "],"id":812}],[{"start":{"row":75,"column":29},"end":{"row":75,"column":30},"action":"remove","lines":[" "],"id":813}],[{"start":{"row":75,"column":29},"end":{"row":75,"column":30},"action":"remove","lines":[" "],"id":814}],[{"start":{"row":88,"column":59},"end":{"row":89,"column":0},"action":"remove","lines":["",""],"id":815}],[{"start":{"row":88,"column":59},"end":{"row":88,"column":60},"action":"remove","lines":[" "],"id":816}],[{"start":{"row":88,"column":59},"end":{"row":88,"column":60},"action":"remove","lines":[" "],"id":817}],[{"start":{"row":88,"column":59},"end":{"row":88,"column":60},"action":"remove","lines":[" "],"id":818}],[{"start":{"row":88,"column":59},"end":{"row":88,"column":60},"action":"remove","lines":[" "],"id":819}],[{"start":{"row":88,"column":59},"end":{"row":88,"column":60},"action":"remove","lines":[" "],"id":820}],[{"start":{"row":88,"column":59},"end":{"row":88,"column":60},"action":"remove","lines":[" "],"id":821}]]},"ace":{"folds":[],"scrolltop":1077,"scrollleft":0,"selection":{"start":{"row":69,"column":6},"end":{"row":69,"column":89},"isBackwards":true},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1454877539813}