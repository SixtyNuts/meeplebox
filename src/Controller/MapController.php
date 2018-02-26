<?php
namespace App\Controller;

use App\Entity\Users;
use App\Entity\Events;
use App\Entity\Games;
use App\Entity\GameTypes;
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

    public function showMapAction(Request $request, FormFactoryInterface $formFactory, EntityManagerInterface $entityManager, SessionInterface $session)
    {      

        if ($session->get('id') != null) {

            return $this->render(
                'map/mappage.html.twig'
            );
        }

        else {

            return $this->redirect($this->generateUrl('index'));
        }

    }

    /**
     * @Route("/map/filtered", name="map_filtered")
     */

    public function showMapWhithFilteredTypesPrefUserAction(EntityManagerInterface $entityManager, SessionInterface $session)
    {
            
        if ($session->get('id') != null) {

                $events = $entityManager->getRepository(Events::class)->findAll();
                $user = $entityManager->getRepository(Users::class)->findOneById($session->get('id'));
                $userTypesGamePref = $user->getGamesPref();
                $gameTypes = $entityManager->getRepository(GameTypes::class)->findAll();
                
                // Tableau des id des Types de jeux préférés de l'utilisateur
                $userGamePrefId = [];
                foreach ($userTypesGamePref as $userTypeGamePref) {
                    $userGamePrefId[] = $userTypeGamePref->getId();
                }

                // Tableau des Events qui ont un type de jeu préféré de l'User
                $eventsFilteredForUser = []; 
                foreach ($events as $event) {
                    if (in_array($event->getGame()->getGameType()->getId(), $userGamePrefId)) {
                        $eventsFilteredForUser[] = $event;
                    }
                }

                $eventsArray = [];
                foreach ($eventsFilteredForUser as $event) {
                    $eventArray = [
                        'id' => $event->getId(),
                        'title' => $event->getTitle(),
                        'description' => $event->getDescription(),
                        'date' => $event->getDate(),
                        'startTime' => $event->getStartTime(),
                        'duration' => $event->getDuration(),
                        'address' => $event->getAddress(),
                        'city' => $event->getCity(),
                        'latitude' => $event->getLatitude(),
                        'longitude' => $event->getLongitude(),
                        'pseudo_creat' => $event->getUserCreator()->getPseudo(),
                        'pict_game' => $event->getGame()->getPict(),
                        'type_game' => $event->getGame()->getGameType()->getId()
                    ];
                    $eventsArray[] = $eventArray;
                }

                // Tableau des Nom des Types de jeux préférés de l'utilisateur pour générer les filtres
                $userGamePrefForFilters = [];
                foreach ($userTypesGamePref as $userTypeGamePref) {
                    $userGamePrefForFilters[] = ['id' => $userTypeGamePref->getId(), 'type' => $userTypeGamePref->getTypeText(), 'code' => $userTypeGamePref->getTypeCode()];
                }

                // Tableau des id des Types de jeux resta
                $listGameTypesRestForAddFilters = [];
                foreach ($gameTypes as $gameType) {
                    if (!in_array($gameType->getId(), $userGamePrefId)) {
                        $listGameTypesRestForAddFilters[] = ['id' => $gameType->getId(), 'type' => $gameType->getTypeText(), 'code' => $gameType->getTypeCode()];
                    }
                }

                $jsonResponse = new JsonResponse();
                return $jsonResponse->setData(['events' => $eventsArray, 'filters' => $userGamePrefForFilters, 'add_filters' => $listGameTypesRestForAddFilters]);

            }
            
    }

    /**
     * @Route("/map/allevents", name="map_allevents")
     */

    public function showMapWhithAllEventAction(EntityManagerInterface $entityManager, SessionInterface $session)
    {
            
        if ($session->get('id') != null) {

                $events = $entityManager->getRepository(Events::class)->findAll();
                
                $eventsArray = [];
                foreach ($events as $event) {
                    $eventArray = [
                        'id' => $event->getId(),
                        'title' => $event->getTitle(),
                        'description' => $event->getDescription(),
                        'date' => $event->getDate(),
                        'startTime' => $event->getStartTime(),
                        'duration' => $event->getDuration(),
                        'address' => $event->getAddress(),
                        'city' => $event->getCity(),
                        'latitude' => $event->getLatitude(),
                        'longitude' => $event->getLongitude(),
                        'pseudo_creat' => $event->getUserCreator()->getPseudo(),
                        'pict_game' => $event->getGame()->getPict(),
                        'type_game' => $event->getGame()->getGameType()->getId()
                    ];
                    $eventsArray[] = $eventArray;
                }

                $jsonResponse = new JsonResponse();
                return $jsonResponse->setData(['events' => $eventsArray]);

            }
            
    }


    /**
     * @Route("/map/filtered/{id}", name="map_filtered_add")
     */

    public function addFilteredAction($id, EntityManagerInterface $entityManager, SessionInterface $session)
    {
            
        if ($session->get('id') != null) {

                $events = $entityManager->getRepository(Events::class)->findAll();
                
                $eventsFilteredForAddFilter = []; 
                foreach ($events as $event) {
                    if ($event->getGame()->getGameType()->getId() == $id) {
                        $eventsFilteredForAddFilter[] = $event;
                    }
                }

                $eventsArray = [];
                foreach ($eventsFilteredForAddFilter as $event) {
                    $eventArray = [
                        'id' => $event->getId(),
                        'title' => $event->getTitle(),
                        'description' => $event->getDescription(),
                        'date' => $event->getDate(),
                        'startTime' => $event->getStartTime(),
                        'duration' => $event->getDuration(),
                        'address' => $event->getAddress(),
                        'city' => $event->getCity(),
                        'latitude' => $event->getLatitude(),
                        'longitude' => $event->getLongitude(),
                        'pseudo_creat' => $event->getUserCreator()->getPseudo(),
                        'pict_game' => $event->getGame()->getPict(),
                        'type_game' => $event->getGame()->getGameType()->getId()
                    ];
                    $eventsArray[] = $eventArray;
                }

                $jsonResponse = new JsonResponse();
                return $jsonResponse->setData(['events' => $eventsArray]);

            }
            
    }

    /**
     * @Route("/map/deco", name="deco")
     */

    public function deco(SessionInterface $session)
    {      

        $session->clear();

        return $this->redirect($this->generateUrl('index'));
        
    }



}