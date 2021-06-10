<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form', 'url'];
        
	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();
                $this->session = session();
                $this->doctrine= \Config\Services::doctrine();
        }
        
    /*
     * Funkcija prikaz - sluzi za prikazivanje stranice sa nepromenljivim(header,footer) i promenljivim delovima ( sredisnji deo stranice koji se razlikuje
     * u zavistnosti od trenutne pozicije korisnika na sajtu)
     * 
     * @param string $page String
     * @param string[] $data String[]
     */
    protected function prikaz($page, $data) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
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
        $books = $this->doctrine->em->getRepository(\App\Models\Entities\Book::class)->findAll();
        $genres=$this->doctrine->em->getRepository(\App\Models\Entities\Genre::class)->findAll();
        $this->prikaz('Pocetna', ['knjige' => $books,'genres' => $genres,"poruka"=>$poruka]);
    }
    
    /*
     * 
     * funkcija za prikaz knjige
     * Sara Kolarevic 2018/0388
     */
    public function prikaziKnjigu($id,$poruka=null){
        
        $book=$this->doctrine->em->getRepository(\App\Models\Entities\Book::class)->find($id);
//        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["idu" => session()->get("korisnik")->getIdu()]);
        $reviews=$this->doctrine->em->getRepository(\App\Models\Entities\Review::class)->getReviewsFromAccountType($id,"privileged_user");
        $reviews=array_merge($reviews,$this->doctrine->em->getRepository(\App\Models\Entities\Review::class)->getReviewsFromNotAccountType($id,"privileged_user"));
       $nizz=array();
        foreach($book->getGenres() as $pom){
            array_push($nizz,$pom->getName());
       }
       
       if(isset($_SESSION["displayNotificationMessage"]))
       {
           $poruka=$_SESSION["displayNotificationMessage"];
           unset($_SESSION["displayNotificationMessage"]);
       }
//        $reviews=array_merge($reviews,$this->doctrine->em->getRepository(Entities\Review::class)->getReviewsFromNotAccountType("privileged_user"));
        $this->prikaz('Knjiga', ["poruka"=>$poruka,'knjiga'=>$book, 'komentari' => $reviews,'korisnik' => $user,'citati' => $book->getQuotes(),'zanrovi'=>$nizz]);
    }
    
    /*
     * funkcija za filtriranje
     * Nikola Krstic 18/0546
     */
    public function filter(){
        //$knjige = $this->session->get("knjige");//pocetni niz knjiga
        $knjige = $this->doctrine->em->getRepository(\App\Models\Entities\Book::class)->findAll();
        $genres=$this->doctrine->em->getRepository(\App\Models\Entities\Genre::class)->findAll();

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
        $knjige = $this->doctrine->em->getRepository(\App\Models\Entities\Book::class)->findAll();
        $genres=$this->doctrine->em->getRepository(\App\Models\Entities\Genre::class)->findAll();
         
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
                    return $a->getIdb()<$b->getIdb();
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
}
