<?php

class GetFilter
{

    public $getVar;
    public function __construct()
    {
        $this->validator();
    }
    private function validator()
    {

        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

        $explodeurl = explode('=', $url);

        $value = $explodeurl[1];

        $this->getVar = filter_var($value, FILTER_VALIDATE_INT);
    }

    public function getVar()
    {
        return $this->getVar;
    }
}
