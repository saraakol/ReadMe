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
        $data['user_type'] = session()->get("korisnik")->getType();
        echo view('Sablon/header_korisnik');
        echo view("Stranice/$page", $data);
        echo view('Sablon/footer');
    }

    /*
     * 
     * funkcija za prikaz pocetne stranice
     * Sara Kolarevic 2018/0388
     */

    public function index() {
        $books = $this->doctrine->em->getRepository(Entities\Book::class)->findAll();
        $this->prikaz('Pocetna', ['knjige' => $books]);
    }

    public function logout() {
        $this->session->destroy();
        return redirect()->to(site_url("/"));
    }

    /*
     * Funkcija dodajPretplatu() - Sluzi za dodavanje pretplate korisnika na odredjeni zanr
     * @author Andrej Jokic 18/0247
     */

    function dodajPretplatu() {
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["idu" => $this->request->getVar('idU')]);
        $selected = $this->request->getVar('list'); //Id zanra
        $genre = $this->doctrine->em->getRepository(Entities\Genre::class)->findOneBy(['idg' => $selected]);

        $user->addGenre($genre);     //Owner strana asocijacije

        $this->doctrine->em->flush();

        return redirect()->to(site_url('Korisnik/prikaziProfil'));
    }

    /*
     * Funkcija ukloniPretplatu() - Sluzi za uklanjanje pretplate korisnika na odredjeni zanr
     * @author Andrej Jokic 18/0247
     */

    function ukloniPretplatu() {
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["idu" => $this->request->getVar('idU')]);
        $selected = $this->request->getVar('list'); //Id zanra
        $genre = $this->doctrine->em->getRepository(Entities\Genre::class)->findOneBy(['idg' => $selected]);

        $user->removeGenre($genre);     //Owner strana asocijacije

        $this->doctrine->em->flush();

        return redirect()->to(site_url('Korisnik/prikaziProfil'));
    }

    /*
     * Funkcija prikaziProfil() - Prikazuje p rofil korisnika
     * @author Andrej Jokic 18/0247,Nikola Krstic 18/0546
     */

    public function prikaziProfil() {
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["idu" => session()->get("korisnik")->getIdu()]);
        $all = $this->doctrine->em->getRepository(Entities\Userbooks::class)->dohvatiSve($user->getIdu());
        $read = $this->doctrine->em->getRepository(Entities\Userbooks::class)->dohvatiProcitane($user->getIdu());
        $wantToRead = $this->doctrine->em->getRepository(Entities\Userbooks::class)->dohvatiWantToRead($user->getIdu());

        $this->prikaz('Profil', ['korisnik' => $user, 'all' => $all, 'read' => $read, 'wantToRead' => $wantToRead]);
    }

    /*
     * 
     * funkcija za prikaz knjige
     * Sara Kolarevic 2018/0388
     */

    public function prikaziKnjigu($id) {
        $book = $this->doctrine->em->getRepository(Entities\Book::class)->find($id);
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["idu" => session()->get("korisnik")->getIdu()]);
        $this->prikaz('Knjiga', ['knjiga' => $book,'korisnik' => $user, 'komentari' => $book->getReviews()]);
    }

    /*
     * Funkicja za dodavanje na Want to read listu
     * @author Nikola Krstic 18/0546
     */

    public function dodajNaWantListu() {
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["idu" => session()->get("korisnik")->getIdu()]);
        $book = $this->doctrine->em->getRepository(Entities\Book::class)->findOneBy(["idb" => $this->request->getVar('idb')]);
        
        $userbook = new Entities\Userbooks();
        $userbook->setType("want-to-read");
        $userbook->setIdb($book);
        $userbook->setIdu($user);
        
        
        $user->addBooks($userbook);
        $this->doctrine->em->persist($userbook);
        $this->doctrine->em->persist($user);
        $this->doctrine->em->persist($book);
        $this->doctrine->em->flush();
        return $this->prikaz('Knjiga', ['knjiga' => $book]);
    }
    /*
     * dodavanje citata iz knjige
     * Sara Kolarevic 2018/0388
     */
    public function addQuote($poruka=null){
        $referer=$_SERVER['HTTP_REFERER'];
        echo view("Stranice/Quote", ["poruka"=>$poruka,"referer"=>$referer,"controller"=>"korisnik"]);
        
    }
    /*
     * potvrdnjivanje dodavanja citata
     * Sara Kolarevic 2018/0388
     */
    public function registerAddQuote(){
        $user=$this->doctrine->em->getRepository(\App\Models\Entities\User::class)->find($this->session->get("korisnik")->getIdu());
        $referer=$this->request->getVar("hiddenBook");
        $text=$this->request->getVar("quote");
        $args=explode("/",$referer);
        $bookId=intval($args[count($args)-1]);
        $book=$this->doctrine->em->getRepository(\App\Models\Entities\Book::class)->find($bookId);
        $quote=new \App\Models\Entities\Quote();
          $quote->setBook($book);
          $quote->setUser($user);
          $quote->setText($text);
        $user->addQuote($quote);
          $book->addQuote($quote);
          $this->doctrine->em->persist($quote);      
          $this->doctrine->em->flush();
          $path="";
        for($i=3;$i<count($args);$i++)
        {   
            
            $path=$path."/".$args[$i];
        }

        return redirect()->to(site_url($path));

    }
    /*


     * Funkcija za dodavanje na All listu
     * Nikola Krstic 18/0546
     */

    public function dodajNaReadListu() {
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["idu" => session()->get("korisnik")->getIdu()]);
        $book = $this->doctrine->em->getRepository(Entities\Book::class)->findOneBy(["idb" => $this->request->getVar('idb')]);
        
        #foreach($user->getBooks() as $userbooktmp){
           # if($userbooktmp->getIdb()->getIdb()==$book->getIdb()){
            #    if($userbooktmp->getType()=="want-to-read"){
             #       $this->doctrine->em->remove($userbooktmp);
              #  }
            #}
        #}
        $userbook = new Entities\Userbooks();
        $userbook->setType("read");
        $userbook->setIdb($book);
        $userbook->setIdu($user);
        
        
        $user->addBooks($userbook);
        $this->doctrine->em->persist($userbook);
        $this->doctrine->em->persist($user);
        $this->doctrine->em->persist($book);
        $this->doctrine->em->flush();
        return $this->prikaz('Knjiga', ['knjiga' => $book]);
    }

    /*
     * komentarisanje knjige
     * Andrej Veselinovic 2018/0221
     */
    public function addReview($poruka=null){
        $referer=$_SERVER['HTTP_REFERER'];
        echo view("Stranice/Review", ["poruka"=>$poruka,"referer"=>$referer,"controller"=>"korisnik"]);
        
    }
    /*
     * potvrdnjivanje komentarisanja knjige
     * Andrej Veselinovic 2018/0221
     */
    public function registerAddReview(){
//        $user=$this->session->get("korisnik");
        $user=$this->doctrine->em->getRepository(\App\Models\Entities\User::class)->find($this->session->get("korisnik")->getIdu());
        $referer=$this->request->getVar("hiddenBook");
        $text=$this->request->getVar("review");
        $args=explode("/",$referer);
        $bookId=intval($args[count($args)-1]);
        $book=$this->doctrine->em->getRepository(\App\Models\Entities\Book::class)->find($bookId);
        $review=new \App\Models\Entities\Review();
        $review->setBook($book);
        $review->setUser($user);
        $review->setText($text);
        $user->addReview($review);
        $book->addReview($review);
//        echo $review->getBook()->getIdb();
//        echo $review->getUser()->getIdu();
//        echo $review->getText();
//        echo count($args);
        $this->doctrine->em->persist($review);      
        $this->doctrine->em->flush();
        $path="";
        for($i=3;$i<count($args);$i++)
        {   
            
            $path=$path."/".$args[$i];
        }

        return redirect()->to(site_url($path));

    }
}
