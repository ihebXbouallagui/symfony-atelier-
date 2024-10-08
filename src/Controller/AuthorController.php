<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthorController extends AbstractController
{
    private $authors;
    public function __construct()
    {
        $this->authors = array(
            array('id' => 1, 'picture' => '/image/vh.png','username' => 'Victor Hugo', 'email' =>
            'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/image/ws.png','username' => ' William Shakespeare', 'email' =>
            ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
            array('id' => 3, 'picture' => '/image/th.png','username' => 'Taha Hussein', 'email' =>
            'taha.hussein@gmail.com', 'nb_books' => 300),
            );
            
    }

    #[Route('/author', name: 'app_author',methods:['GET'])]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/showAuthor/{name}', name: 'app_showAuthor',defaults:['name'=>'vector_Hugo'],methods:['GET'])]
    public function showAuthor($name): Response
    {
        return $this->render('author/show.html.twig', [
            'name' => $name,
        ]);
    }

    #[Route('/listAuthors', name: 'app_listAuthors',methods:['GET'])]
    public function listAuthors(): Response
    {
        
        return $this->render('author/list.html.twig', ['authors' => $this->authors]);
    }

    #[Route('/det/{id}', name: 'detail', methods: ['GET'])]
    public function authorDetails($id): Response
    {
        // Chercher l'auteur par ID
        $author = null;
        foreach ($this->authors as $a) {
            if ($a['id'] == $id) {
                $author = $a;
                break;
            }
        }
    
        // Vérifier si l'auteur a été trouvé
        if ($author === null) {
            return $this->render('author/showAuthor.html.twig', [
                'author' => null,
            ]);
        }
    
        return $this->render('author/showAuthor.html.twig', [
            'author' => $author,
        ]);
    }
    




}
