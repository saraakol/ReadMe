<?php

namespace App\Controllers;

use App\Models\Entities;

/*
 * Klasa Korisnik - implementira metode kontrolera koji sluzi za funkcionalnosti Korisnika(privilegovanog i registrovanog)
 * 
 *  @version 1.0
 */

class Korisnik extends BaseController {

    protected function prikaz($page, $data) {
        $data['controller'] = 'Korisnik';
        if ($page=='Pocetna') echo view('Sablon/header_korisnik', ['controller'=>'Korisnik']);
        else echo view('Sablon/header', ['controller'=>'Korisnik']);
        echo view("Stranice/$page", $data);
        echo view('Sablon/footer');
    }

    /*
     * funkcija za prikaz pocetne stranice
     * Sara Kolarevic 2018/0388
     */
    public function index($poruka=null) {
        
        if(isset($_SESSION["displayNotificationMessage"]))
        {
            $poruka=$_SESSION["displayNotificationMessage"];
            unset($_SESSION["displayNotificationMessage"]);
        }
        parent::index($poruka);
    }

    public function logout() {
        $this->session->destroy();
        return redirect()->to(site_url("/"));
    }
    
    protected function getController() {
        if (session()->get('korisnik')->getType() == 'administrator') {
            return 'Administrator';
        } else if (session()->get('korisnik')->getType() == 'regular_user') {
            return 'Korisnik';
        } else {
            return 'Privilegovani';
        }
    }

    /*
     * Funkcija dodajPretplatu() - Sluzi za dodavanje pretplate korisnika na odredjeni zanr
     * @author Andrej Jokic 18/0247
     */
    function dodajPretplatu() {
        //$user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["idu" => $this->request->getVar('idU')]);
        $user = $this->doctrine->em->getRepository(Entities\User::class)->find(session()->get("korisnik")->getIdu());
        $selected = $this->request->getVar('list'); //Id zanra
        $genre = $this->doctrine->em->getRepository(Entities\Genre::class)->findOneBy(['idg' => $selected]);

        $user->addGenre($genre);     //Owner strana asocijacije
        $this->doctrine->em->flush();
        
        session()->setFlashdata("poruka", "Subscription successfully added!");

        return redirect()->to(site_url("/{$this->getController()}/prikaziProfil"));
    }
    
    /*
     * Funkcija ukloniPretplatu() - Sluzi za uklanjanje pretplate korisnika na odredjeni zanr
     * @author Andrej Jokic 18/0247
     */

    function ukloniPretplatu() {
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["idu" => $this->request->getVar('idU')]);
        $selected = $this->request->getVar('list'); //Id zanra
        $genre = $this->doctrine->em->getRepository(Entities\Genre::class)->findOneBy(['idg' => $selected]);

        $user->removeGenre($genre);     //Owner strana asocijacija
        $this->doctrine->em->flush();

        session()->setFlashdata("poruka", "Subscription successfully removed!");
        
