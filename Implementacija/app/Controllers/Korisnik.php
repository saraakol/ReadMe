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
        //$data['user_type'] = session()->get("korisnik")->getType();
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
        $books = $this->doctrine->em->getRepository(Entities\Book::class)->findAll();
        $genres=$this->doctrine->em->getRepository(Entities\Genre::class)->findAll();
        $this->prikaz('Pocetna', ['knjige' => $books,'genres' => $genres,"poruka"=>$poruka]);
    }

//    public function logout() {
//        $this->session->destroy();
//        return redirect()->to(site_url("/"));
//    }

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

        $user->removeGenre($genre);     //Owner strana asocijacija
        $this->doctrine->em->flush();

        session()->setFlashdata("poruka", "Subscription successfully removed!");
        
        return redirect()->to(site_url('Korisnik/prikaziProfil'));
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
     * 
     * funkcija za prikaz knjige
     * Sara Kolarevic 2018/0388
     */

     public function prikaziKnjigu($id){
         
           $book=$this->doctrine->em->getRepository(Entities\Book::class)->find($id);
//        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["idu" => session()->get("korisnik")->getIdu()]);
        $reviews=$this->doctrine->em->getRepository(Entities\Review::class)->getReviewsFromAccountType($id,"privileged_user");
        $reviews=array_merge($reviews,$this->doctrine->em->getRepository(Entities\Review::class)->getReviewsFromNotAccountType($id,"privileged_user"));
       $nizz=array();
        foreach($book->getGenres() as $pom){
            array_push($nizz,$pom->getName());
       }
//        $reviews=array_merge($reviews,$this->doctrine->em->getRepository(Entities\Review::class)->getReviewsFromNotAccountType("privileged_user"));
        $this->prikaz('Knjiga', ["poruka"=>$poruka,'knjiga'=>$book, 'komentari' => $reviews,'korisnik' => $user,'citati' => $book->getQuotes(),'zanrovi'=>$nizz]);
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
     * ocenjivanje knjige
     * Nikola Krstic 18/0546
     */
    public function addRate($poruka=null){
        $referer=$_SERVER['HTTP_REFERER'];
        echo view("Stranice/Rate", ["poruka"=>$poruka,"referer"=>$referer,"controller"=>"korisnik"]);
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
        $filter=true;
        $this->prikaz('Pocetna', ['noveKnjige' => $noveKnjige,'knjige' => $knjige, 'genres' => $genres,'filter' => $filter]);  
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

            $userbook = new Entities\Userbooks();

            $userbook->setType("want-to-read");
            $userbook->setIdb($book);
            $userbook->setIdu($user);


            $user->addBook($userbook); //ovde je greska
            $this->doctrine->em->persist($userbook);
            $this->doctrine->em->persist($user);
            $this->doctrine->em->persist($book);
            $this->doctrine->em->flush();
            session()->setFlashdata("porukaa","Book successfully added to want to read list");
        }else{
            session()->setFlashdata("porukaa","Book already exist on your lists");
        }
        $this->prikaziKnjigu($book->getIdb());
    }
    
    private function setMessage($userBookk){
        if($userBookk!=null){
            if($userBookk->getType()=="read"){                  //ukoliko postoji na read listi
                session()->setFlashdata("porukaa","Book alreay exist on read list");
                return;
            }else{                                              //ukoliko postoji na write listi treba je izbaciti sa te liste
                session()->setFlashdata("porukaa","Book moved from want to read list to read list");
                return;
            }
        }else{
            session()->setFlashdata("porukaa","Book successfully added to read list");
            return;
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
        $this->setMessage($userBookk);
        if($userBookk!=null){
            if($userBookk->getType()=="read"){                  //ukoliko postoji na read listi
                return $this->prikaziKnjigu($book->getIdb());
            }else{                                              //ukoliko postoji na write listi treba je izbaciti sa te liste
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
        return $this->prikaziKnjigu($book->getIdb());
    }

    /*
     * potvrdjivanje ocenjivanja knjige
     * Nikola Krstic 18/0546
     */
    public function registerAddRate(){
        $user=$this->doctrine->em->getRepository(\App\Models\Entities\User::class)->find($this->session->get("korisnik")->getIdu());
        $text=$this->request->getVar("rate");
        $this->setMessageRate($text);
        $referer=$this->request->getVar("hiddenBook");
        $args=explode("/",$referer);
        $book=$this->doctrine->em->getRepository(\App\Models\Entities\Book::class)->find(intval($args[count($args)-1]));
        if(is_numeric($text)){
            $rate=new \App\Models\Entities\Rate();
            $rate->setIdb($book);
            $rate->setIdu($user);
            $rate->setRate($text);
            // $book->addRates($rate);
            // $user->addRate($rate);
            $this->doctrine->em->persist($rate); 
            $this->doctrine->em->flush();
        }
        $path="";
        for($i=3;$i<count($args);$i++){   
            $path=$path."/".$args[$i];
        }
        return redirect()->to(site_url($path));
    }

    private function setMessageRate($text){
        if(is_numeric($text)){
            session()->setFlashdata("porukaa", "Successfully added new rate!");
        }else{
            session()->setFlashdata("porukaa", "Unsuccessfully added new rate!");
        }
        return;
    }
}
