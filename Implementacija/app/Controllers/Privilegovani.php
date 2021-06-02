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
       // $data['user_type'] = session()->get("korisnik")->getType();
        if ($page=='Pocetna') echo view('Sablon/header_korisnik', ['controller'=>'Privilegovani']);
        else echo view('Sablon/header', ['controller'=>'Privilegovani']);
        echo view("Stranice/$page", $data);
        echo view('Sablon/footer');
    }
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
        return redirect()->to(site_url("/Administrator/prikaziKnjigu/{$bookId}"));

    }
    
    /*
     * ocenjivanje knjige
     * Nikola Krstic 18/0546
     */
    public function addRate($poruka=null){
        $referer=$_SERVER['HTTP_REFERER'];
        echo view("Stranice/Rate", ["poruka"=>$poruka,"referer"=>$referer,"controller"=>"Privilegovani"]);
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
        
        return redirect()->to(site_url('Privilegovani/prikaziProfil'));
    }
    /*
     * 
     * funkcija za prikaz knjige
     * Sara Kolarevic 2018/0388
     */
//     public function prikaziKnjigu($id){
//        $book=$this->doctrine->em->getRepository(Entities\Book::class)->find($id);
//        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["idu" => session()->get("korisnik")->getIdu()]);
//        $this->prikaz('Knjiga', ['knjiga'=>$book, 'komentari' => $book->getReviews(),'korisnik' => $user,'citati' => $book->getQuotes()]);
//    }
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
         $data = ['knjiga'=>$book, 'komentari' => $reviews,'korisnik' => $user,'citati' => $book->getQuotes(),'zanrovi'=>$nizz];
        
       if (session()->getFlashdata('porukaa') != null) {
            $data['poruka'] = session()->getFlashdata('porukaa');
        }
        
//        $reviews=array_merge($reviews,$this->doctrine->em->getRepository(Entities\Review::class)->getReviewsFromNotAccountType("privileged_user"));
        $this->prikaz('Knjiga',$data );
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
       
        
        if($selected == "Reset"){
            $filter=false;
            return $this->prikaz('Pocetna', ['noveKnjige' => $noveKnjige,'knjige' => $knjige, 'genres' => $genres,'filter' => $filter]);
        }

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
            case "Date":
                usort($knjige, function($a, $b){
                    return $a->getIdb()>$b->getIdb();
                });
                break;
            case "Rate":
                usort($knjige, function($a, $b){
                    $ratesA=$a->getRates();
                    $ratesB=$b->getRates();
                    
                    $numA=0;
                    $numB=0;
                    $numOfVotes=0;
                    if(isset($ratesA)){
                        foreach($ratesA as $rateA){
                            if($rateA->getIdu()->getType()=="privileged_user" || $rateA->getIdu()->getType()=="administrator"){
                                $numA+=$rateA->getRate()*1.5;
                                $numOfVotes+=1.5;
                            }else{
                            $numA+=$rateA->getRate();
                            $numOfVotes++;
                            }
                        }
                        if($numOfVotes!=null)
                            $numA/=$numOfVotes;
                        else $numA=0;
                    }else{
                        $numA=0;
                    }
                    $numOfVotes=0;
                    if(isset($ratesB)){
                        foreach($ratesB as $rateB){
                            if($rateB->getIdu()->getType()=="privileged_user" || $rateB->getIdu()->getType()=="administrator"){
                                $numB+=$rateB->getRate()*1.5;
                                $numOfVotes+=1.5;
                            }else{
                                $numB+=$rateB->getRate();
                                $numOfVotes++;
                            }
                        }
                        if($numOfVotes!=0)
                            $numB/=$numOfVotes;
                        else $numB=0;
                    }else{
                        $numB=0;
                    }
                    return $numA<$numB;
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

        return redirect()->to(site_url('Privilegovani/prikaziProfil'));
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

        session()->setFlashdata("poruka", "Subscription successfully removed!");
        
        return redirect()->to(site_url('Privilegovani/prikaziProfil'));
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
     * dodavanje citata iz knjige
     * Sara Kolarevic 2018/0388
     */
    public function addQuote($poruka=null){
        $referer=$_SERVER['HTTP_REFERER'];
        echo view("Stranice/Quote", ["poruka"=>$poruka,"referer"=>$referer,"controller"=>"Privilegovani"]);
        
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
            // $user->addQuote($quote);
            // $book->addQuote($quote);
          $this->doctrine->em->persist($quote);      
          $this->doctrine->em->flush();
          $path="";
        for($i=3;$i<count($args);$i++)
        {   
            
            $path=$path."/".$args[$i];
        }
        session()->setFlashdata("porukaaa", "Successfully added new quote!");
         return redirect()->to(site_url($path));
        //return $this->prikaziKnjigu(intval($args[sizeof($args)-1]),"Successfully added new quote");

    }

    private function setMessageRate($text){
        if(is_numeric($text)){
            if(intval($text)>0 && intval($text)<=5)
                session()->setFlashdata("porukaa", "Successfully added new rate!");
            else
                session()->setFlashdata("porukaa", "Please enter number from 1 to 5!");
        }else{
            session()->setFlashdata("porukaa", "Unsuccessfully added new rate!");
        }
        return;
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
            if(intval($text)>0 && intval($text)<=5){
                $rate=new \App\Models\Entities\Rate();
                $rate->setIdb($book);
                $rate->setIdu($user);
                $rate->setRate($text);
                $book->addRates($rate);
                $user->addRate($rate);
                $this->doctrine->em->persist($rate); 
                $this->doctrine->em->flush();
            }
        }
        $path="";
        for($i=3;$i<count($args);$i++){   
            $path=$path."/".$args[$i];
        }
        return redirect()->to(site_url($path));
    }
}

