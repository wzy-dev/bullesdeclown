<?php

namespace App\Controller;

use App\Entity\Parameter;
use App\Entity\Article;
use App\Entity\Element;
use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;


class IndexController extends AbstractController
{
    private function init(string $category) {
        $em = $this->getDoctrine()->getManager();        
        $elements=$em->getRepository(Element::class)->findByCategory($category);
        $articles=null;    
        foreach($elements as $element) {
            if ($element->getArticleBlock() !== null) {
                $category=$element->getArticleBlock()->getCategory();
                if ($category !== 'all') {
                    $articles=$em->getRepository(Article::class)->findBy(array('category'=>$category), array('date' => 'desc'), 4, 0);
                } else {
                    $articles=$em->getRepository(Article::class)->findBy(array(), array('date' => 'desc'), 4, 0);
                }
            }
        }

        return array($elements,$articles);
    }

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $data = $this->init('index');

        return $this->render('page/index.html.twig',array(
        	'articles'=>$data[1],
        	'elements'=>$data[0]
        ));        
    }

    /**
     * @Route("/mentions", name="mentions")
     */
    public function mentions()
    {
        $data = $this->init('mentions');

        return $this->render('page/mentions.html.twig',array());        
    }

    /**
     * @Route("/yoga", name="yoga")
     */
    public function yoga()
    {
        $data = $this->init('yoga');

        return $this->render('page/yoga.html.twig',array(
            'articles'=>$data[1],
            'elements'=>$data[0]
        ));        
    }

    /**
     * @Route("/clown", name="clown")
     */
    public function clown()
    {
        $data = $this->init('clown');

        return $this->render('page/clown.html.twig',array(
            'articles'=>$data[1],
            'elements'=>$data[0]
        ));        
    }

    /**
     * @Route("/teambuilding", name="teambuilding")
     */
    public function teambuilding()
    {
        $data = $this->init('teambuilding');

        return $this->render('page/teambuilding.html.twig',array(
            'articles'=>$data[1],
            'elements'=>$data[0]
        ));        
    }

    /**
     * @Route("/bienetre", name="bienetre")
     */
    public function bienetre()
    {
        $data = $this->init('bienetre');

        return $this->render('page/bienetre.html.twig',array(
            'articles'=>$data[1],
            'elements'=>$data[0]
        ));        
    }

    /**
     * @Route("/organisation", name="organisation")
     */
    public function organisation()
    {
        $data = $this->init('organisation');

        return $this->render('page/organisation.html.twig',array(
            'articles'=>$data[1],
            'elements'=>$data[0]
        ));        
    }


    /**
     * @Route("/contact", name="contact")
     */
    public function contact(\Swift_Mailer $mailer, Request $request, $id=null)
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $message = (new \Swift_Message('[Bulle de clown] '.$task->getSubject()))
            ->setFrom([$task->getEmail() => $task->getName()])
            ->setTo('contact@bulledeclown.fr')
            ->setBody(
                $this->renderView(
                    'plugin/mail.html.twig',
                    array('body' =>$task->getBody(), 'name' =>$task->getName(), 'email' =>$task->getEmail(), 'subject' =>$task->getSubject())
                ),
                'text/html'
            )
            ;

            $mailer->send($message);

            $this->addFlash("success", "Le message a bien été envoyé !");

            return $this->render('page/contact.html.twig', [
                'form' => $form->createView()
            ]);        
        }

        $em = $this->getDoctrine()->getManager();
        $parameters = $em->getRepository(Parameter::class)->findAll()[0];

        return $this->render('page/contact.html.twig', [
            'form' => $form->createView(),
            'parameters' => $parameters
        ]);        
    }

    /**
     * @Route("/articles", name="articles")
     */
    public function articles(Request $request, PaginatorInterface $paginator)
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

        return $this->render('page/articles.html.twig', ['pagination' => $pagination]);
    }
}
