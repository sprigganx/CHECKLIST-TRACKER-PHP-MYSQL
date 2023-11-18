<?php
    class Checklist{
        // conexion de base de datos y tabla productos
        private $conn;
        public $titulo;
        public $descripcion;
        public $responsable;
        public $fechaCompromiso;
        public $estado;
        public $tipoTarea;
       
        // constructor con $db como conexion a base de datos
        public function __construct($db){
            $this->conn = $db;
        }

        public function mostrarTareas() {
            $instruccion = "CALL sp_mostrar_tareas()";
            $consulta = $this->conn->query($instruccion);

            if ($consulta) {
                $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
                $consulta->closeCursor(); // Cerrar el cursor para permitir nuevas consultas
                return $resultado;
            } else {
                return false;
            }
        }

        public function obtenerTareaPorId($idTarea) {
            $instruccion = "CALL sp_obtener_tarea_por_id(:idTarea)";
            $stmt = $this->conn->prepare($instruccion);
    
            $stmt->bindParam(':idTarea', $idTarea);
            if ($stmt->execute()) {
                $tarea = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                return $tarea;
            } else {
                return null; // Retorna null si la consulta falla o no se encuentra la tarea
            }
        }

        public function agregarTarea(){
            $instruccion = "CALL sp_agregar_tarea(:titulo, :descripcion, :responsable, :fechaCompromiso, :estado, :tipoTarea)";
            $stmt = $this->conn->prepare($instruccion);
    
            $stmt->bindParam(':titulo', $this->titulo);
            $stmt->bindParam(':descripcion', $this->descripcion);
            $stmt->bindParam(':responsable', $this->responsable);
            $stmt->bindParam(':fechaCompromiso', $this->fechaCompromiso);
            $stmt->bindParam(':estado', $this->estado);
            $stmt->bindParam(':tipoTarea', $this->tipoTarea);
    
            return $stmt->execute();
        }

        public function editarTarea($idTarea, $titulo, $descripcion, $responsable, $fechaCompromiso, $estado, $tipoTarea) {
            $instruccion = "CALL sp_editar_tarea(:idTarea, :titulo, :descripcion, :responsable, :fechaCompromiso, :estado, :tipoTarea)";
            $stmt = $this->conn->prepare($instruccion);
    
            $stmt->bindParam(':idTarea', $idTarea);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':responsable', $responsable);
            $stmt->bindParam(':fechaCompromiso', $fechaCompromiso);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':tipoTarea', $tipoTarea);
    
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function eliminarTarea($idTarea) {
            $instruccion = "CALL sp_eliminar_tarea(:idTarea)";
            $stmt = $this->conn->prepare($instruccion);
            
            $stmt->bindParam(':idTarea', $idTarea, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }
?>