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
     * /*
     * funkcija za prikaz pocetne stranice
     * Sara Kolarevic 2018/0388
     */
     
    public function index($poruka=null) {
        
        
        
         
//        if(isset($_SESSION["displayNotificationMessage"]))
//        {
//            $poruka=$_SESSION["displayNotificationMessage"];
//            unset($_SESSION["displayNotificationMessage"]);
//        }
        $books = $this->doctrine->em->getRepository(Entities\Book::class)->findAll();
        $genres=$this->doctrine->em->getRepository(Entities\Genre::class)->findAll();
        $this->prikaz('Pocetna', ['knjige' => $books,'genres' => $genres,"poruka"=>$poruka]);
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

    /*
     * funkcija za prikaz stranice za log inovanje
     * Andrej Veselinovic 2018/0221
     */
    public function login($poruka=null)
    {


        $data['controller'] = 'Gost';
        //echo view('Sablon/header_gost');
        echo view("Stranice/login", ["poruka"=>$poruka]);
        //$this->prikaz("register",["poruka"=>$poruka]);
    }
    /*
     * funkcija za potvrdu zahteva za log inovanje
     * Andrej Veselinovic 2018/0221
     */
    public function loginSubmit()
    {
        if(!$this->validate(['username'=>'required',"password"=>"required"]))
        {
            return $this->login(["errors"=>$this->validator->getErrors()]);
        }
        $user=$this->doctrine->em->getRepository(Entities\User::class)->findBy(array("username"=>$this->request->getVar("username")))[0];

        if($user==null)
            return $this->login(["errors"=>["User with given username and password doesnt exist"]]);
        if($user->getPassword()!==$this->request->getVar("password"))
            return $this->login(["errors"=>["User with given username and password doesnt exist"]]);
        if($user->getStatus()==="pending")
            return $this->login(["errors"=>["User with given username and password doesnt exist"]]);
        $this->session->set("korisnik",$user);
        
        $_SESSION["displayNotificationMessage"]="Successfully logged in";
//        echo $GLOBALS["displayNotificationMessage"];
        if($user->getType()==="administrator")
            return redirect()->to(site_url("Administrator"));
        else if($user->getType()==="privileged_user")
            return redirect()->to(site_url("Privilegovani"));
        else
            return redirect()->to(site_url("Korisnik"));
        
//        return redirect()->to(site_url("Korisnik"));
    }
    /*
     * funkcija za potvrdu zahteva za registraciju novog korisnika
     * Andrej Veselinovic 2018/0221
     */

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
        if($_FILES["img"]["tmp_name"]!=""){
            
            $user->setImage("yes");
        }
        
        try{
        $this->doctrine->em->persist($user);
        
        $this->doctrine->em->flush();
        }
        catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e)
        {
            return $this->register(["errors"=>["Username not unique"]]);
        }
        
        if($_FILES["img"]["tmp_name"]!=""){
            
            
            $myfile = fopen("images/users/".$user->getIdu().".jpg", "wb");
            
            fwrite($myfile,file_get_contents($_FILES['img']['tmp_name']));
            
            fclose($myfile);
            
                   
        }
        
//        echo "<script>alert('Successfully created, wait for administrator approval.');</script>";
//        return redirect()->to(site_url("Gost/index")); 
        $this->index("Successfully created, wait for administrator approval");
    }
    /*
     * /*
     * funkcija za prikaz knjige
     * Sara Kolarevic 2018/0388
     */
//   public function prikaziKnjigu($id){
//        $book=$this->doctrine->em->getRepository(Entities\Book::class)->find($id);
//        $this->prikaz('Knjiga', ['knjiga'=>$book, 'komentari' => $book->getReviews(),'citati' => $book->getQuotes()]);
//    }

     public function prikaziKnjigu($id,$poruka=null){
        
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
     * funkcija za filtriranje
     * Nikola Krstic 18/0546
     */
    
    public function filter(){
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
}
