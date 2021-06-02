<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class GostFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    { 
        if (session()->get('korisnik') != null) {
            if (session()->get('korisnik')->getType() == 'administrator') {
                return redirect()->to(site_url('Administrator'));
            } else if (session()->get('korisnik')->getType() == 'privileged_user') {
                return redirect()->to(site_url('Privilegovani'));
            } else {
                return redirect()->to(site_url('Korisnik'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }

   

}