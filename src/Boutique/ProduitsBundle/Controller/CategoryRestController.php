<?php 

namespace Boutique\ProduitsBundle\Controller;

use FOS\RestBundle\View\View;
use Boutique\ProduitsBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CategoryRestController extends Controller {

    /**
     * @Rest\Get("/getcategories")
     * @Rest\View()
     */
    public function getCategoriesAction() {
        
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Category::class)->findAll();
    
        // Création d'une vue FOSRestBundle
        $view = View::create($categories);
        $view->setFormat('json');
    
        // Gestion de la réponse
        return $view;
    }

    /**
     * @Rest\Post("/postcategory")
     * @Rest\View()
     */

    public function postCategoryAction(Request $request) {
        $category = new Category();
        $category->setName($request->get('nom'));
        $category->setDescription($request->get('description'));

        $em = $this->getDoctrine()->getManager();

        $em->persist($category);
        $em->flush();
        $view = View::create($category);
        $view->setFormat('json');
    
        return $view;
        
    }
    /**
     * @Rest\Delete("/removecategory/{id}")
     * @Rest\View()
     */

    public function removeCategoryAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository(Category::class)
                    ->find($request->get('id'));

        if ($category) {
            $em->remove($category);
            $em->flush();
        }
        
        $categories = $em->getRepository(Category::class)->findAll();
        $view = View::create($categories);
        $view->setFormat('json');
    
        return $view;
    }

    /**
     * @Rest\Put("/updatecategory/{id}")
     * @Rest\View()
     */
    public function updateCategoryAction(Request $request) {

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository(Category::class)->find($id);
        if ($category && $id) {
            $category->setName($request->get('name'));
            $category->setDescription($request->get('description'));
            // $em->merge($category) si jamais je veux juste changé un champ.
            $em->persist($category);
            $em->flush();

            $view = View::create($category);
            $view->setFormat('json');
        
            return $view;
        } else {
            return new JsonResponse(
                ['message' => 'Place not found'], 
                Response::HTTP_NOT_FOUND
            );
        }

    }

}