<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdministratorFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
//        $user = session()->get("korisnik");
//        if ($user == null) {
//            return redirect()->to(site_url("Gost"));
//        } else if ($user->getType() != 'administrator') {
//            return redirect()->to(site_url("Korisnik"));
//        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }

   

}