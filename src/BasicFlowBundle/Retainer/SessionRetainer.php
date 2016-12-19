<?php

namespace BasicFlowBundle\Retainer;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;

class SessionRetainer extends BaseRetainer
{
    /**
     * @var Session
     */
    protected $session;

    protected $flowVariables = [];

    /**
     * @param RequestStack $request_stack
     */
    public function setSession(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param array $params
     */
    public function setBasicFlowParams($params)
    {
        $this->flowVariables = $params;
    }

    /*
     * clears all set data for flow paging
     */
    public function clearPaging()
    {
        foreach($this->flowVariables['retain_data_keys'] as $var) {
            $this->session->remove($var);
        }
    }

    public function setData($id, $data)
    {
        $this->session->set($id, $data);
    }

    public function getData($id)
    {
        return $this->session->get($id);
    }

    public function removeData($id)
    {
        $this->session->remove($id);
    }
}
