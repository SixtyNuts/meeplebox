<?php
namespace App\Controller;

use App\Entity\Users;
use App\Entity\GameTypes;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\Logger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FilterboardgameController extends Controller
{

    /**
     * @Route("/filterbg", name="filterbg")
     * @Method({"GET", "POST"})
     */

    public function filterAction(Request $request, FormFactoryInterface $formFactory, EntityManagerInterface $entityManager, SessionInterface $session)
    {

        if ($session->get('id') != null) {

            $listGameTypes = $entityManager->getRepository(GameTypes::class)->findAll();
            
            if (!empty($request->request->all())) {

                $user = $entityManager->getRepository(Users::class)->findOneById($session->get('id'));

                $requestGamesPref = $request->request->all();

                $listGamesPref = []; 

                foreach ($requestGamesPref as $key => $value) {
                    $listGamesPref[] = $entityManager->getRepository(GameTypes::class)->findOneById($key);
                }

                foreach ($listGamesPref as $gamePref) {
                    $user->addGamePref($gamePref);
                }

                $entityManager->flush();

                return $this->redirect($this->generateUrl(
                    'map'
                ));

            }

            return $this->render(
                'filterbg/filterbgpage.html.twig', array('list_game_types' => $listGameTypes)
            );

        }

        else {
            return $this->redirect($this->generateUrl('index'));
        }

    }

}