<?php
/**
 * Created by PhpStorm.
 * User: gkatilevicius
 * Date: 16.12.17
 * Time: 15.14
 */

namespace BasicFlowBundle\Retainer;


abstract class BaseRetainer implements RetainerInterface
{
    protected $flowVariables = [

    ];

    abstract public function clearPaging();

    abstract public function setData($id, $data);

    abstract public function getData($id);

}