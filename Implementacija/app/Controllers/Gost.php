<?php

namespace App\Controllers;
use App\Models\Entities;
/*
 * Klasa Gost - implementira metode kontrolera koji sluzi za funkcionalnosti Gosta 
 * 
 *  @version 1.0
 */
class Gost extends BaseController
{
    /*
     * Funkcija prikaz - sluzi za prikazivanje stranice sa nepromenljivim(header,footer) i promenljivim delovima ( sredisnji deo stranice koji se razlikuje
     * u zavistnosti od trenutne pozicije korisnika na sajtu)
     * 
     * @param string $page String
     * @param string[] $data String[]
     */
    protected function prikaz($page, $data) {
        $data['controller'] = 'Gost';
        echo view('Sablon/header_gost');
        echo view("Stranice/$page", $data);
        echo view('Sablon/footer');
    }
    
     /*
     * Funkcija index - pocetna stranica za gosta
     */
    public function index() {
        $this->prikaz('Pocetna', []);
    }
    
    /*
     * Andrej Veselinovic prikaz stranice za registrovanje
     */
    public function register($poruka=null)
    {
        $data['controller'] = 'Gost';
        //echo view('Sablon/header_gost');
        echo view("Stranice/register", ["poruka"=>$poruka]);
        //$this->prikaz("register",["poruka"=>$poruka]);

    }
    
    public function registerSubmit()
    {
        
        if(!$this->validate(['firstname'=>'required','lastname'=>'required','username'=>'required','email'=>'required',
            'password'=>'required','repeatpassword'=>'required']))
        {
            return $this->register(["errors"=>$this->validator->getErrors()]);
            
//            return $this->prikaz("register",["errors"=>$this->validator->getErrors()]);
        }
        if($this->request->getVar("password")!==$this->request->getVar("repeatpassword"))
        {
            $_SERVER["REQUEST_URI"]="../register";
            return $this->register(["errors"=>["Passwords dont match"]]);
        }
        
        $user=new Entities\User();
        $user->setEmail($this->request->getVar("email"));
        $user->setFirstname($this->request->getVar("firstname"));
        $user->setLastname($this->request->getVar("lastname"));
        $user->setPassword($this->request->getVar("password"));
        $user->setUsername($this->request->getVar("username"));
        $user->setStatus("pending");
        $user->setType("regular_user");
        
        try{
        $this->doctrine->em->persist($user);
        
        $this->doctrine->em->flush();
        }
        catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e)
        {
            return $this->register(["errors"=>["Username not unique"]]);
        }
        if(isset($_FILES["img"]))
        {
            
            
            $myfile = fopen("images/users/".$user->getIdu().".jpg", "wb");
            fwrite($myfile,file_get_contents($_FILES['img']['tmp_name']));
            fclose($myfile);
                   
        }
        echo "<script>alert('Successfully created, wait for administrator approval.');</script>";
//        redirect()->to(site_url("Gost/index")); 
        return $this->index();
    }
}
