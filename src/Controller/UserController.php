<?php

namespace App\Controller;

use App\Entity\Acheteur;
use App\Repository\AchatRepository;
use App\Repository\UsersRepository;
use App\Repository\LigneAchatRepository;
use App\Repository\ProduitRepository;
use App\Repository\SolutionsRepository;
use App\Repository\CategorieProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(CategorieProduitRepository $repoC , ProduitRepository $repoP ,  SolutionsRepository $repoS ,Request $request)
    {
        $categorie = $repoC->findAll();
        $produits = $repoP->findAll();
        $solution = $repoS->findAll();

        return $this->render('pages/login.html.twig', [
            'controller_name' => 'UserController',
            'categories' => $categorie,
            'produits' => $produits,
            'solutions' => $solution
        ]);
    }

    /**
     * @Route("/connexion", name="connexion")
     * 
     */
    public function connexion(EntityManagerInterface $entityManager,CategorieProduitRepository $repoC , ProduitRepository $repoP , SolutionsRepository $repoS, UsersRepository $repoU,AchatRepository $repoAc ,Request $request)
    {
        $categorie = $repoC->findAll();
        $produits = $repoP->findAll();
        $solution = $repoS->findAll();

        $user = $repoU->findOneby([
            "email" => $request->get("email"),
            "password" => $request->get('password')
        ]);

        $user->setFirstLogin(new \DateTime());
            
        $entityManager->persist($user);
        $entityManager->flush();
        //$idacheteur=$acheteur->getId();
        //dd($acheteur);
        //$achats = $repoAc->findOneBy([
            //"acheteur" => $acheteur
        //]);
        //dd($achats);

        return $this -> redirectToRoute('show_compte',['id' => $user->getId()]);

        return $this->render('pages/utilisateur.html.twig', [
            'controller_name' => 'UserController',
            'categories' => $categorie,
            'produits' => $produits,
            'solutions' => $solution,
            'user' => $user,
            'achats' => $achats
        ]);
    }

    /**
     * @Route("/MonCompte/{id}", name="show_compte")
     */
    public function commande_show($id, Request $request,EntityManagerInterface $entityManager,CategorieProduitRepository $repoC , ProduitRepository $repoP , SolutionsRepository $repoS , LigneAchatRepository $repoL, UsersRepository $repoU,AchatRepository $repoAc )
    {
        $categorie = $repoC->findAll();
        $produits = $repoP->findAll();
        $solution = $repoS->findAll();

        //je recupere les info de l'acheteur
        $user = $repoU->findOneby([
            "id" => $id
        ]);
        
        // je recupere les info sur l'achat de l'acheteur avec la clé de l'acheteur
        $achats = $repoAc->findBy([
            'user' => $id
        ]);
        //dd($achats);
        //je recupere les details sur l'achat de l'acheteur avec la clé de l'achat du client
        $ligneachat = $repoL->findBy([
            'achat' => $achats
        ]);
        //dd($ligneachat);
            
        return $this->render('/pages/utilisateur.html.twig', [
            'controller_name' => 'UserController',
            'categories' => $categorie,
            'produits' => $produits,
            'solutions' => $solution,
            'user' => $user,
            'achats' => $achats,
            'ligneachats' => $ligneachat
            
        ]);
           
    }

    /**
     * @Route("/modif_pass/{id}", name="modif_pass")
     * 
     */
    public function modif_pass($id, CategorieProduitRepository $repoC , ProduitRepository $repoP , SolutionsRepository $repoS, UsersRepository $repoU,AchatRepository $repoAc ,Request $request, LigneAchatRepository $repoL,EntityManagerInterface $entityManager)
    {
        $categorie = $repoC->findAll();
        $produits = $repoP->findAll();
        $solution = $repoS->findAll();

        //dd($achat);
        //je recupere les info de l'acheteur et verifie si le mot de passe est correct
        $user = $repoU->findOneby([
            "id" => $id
        ]);

        // je recupere les info sur l'achat de l'acheteur avec la clé de l'acheteur
        $achats = $repoAc->findBy([
            'user' => $id
        ]);
        //dd($achat);
        //je recupere les details sur l'achat de l'acheteur avec la clé de l'achat du client
        $ligneachat = $repoL->findBy([
            'achat' => $achats
        ]);
        $password = $request->get('password');
        //dd($password);
        if ($user->getPassword() == $request->get('password')) {
            if( ($request->get('password1')) == ($request->get('password2')) ){
                $user->setPassword($request->get("password1"));
                
                $entityManager->persist($user);
                $entityManager->flush();
            }
        }

        return $this -> redirectToRoute('show_compte',['id' => $user->getId()]);
        
        return $this->render('pages/utilisateur.html.twig', [
            'controller_name' => 'UserController',
            'categories' => $categorie,
            'produits' => $produits,
            'solutions' => $solution,
            'user' => $user,
            'achats' => $achats,
            'ligneachats' => $ligneachat
        ]);
    }

    /**
     * @Route("/modif_user/{id}", name="modif_user")
     * 
     */
    public function modif_user($id, CategorieProduitRepository $repoC , ProduitRepository $repoP , SolutionsRepository $repoS, UsersRepository $repoU,AchatRepository $repoAc ,Request $request, LigneAchatRepository $repoL,EntityManagerInterface $entityManager)
    {
        $categorie = $repoC->findAll();
        $produits = $repoP->findAll();
        $solution = $repoS->findAll();

        //dd($achat);
        //je recupere les info de l'acheteur et verifie si le mot de passe est correct
        $user = $repoU->findOneby([
            "id" => $id
        ]);

        // je recupere les info sur l'achat de l'acheteur avec la clé de l'acheteur
        $achats = $repoAc->findBy([
            'user' => $id
        ]);
        //dd($achat);
        //je recupere les details sur l'achat de l'acheteur avec la clé de l'achat du client
        $ligneachat = $repoL->findBy([
            'achat' => $achats
        ]);
        //$password = $request->get('password');
        //dd($password);
            $user->setNom($request->get("nom"));
            $user->setPrenom($request->get("prenom"));
            $user->setPays($request->get("pays"));
            $user->setVille($request->get("ville"));
            $user->setAdresse($request->get("adresse"));
            $user->setTelephone($request->get("telephone"));
            $user->setEmail($request->get("email"));
            
            $entityManager->persist($user);
            $entityManager->flush();

        //retourne sur le chemain show pour afficher le compte utilisateur
        return $this -> redirectToRoute('show_compte',['id' => $user->getId()]);

        return $this->render('pages/utilisateur.html.twig', [
            'controller_name' => 'UserController',
            'categories' => $categorie,
            'produits' => $produits,
            'solutions' => $solution,
            'user' => $user,
            'achats' => $achats,
            'ligneachats' => $ligneachat
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    
    public function logout() {
      
    }
}
