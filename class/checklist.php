<?php

    require_once('modelo.php');

    class Checklist extends modeloCredencialesBD {
        protected $titulo;
        protected $descripcion;
        protected $estado;
        protected $fechaCompromiso;
        protected $etiquetaEditado;
        protected $responsable;
        protected $tipoTarea;
    
        public function __construct($titulo, $descripcion, $estado, $fechaCompromiso, $etiquetaEditado, $responsable, $tipoTarea) {
            parent::__construct(); // Llama al constructor de la clase padre
            $this->titulo = $titulo;
            $this->descripcion = $descripcion;
            $this->estado = $estado;
            $this->fechaCompromiso = $fechaCompromiso;
            $this->etiquetaEditado = $etiquetaEditado;
            $this->responsable = $responsable;
            $this->tipoTarea = $tipoTarea;
        }
    
        public function mostrarTareas() {
            $instruccion = "CALL sp_mostrar_tareas()";
    
            $consulta = $this->_db->query($instruccion);
            $resultado = $consulta->fetch_all(MYSQLI_ASSOC);
    
            if ($resultado) {
                return $resultado;
            }
        }
    
        public function agregarTarea() {
            $instruccion = "CALL sp_agregar_tarea(
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