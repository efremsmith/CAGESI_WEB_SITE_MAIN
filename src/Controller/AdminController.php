<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Solutions;
use App\Form\ProduitType;
use App\Form\SolutionsType;
use App\Entity\TypeReglement;
use App\Entity\TypeSolutions;
use App\Form\TypeReglementType;
use App\Form\TypeSolutionsType;
use App\Entity\CategorieProduit;
use App\Form\CategorieProduitType;
use App\Repository\ProduitRepository;
use App\Repository\SolutionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TypeReglementRepository;
use App\Repository\TypeSolutionsRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CategorieProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/pages/login.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/home", name="admin_home")
     */
    public function admin_home()
    {
        return $this->render('admin/pages/Dashboard.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    /**
     * @Route("/admin/ajout", name="ajout")
     * @route("admin/edit/{id}" , name="edit")
     */
    public function ajout(Request $request, CategorieProduit $categorieproduit = null ,CategorieProduitRepository $repoC , Produit $produit = null ,ProduitRepository $repoP , Solutions $solutions = null ,SolutionsRepository $repoS, TypeSolutions $typesolutions = null ,TypeSolutionsRepository $repoTS , TypeReglement $typereglement = null ,TypeReglementRepository $repoTR ,EntityManagerInterface $entitymanager)
    {
        //formulaire categorie
        if(!$categorieproduit) {
            $categorieproduit = new categorieproduit();
        }
        $formCat = $this->createForm(CategorieProduitType::class , $categorieproduit);
        $formCat->handleRequest($request);
        if ($formCat->isSubmitted() && $formCat->isValid()) {
            
            $entitymanager->persist($categorieproduit);
            $entitymanager->flush();
            //$categories = $repo->findAll();

            return $this -> redirectToRoute('ajout');
        }

        //formulaire produit
        if(!$produit) {
            $produit = new produit();
        }
        $formProd = $this->createForm(ProduitType::class , $produit);
        $formProd->handleRequest($request);
        if ($formProd->isSubmitted() && $formProd->isValid()) {
            
            $entitymanager->persist($produit);
            $entitymanager->flush();
            //$categories = $repo->findAll();

            return $this -> redirectToRoute('ajout');
        }

        //formulaire solutions
        if(!$solutions) {
            $solutions = new solutions();
        }
        $formSol = $this->createForm(SolutionsType::class , $solutions);
        $formSol->handleRequest($request);
        if ($formSol->isSubmitted() && $formSol->isValid()) {
            $solutions -> setCreatedAt(new \DateTime());

            $entitymanager->persist($solutions);
            $entitymanager->flush();
            //$categories = $repo->findAll();

            return $this -> redirectToRoute('ajout');
        }

        //formulaire type de solutions
        if(!$typesolutions) {
            $typesolutions = new typesolutions();
        }
        $formTsol = $this->createForm(TypeSolutionsType::class , $typesolutions);
        $formTsol->handleRequest($request);
        if ($formTsol->isSubmitted() && $formTsol->isValid()) {
            $typesolutions -> setCreatedAt(new \DateTime());
            
            $entitymanager->persist($typesolutions);
            $entitymanager->flush();
            //$categories = $repo->findAll();

            return $this -> redirectToRoute('ajout');
        }

        //formulaire type de reglement
        if(!$typereglement) {
            $typereglement = new typereglement();
        }
        $formTreg = $this->createForm(TypeReglementType::class , $typereglement);
        $formTreg->handleRequest($request);
        if ($formTreg->isSubmitted() && $formTreg->isValid()) {
            
            $entitymanager->persist($typereglement);
            $entitymanager->flush();
            //$categories = $repo->findAll();

            return $this -> redirectToRoute('ajout');
        }
        

        return $this->render('admin/pages/Ajouter.html.twig', [
            'controller_name' => 'AdminController',
            'formCategorie' => $formCat->createView(),
            'formProduit' => $formProd->createView(),
            'formSolution' => $formSol->createView(),
            'formTypeSolution' => $formTsol->createView(),
            'formTypeReglement' => $formTreg->createView(),
            
        ]);
    }

    /**
     * @Route("/admin/liste", name="admin_liste")
     */
    public function admin_liste(Request $request, CategorieProduit $categorieproduit = null ,CategorieProduitRepository $repoC , Produit $produit = null ,ProduitRepository $repoP , Solutions $solutions = null ,SolutionsRepository $repoS, TypeSolutions $typesolutions = null ,TypeSolutionsRepository $repoTS , TypeReglement $typereglement = null ,TypeReglementRepository $repoTR ,EntityManagerInterface $entitymanager)
    {
        $categorieproduit = $repoC->findAll();
        $produit = $repoP->findAll();
        $solutions = $repoS->findAll();
        $typereglement = $repoTR->findAll();
        $typesolutions = $repoTS->findAll();

        
        return $this->render('admin/pages/ListeParametre.html.twig', [
            'controller_name' => 'AdminController',
            'categorieproduits' => $categorieproduit ,
            'produit' => $produit ,
            'solutions' => $solutions ,
            'typereglements' => $typereglement ,
            'typesolutions' => $typesolutions 
        ]);
    }

    //suppresion des données dans la base de données
    /**
     * @route("/admin/{id}/delete" , name="delete_prod")
    */

    public function delete(Request $request,Produit $produit,ProduitRepository $repoP) {
        
 
        $produits = $this->getDoctrine()->getManager();
        $produits->remove($produit);
        $produits->flush();
     
    
        return $this -> redirectToRoute('admin_liste');


        return $this->render('admin/pages/ListeParametre.html.twig', [
            'controller_name' => 'AdminController'
        ]);
    }

    /**
     * @route("/admin/{id}/delete" , name="delete_cat")
    */

    public function deleteC(Request $request,CategorieProduit $categorieproduit,CategorieProduitRepository $repoC) {
        
 
        $categorieproduits = $this->getDoctrine()->getManager();
        $categorieproduits->remove($categorieproduit);
        $categorieproduits->flush();
     
    
        return $this -> redirectToRoute('admin_liste');


        return $this->render('admin/pages/ListeParametre.html.twig', [
            'controller_name' => 'AdminController'
        ]);
    }

    /**
     * @route("/admin/{id}/delete" , name="delete_sol")
    */

    public function deleteS(Request $request,Solutions $solutions,SolutionsRepository $repoS) {
        
 
        $solution = $this->getDoctrine()->getManager();
        $solution->remove($solutions);
        $solution->flush();
     
    
        return $this -> redirectToRoute('admin_liste');


        return $this->render('admin/pages/ListeParametre.html.twig', [
            'controller_name' => 'AdminController'
        ]);
    }

    /**
     * @route("/admin/{id}/delete" , name="delete_Tsol")
    */

    public function deleteTs(Request $request,TypeSolutions $typesolutions,TypeSolutionsRepository $repoS) {
        
 
        $typesolution = $this->getDoctrine()->getManager();
        $typesolution->remove($typesolutions);
        $typesolution->flush();
     
    
        return $this -> redirectToRoute('admin_liste');


        return $this->render('admin/pages/ListeParametre.html.twig', [
            'controller_name' => 'AdminController'
        ]);
    }

    /**
     * @route("/admin/{id}/delete" , name="delete_reg")
    */

    public function deletereg(Request $request,TypeReglement $typereglement,TypeReglementRepository $repoS) {
        
 
        $typereglements = $this->getDoctrine()->getManager();
        $typereglements->remove($typereglement);
        $typereglements->flush();
     
    
        return $this -> redirectToRoute('admin_liste');


        return $this->render('admin/pages/ListeParametre.html.twig', [
            'controller_name' => 'AdminController'
        ]);
    }
}
