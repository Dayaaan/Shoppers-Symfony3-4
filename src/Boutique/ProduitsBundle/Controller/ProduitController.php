<?php

namespace Boutique\ProduitsBundle\Controller;

use Boutique\ProduitsBundle\Entity\Image;
use Boutique\ProduitsBundle\Entity\Produit;
use Boutique\ProduitsBundle\Entity\Category;
use Boutique\ProduitsBundle\Form\ProduitType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Produit controller.
 *
 * @Route("produit")
 */
class ProduitController extends Controller
{

    /**
     * Lists all produit entities.
     *
     * @Route("/", name="produit_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('BoutiqueProduitsBundle:Produit')->findAll();

        $categories = $em->getRepository('BoutiqueProduitsBundle:Category')->findAll();

        dump($categories);

        return $this->render('produit/index.html.twig', array(
            'products' => $products,
            'categories' => $categories
        ));
    }


    /**
    * @Route("/displaycart" , name="cart")
    */
    public function displayCartAction() {

        $session = $this->get('session');
       
        $cart = $session->get('cart');


        dump($cart);


        $em = $this->getDoctrine()->getManager();

        $subtotal = 0;

        for ( $i = 0 ; $i < sizeof($cart) ; $i++) {
            
            $products[$i]['productDetails'] = $em->getRepository(Produit::class)->find($cart[$i]['idproduit']);
            $products[$i]['quantity'] = $cart[$i]['qteproduit'];
            $products[$i]['total'] = $products[$i]['productDetails']->getPrice() * $cart[$i]['qteproduit'];
            $subtotal += $products[$i]['total'];
        }     
        dump($products);

    

        $orders = $session->set('orders', $products);
        

        return $this->render("produit/cart.html.twig", 
            [
                'products' => $products,
                'subtotal' => $subtotal
            ]
        );



    }

    /**
     * Creates a new produit entity.
     *
     * @Route("/new", name="produit_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $x = $form->getData();

            $images->$form["images"];

            foreach ($images as $image) {
                $image->setProduit($produit);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();

            return $this->redirectToRoute('produit_show', array('id' => $produit->getId()));
        }

        return $this->render('produit/new.html.twig', array(
            'produit' => $produit,
            'form' => $form->createView()
        ));
    }

    /**
     * Finds and displays a produit entity.
     *
     * @Route("/{id}", name="produit_show")
     * @Method("GET")
     */
    public function showAction(Produit $produit)
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('BoutiqueProduitsBundle:Category')->findAll();

        $images = $produit->getImages();

        return $this->render('produit/show.html.twig', array(
            'produit' => $produit,
            'categories' => $categories
        ));
    }

    /**
     * Displays a form to edit an existing produit entity.
     *
     * @Route("/{id}/edit", name="produit_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Produit $produit)
    {
        $deleteForm = $this->createDeleteForm($produit);
        $editForm = $this->createForm('Boutique\ProduitsBundle\Form\ProduitType', $produit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produit_edit', array('id' => $produit->getId()));
        }

        return $this->render('produit/edit.html.twig', array(
            'produit' => $produit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a produit entity.
     *
     * @Route("/{id}", name="produit_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Produit $produit)
    {
        $form = $this->createDeleteForm($produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produit);
            $em->flush();
        }

        return $this->redirectToRoute('produit_index');
    }

    /**
     * Creates a form to delete a produit entity.
     *
     * @param Produit $produit The produit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Produit $produit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produit_delete', array('id' => $produit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
    * @Route("/searchproducts" , name="searchproducts")
    */
    //FORMULAIRE SEARCH
      
    public function searchProductsAction(Request $request) {

    // $_GET parameters
    //$request->query->get('name');

    // $_POST parameters
    // $request->request->get('name');

        $em = $this->getDoctrine()->getManager();

        //POST
        $search = $request->request->get('search');

        $products = $em->getRepository(Produit::class)->sortProductByName($search);

        $categories = $em->getRepository(Category::class)->findAll();

        return $this->render("produits/index.html.twig",
            [
                'products' => $products,
                'categories' => $categories
            ]
        );
    }

    /**
    * @Route("/addtocart/{id}" , name="addtocart")
    */
    public function addToCartAction(Request $request,$id) {

        $quantity = $request->request->get('quantity');

        $session = $this->get('session');

        //$session->clear();


        $tab['idproduit'] = $id;
        $tab['qteproduit'] = $quantity;
       
        
        $cart = $session->get('cart');

        $x = false;
        
        if ($cart) {
            for ($i = 0; $i < count($cart) ; $i++) {

                if ($cart[$i]['idproduit'] == $id) {
    
                    $cart[$i]['qteproduit'] += $quantity;
    
                    $x = true;
                } 
            }
        }

        if(!$x) {
            $cart[] = $tab;
        }
        
        $session->set('cart', $cart);

        $getCart = $session->get('cart');

        dump($getCart);

        return $this->redirectToRoute("cart");
        
    }


    
}
