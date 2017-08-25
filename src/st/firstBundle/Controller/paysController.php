<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 23/11/2016
 * Time: 22:09
 */

namespace st\firstBundle\Controller;


use st\firstBundle\Entity\pays;
use st\firstBundle\Entity\picture;
use st\firstBundle\Form\pictureType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class paysController extends Controller
{


    public function viewPaysAction(pays $pays)
    {
//        if ($id < 1)
//            throw new NotFoundHttpException (' ARRETEZ  de jouer avec l URL ! !!! !!  ');
//        $pays = $this->getDoctrine()
//            ->getManager()
//            ->getRepository('stFirstBundle:pays')
//            ->find($id);
//        if ($pays === NULL)
//            throw $this->createNotFoundHttpException(' ERROOOR');

        return $this->render('stFirstBundle:pays:show.html.twig', array('pays' => $pays));


    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *      *@Security("has_role('ROLE_ADMIN')")
     */
    public function addAction(Request $request)
    {
        $task = new pays();
        $form = $this->createFormBuilder($task)
            ->add('nom', TextType::class)
            ->add('population', IntegerType::class)
            ->add('continent', EntityType::class, array('class' => 'stFirstBundle:continents',
                'choice_label' => 'nom'))
            ->add('picture', pictureType::class)
            ->add('save', SubmitType::class, array('label' => 'ok'))
            ->getForm();


        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $task->getPicture()->upload();


            $em = $this->getDoctrine()
                ->getManager();

            $em->persist($task);
            $em->flush();

            if ($request->isMethod('POST')) {
                $request->getSession()
                    ->getFlashBag()
                    ->add('notice ', '  pays ajouté   ');

                return $this->redirectToRoute('st_core_homepage');
            }
        }
        return $this->render('stFirstBundle:pays:add.html.twig', array('form' => $form->createView()));
    }


    /**
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $pays = $em->getRepository('stFirstBundle:pays')->find($id);

        if ($pays === null) {
            throw new NotFoundHttpException (" n'existe paaaaas");
        }


        //$task= $pays ;
        $form = $this->createFormBuilder($pays)
            ->add('nom', TextType::class)
            ->add('population', IntegerType::class)
            ->add('continent', EntityType::class, array('class' => 'stFirstBundle:continents',
                'choice_label' => 'nom'))
            ->add('picture', EntityType::class, array('class' => 'stFirstBundle:picture',
                'choice_label' => 'alt', 'required' => false))
            ->add('save', SubmitType::class, array('label' => 'ok'))
            ->getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();

            $em->flush();


            if ($request->isMethod('POST')) {
                $request->getSession()
                    ->getFlashBag()
                    ->add('notice ', '  pays modifié   ');

                return $this->redirectToRoute('st_core_homepage');


            }

        }
        return $this->render('stFirstBundle:pays:edit.html.twig', array('form' => $form->createView(), 'id' => $id));


    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_ADMIN')")
     */

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()
            ->getManager();
        $pays = $em->getRepository('stFirstBundle:pays')
            ->find($id);

        if ($pays === null) {
            throw new NotFoundHttpException (" pays n'existe pas   ");
        }

        $em->remove($pays);
        $em->flush();

        //return $this->render('stCoreBundle:Default:index.html.twig');
        return $this->redirectToRoute('st_core_homepage');
    }



}