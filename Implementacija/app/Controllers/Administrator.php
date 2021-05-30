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
     * Funkcija index - pocetna stranica za gosta
     */
//    public function index() {
//        $genres=$this->doctrine->em->getRepository(Entities\Genre::class)->findAll();
//        $this->prikaz('Pocetna', ['genres' => $genres]);
//    }
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
    
    protected function prikaz($page, $data) {
        $data['controller'] = 'Administrator';
        $data['user_type'] = session()->get("korisnik")->getType();
        
        echo view('Sablon/header_korisnik');
        echo view("Stranice/$page", $data);
        echo view('Sablon/footer');
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

       // return redirect()->to(site_url($path));
        return $this->prikaziKnjigu(intval($args[sizeof($args)-1]),"Successfully added new quote");
    }
    /*
     * komentarisanje knjige
     * Andrej Veselinovic 2018/0221
     */
    public function addReview($poruka=null){
        $referer=$_SERVER['HTTP_REFERER'];
//        echo $referer;
        echo view("Stranice/Review", ["poruka"=>$poruka,"referer"=>$referer,"controller"=>"Administrator"]);
        
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
//        if(isset($_FILES["img"])){
        if($_FILES["img"]["tmp_name"]!=""){
            $book->setImage("yes");
        }
        $this->doctrine->em->persist($book);
        
        $this->doctrine->em->flush();
//        if(isset($_FILES["img"])){
        if($_FILES["img"]["tmp_name"]!=""){
        
            
            
            $myfile = fopen("images/books/".$book->getIdb().".jpg", "wb");
            fwrite($myfile,file_get_contents($_FILES['img']['tmp_name']));
            fclose($myfile);
                   
        }
//        echo "<script>alert('Successfully created new book');</script>";
        $_SESSION["displayNotificationMessage"]="Successfully created new book";
        return redirect()->to("/Korisnik");
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
}

