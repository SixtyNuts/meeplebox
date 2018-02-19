<?php
namespace App\Controller;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\Logger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SignupController extends Controller
{
    // public function signupAction(Request $request, FormFactoryInterface $formFactory, EntityManagerInterface $entityManager, SessionInterface $session)
    // {
    //     $form = $formFactory->create(UsersType::class, new Users());

    //     $form->handleRequest($request);

    //     dump($form); die;

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $user = $form->getData();
    //         $entityManager->persist($user);
    //         $entityManager->flush();

    //         return $this->redirect($this->generateUrl(
    //             ''
    //         ));
    //     }

    //     return $this->render(
    //         'signup/signuppage.html.twig',
    //         array('form' => $form->createView())
    //     );
    // }

    public function signupAction(Request $request)
    {
        // creates a task and gives it some dummy data for this example
        $user = new Users();

        $form = $this->createFormBuilder($user)
            ->add('pseudo', TextType::class, array('invalid_message'=>'error pseudo'))
            ->add('password', PasswordType::class, array('invalid_message'=>'error password'))
            ->add('birthday', DateType::class, array('invalid_message'=>'error birthday'))
            ->add('email', EmailType::class, array('invalid_message'=>'error email'));

        return $this->render('signup/signuppage.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}