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

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."cine-add.php");
        }

        public function ShowListView()
        {
            $cineList = $this->cineDAO->GetAll();

            require_once(VIEWS_PATH."cine-list.php");
        }

        public function Add($nombre, $direccion, $salas, $valorEntrada)
        {
          $cine = new Cine();
          $cine->setValorEntrada($valorEntrada);
          $cine->setNombre($nombre);
          $cine->setDireccion($direccion);
          $cine->setSalas($salas);


          $this->cineDAO->Add($cine);

          $this->ShowAddView();
        }
    }
?>