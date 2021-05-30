<?php

namespace App\Controllers;

use App\Models\Entities;

/*
 * Klasa Privilegovani - implementira metode kontrolera koji sluzi za funkcionalnosti privilegovanog korisnika
 * 
 *  @version 1.0
 */
class Privilegovani extends BaseController
{   
    
    protected function prikaz($page, $data) {
        $data['controller'] = 'Privilegovani';
        $data['user_type'] = session()->get("korisnik")->getType();
        
        echo view('Sablon/header_korisnik');
        echo view("Stranice/$page", $data);
        echo view('Sablon/footer');
    }
    public function index() {
        
        $poruka=null;
        if(isset($_SESSION["displayNotificationMessage"]))
        {
            $poruka=$_SESSION["displayNotificationMessage"];
            unset($_SESSION["displayNotificationMessage"]);
        }
        $books = $this->doctrine->em->getRepository(Entities\Book::class)->findAll();
        $genres=$this->doctrine->em->getRepository(Entities\Genre::class)->findAll();
        $this->prikaz('Pocetna', ['knjige' => $books,'genres' => $genres,"poruka"=>$poruka]);
    }
    /*
     * komentarisanje knjige
     * Andrej Veselinovic 2018/0221
     */
    public function addReview($poruka=null){
        $referer=$_SERVER['HTTP_REFERER'];
        echo view("Stranice/Review", ["poruka"=>$poruka,"referer"=>$referer,"controller"=>"Privilegovani"]);
        
    }
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
//        $user->addReview($review);
//        $book->addReview($review);
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
//echo intval($args[count($args)-1]);
        return $this->prikaziKnjigu(intval($args[sizeof($args)-1]),"Successfully added new review");
//        return redirect()->to(site_url($path));

    }
    /*
     * Funkcija dodajCilj() - Dodaje licni cilj korisniku
     * @author Andrej Jokic 18-0247
     */
    function dodajCilj() {
        if ($this->request->getVar('brojKnjiga') <= 0) {
            return redirect()->to(site_url('Korisnik/prikaziProfil'));
        }
      
        $user = $this->doctrine->em->getRepository(Entities\User::class)->find(session()->get("korisnik")->getIdu());
        $user->setPersonalGoal($this->request->getVar('brojKnjiga'));
        $this->doctrine->em->flush();
        
        session()->setFlashdata("poruka", "Personal goal successfully added!");
        
        return redirect()->to(site_url('Korisnik/prikaziProfil'));
    }
    
    /*
     * 
     * funkcija za prikaz knjige
     * Sara Kolarevic 2018/0388
     */

        public function prikaziKnjigu($id,$poruka=null){
        
        $book=$this->doctrine->em->getRepository(Entities\Book::class)->find($id);
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["idu" => session()->get("korisnik")->getIdu()]);
        $reviews=$this->doctrine->em->getRepository(Entities\Review::class)->getReviewsFromAccountType($id,"privileged_user");
        $reviews=array_merge($reviews,$this->doctrine->em->getRepository(Entities\Review::class)->getReviewsFromNotAccountType($id,"privileged_user"));
       
//        $reviews=array_merge($reviews,$this->doctrine->em->getRepository(Entities\Review::class)->getReviewsFromNotAccountType("privileged_user"));
        $this->prikaz('Knjiga', ["poruka"=>$poruka,'knjiga'=>$book, 'komentari' => $reviews,'korisnik' => $user,'citati' => $book->getQuotes()]);
    }
    
    /*
     * Funkcija prijaviKorisnika() - Prijava korisnika se belezi u bazi podataka
     * @author Andrej Jokic 18/0247
     */
    public function prijaviKorisnika($id) {
        
        $user = $this->doctrine->em->getRepository(Entities\User::class)->find($id);
        
        if ($user->getType() != 'administrator') {
            $user->setStatus('reported');
            
            $this->doctrine->em->flush();  
            
        }
        
        
        
        return redirect()->to($_SERVER['HTTP_REFERER']);
    }

    
    /*
     * funkcija za filtriranje
     * Nikola Krstic 18/0546
     */
    
    public function filter(){
        //$knjige = $this->session->get("knjige");//pocetni niz knjiga
        $knjige = $this->doctrine->em->getRepository(Entities\Book::class)->findAll();
        $genres=$this->doctrine->em->getRepository(Entities\Genre::class)->findAll();

        if(isset($_POST['submit']))
            $selected = $_POST['filter']; 


        $noveKnjige = [];
        foreach($knjige as $knjiga){

            $bookGenres = $knjiga->getGenres();
            foreach($bookGenres as $genre){
                if($genre->getName()== $selected)
                    $noveKnjige[] = $knjiga;
            }
        }
        $this->prikaz('Pocetna', ['noveKnjige' => $noveKnjige,'knjige' => $knjige, 'genres' => $genres]);  
    }
    
    /*
     * funkcija za sortiranje
     * Nikola Krstic 18/0546
     */
    
    public function sort(){
        //$knjige = $this->session->get("knjige");//pocetni niz knjiga
        $knjige = $this->doctrine->em->getRepository(Entities\Book::class)->findAll();
        $genres=$this->doctrine->em->getRepository(Entities\Genre::class)->findAll();
         
        if(isset($_POST['submit']))
            $selected = $_POST['sort'];
        
        
        switch ($selected){
            case "A-Z":
                usort($knjige, function($a, $b){
                    return strcmp($a->getName(), $b->getName());
                });
                break;
            case "Z-A":
                usort($knjige, function($a, $b){
                    return strcmp($b->getName(),$a->getName());
                });
                break;
        }
        
        $this->prikaz('Pocetna', ['knjige' => $knjige,'genres' => $genres]);
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
            //$user->setUsername("nikolakrstic");//nikolakrstic
            //$book->setName("Harry Potter and the Philosopher's stone");//Harry Potter and the Philosopher's stone


            $userbook = new Entities\Userbooks();

            $userbook->setType("want-to-read");
            $userbook->setIdb($book);
            $userbook->setIdu($user);


            $user->addBook($userbook); //ovde je greska
            $this->doctrine->em->persist($userbook);
            $this->doctrine->em->persist($user);
            $this->doctrine->em->persist($book);
            $this->doctrine->em->flush();
        }
        $this->prikaz('Knjiga', ['knjiga' => $book]);
    }
    
    /*
     * Funkcija za dodavanje na All listu
     * Nikola Krstic 18/0546
     */

    public function dodajNaReadListu() {
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["idu" => session()->get("korisnik")->getIdu()]);
        $book = $this->doctrine->em->getRepository(Entities\Book::class)->findOneBy(["idb" => $this->request->getVar('idb')]);
        $userBookk = $this->doctrine->em->getRepository(Entities\Userbooks::class)->findOneBy(["idu" => session()->get("korisnik")->getIdu(),"idb" => $book->getIdb()]);
        
        if($userBookk!=null){
            if($userBookk->getType()=="read"){//ukoliko postoji na read listi
                return $this->prikaz('Knjiga', ['knjiga' => $book]);
            }else{//ukoliko postoji na write listi treba je izbaciti sa te liste
                $this->doctrine->em->remove($userBookk);
            }
        }
        
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


        $user->addBook($userbook);//ovde je greska
        $this->doctrine->em->persist($userbook);
        $this->doctrine->em->persist($user);
        $this->doctrine->em->persist($book);
        $this->doctrine->em->flush();
        
        return $this->prikaz('Knjiga', ['knjiga' => $book]);

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

       // return redirect()->to(site_url($path));
        return $this->prikaziKnjigu(intval($args[sizeof($args)-1]),"Successfully added new quote");

    }
}

