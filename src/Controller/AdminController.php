<?php

namespace App\Controller;

use App\Entity\Parameter;
use App\Form\ParameterType;
use App\Entity\ArticleBlock;
use App\Form\ArticleBlockType;
use App\Entity\Article;
use App\Form\ArticleType;
use App\Entity\Element;
use App\Form\ElementType;
use App\Entity\Data;
use App\Form\DataType;
use App\Entity\Rate;
use App\Form\RateType;
use App\Entity\Schedulde;
use App\Form\ScheduldeType;
use App\Entity\Presentation;
use App\Form\PresentationType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
      $em = $this->getDoctrine()->getManager();
      $articles = $em->getRepository(Article::class)->findBy(
        array(),
        array('date'=>'desc'),
        5,
        0
      );

      return $this->render('admin/index.html.twig', [
          'articles' => $articles,
      ]);
    }

    /**
     * @Route("/admin/edit/articles", name="admin_edit_articles")
     */
    public function editArticles(Request $request, PaginatorInterface $paginator)
    {
      $em = $this->getDoctrine()->getManager();
      $category=$request->query->get('category');
      if ($category == null || $category == 'all') {
        $query = $em->createQuery('SELECT a FROM App:Article a ORDER BY a.date DESC');
      } else {
        $query = $em->createQuery('SELECT a FROM App:Article a WHERE a.category = ?1 ORDER BY a.date DESC');
        $query->setParameter(1, $category);
      }

      $pagination = $paginator->paginate(
          $query, /* query NOT result */
          $request->query->getInt('page', 1), /*page number*/
          5 /*limit per page*/
      );

      return $this->render('admin/editarticles.html.twig', ['pagination' => $pagination]);
    }

    /**
     * @Route("/admin/new/article", name="admin_new_article")
     * @Route("/admin/edit/article/{article}", name="admin_edit_article")
     */
    public function newArticle(Request $request, $article = null)
    {
      $em = $this->getDoctrine()->getManager();

      if ($article === null) {
        $article = new Article();
      } else {
        $article=$em->getRepository(Article::class)->find($article);
      }

      $form = $this->get('form.factory')->create(ArticleType::class, $article);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {      
        $em->persist($article);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Les modifications ont bien été enregistrés.');

        return $this->redirectToRoute('admin_edit_article', array('article'=>$article->getId()));
      }     

      return $this->render('admin/newarticle.html.twig', array(
        'form' => $form->createView()
      ));
    }

    /**
     * @Route("/admin/remove/article/{article}/{confirm}", name="admin_remove_article")
     */
    public function removeArticle(Request $request, $article, $confirm=false)
    {
      $em = $this->getDoctrine()->getManager();
      $article = $em->getRepository(Article::class)->find($article);

      if ($confirm == true) {
        $em->remove($article);
        $em->flush();

        return $this->redirectToRoute('admin_edit_articles');                
      }

      return $this->render('admin/removearticle.html.twig', array(
        'article' => $article,
      ));      
    }

    /**
     * @Route("/admin/new/element/{category}", name="admin_new_element")
     */
    public function newElement(Request $request, $category)
    {
	    $element = new Element();
	    $form = $this->get('form.factory')->create(ElementType::class);
  		$form->handleRequest($request);

	    if ($form->isSubmitted() && $form->isValid()) {
	     	$em = $this->getDoctrine()->getManager();
        $element->setType('undefined');
        $element->setCategory($category);
        $lastElement = $em->getRepository(Element::class)->findOneBy(
          array('category'=>$category),
          array('rank'=>'desc'),
          1,
          0
        );
        if ($lastElement !== null) {
          $rank=$lastElement->getRank()+1;
        } else {
          $rank=1;
        }
        $element->setRank($rank);
        $em->persist($element);
      	$em->flush();

	     	$data = $form->getData();

	      return $this->redirectToRoute('admin_new', array(
          'element' => $element->getId(),
          'type' => $data['type']
        ));
	    }    	

      return $this->render('admin/newelement.html.twig', array(
      	'form' => $form->createView(),
        'category' => $category
      ));
    }

    /**
     * @Route("/admin/edit/elements/{category}", name="admin_edit_elements")
     */
    public function editElements(Request $request, $category)
    {
      $em = $this->getDoctrine()->getManager();
      $elements = $em->getRepository(Element::class)->findByCategory($category);

      return $this->render('admin/editelements.html.twig', array(
        'elements' => $elements,
        'category' => $category
      ));      
    }

    /**
     * @Route("/admin/remove/element/{element}/{confirm}", name="admin_remove_element")
     */
    public function removeElement(Request $request, $element, $confirm=false)
    {
      $em = $this->getDoctrine()->getManager();
      $element = $em->getRepository(Element::class)->find($element);
      $category = $element->getCategory();

      if ($confirm == true) {
        $em->remove($element);
        $em->flush();

        return $this->redirectToRoute('admin_edit_elements', array(
          'category' => $category,
        ));                
      }

      return $this->render('admin/removeelement.html.twig', array(
        'element' => $element,
      ));      
    }

    /**
     * @Route("/admin/new/{type}/in/{element}", name="admin_new")
     * @Route("/admin/edit/{type}/in/{element}", name="admin_edit")
     */
    public function editForm(Request $request, $type, $element)
    {  
      $currentRoute = $request->attributes->get('_route');
      $em = $this->getDoctrine()->getManager();   

      $route = [];
      $route['request']=explode('_',$currentRoute)[1];
      $route['entity']=$type;
      $route['entityUp']=ucwords($route['entity']);

      $element=$em->getRepository(Element::class)->find($element);      

      if ($route['request']=='new') {
        $class_name = $route['entityUp'];
        $namespace = '\\App\\Entity';
        $fully_qualified_class_name = "$namespace\\$class_name";
        $entity = new $fully_qualified_class_name;
      } else {
        $getEntityFunc = 'get'.$route['entityUp'];
        $entity = $element->$getEntityFunc();
      }

      $form = $this->get('form.factory')->create('App\Form\\'.$route['entityUp'].'Type', $entity);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        
        $setEntityFunc = 'set'.$route['entityUp'];

        if ($route['request']=='new') {
          $element->$setEntityFunc($entity);
          $element->setType($route['entity']);
        } 

        if(method_exists($entity,'getFields')) {
          foreach ($entity->getFields() as $field) {
            $field->$setEntityFunc($entity);
          }    
        }

        $em->persist($entity);
        $em->flush();
          
        $request->getSession()->getFlashBag()->add('notice', 'Les modifications ont bien été enregistrés.');

        return $this->redirectToRoute('admin_edit', array(
          'element' => $element->getId(),
          'type' => $route['entity']
        ));
      }     

      return $this->render('admin/new'.$route['entity'].'.html.twig', array(
        'form' => $form->createView(),
        'category' => $element->getCategory()
      ));
    }

    /**
     * @Route("/admin/edit/parameters", name="admin_edit_parameters")
     */
    public function editParameters(Request $request)
    {  
      $em = $this->getDoctrine()->getManager();   
      $parameters=$em->getRepository(Parameter::class)->findAll()[0];      

      $form = $this->get('form.factory')->create(ParameterType::class,$parameters);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($parameters);
        $em->flush();
          
        $request->getSession()->getFlashBag()->add('notice', 'Les modifications ont bien été enregistrés.');

        return $this->redirectToRoute('admin_edit_parameters', array( ));
      }     

      return $this->render('admin/editparameters.html.twig', array(
        'form' => $form->createView()
      ));
    }
}
