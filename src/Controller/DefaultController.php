<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class DefaultController extends Controller
{
	 /**
     * @Route("/", name="index")
     * @Method({"GET", "POST"})
     */

    public function index()
    {
        return $this->render('homepage.html.twig');
    }
}