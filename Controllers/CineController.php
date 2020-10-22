<?php

namespace Controllers;

use DAO\CineDAO as CineDAO;
use Models\Cine as Cine;

class CineController
{
    private $cineDAO;

    public function __construct()
    {
        $this->cineDAO = new CineDAO();
    }

    public function ShowAddView($nameError = "")
    {
        require_once(VIEWS_PATH . "cine-add.php");
    }

    public function ShowModView($id, $nameError = "")
    {
        $cine = $this->cineDAO->getById($id);
        require_once(VIEWS_PATH . "cine-mod.php");
    }

    public function ShowListView()
    {
        $cineList = $this->cineDAO->GetAll();

        require_once(VIEWS_PATH . "cine-list.php");
    }

    public function Add($nombre, $direccion, $salas, $valorEntrada)
    {
        if ($this->validateName($nombre) == true) {
            $id = $this->cineDAO->lastId() + 1;

            $cine = new Cine();
            $cine->setValorEntrada($valorEntrada);
            $cine->setNombre($nombre);
            $cine->setDireccion($direccion);
            $cine->setSalas($salas);
            $cine->setId($id);
            $cine->setState(true);

            $this->cineDAO->Add($cine);
            $this->ShowAddView();
        } else {
            //error de nombre view
            $this->ShowAddView("nameError");
        }
    }

    public function Mod($nombre, $direccion, $salas, $valorEntrada, $id)
    {
        if ($this->validateName($nombre, $id) == true) {
            $cine = new Cine();
            $cine->setValorEntrada($valorEntrada);
            $cine->setNombre($nombre);
            $cine->setDireccion($direccion);
            $cine->setSalas($salas);
            $cine->setId($id);
            $this->cineDAO->Mod($cine);

            $this->ShowListView();
        } else {
            //error de nombre view
            $this->ShowModView($id, "nameError");
        }
    }

    public function Delete($id)
    {
        $this->cineDAO->Delete($id);
        $this->ShowListView();
    }

    public function validateName($name, $id = null)
    { // devuelve false si el nombre es invalido
        $res = true;
        $con = $this->cineDAO->GetByName($name);
        if ($name == "" || ($con && $con->getId() != $id)) {
            $res = false;
        }
        return $res;
    }

    public function Activate($id)
    {
        $this->cineDAO->Activate($id);
        $this->ShowListView();
    }
}
