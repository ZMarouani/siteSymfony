<?php

namespace st\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use st\firstBundle\Entity\pays;
use st\firstBundle\Entity\picture;
use st\firstBundle\Form\pictureType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class DefaultController extends Controller
{
    public function indexAction($page)
    {
    $page=htmlspecialchars($_GET["page"]) ;


        $em = $this->getDoctrine()->getManager();

        /*------------------------------------------------------------------------------------------------------------*/

        /* $listPays=$em->getRepository('stFirstBundle:pays')->findAll() ;*/

        $listContinents = $em
            ->getRepository('stFirstBundle:continents')
            ->findAll();


            if ($page < 1) {
                throw $this->createNotFoundException("La page " . $page . " n'existe paaaaaaas1.");
            }
            $nbPerPage = 5;

            $listPays = $em
                ->getRepository('stFirstBundle:pays')
                ->getListPays($page, $nbPerPage);


            $nbPages = ceil(count($listPays) / $nbPerPage);

            if ($page > $nbPages) {
                throw $this->createNotFoundException("La page " . $page . " n'existe pasaaaaaaaaaas2.");
            };


//            $form=$this->createFormBuilder()
//                ->add('rating', RatingType::class, [
//        'label' => 'Rating'])
//        ->getForm()
//                ->getData() ;


        return $this->render('stCoreBundle:Default:index.html.twig', array('listPays' => $listPays, 'nbPages' => $nbPages,
            'page' => $page, 'listContinents' => $listContinents));
    }


    public function homeAction($page=1)
    {



        $em = $this->getDoctrine()->getManager();

        /*------------------------------------------------------------------------------------------------------------*/

        /* $listPays=$em->getRepository('stFirstBundle:pays')->findAll() ;*/

        $listContinents = $em
            ->getRepository('stFirstBundle:continents')
            ->findAll();

        $nbPerPage = 5;

        $listPays = $em
            ->getRepository('stFirstBundle:pays')
            ->getListPays($page, $nbPerPage);


        $nbPages = ceil(count($listPays) / $nbPerPage);





        return $this->render('stCoreBundle:Default:index.html.twig', array('listPays' => $listPays, 'nbPages' => $nbPages,
            'page' => $page, 'listContinents' => $listContinents));
    }


    public function flagsAction()
    {
        $em=$this->getDoctrine()
            ->getRepository('stFirstBundle:picture') ;
        $allFlags=$em->findAll() ;

        return $this->render('stCoreBundle:Default:flags.html.twig', array('allFlags'=> $allFlags)) ;

    }

    public function searchAction()
    {
        $sName=htmlspecialchars($_GET["q"]) ;


        $em = $this->getDoctrine()->getManager();
        $sContinent = $em
            ->getRepository('stFirstBundle:continents')
            ->findOneBy(array('nom'=>$sName));

        if ($sContinent != null) {
            $id=$sContinent->getId() ;
        return $this->redirectToRoute('st_first_continents' , array('id'=>$id)) ;
        }

        $sPays = $em
            ->getRepository('stFirstBundle:pays')
            ->findOneBy(array('nom'=>$sName));


        if ($sPays != null )
        { $id=$sPays->getId() ;
        return $this->redirectToRoute('st_first_pays' , array('id'=>$id)) ;
        }

        return $this->redirectToRoute('st_core_homepage') ;

    }



//    public function addPicture(Request $request)
//    {
//        $task = new picture();
//        $form = $this->createFormBuilder($task)
//            ->add('file', pictureType::class)
//            ->add('save', SubmitType::class, array('label' => 'ok'))
//            ->getForm();
//
//
//        $form->handleRequest($request);
//
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $task = $form->getData();
//
//            $task->getPicture()->upload();
//
//
//            $em = $this->getDoctrine()
//                ->getManager();
//
//            $em->persist($task);
//            $em->flush();
//
//
//
//            if ($request->isMethod('POST')) {
//                $request->getSession()
//                    ->getFlashBag()
//                    ->add('notice ', '  photo ajouté   ');
//
//                return $this->redirectToRoute('st_core_homepage');
//            }
//        }
//        return $this->render('::layout.html.twig', array('form' => $form->createView()));
//    }


    public function testAction()
    {
        return $this->render('stCoreBundle::layout.html.twig');
    }
    /*

        public function newFormAction(Request $request)
        {
            $form = new form();

            $formulaire = $this->createFormBuilder($form)
                ->add('nom', TextType::class)
                ->add('population', IntegerType::class)
                ->add('continent', TextType::class)
                ->add('save', SubmitType::class, array('label' => 'edit form'))
                ->getForm();

            $formulaire->handleRequest($request);

            if ($formulaire->isSubmitted() && $formulaire->isValid())
            {
                $form = $formulaire->getData();

                // class Form est une entité Doctrine , il faut la persister !!


                $em = $this->getDoctrine()
                    ->getManager();
                $em->persist($form);
                $em->flush();

                return $this->redirectToRoute('form_remplit');

            }

            return $this->render('stCoreBundle:Default:index.html.twig', array(
                'formulaire' => $formulaire->createView(),
            ));
        }*/

}