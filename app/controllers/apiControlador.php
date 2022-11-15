<?php
    require_once 'app/views/apiVista.php';
    require_once 'app/models/modelo_vehiculo.php';
    require_once 'app/models/modelo_especificacion.php';

    class apiControlador {
        private $vista;
        private $modelo;
        private $modeloE;

        function __construct(){
            $this->vista = new ApiVista();
            $this->modelo = new Modelo_vehiculo();
            $this->modeloE = new Modelo_especificacion();
        }

        //TRAE TODO LOS VEHICULOS
        public function obtenerVehiculos(){
            $columnaXdefecto = "id_vehiculo";
            $ordenXdefecto = "ASC";
            $offsetXdefecto = 0;
            foreach ($_GET as $i => $valor) {
                if ($i != 'campo' && $i != 'orden' && $i != 'limite' && $i != 'offset' && $i != 'resource' && $i != 'filtro' && $i != 'valorDeFiltro') {
                        $this->vista->response('Solicitud incorrecta', 400);
                    }
            }
            //si estan ambos, columna y orden hacer esto
            if (isset($_GET['campo']) && isset($_GET['orden'])) {
                $vehiculos = $this->modelo->obtenerVehiculos($_GET['campo'], $_GET['orden']);
            }
            //si esta solo columna hacer esto
            else if (isset($_GET['campo'])) {
                $vehiculos = $this->modelo->obtenerVehiculos($_GET['campo'], $ordenXdefecto);
            }
            //si esta solo orden hacer esto
            else if (isset($_GET['orden'])) {
                $vehiculos = $this->modelo->obtenerVehiculos($columnaXdefecto, $_GET['orden']);
            } else {
                $vehiculos = $this->modelo->obtenerVehiculos($columnaXdefecto, $ordenXdefecto);
            }
            if ($vehiculos != null) {
                if (isset($_GET['filtro']) && isset($_GET['valorDeFiltro'])) {
                    if (!is_string($_GET['filtro'])){
                        $this->vista->response('Solicitud incorrecta', 400);
                        die();
                    }
                    $vehiculos = $this->filtrar($_GET['filtro'], $_GET['valorDeFiltro'], $vehiculos);
                }
                if (isset($_GET['limite']) && isset($_GET['offset'])){
                    if (!ctype_digit($_GET['limite']) || !ctype_digit($_GET['offset'])){
                        $this->view->response('Solicitud incorrecta', 400);
                        die();
                    }
                    $offset = $_GET['offset'];
                    $vehiculos = $this->paginar($_GET['limite'], $vehiculos, $offset);
                }
                //limit solo
                else if (isset($_GET['limite'])) {
                    if (!ctype_digit($_GET['limite'])){
                        $this->vista->response('Solicitud incorrecta', 400);
                        die();
                    }
                    $offset = $offsetXdefecto;
                    $vehiculos = $this->paginar($_GET['limite'], $vehiculos, $offset);
                }
                //offset solo
                else if (isset($_GET['offset'])) {
                    if (!ctype_digit($_GET['offset'])){
                        $this->vista->response('Solicitud incorrecta', 400);
                        die();
                    }
                    $limiteXdefecto = count($vehiculos);
                    $vehiculos = $this->paginar($limiteXdefecto, $vehiculos, $_GET['offset']);
                }
            $this->vista->response($vehiculos, 200);
            } else {
                $this->view->response('Solicitud incorrecta', 400);
            }
        }

        //FILTRA POR COLUMNA Y VALOR
        public function filtrar($filtro, $valor, $vehiculos){
            $vehiculoFiltrado = [];
            foreach ($vehiculos as $vehiculo) {
                if($vehiculo->$filtro == $valor){
                    array_push($vehiculoFiltrado, $vehiculo);
                }
            }            
            return $vehiculoFiltrado;
        }

        //PAGINA
        public function paginar($limite, $vehiculos, $offset){
            return array_slice($vehiculos, $offset, $limite);
        }

        //TRAE VEHICULO POR ID
        function obtenerVehiculo($params = []){
            $id = $params[":ID"];
            $vehiculo = $this->modelo->obtenerVehiculo($id);
            if($vehiculo){
                $this->vista->response($vehiculo, 200);
            }
            else {
                $this->vista->response("no existe vehiculo con este id", 404);
            }
        }

        //ELIMINA VEHICULO POR ID
        function eliminarVehiculo($params = []){
            $id = $params[":ID"];
            $vehiculo = $this->modelo->obtenerVehiculo($id);

            if ($vehiculo) {
                $this->modeloE->eliminarEspecificacion($id);
                $this->modelo->eliminarVehiculo($id);
                $this->vista->response("vehiculo id=$id eliminada con éxito", 200);
            }
            else 
                $this->vista->response("vehiculo id=$id not found", 404);
            }       
    
        
        //INSERTAR VEHICULO
        function agregarVehiculo() {
            $body = $this->obtenerBody();
            if(empty($body->vehiculo) || empty($body->categoria) || empty($body->agencia) || empty($body->imagen)){
                $this->vista->response("Faltan completar campos", 400);
            }
            else {
                $this->modelo->agregarVehiculo($body->vehiculo, $body->categoria, $body->agencia, $body->imagen);
                $this->vista->response("se creo con exito", 201);
            }
        }

        //EDITAR VEHICULO
        function editarVehiculo($params = []){
            $id = $params[":ID"];
            $vehiculo = $this->modelo->obtenerVehiculo($id);
            if($vehiculo){
                $body = $this->obtenerBody();
                if(empty($body->vehiculo) || empty($body->categoria) || empty($body->agencia) || empty($body->imagen)){
                    $this->vista->response("Faltan completar campos", 400);
                }
                else {
                    $this->modelo->editarVehiculo($id, $body->vehiculo, $body->agencia, $body->categoria, $body->imagen);
                    $this->vista->response("Se ha editado correctamente el vehiculo con id: $id", 201);
                }
            }
        }

        //OBTIENE EL BODY DEL POSTMAN
        function obtenerBody(){
            $bodyString = file_get_contents("php://input"); 
            return json_decode($bodyString); 
        }
       
    }
    
?>