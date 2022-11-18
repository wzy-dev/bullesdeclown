<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use App\Entity\ScheduldeField;
use App\Entity\RateField;
use App\Entity\Element;
use App\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ApiController extends FOSRestController
{    
    /**
     * @Route("/api/inverse/rank/{start}/by/{end}/in/{category}", name="api_inverse_rank")
     * @IsGranted("ROLE_ADMIN")
     */
    public function inverseRank($start, $end, $category)
    {
        $em = $this->getDoctrine()->getManager();

        $entityStart=$em->getRepository(Element::class)->findOneByRank($category,$start);
        $rankStart=$entityStart->getRank();

        $entityEnd=$em->getRepository(Element::class)->findOneByRank($category,$end);
        $rankEnd=$entityEnd->getRank();

        $min = min($rankStart,$rankEnd);
        $max = max($rankStart,$rankEnd);
        $entities=$em->getRepository(Element::class)->findListByRank($category,$min,$max);

        if ($start < $end) {  
            $saveFirst=$entities[count($entities)-1]->getRank();
            for ($i=count($entities)-1; $i > 0; $i--) {
                $entities[$i]->setRank($entities[$i-1]->getRank());
                $em->persist($entities[$i]);
            }     
            $entities[0]->setRank($saveFirst);   
            $em->persist($entities[0]);
        } else {
            $saveLast=$entities[0]->getRank();
            for ($i=0; $i < count($entities)-1; $i++) {
                $entities[$i]->setRank($entities[$i+1]->getRank());
                $em->persist($entities[$i]);
            }     
            $entities[count($entities)-1]->setRank($saveLast);   
            $em->persist($entities[count($entities)-1]);  
        }

       $em->flush();

        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();

        $serializer = new Serializer(array($normalizer), array($encoder));
        $jsonContent = $serializer->serialize(array(
            'status'=>'inversed',
            'start'=>$rankStart,
            'end'=>$rankEnd
        ), 'json');
        return new JsonResponse($jsonContent);
    }

    /**
     * @Route("/api/rate/remove/field/{field}", name="api_remove_rate_field")
     * @Route("/api/schedulde/remove/field/{field}", name="api_remove_schedulde_field")
     * @IsGranted("ROLE_ADMIN")
     */
    public function removeField(Request $request, $field)
    {
        $currentRoute = $request->attributes->get('_route');
        $em = $this->getDoctrine()->getManager();        

        if (strpos($currentRoute, 'schedulde') !== false) {
            $field=$em->getRepository(ScheduldeField::class)->find($field);
        } else {
            $field=$em->getRepository(RateField::class)->find($field);
        }
                
        $em->remove($field);
		$em->flush();                                    

        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();

        $serializer = new Serializer(array($normalizer), array($encoder));
        $jsonContent = $serializer->serialize(array('status'=>'deleted'), 'json');
        return new JsonResponse($jsonContent);
    }

    /**
     * @Route("/api/show/article/{article}", name="api_show_article")
     */
    public function showArticle(Request $request, $article)
    {
        $em = $this->getDoctrine()->getManager();
        $article=$em->getRepository(Article::class)->find($article);

        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();

        $serializer = new Serializer(array($normalizer), array($encoder));
        $jsonContent = $serializer->serialize(array(
            'article'=>$article,
            'date'=>date_format($article->getDate(), 'd/m/Y'),
            'category'=>$this->getParameter('categoryConst')[$article->getCategory()]
        ), 'json');
        return new JsonResponse($jsonContent);
    }
}
