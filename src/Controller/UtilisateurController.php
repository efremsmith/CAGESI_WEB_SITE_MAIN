<?php

namespace App\Controller;

use App\Entity\Achat;
use App\Entity\LigneAchat;
use App\Entity\Users;
use App\Entity\Produit;
use App\Repository\AchatRepository;
use App\Repository\UsersRepository;
use App\Repository\ProduitRepository;
use App\Repository\SolutionsRepository;
use App\Repository\CategorieProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\TypeReglementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index(): Response
    {
        return $this->render('/pages/accueil.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function produit()
    {
        return $this->render('/pages/contact.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    /**
     * @Route("/solutions", name="solutions")
     */
    public function solutions()
    {
        return $this->render('/pages/solutions.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    /**
     * @Route("/services", name="services")
     */
    public function services()
    {
        return $this->render('/pages/services.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    /**
     * @Route("/formations", name="formations")
     */
    public function formation()
    {
        return $this->render('/pages/formations.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    /**
     * @Route("/boutique", name="boutique")
     */
    public function boutique(CategorieProduitRepository $repoC , ProduitRepository $repoP ,  SolutionsRepository $repoS , Request $request)
    {
        $categorie = $repoC->findAll();
        $produit = $repoP->findAll();
        $solution = $repoS->findAll();
        
        return $this->render('/pages/boutique.html.twig', [
            'controller_name' => 'UtilisateurController',

            'categories' => $categorie,
            'produits' => $produit,
            'solutions' => $solution,

        ]);
    }

    /**
     * @Route("/boutique/{id}/Details", name="Details")
     */
    public function Details(CategorieProduitRepository $repoC , ProduitRepository $repoP ,  SolutionsRepository $repoS ,Produit $produit,Request $request, ManagerRegistry $managerRegistry)
    {
        $categorie = $repoC->findAll();
        $produits = $repoP->findAll();
        $solution = $repoS->findAll();

        return $this->render('/pages/ProduitDetails.html.twig', [
            'produit' => $produit,
            'categories' => $categorie,
            'produits' => $produits,
            'solutions' => $solution,
        ]);

    }

    /**
     * @Route("/boutique/{id}", name="boutique_cat")
     */
    public function produitCategorie($id, CategorieProduitRepository $repoC , ProduitRepository $repoP ,  SolutionsRepository $repoS ,Produit $produit,Request $request, ManagerRegistry $managerRegistry)
    {
        $categorie = $repoC->findAll();
        $solution = $repoS->findAll();

        $produit = $repoP->findBy([
            "categorieproduit" => $request->get("id")
        ]);
        //dd($categorie);
        
        return $this->render('/pages/ProduitParCategorie.html.twig', [
            'controller_name' => 'UtilisateurController',
            'produits' => $produit,
            'categories' => $categorie,
            'solutions' => $solution
        ]);
    }


    ////////////////////////////////////////////////////////session panier //////////////////////////////////////////////////////////////////

    /**
     * @Route("/panier", name="panier")
     */
    public function panier(CategorieProduitRepository $repoC , ProduitRepository $repoP ,  SolutionsRepository $repoS,SessionInterface $session, ManagerRegistry $managerRegistry)
    {
        $categorie = $repoC->findAll();
        $produits = $repoP->findAll();
        $solution = $repoS->findAll();
        
        //remplir le tableau
        $panier= $session->get('panier',[]);
        $panierWithData = [];

        foreach ($panier as $id=>$quantity){
            $panierWithData[]=[
                'produit'=>$repoP->find($id),
                'quantite'=>$quantity
            ];
        }
        
        $total=0;
        foreach($panierWithData as $item ){
            $totalItem = $item['produit']->getPrix() * $item['quantite'];
            $total += $totalItem;
        }

        return $this->render('/pages/panier.html.twig', [
            'controller_name' => 'UtilisateurController',
            'items' => $panierWithData,
            'total' => $total,
            'categories' => $categorie,
            'produits' => $produits,
            'solutions' => $solution
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="panier_add")
     */
    public function panieradd($id, SessionInterface $session, Request $request )
    {
        $panier = $session->get('panier',[]);
        $quantite = (int) $request->get('quantite');

        //le if permet d'ajouter plusieur fois le même produits
        if(!empty($panier[$id])){
            $panier[$id] += $quantite;
        }else{
            $panier[$id]=$quantite;
        }

        $session->set('panier',$panier);
        //dd($session->get('panier'));

        return $this->redirectToRoute("panier");
    }

    /**
     * @Route("/panier/remove/{id}", name="panier_remove")
     */
    public function panierremove($id, SessionInterface $session )
    {
        
        $panier = $session->get('panier',[]);

        //le if permet d'ajouter plusieur fois le même produits
        if(!empty($panier[$id])){
            unset($panier[$id]);
        }

        $session->set('panier',$panier);
        //dd($session->get('panier'));

        
        return $this->redirectToRoute("panier");
           
    }

    /**
     * @Route("/reglement", name="reglement")
     */
    public function reglement(CategorieProduitRepository $repoC ,TypeReglementRepository $repoR, ProduitRepository $repoP ,  SolutionsRepository $repoS,SessionInterface $session, ManagerRegistry $managerRegistry)
    {
        $categorie = $repoC->findAll();
        $produits = $repoP->findAll();
        $solution = $repoS->findAll();
        $typereglement = $repoR->findAll();
        
        //remplir le tableau
        $panier= $session->get('panier',[]);
        $panierWithData = [];

        foreach ($panier as $id=>$quantity){
            $panierWithData[]=[
                'produit'=>$repoP->find($id),
                'quantite'=>$quantity
            ];
        }
        
        $total=0;
        foreach($panierWithData as $item ){
            $totalItem = $item['produit']->getPrix() * $item['quantite'];
            $total += $totalItem;
        }

        return $this->render('/pages/Reglement.html.twig', [
            'controller_name' => 'UtilisateurController',
            'items' => $panierWithData,
            'total' => $total,
            'categories' => $categorie,
            'produits' => $produits,
            'solutions' => $solution,
            'typereglements' => $typereglement
        ]);
    }

    /**
     * @Route("/commande", name="commande")
     */
    public function commande(Request $request,EntityManagerInterface $entityManager,AchatRepository $repoAc,UsersRepository $repoU,TypeReglementRepository $repoT,SessionInterface $session, ProduitRepository $repoP,CategorieProduitRepository $repoC , SolutionsRepository $repoS)
    {
        $categorie = $repoC->findAll();
        $produits = $repoP->findAll();
        $solution = $repoS->findAll();
        $typereglement = $repoT->findAll();
        //remplir le tableau de panier
        //remplir le tableau
        $panier= $session->get('panier',[]);
        $panierWithData = [];

        foreach ($panier as $id=>$quantity){
            $panierWithData[]=[
                'produit'=>$repoP->find($id),
                'quantite'=>$quantity
            ];
        }
        
        $total=0;
        foreach($panierWithData as $item ){
            $totalItem = $item['produit']->getPrix() * $item['quantite'];
            $total += $totalItem;
        }


        $idTypeReglement = $repoT->findOneBy([
            "id" => $request->get("modereglement")
        ]);
        ///// on verifie si l'acheteur a deja un compte si oui on fait plus son inscription
        $userR = $repoU->findOneby([
            "nom" => $request->get("nom"),
            "prenom" => $request->get("prenom"),
            "email" => $request->get("email"),
            "password" => $request->get('password')
        ]);
        //dd($acheteurR);
        if(!$userR) {
            //Enregistrement dans la base de la commande du client et les infos du client
            ///////////////////enregistrement de l'acheteur//////////
            $user = new Users();
            $user->setNom($request->get("nom"));
            $user->setPrenom($request->get("prenom"));
            $user->setPays($request->get("pays"));
            $user->setVille($request->get("ville"));
            $user->setAdresse($request->get("adresse"));
            $user->setTelephone($request->get("telephone"));
            $user->setEmail($request->get("email"));
            $user->setPassword($request->get("password"));
            $user->setCreatedAt(new \DateTime());
            
            $entityManager->persist($user);
            $entityManager->flush();
        }else {
            $user = $userR;
        }
        

        //dd($typereglement);
        
        ///////////enregistrement de l'achat (commande)////////
        $achat = new Achat;
        $achat->setCreatedAt(new \DateTime());
        $achat->setPrixAchat($total);
        $achat->setStatut("En cours");
        $achat->setUser($user);
        $achat->setTypeReglement($idTypeReglement);
        

        $entityManager->persist($achat);
        $entityManager->flush();
        //dd($typereglement);
        ////////////enregistrement de details//////////////////
        $panier= $session->get('panier',[]);
        $panierWithData = [];

        foreach ($panier as $id=>$quantity){
            $panierWithData[]=[
                'produit'=>$repoP->find($id),
                'quantite'=>$quantity
            ];
        }
        //dd($panierWithData);
        //recherche du type de reglement
        $typeR = $repoT->findOneBy([
            "id" => $request->get('modereglement')
        ]);
        //dd($typeR);
        //recherche de la cle du produit
        $idProd = $repoP->findOneBy([
            "nomProduit" => $item['produit']->getNomProduit(),
            "categorieproduit" => $item['produit']->getCategorieproduit()
        ]);
        //dd($idProd);
            $total=0;
            foreach($panierWithData as $item ){
                $totalItem = $item['produit']->getPrix() * $item['quantite'];
                $total += $totalItem;
 
                $ligneachat = new LigneAchat();
                $ligneachat->setQuantite($item['quantite']);
                $ligneachat->setPrixTotal(($item['produit']->getPrix()) * ($item['quantite']));
                $ligneachat->setProduit($idProd);
                $ligneachat->setAchat($achat);
                $entityManager->persist($ligneachat);
            }
        //dd($panierWithData);
        $entityManager->flush();
        //$session->remove('panier');
        //////////fin de l'enregistrement////////////////////

        return $this -> redirectToRoute('show',['id' => $achat->getId()]);
        
        //dd($session->get('panier'));
        return $this->render('/pages/commande.html.twig', [
            'controller_name' => 'UtilisateurController',
            'items' => $panierWithData,
            'total' => $total,
            'categories' => $categorie,
            'produits' => $produits,
            'solutions' => $solution,
            'typereglements' => $typereglement,
            'user'=>$user,
            'type' => $typeR,
            'achat' => $achat
            
        ]);
    }

    /**
     * @Route("/reglement/{id}", name="show")
     */
    public function commande_show($id, Request $request,EntityManagerInterface $entityManager,UsersRepository $repoU,AchatRepository $repoAc,TypeReglementRepository $repoT,SessionInterface $session, ProduitRepository $repoP,CategorieProduitRepository $repoC , SolutionsRepository $repoS)
    {
        $categorie = $repoC->findAll();
        $produits = $repoP->findAll();
        $solution = $repoS->findAll();

        $achat = $repoAc->findOneBy([
            'id' => $id
        ]);
    
        //appel le tableau
        $panier= $session->get('panier',[]);
        $panierWithData = [];

        foreach ($panier as $id=>$quantity){
            $panierWithData[]=[
                'produit'=>$repoP->find($id),
                'quantite'=>$quantity
            ];
        }
        
        $total=0;
        foreach($panierWithData as $item ){
            $totalItem = $item['produit']->getPrix() * $item['quantite'];
            $total += $totalItem;
        }
        $session->remove('panier');


        return $this->render('/pages/commande.html.twig', [
            'controller_name' => 'UtilisateurController',
            'items' => $panierWithData,
            'total' => $total,
            'categories' => $categorie,
            'produits' => $produits,
            'solutions' => $solution,
            'achat' => $achat
            
        ]);;
           
    }

    
}
