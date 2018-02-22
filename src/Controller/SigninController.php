<?php
namespace App\Controller;

use App\Entity\Users;
use App\Form\SigninType;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\Logger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SigninController extends Controller
{

    /**
     * @Route("/signin", name="signin")
     * @Method({"GET", "POST"})
     */

    public function signinAction(Request $request, FormFactoryInterface $formFactory, EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $form = $formFactory->create(SigninType::class, new Users());

        $form->handleRequest($request);

        $pseudo = $form->getData()->getPseudo();
        $password = $form->getData()->getPassword();

        $messageAccount = "";
        $messagePassword = "";

        if ($pseudo && $password != null) {
            $user = $entityManager->getRepository(Users::class)->findOneByPseudo($pseudo);
            if ($user != null) {
                $passwordDB = $user->getPassword();
                $verifPassword = password_verify($password, $passwordDB);
                if ($verifPassword) {
                    $session->set('Pseudo', $pseudo);
                    return $this->redirect($this->generateUrl('map'));
                }
                else {
                    $messagePassword = "<ul><li>Mot de passe erroné<li><ul>";
                }
            }
            else {
                $messageAccount = "<ul><li>Ce compte n'existe pas<li><ul>";
            }
        }

        return $this->render(
            'signin/signinpage.html.twig', 
            array('form' => $form->createView(),
                  'message_account' => $messageAccount,
                  'message_password' => $messagePassword)
        );
    }

}