        return redirect()->to(site_url("/{$this->getController()}/prikaziProfil"));
    }
   
    /*
     * Funkcija prikazi Profil - Prikazuje p rofil korisnika
     * @author Andrej Jokic 18/0247,Nikola Krstic 18/0546
     */

    public function prikaziProfil() {
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["idu" => session()->get("korisnik")->getIdu()]);
        $brProcitanih = $this->doctrine->em->getRepository(Entities\User::class)->dohvatiBrojProcitanihKnjiga($user->getIdu());
        $pretplaceniZanrovi = $this->doctrine->em->getRepository(Entities\Genre::class)->dohvatiPretplaceneZanroveKorisnika($user->getIdu());
        $nepretplaceniZanrovi = $this->doctrine->em->getRepository(Entities\Genre::class)->dohvatiNepretplaceneZanroveKorisnika($user->getIdu());
        
        $all = $this->doctrine->em->getRepository(Entities\Userbooks::class)->dohvatiSve($user->getIdu());
        $read = $this->doctrine->em->getRepository(Entities\Userbooks::class)->dohvatiProcitane($user->getIdu());
        $wantToRead = $this->doctrine->em->getRepository(Entities\Userbooks::class)->dohvatiWantToRead($user->getIdu());
        $knjige = $this->doctrine->em->getRepository(Entities\Book::class)->findAll();
        
        $data = ['korisnik' => $user, 'brProcitanih' => $brProcitanih, 'pretplaceni' => $pretplaceniZanrovi,
            'nepretplaceni' => $nepretplaceniZanrovi, 'all' => $all, 'read' => $read, 'wantToRead' => $wantToRead, 'knjige' => $knjige];
        
        if (session()->getFlashdata('poruka') != null) {
            $data['poruka'] = session()->getFlashdata('poruka');
        }
        
        $this->prikaz('Profil', $data);
    }   

    /*
     * komentarisanje knjige
     * Andrej Veselinovic 2018/0221
     */
    public function addReview($id,$poruka=null){
//        $referer=$_SERVER['HTTP_REFERER'];
        
        echo view("Stranice/Review", ["poruka"=>$poruka,"bookId"=>$id,"controller"=>$this->getController()]);    
    }
    
    
    /*
     * ocenjivanje knjige
     * Nikola Krstic 18/0546
     */
    public function addRate($id,$poruka=null){
        //$referer=$_SERVER['HTTP_REFERER'];
        echo view("Stranice/Rate", ["poruka"=>$poruka,"bookId"=>$id,"controller"=>$this->getController()]);
    }
    
    /*
     * potvrdnjivanje komentarisanja knjige
     * Andrej Veselinovic 2018/0221
     */
    public function registerAddReview(){
        
//        $user=$this->session->get("korisnik");
        $user=$this->doctrine->em->getRepository(\App\Models\Entities\User::class)->find($this->session->get("korisnik")->getIdu());
        $bookId=$this->request->getVar("hiddenBook");
        
        $text=$this->request->getVar("review");
        
        
        $book=$this->doctrine->em->getRepository(\App\Models\Entities\Book::class)->find($bookId);
        $review=new \App\Models\Entities\Review();
        $review->setBook($book);
        $review->setUser($user);
        $review->setText($text);
//        $user->addReview($review);
//        $book->addReview($review);
//        echo $review->getBook()->getIdb();
//        echo $review->getUser()->getIdu();
//        echo $review->getText();
//        echo count($args);
        $this->doctrine->em->persist($review);      
        $this->doctrine->em->flush();
        $path="";
//        for($i=3;$i<count($args);$i++)
//        {   
//            
//            $path=$path."/".$args[$i];
//        }
//echo intval($args[count($args)-1]);
        
        
        
//        return $this->prikaziKnjigu($bookId,"Successfully added new review");
        $_SESSION["displayNotificationMessage"]="Successfully added new review";
        return redirect()->to(site_url("/{$this->getController()}/prikaziKnjigu/{$bookId}"));

    }
    
    /*
     * Funkicja za dodavanje na Want to read listu
     * @author Nikola Krstic 18/0546
     */
    public function dodajNaWantListu() {
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["idu" => session()->get("korisnik")->getIdu()]);
        $book = $this->doctrine->em->getRepository(Entities\Book::class)->findOneBy(["idb" => $this->request->getVar('idb')]);
        $userBookk = $this->doctrine->em->getRepository(Entities\Userbooks::class)->findOneBy(["idu" => session()->get("korisnik")->getIdu(),"idb" => $book->getIdb()]);
        
        if($userBookk==null){

            $userbook = new Entities\Userbooks();

            $userbook->setType("want-to-read");
            $userbook->setIdb($book);
            $userbook->setIdu($user);

            $user->addBook($userbook); //ovde je greska
            $this->doctrine->em->persist($userbook);
            $this->doctrine->em->persist($user);
            $this->doctrine->em->persist($book);
            $this->doctrine->em->flush();
            return $this->prikaziKnjigu($book->getIdb(),"Book successfully added to want to read list");
        }else{
            return $this->prikaziKnjigu($book->getIdb(),"Book already exist on your lists");
        }
    }

    
    private function makeUserBook(){
        $userbook = new Entities\Userbooks();
        $userbook->setType("read");
        return $userbook;
    }
    
    /*
     * Funkcija za dodavanje na read listu
     * Nikola Krstic 18/0546
     */
    public function dodajNaReadListu() {
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["idu" => session()->get("korisnik")->getIdu()]);
        $book = $this->doctrine->em->getRepository(Entities\Book::class)->findOneBy(["idb" => $this->request->getVar('idb')]);
        $userBookk = $this->doctrine->em->getRepository(Entities\Userbooks::class)->findOneBy(["idu" => session()->get("korisnik")->getIdu(),"idb" => $book->getIdb()]);
        $poruka="Book successfully added to read list";
        if($userBookk!=null){
            if($userBookk->getType()=="read"){                  //ukoliko postoji na read listi
                return $this->prikaziKnjigu($book->getIdb(),"Book already exist on read list");
            }else{      
                $poruka="Book moved from want to read list to read list";       //ukoliko postoji na write listi treba je izbaciti sa te liste
                $this->doctrine->em->remove($userBookk);
            }
        }
        $userbook = $this->makeUserBook();
        $userbook->setIdb($book);
        $userbook->setIdu($user);
        $user->addBook($userbook);
        
        $this->doctrine->em->persist($userbook);
        $this->doctrine->em->persist($user);
        $this->doctrine->em->persist($book);
        $this->doctrine->em->flush();
        $this->prikaziKnjigu($book->getIdb(),$poruka);
    }

    private function setMessageRate($text){
        if(is_numeric($text)){
            if(intval($text)>0 && intval($text)<=5)
                return "Successfully added new rate!";
            else
                return "Please enter number from 1 to 5!";
        }else{
            return "Unsuccessfully added new rate!";
        }
    }
    
    /*
     * potvrdjivanje ocenjivanja knjige
     * Nikola Krstic 18/0546
     */
    public function registerAddRate(){
        $user=$this->doctrine->em->getRepository(\App\Models\Entities\User::class)->find($this->session->get("korisnik")->getIdu());
        $bookId=$this->request->getVar("hiddenBook");
        $book=$this->doctrine->em->getRepository(\App\Models\Entities\Book::class)->find($bookId);
        $text=$this->request->getVar("rate");
        $poruka=$this->setMessageRate($text);
        
        if(is_numeric($text)){
            if(intval($text)>0 && intval($text)<=5){
                $rate=new \App\Models\Entities\Rate();
                $rate->setIdb($book);
                $rate->setIdu($user);
                $rate->setRate($text);
                $this->doctrine->em->persist($rate); 
                $this->doctrine->em->flush();
            }
        }
        return $this->prikaziKnjigu($bookId,$poruka);
    }
}
