<?php

namespace BasicFlowBundle\Retainer;


interface RetainerInterface
{
    /**
     * Clear all data defined in retainer container.
     * This method must be called before retaining and after retaining
     * to ensure clean flow of pages.
     *
     * @return mixed
     */
    public function clearPaging();

    /**
     * Set data in your retainer
     *
     * @param $id
     * @param $data
     * @return mixed
     */
    public function setData($id, $data);

    /**
     * Get data from your retainer
     *
     * @param $id
     * @return mixed
     */
    public function getData($id);

    /**
     * Remove data from retainer
     *
     * @param $id
     * @return mixed
     */
    public function removeData($id);
}