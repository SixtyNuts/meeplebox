<?php
namespace App\Controller;

use App\Entity\Users;
use App\Entity\Events;
use App\Entity\Games;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\Logger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MapController extends Controller
{

    /**
     * @Route("/map", name="map")
     * @Method({"GET", "POST"})
     */

    public function showEventAction(Request $request, FormFactoryInterface $formFactory, EntityManagerInterface $entityManager, SessionInterface $session)
    {

        if ($session->get('id') != null) {

            return $this->render(
                'map/mappage.html.twig'
                // , array('events_filt_for_user' => $eventsFilteredForUser)
            );
        }

        else {

            return $this->redirect($this->generateUrl('index'));
        }

    }

    /**
     * @Route("/map/filtered", name="map_filtered")
     */

    public function filteredTypeGameUserAction(Request $request, FormFactoryInterface $formFactory, EntityManagerInterface $entityManager, SessionInterface $session)
    {

            $events = $entityManager->getRepository(Events::class)->findAll();
            $user = $entityManager->getRepository(Users::class)->findOneById($session->get('id'));
            $userTypeGamePrefArray = $user->getGamesPref();

            $listTypeGameForEachEvent = []; 
            foreach ($events as $event) {
                $listTypeGameForEachEvent[$event->getId()] = $event->getGame()->getid();
            }

            $userGamePrefId = [];
            foreach ($userTypeGamePrefArray as $userTypeGamePref) {
                $userGamePrefId[] = $userTypeGamePref->getId();
            }

            $eventsFilteredForUser = [];
            foreach ($listTypeGameForEachEvent as $eventId => $TypeGame) {
                if (in_array($TypeGame, $userGamePrefId)) {
                   $eventsFilteredForUser[] = $entityManager->getRepository(Events::class)->findOneById($eventId);
                }
            }

            $eventsArray = [];
            foreach ($eventsFilteredForUser as $event) {
                $eventArray = [
                    'id' => $event->GetId(),
                    'title' => $event->GetTitle(),
                    'description' => $event->GetDescription(),
                    'date' => $event->GetDate(),
                    'startTime' => $event->GetStartTime(),
                    'duration' => $event->GetDuration(),
                    'address' => $event->GetAddress(),
                    'city' => $event->GetCity(),
                    'latitude' => $event->GetLatitude(),
                    'longitude' => $event->GetLongitude()
                ];
                $eventsArray[] = $eventArray;
            }

            $jsonResponse = new JsonResponse();
            return $jsonResponse->setData($eventsArray);
            
    }



}