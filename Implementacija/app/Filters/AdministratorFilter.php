<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdministratorFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
//        if (session()->get('korisnik') == null) {
//            return redirect()->to(site_url('Gost'));
//        } else if (session()->get('korisnik')->getType() == 'regular_user') {
//            return redirect()->to(site_url('Korisnik'));
//        } else if (session()->get('korisnik')->getType() == 'privileged_user') {
//            return redirect()->to(site_url('Privilegovani'));
//        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }

   

}