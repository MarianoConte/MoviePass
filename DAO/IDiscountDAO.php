<?php

namespace DAO;

use Models\Discount as Discount;

interface IDiscountDAO
{
    function GetAll();
    function GetById($discount_id);
    function Add(Discount $discount);
    function Edit(Discount $discount);
    function Desactivate($discount_id);
    function Activate($discount_id);
}

?>