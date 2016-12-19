<?php

namespace BasicFlowBundle\Retainer;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class CookieRetainer extends BaseRetainer
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @param RequestStack $request_stack
     */
    public function setRequest(RequestStack $request_stack)
    {
        $this->request = $request_stack->getCurrentRequest();
    }

    /*
     * clears all set data for flow paging
     */
    public function clearPaging()
    {
        foreach($this->flowVariables as $var) {
            $this->request->cookies->remove($var);
        }
    }

    public function setData($id, $data)
    {
        $this->request->cookies->set($id, $data);
    }

    public function getData($id)
    {
        return $this->request->cookies->get($id);
    }

    public function removeData($id)
    {
        $this->request->cookies->remove($id);
    }


}
