<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class PrivilegovaniFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session=session();
        $korisnik=$session->get("korisnik");
        if($korisnik==null)
            return redirect()->to(site_url("Gost"));
        if($korisnik->getType()=="administrator")
            return redirect()->to(site_url("Administrator"));
        if($korisnik->getType()=="regular_user")
            return redirect()->to(site_url("Korisnik"));
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }

   

}