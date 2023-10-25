<?php

    require_once('modelo.php');

    class Checklist extends modeloCredencialesBD {
    
        public function __construct() {
            parent::__construct(); // Llama al constructor de la clase padre
        }
        
        /* public static function mostrarTareas() {
            $modelo = new self(); // Crea una instancia de la clase Checklist
            $instruccion = "CALL sp_mostrar_tareas()";
        
            $consulta = $modelo->_db->query($instruccion);
            $resultado = $consulta->fetch_all(MYSQLI_ASSOC);
        
            if ($resultado) {
                return $resultado;
            }
        } */
        
        public function mostrarTareasPorEstado($estado) {
            $instruccion = "CALL sp_mostrar_tareas_por_estado('$estado')";
            $consulta = $this->_db->query($instruccion);
            $resultado = $consulta->fetch_all(MYSQLI_ASSOC);
        
            if ($resultado) {
                return $resultado;
            } else {
                return array(); // Devuelve un array vacío si no se encontraron tareas
            }
        }
        
        public function agregarTarea($titulo, $descripcion, $responsable, $fechaCompromiso, $estado, $tipoTarea) {
            $instruccion = "CALL sp_agregar_tarea('" . $titulo . "', '" . $descripcion . "', '" . $responsable . "', '" . $fechaCompromiso . "', '" . $estado . "', '" . $tipoTarea . "')";
            $crear = $this->_db->query($instruccion);

            if ($crear) {
                return true;
            } else {
                return false;
            }
        }    

        public function editarTarea($idTarea) {
            $instruccion = "CALL sp_editar_tarea(
                $idTarea,
                '{$this->titulo}',
                '{$this->descripcion}',
                '{$this->estado}',
                '{$this->fechaCompromiso}',
                '{$this->etiquetaEditado}',
                '{$this->responsable}',
                '{$this->tipoTarea}'
            )";
    
            $consulta = $this->_db->query($instruccion);
    
            if ($consulta) {
                return true;
            } else {
                return false;
            }
        }

        public function eliminarTarea($idTarea) {
            $instruccion = "CALL sp_eliminar_tarea($idTarea)";
            $consulta = $this->_db->query($instruccion);
        
            if ($consulta) {
                return true;
            } else {
                return false;
            }
        }
            
    
    }
?>