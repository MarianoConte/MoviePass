<?php
    namespace DAO;

    use DAO\ICineDAO as ICineDAO;
    use Models\Cine as Cine;

    Class CineDAO implements ICineDAO
    {
        private $cineList = array();

        public function Add(Cine $cine)
        {
            $this->RetrieveData();
            array_push($this->cineList, $cine);

            $this->SaveData();
        }
        
        public function Mod($cine){
            $this->RetrieveData();
            // funcion de modificacion
            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->cineList;
        }

        public function lastId(){
            $this->RetrieveData();
            $last = end($this->cineList);
            $id = ($last == true)?$last->getId():0;
            return $id;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->cineList as $cine)
            {
                $valuesArray["valorEntrada"] = $cine->getValorEntrada();
                $valuesArray["nombre"] = $cine->getNombre();
                $valuesArray["direccion"] = $cine->getDireccion();
                $valuesArray["salas"] = $cine->getSalas();
                $valuesArray["id"] = $cine->getId();
                $valuesArray["state"] = $cine->getState();
                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/cines.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->cineList = array();

            if(file_exists('Data/cines.json'))
            {
                $jsonContent = file_get_contents('Data/cines.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                  $cine = new Cine();
                  $cine->setDireccion($valuesArray["direccion"]);
                  $cine->setValorEntrada($valuesArray["valorEntrada"]);
                  $cine->setNombre($valuesArray["nombre"]);
                  $cine->setSalas($valuesArray["salas"]);
                  $cine->setId($valuesArray["id"]);
                  $cine->setState($valuesArray["state"]);
                  array_push($this->cineList, $cine);
                }
            }
        }
    }
?>