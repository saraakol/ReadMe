<?php

namespace App\Controllers;


use App\Models\Entities;

/*
 * Klasa Administrator - implementira metode kontrolera koji sluzi za funkcionalnosti Administratora
 * 
 *  @version 1.0
 */
class Administrator extends BaseController
{
    /*
     * Funkcija prikaz - sluzi za prikazivanje stranice sa nepromenljivim(header,footer) i promenljivim delovima ( sredisnji deo stranice koji se razlikuje
     * u zavistnosti od trenutne pozicije korisnika na sajtu)
     * 
     * @param string $page String
     * @param string[] $data String[]
     */
    protected function prikaz($page, $data) {
        $data['controller'] = 'Administrator';
        echo view('Sablon/header_administrator');
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
     * Funkcija prikaziRegistracije() - sluzi za prikazivanje svih zahteva korisnika za registrovanje
     * @author Andrej Jokic 18/0247
     */
    public function prikaziRegistracije() {
        $registracije = $this->doctrine->em->getRepository('\App\Models\Entities\User')->findBy(['status'=>'pending']);
        $this->prikaz('Registracije', ['registracije'=>$registracije]);
    }
   
    /*
     * Funkcija potvrdiRegistraciju() - sluzi za prihvatanje registracije korisnika, nakon cega korisnik postaje registrovan
     * @author Andrej Jokic 18/0247
     */
    public function potvrdiRegistraciju() {
//        $data['username'] = $this->request->getVar('username');
//        $data['status'] = 'registered';
//        $userModel = new UserModel();
//        $userModel->postaviStatus($data);
//        return redirect()->to(site_url('Administrator/prikaziRegistracije'));
        $user = $this->doctrine->em->getRepository('\App\Models\Entities\User')->findOneBy(['username'=>$this->request->getVar('username')]);
        $user->setStatus('registered');
        $this->doctrine->em->flush();
        return redirect()->to(site_url('Administrator/prikaziRegistracije'));
    }
    
    /*
     * Funkcija odbijRegistraciju() - sluzi za odbijanje registracije korisnika, nakon cega korisnik ostaje gost sistema
     * @author Andrej Jokic 18/0247 hahaha
     */
    public function odbijRegistraciju() {
//        $userModel = new UserModel();
//        $userModel->izbrisiKorisnika($this->request->getVar('username'));
//        return redirect()->to(site_url('Administrator/prikaziRegistracije'));
        $user = $this->doctrine->em->getRepository('\App\Models\Entities\User')->findOneBy(['username'=>$this->request->getVar('username')]);
        $this->doctrine->em->remove($user);
        $this->doctrine->em->flush();
        return redirect()->to(site_url('Administrator/prikaziRegistracije'));
    }
        
    /*
     * funkcija za log outovanje sa sistema
     * Andrej Veselinovic 2018/0221
     */
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(site_url("/"));
    }
    /*
     * funkcijz za otvaranje stranice za dodavanje nove knjige
     * Andrej Veselinovic 2018/0221
     */
    public function addBook($data=null)
    {
//        $data['controller'] = 'Administrator';
       $genres=$this->doctrine->em->getRepository(Entities\Genre::class)->findAll();
        echo view("Stranice/addBook", ["genres"=>$genres,"poruka"=>$data]);
        
    }
    /*
     * funkcija za potvrdu zahteva za dodavanje nove knjige
     * Andrej Veselinovic 2018/0221
     */
    public function addBookSubmit()
    {
        
        if(!$this->validate(['title'=>'required',"authors"=>"required","synopsis"=>"required","genres"=>"required"]))
        {
            return $this->addBook(["errors"=>$this->validator->getErrors()]);
        }
//        echo $this->request->getVar('title');
//        echo $this->request->getVar('authors');
//        echo $this->request->getVar('synopsis');
//        foreach($this->request->getVar('genres') as $genre)
//            echo $genre;
       
        
        $book=new Entities\Book();
        $book->setAuthors($this->request->getVar('authors'));
        $book->setDescription($this->request->getVar('synopsis'));
        $book->setName($this->request->getVar('title'));
        foreach($this->request->getVar('genres') as $genreId)
        {
            $genre=$this->doctrine->em->getRepository(Entities\Genre::class)->find($genreId);
            $book->addGenre($genre);
            
        }
        $this->doctrine->em->persist($book);
        
        $this->doctrine->em->flush();
        if(isset($_FILES["img"]))
        {
            
            
            $myfile = fopen("images/books/".$book->getIdb().".jpg", "wb");
            fwrite($myfile,file_get_contents($_FILES['img']['tmp_name']));
            fclose($myfile);
                   
        }
        echo "<script>alert('Successfully created new book');</script>";

        return $this->index();
    }
}

