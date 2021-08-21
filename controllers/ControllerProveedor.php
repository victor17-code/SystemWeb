<?php

include '../bd/autoload.php';

class ControllerProveedor {

    public function mostrarUsuario($idProveedor) {
        $prov = new Proveedor();
        return $prov->mostrarUsuario($idProveedor);
    }

    public function updateProveedor(array $datos) {
        $proveedor = new Proveedor();
        if (isset($datos['idproveedor'])) {
            $proveedor->setIdProveedor($datos['idproveedor']);
        }
        $proveedor->setTelefono($datos['telefono']);
        $proveedor->setNombreUsuario($datos['usuario']);
        $proveedor->UpdateProveedorFruto();
    }
    public function cambiarPassword(array $datos) {
        $proveedor = new Proveedor();
        if (isset($datos['idproveedor'])) {
            $proveedor->setIdProveedor($datos['idproveedor']);
        }
        $proveedor->setPassword($datos['telefono']);       
        $proveedor->cambiarPassword();
    }

}
