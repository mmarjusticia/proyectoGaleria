{"filter":false,"title":"AutoCarga.php","tooltip":"/clases/AutoCarga.php","undoManager":{"mark":30,"position":30,"stack":[[{"start":{"row":8,"column":15},"end":{"row":9,"column":0},"action":"insert","lines":["",""],"id":2},{"start":{"row":9,"column":0},"end":{"row":9,"column":13},"action":"insert","lines":["             "]}],[{"start":{"row":9,"column":13},"end":{"row":9,"column":14},"action":"insert","lines":["i"],"id":3}],[{"start":{"row":9,"column":14},"end":{"row":9,"column":15},"action":"insert","lines":["f"],"id":4}],[{"start":{"row":9,"column":15},"end":{"row":9,"column":17},"action":"insert","lines":["()"],"id":5}],[{"start":{"row":9,"column":16},"end":{"row":9,"column":17},"action":"insert","lines":["e"],"id":6}],[{"start":{"row":9,"column":17},"end":{"row":9,"column":18},"action":"insert","lines":["x"],"id":7}],[{"start":{"row":9,"column":18},"end":{"row":9,"column":19},"action":"insert","lines":["i"],"id":8}],[{"start":{"row":9,"column":19},"end":{"row":9,"column":20},"action":"insert","lines":["s"],"id":9}],[{"start":{"row":9,"column":19},"end":{"row":9,"column":20},"action":"remove","lines":["s"],"id":10}],[{"start":{"row":9,"column":19},"end":{"row":9,"column":20},"action":"insert","lines":["s"],"id":11}],[{"start":{"row":9,"column":20},"end":{"row":9,"column":21},"action":"insert","lines":["t"],"id":12}],[{"start":{"row":9,"column":21},"end":{"row":9,"column":22},"action":"insert","lines":["s"],"id":13}],[{"start":{"row":9,"column":22},"end":{"row":9,"column":24},"action":"insert","lines":["()"],"id":14}],[{"start":{"row":9,"column":23},"end":{"row":9,"column":49},"action":"insert","lines":["\"clases/\" .$clase . \".php\""],"id":15}],[{"start":{"row":9,"column":16},"end":{"row":9,"column":17},"action":"insert","lines":["f"],"id":16}],[{"start":{"row":9,"column":17},"end":{"row":9,"column":18},"action":"insert","lines":["i"],"id":17}],[{"start":{"row":9,"column":18},"end":{"row":9,"column":19},"action":"insert","lines":["l"],"id":18}],[{"start":{"row":9,"column":19},"end":{"row":9,"column":20},"action":"insert","lines":["e"],"id":19}],[{"start":{"row":9,"column":20},"end":{"row":9,"column":21},"action":"insert","lines":["_"],"id":20}],[{"start":{"row":9,"column":56},"end":{"row":9,"column":57},"action":"insert","lines":["{"],"id":21}],[{"start":{"row":12,"column":10},"end":{"row":12,"column":11},"action":"insert","lines":["}"],"id":22}],[{"start":{"row":12,"column":9},"end":{"row":12,"column":12},"action":"insert","lines":["   "],"id":23}],[{"start":{"row":12,"column":13},"end":{"row":14,"column":9},"action":"insert","lines":["","             ","         "],"id":24}],[{"start":{"row":13,"column":13},"end":{"row":13,"column":14},"action":"insert","lines":["e"],"id":25}],[{"start":{"row":13,"column":14},"end":{"row":13,"column":15},"action":"insert","lines":["l"],"id":26}],[{"start":{"row":13,"column":15},"end":{"row":13,"column":16},"action":"insert","lines":["s"],"id":27}],[{"start":{"row":13,"column":16},"end":{"row":13,"column":17},"action":"insert","lines":["e"],"id":28}],[{"start":{"row":13,"column":17},"end":{"row":13,"column":18},"action":"insert","lines":["{"],"id":29}],[{"start":{"row":13,"column":18},"end":{"row":13,"column":19},"action":"insert","lines":["}"],"id":30}],[{"start":{"row":13,"column":18},"end":{"row":15,"column":13},"action":"insert","lines":["","                 ","             "],"id":31}],[{"start":{"row":0,"column":0},"end":{"row":19,"column":80},"action":"remove","lines":["<?php","","class AutoCarga {","    static function cargar($clase){","        $clase = str_replace(\"\\\\\", \"/\", $clase);","        $archivo = \"../clases/\" .$clase . \".php\";","         if (file_exists($archivo)) {","              require $archivo;","         }else{","             if(file_exists(\"clases/\" .$clase . \".php\")){","             $archivo = \"clases/\" .$clase . \".php\";","             require $archivo;","            }","             else{","                 ","             }","         }","   }","}","spl_autoload_register('AutoCarga::cargar'); // Tiene que estar fuera de la clase"],"id":32},{"start":{"row":0,"column":0},"end":{"row":19,"column":80},"action":"insert","lines":["<?php","class AutoCarga {","    ","    static function cargar($clase){","        $clase = str_replace(\"\\\\\", \"/\", $clase);","        $archivo = \"../clases/\" .$clase . \".php\";","         if (file_exists($archivo)) {","              require $archivo;","         }else{","             if(file_exists(\"clases/\" .$clase . \".php\")){","                $archivo = \"clases/\" .$clase . \".php\";","                require $archivo;","             }else{","                 //$archivo=$clase.\".php\";","                 //require $archivo;","             }","         }","   }","}","spl_autoload_register('AutoCarga::cargar'); // Tiene que estar fuera de la clase"]}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":19,"column":80},"end":{"row":19,"column":80},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1454261187678,"hash":"26fee9265c87b0ca1e704263c6e85101fabf08aa"}