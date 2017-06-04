<?php

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Application;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\Image;
use OC\PlatformBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller{

/**
 * @Route( "/", name = "oc_platform_home" )
 */
    public function homeAction(){

        return  $this->render('OCPlatformBundle:Advert:home.html.twig');
    }

/**
 * @Route("/{page}", name="oc_platform_page",defaults={"page" = 1}, requirements={"page" = "\d*"} )
 */
    public function indexAction($page){
        if($page < 1){
            throw new NotFoundHttpException("Page '".$page."' non trouvée ...");
        }

        return $this->render('OCPlatformBundle:Advert:index.html.twig');
    }

/**
 * @Route("/advert/{id}", name="oc_platform_view", requirements={"id" = "\d+"} )
 */
    public function viewAction($id){
    $em = $this->getDoctrine()->getManager();
    $advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);
    $applications = $em->getRepository('OCPlatformBundle:Application')->findBy(array('advert' => $advert));
        return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
            'advert'=>$advert,
            'applications' => $applications
        ));
    }

/**
 * @Route("/adverts", name="oc_platform_viewlist" )
 */
    public function viewListAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $adverts = $em->getRepository("OCPlatformBundle:Advert")->findAll();
        return $this->render('OCPlatformBundle:Advert:views.html.twig', array(
            "adverts" => $adverts
        ));
    }

/**
 * @Route("/add", name="oc_platform_add")
 */
    public function addAction(Request $request){
        // if($request->isMethod('POST')){
        //
        //     $request->getSession()->getFlashBag('notice', 'Annonce bien enregistrée ...');
        // }

        $em = $this->getDoctrine()->getManager();
        $advert  = $em->getRepository("OCPlatformBundle:Advert")->find(1);


        $cat1 = new Category();
        $cat2 = new Category();
        $cat3 = new Category();

        $cat1->setName('Informatique');
        $cat2->setName('Développement web');
        $cat3->setName('Graphisme');

        $advert->addCategory($cat1);
        $advert->addCategory($cat2);
        $advert->addCategory($cat3);

        $image = new Image();
        $image->setAlt('logo nodejs');
        $image->setUrl('http://akinsella.github.io/node-overview/pictures/node-logo.png');

        $advert->setImage($image);

        $application1 = new Application();
        $application2 = new Application();

        $em->persist($advert);

        $application1->setAuthor("Mr Smith");
        $application1->setContent("Je suis le bon candidat");
        $application2->setAuthor("Mr Galo");
        $application2->setContent("J'ai toutes les qualités requises");

        $application1->setAdvert($advert);
        $application1->setAdvert($advert);

        $em->persist($application1);
        $em->persist($application2);

        $em->flush();

        return $this->render('OCPlatformBundle:Advert:add.html.twig', array('advert' =>  $advert));
    }

/**
 * @Route("/edit/{id}", name="oc_platform_edit", requirements= {"id"= "\d+" }  )
 */
    public function editAction($id, Request $request){
        if ($request->isMethod('POST')){

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistré');
        }

        return $this->render('OCPlatformBundle:Advert:edit.html.twig');
    }
/**
 * @Route("/delete/{id}", name="oc_platform_delete", requirements= {"id"= "\d+"} )
 */
    public function deleteAction($id){

        return $this->render('OCPlatformBundle:Advert:delete.html.twig');
    }

    public function menuAction(){
        $listAdverts = array(
            "id"=>1, "title"=>"Symfony dans la vie",
            "id"=>2, "title"=>"Symfony dans la vie de demain",
            "id"=>3, "title"=>"Symfony dans la vie de tous les jours",
        );

        return $this->render('OCPlatformBundle:Advert:menu.html.twig', array(
            'listAdverts' => $listAdverts
        ));
    }
}
