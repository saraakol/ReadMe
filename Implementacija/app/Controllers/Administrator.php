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
     * Funkcija prikaziProfil() - Prikazuje profil korisnika
     * @author Andrej Jokic 18/0247
     */
    public function prikaziProfil() {
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(['idu'=>$this->session->get("korisnik")->getIdu()]);
        $this->prikaz('Profil', ['korisnik'=>$user]);
    }
    
    /*
     * Funkcija dodajCilj() - Dodaje licni cilj korisniku
     * @author Andrej Jokic 18-0247
     */
    function dodajCilj() {
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(['username'=>$this->request->getVar('username')]);
        $user->setPersonalGoal($this->request->getVar('brojKnjiga'));
        $this->doctrine->em->flush();
        return redirect()->to(site_url('Administrator/prikaziProfil'));
    }
    
    /*
     * Funkcija prikaziRegistracije() - sluzi za dohvatanje svih korisnika koji su poslali zahtev za registraciju
     * @author Andrej Jokic 18/0247
     */
    public function prikaziRegistracije() {
        $korisnici = $this->doctrine->em->getRepository(Entities\User::class)->findBy(['status'=>'pending']);
        $this->prikaz('Zahtevi', ['korisnici'=>$korisnici, 'zahtev'=>'Registrations']);
    }
   
    /*
     * Funkcija acceptRegistrations() - sluzi za prihvatanje registracije korisnika, nakon cega korisnik postaje registrovan
     * @author Andrej Jokic 18/0247
     */
    public function acceptRegistrations() {
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(['username'=>$this->request->getVar('username')]);
        $user->setStatus('registered');
        $this->doctrine->em->flush();
        return redirect()->to(site_url('Administrator/prikaziRegistracije'));
    }
    
    /*
     * Funkcija declineRegistrations() - sluzi za odbijanje registracije korisnika, nakon cega korisnik ostaje gost sistema
     * @author Andrej Jokic 18/0247
     */
    public function declineRegistrations() {
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(['username'=>$this->request->getVar('username')]);
        $this->doctrine->em->remove($user);
        $this->doctrine->em->flush();
        return redirect()->to(site_url('Administrator/prikaziRegistracije'));
    }
    
    /*
     * Funkcija prikaziPrijave() - sluzi za dohvatanje svih korisnika koji su prijavljeni od strane drugog korisnika 
     * @author Andrej Jokic 18/0247
     */
    public function prikaziPrijave() {
        $korisnici = $this->doctrine->em->getRepository(Entities\User::class)->findBy(['status'=>'reported']);
        $this->prikaz('Zahtevi', ['korisnici'=>$korisnici, 'zahtev'=>'Reports']);
    }
      
    /*
     * Funkcija acceptReports() - sluzi za prihvatanje prijave korisnika, nakon cega se korisnik brise iz sistem
     * @author Andrej Jokic 18/0247
     */
    public function acceptReports() {
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(['username'=>$this->request->getVar('username')]);
        $this->doctrine->em->remove($user);
        $this->doctrine->em->flush();
        return redirect()->to(site_url('Administrator/prikaziPrijave'));
    }
    
    /*
     * Funkcija declineReports() - sluzi za odbijanje prijave korisnika, nakon cega se tip korisnika u sistemu ne menja
     * @author Andrej Jokic 18/0247
     */
    public function declineReports() {
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(['username'=>$this->request->getVar('username')]);
        $user->setStatus('registered');
        $this->doctrine->em->flush();
        return redirect()->to(site_url('Administrator/prikaziPrijave'));
    }
    
    /*
     * Funkcija prikaziUnapredjenja() - sluzi za dohvatanje svih korisnika koji su procitali vise od 100 knjiga i kandidati su za unapredjenje
     * @author Andrej Jokic 18/0247
     */
    public function prikaziUnapredjenja() {
        $korisnici = $this->doctrine->em->getRepository(Entities\User::class)->dohvatiKandidateZaUnapredjenje();
        $this->prikaz('Zahtevi', ['korisnici'=>$korisnici, 'zahtev'=>'Upgrades']);
    }
    
    /*
     * Funkcija acceptUpgrades() - sluzi za unapredjivanje korisnika u privilegovanog
     * @author Andrej Jokic 18/0247
     */
    public function acceptUpgrades() {
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(['username'=>$this->request->getVar('username')]);
        $user->setType('privileged_user');
        $this->doctrine->em->flush();
        return redirect()->to(site_url('Administrator/prikaziUnapredjenja')); 
    }
    
        /*
     * Funkcija acceptUpgrades() - sluzi za unapredjivanje korisnika u privilegovanog
     * @author Andrej Jokic 18/0247
     */
    public function declineUpgrades() {
        return redirect()->to(site_url('Administrator/prikaziUnapredjenja')); 
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

