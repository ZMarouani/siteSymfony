<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 22/11/2016
 * Time: 17:24
 */

namespace st\firstBundle\Controller;

use st\firstBundle\Entity\continents;
use st\firstBundle\Entity\pays;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Session\Session;
use st\firstBundle\Entity\form;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;



class continentsController extends Controller
{

    /* public function viewHomeAction()
    {
    $listContinents = $this->getDoctrine()
        ->getManager()
        ->getRepository('stFirstBundle:continents')
        ->findAll() ;

        return $this->render('stFirstBundle:continents:continents.html.twig' ,
            $listContinents ) ;
    } */

    //*@ParamConverter("continents" , options:{ mapping:{'id':'continent_id'}} )

    /**
     * @param continents $Continent
     * @return \Symfony\Component\HttpFoundation\Response
     */


    public function viewContinentAction( continents $Continent , $id )
    {

//        if ($id < 1)
//            throw new NotFoundHttpException (' ARRETEZ  de jouer avec l URL ! !!! !!  ');
//
//
//        $Continent = $this->getDoctrine()
//            ->getManager()
//            ->getRepository('stFirstBundle:continents')
//            ->find($id);
//        if ($Continent === NULL)
//            throw $this->createNotFoundHttpException(' ERROOOR');
//-------------------------------------------------------------------------------------------------------------------
////        $serializer = $this->get('serializer');
////
        $data=$this->getDoctrine()
            ->getManager()
            ->getRepository('stFirstBundle:pays')
            ->findArrayPays($id) ;

//
//----------------------------------------------------------------------------------------------------------------------
//
        return $this->render('stFirstBundle:continents:show.html.twig', array('continent' => $Continent , 'data'=>$data) );


    }
/**
  *@Security("has_role('ROLE_ADMIN')")

 */
    public function addAction(Request $request)
    {
        $task = new continents();
        $form = $this->createFormBuilder($task)
            ->add('nom', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'ok'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $em = $this->getDoctrine()
                ->getManager();

            $em->persist($task);
            $em->flush();

            if ($request->isMethod('POST')) {
                $request->getSession()
                    ->getFlashBag()
                    ->add('notice ', '  continent add succeeded   ');

                return $this->redirectToRoute('st_core_homepage');
            }
        }
        return $this->render('stFirstBundle:continents:add.html.twig', array('form' => $form->createView()));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *@Security("has_role('ROLE_ADMIN')")

     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $continent = $em->getRepository('stFirstBundle:continents')->find($id);

        if ($continent === null) {
            throw new NotFoundHttpException (" n'existe paaaaas");
        }

        $task = $continent;
        $form = $this->createFormBuilder($task)
            ->add('nom', TextType::class)
            ->add('population', IntegerType::class)
            ->add('save', SubmitType::class, array('label' => 'ok'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $continent = $form->getData();

            // $continent->setNom('nom') ;
            // $continent->setPopulation('population') ;


            $em->flush();

            if ($request->isMethod('POST')) {
                $request->getSession()
                    ->getFlashBag()
                    ->add('notice ', '  continent edit succeeded   ');

                return $this->redirectToRoute('st_core_homepage');
            }
        }
        return $this->render('stFirstBundle:continents:edit.html.twig', array('form' => $form->createView(), 'id' => $id));
    }


    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *@Security("has_role('ROLE_ADMIN')")

     */

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()
            ->getManager();
        $continent = $em->getRepository('stFirstBundle:continents')
            ->find($id);

        if ($continent === null) {
            throw new NotFoundHttpException (" continent n'existe pas   ");
        }


        $em->remove($continent);
        $em->flush();

        //return $this->render('stCoreBundle:Default:index.html.twig') ;
        return $this->redirectToRoute('st_core_homepage');
    }

}