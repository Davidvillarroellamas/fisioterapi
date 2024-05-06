<?php
    require('Database.php');

    class Masaje{
        public static function create_masaje($nombre, $descripcion, $duracion, $precio){
            $database = new Database();
            $conn = $database->getConnection();
        
            $stmt = $conn->prepare('INSERT INTO masaje(nombre, descripcion, duracion, precio) VALUES(:nombre, :descripcion, :duracion, :precio)');
            
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':duracion', $duracion);
            $stmt->bindParam(':precio', $precio);
        
            if ($stmt->execute()) {  
                header('HTTP/1.1 201 Created');
                echo json_encode(array("message" => "Masaje creado correctamente."));
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                echo json_encode(array("message" => "Error al crear el masaje."));
            }
        }
        
        public static function delete_masaje($id){
            $database = new Database();
            $conn = $database->getConnection();

            $stmt = $conn->prepare('DELETE FROM masaje WHERE id=:id');
            $stmt->bindParam(':id', $id);
            
            if ($stmt->execute()) {
                http_response_code(200);
                echo json_encode(array("message" => "El masaje se borró exitosamente"));
            } else {
                http_response_code(500);
                echo json_encode(array("message" => "No se pudo borrar el masaje"));
            }
        }
        


        public static function get_all_masajes(){
            $database = new Database();
            $conn = $database->getConnection();
        
            $stmt = $conn->prepare('SELECT * FROM masaje');
        
            if ($stmt->execute()) {
                $result = $stmt->fetchAll();
                header('Content-Type: application/json');
                header('HTTP/1.1 202 ok');
                echo json_encode($result);
                return json_encode($result);
            } else {
                header('HTTP/1.1 401 fallo');
                echo "Error en el listado";
            }
        }
        public static function get_id_masaje($id){
            $database = new Database();
            $conn = $database->getConnection();
        
            $stmt = $conn->prepare('SELECT * FROM masaje WHERE id = :id');
            $stmt->bindParam(':id',$id);
            
        
            if ($stmt->execute()) {
                $result = $stmt->fetchAll();
                header('HTTP/1.1 202 ok');
                echo json_encode($result);
                return json_encode($result);
            } else {
                header('HTTP/1.1 401 fallo');
                echo "Error en el listado";
            }
        }


        public static function update_masaje($id, $nombre, $descripcion, $duracion,$precio){
            $database = new Database();
            $conn = $database->getConnection();
        
            $stmt = $conn->prepare('UPDATE masaje SET nombre=:nombre, descripcion=:descripcion, duracion=:duracion, precio=:precio WHERE id=:id');
        
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':duracion', $duracion);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':id', $id);
        
            if ($stmt->execute()) {
                header('HTTP/1.1 201 el masaje se actualizo correctamente');
                echo json_encode(array("message" => "Masaje actualizada correctamente."));
            } else {
                header('HTTP/1.1 401 el masaje no se pudo actualizar');
                echo json_encode(array("message" => "Nose pudo actualizar el masaje."));
            }
        }
        
        
    }


?>