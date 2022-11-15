<?php
    class Modelo_vehiculo {

        //nos conectamos a la base de datos
        function conectarVehiculos(){
            $db = new PDO('mysql:host=localhost;'.'dbname=fiat_db;charset=utf8', 'root', '');
            return $db;
        }

        public function obtenerVehiculos($campo, $orden){
            $db = $this->conectarVehiculos();
            $arr = 'SELECT * FROM vehiculos ORDER BY ';
            $columns = array(
                'id_vehiculo' => 'id_vehiculo',
                'vehiculo' => 'vehiculo',
                'categoria' => 'categoria',
                'agencia' => 'agencia',
                'imagenee' => 'genero',
                'descripcion' => 'descripcion'
            );
            if (isset($columns[$campo])) {
                $arr .= $columns[$campo] ." ";
            } 
            else {
                return null;
            }
            if (strtoupper($orden) == 'ASC' || strtoupper($orden) == 'DESC') {
                $arr .= $orden;
            }
            else{
                return null;
            }
            $sentencia = $db->prepare($arr); 
            $sentencia->execute();
            $vehiculos = $sentencia->fetchAll(PDO::FETCH_OBJ);
            return $vehiculos;
        }

        //elimina un vehiculo en especial por el id
        function eliminarVehiculo($id_vehiculo){
            $db = $this->conectarVehiculos();
            $sentencia = $db->prepare("DELETE FROM vehiculos WHERE id_vehiculo = ?");
            $sentencia->execute([$id_vehiculo]);
        }

        //agregar un nuevo vehiculo a la base de datos
        function agregarVehiculo($vehiculo, $categoria, $agencia, $imagen = null){
            $db = $this->conectarVehiculos();
            $sentencia = $db->prepare("INSERT INTO vehiculos(vehiculo, categoria, agencia, imagen) VALUES (?, ?, ?, ?)");
            $sentencia->execute([$vehiculo, $categoria, $agencia, $imagen]);
        }

        //edita un vehiculo en especial por el id
        function editarVehiculo($id_vehiculo, $vehiculo, $agencia, $categoria, $imagen = null){
            $db = $this->conectarVehiculos();
            $sentencia = $db->prepare("UPDATE vehiculos SET vehiculo=?, categoria=?, agencia=?, imagen=? WHERE id_vehiculo = ?");
            $sentencia->execute([$vehiculo, $categoria, $agencia, $imagen, $id_vehiculo]);
        }
    
        //obtiene un vehiculo en especial por el id
        function obtenerVehiculo($id_vehiculo){
            $db = $this->conectarVehiculos();
            $sentencia = $db->prepare("SELECT id_vehiculo, vehiculo, agencia, categoria, imagen  FROM vehiculos WHERE id_vehiculo = ?");
            $sentencia->execute([$id_vehiculo]);
            $vehiculo = $sentencia->fetch(PDO::FETCH_OBJ);
            return $vehiculo;
        }  

        //obtiene un vehiculo en especial por el id
        function obtener($vehiculo, $categoria, $agencia){
            $db = $this->conectarVehiculos();
            $sentencia = $db->prepare("SELECT vehiculo, categoria, agencia FROM vehiculos WHERE vehiculo, categoria, agencia = ? ? ?");
            $sentencia->execute([$vehiculo, $categoria, $agencia]);
            $vehiculo = $sentencia->fetch(PDO::FETCH_OBJ);
            return $vehiculo;
        }  

        function obtenerVehiculosXcategoria($categoria){
            $db = $this->conectarVehiculos();
            $sentencia = $db->prepare("SELECT `vehiculo`, `categoria` FROM `vehiculos` WHERE `categoria` = ?");
            $sentencia->execute([$categoria]);
            $vehiculos = $sentencia->fetchAll(PDO::FETCH_OBJ);
            return $vehiculos;
        }

        function obtenerVehiculosFiltrados($vehiculo){
            $db = $this->conectarVehiculos();
            $sentencia = $db->prepare("SELECT * FROM `vehiculos` WHERE `vehiculo` = ?");
            $sentencia->execute([$vehiculo]);
            $vehiculos = $sentencia->fetchAll(PDO::FETCH_OBJ);
            return $vehiculos;
        }
    }
?>