<?php
namespace App\Controller;

use App\Entity\Users;
use App\Form\SignupType;
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

    /**
     * @Route("/signup", name="signup")
     * @Method({"GET", "POST"})
     */

    public function signupAction(Request $request, FormFactoryInterface $formFactory, EntityManagerInterface $entityManager, SessionInterface $session)
    {
        
        $form = $formFactory->create(SignupType::class, new Users());

        $form->handleRequest($request);

        $password = $form->getData()->getPassword();
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $form->getData()->setPassword($passwordHash); 

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $entityManager->persist($user);
            $entityManager->flush();
            
            $session->set('id', $form->getData()->getId());

            return $this->redirect($this->generateUrl(
                'filterbg'
            ));

        }

        return $this->render(
            'signup/signuppage.html.twig', 
            array('form' => $form->createView())
        );
    }

}