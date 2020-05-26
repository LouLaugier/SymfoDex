<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Build;
use App\Entity\Image;
use App\Entity\Pokemon;
use App\Entity\Ability;
use App\Entity\Move;
use App\Entity\Nature;

/**
 * @Route("/symfodex")
 */
class BuildController extends AbstractController
{
    /**
     * @Route("/{page}", name="sd_pok_index", requirements={"page"="\d+"}, defaults={"page" = 1})
     */
    public function indexAction($page) {
        if($page < 1) {
            throw $this->createNotFoundException('page "'.$page.'" inexistant.');
        }
        
        //To do : create config
        $nbPerPage = 5;

        $repositories = self::getRepositories(array('Build'));

        $listBuilds = $repositories['Build']->getBuilds($page, $nbPerPage);

        $nbPages = ceil(count($listBuilds) / $nbPerPage);

        if($page > $nbPages) {
            throw $this->createNotFoundException('page "'.$page.'" inexistant.');
        }

        return $this->render('Symfodex/Build/index.html.twig', array(
            'listBuild' => $listBuilds,
            'nbPages' => $nbPages,
            'page' => $page
        ));
    }

    /**
     * @Route("/add", name="sd_pok_add")
     */
    public function addBuildAction(Request $request) {
        $repositories = self::getRepositories(array('Pokemon', 'Image'));
        $build = new Build();                      

        $form = self::createBuildForm($build);

        if($request->isMethod('POST')) {

            if($request->isXmlHttpRequest()) {
                $build = self::ajaxPostPokemonTreatment($request, $build, $repositories);
            } else {
                $form->handleRequest($request);
                if($form->isValid()) {
                    //To do : add more inputs verification

                    $build = self::formPostTreatment($build, $repositories);
                    return $this->redirectToRoute('sd_pok_view', array('id' => $build->getId()));
                }
            }
        } 

        return $this->render('Symfodex/Build/addBuild.html.twig', array(
            'form' => $form->createView(),
            'build' => $build
        ));
    }

    /**
     * @Route("/view/{id}", name="sd_pok_view", requirements={"id" = "\d+"})
     */
    public function viewAction($id) {
        $repositories = self::getRepositories(array('Build'));

        $build = $repositories['Build']->find($id);
        if(is_null($build)) {
            throw new \Exception("Le build d'id ".$id." n'esxiste pas.");
        }

        return $this->render('Symfodex/Build/viewBuild.html.twig', array(
            'build' => $build
        ));
    }

    /**
     * @Route("/edit/{id}", name="sd_pok_edit", requirements={"id" = "\d+"})
     */
    public function editAction($id, Request $request) {
        $repositories = self::getRepositories(array('Build', 'Pokemon', 'Image'));

        $build = $repositories['Build']->find($id);
        if(is_null($build)) {
            throw new \Exception("Le build d'id ".$id." n'esxiste pas.");
        }

        $form = self::createBuildForm($build);

        if($request->isMethod('POST')) {

            if($request->isXmlHttpRequest()) {
                $build = self::ajaxPostPokemonTreatment($request, $build, $repositories);
            } else {
                $form->handleRequest($request);
                if($form->isValid()) {
                    //To do : add more inputs verification

                    $build = self::formPostTreatment($build, $repositories);
                    return $this->redirectToRoute('sd_pok_view', array('id' => $build->getId()));
                }
            }
        }

        return $this->render('Symfodex/Build/editBuild.html.twig', array(
            'form' => $form->createView(),
            'build' => $build
        ));
    }

    /**
     * @Route("/delete/{id}", name="sd_pok_delete", requirements={"id" = "\d+"})
     */
    public function deleteAction($id, Request $request) {
        $repositories = self::getRepositories(array('Build'));
        $build = $repositories['Build']->find($id);

        if(is_null($build)) {
            throw new \Exception("Le build d'id ".$id." n'esxiste pas.");
        }

        // empty form with CSRF field
        $form = $this->get('form.factory')->create();
        
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            
            $em = $this->getDoctrine()->getManager();
            $em->remove($build);
            $em->flush();
        
            return $this->redirectToRoute('sd_pok_index');
        }
          
        return $this->render('Symfodex/Build/deleteBuild.html.twig', array(
            'build' => $build,
            'form'   => $form->createView(),
        ));
    }

    /**
     * input : limit of build number for lastCreatedBuilds action
     * return : 3 last builds
     */
    public function lastCreatedBuildsAction($limit = 3) {
        $repositories = self::getRepositories(array('Build'));

        $listBuilds = $repositories['Build']->findBy(array(), array('date' => 'desc'), $limit, 0);

        return $this->render('Symfodex/Build/lastCreatedBuilds.html.twig', array('listBuild' => $listBuilds));
    }

    

    /**
     * @Route("/setNature", name="sd_set_nat")
     * ajax post request only
     */
    public function setNature(Request $request) {
        $repositories = self::getRepositories(array('Nature'));
        if($request->isMethod('POST')) {
            if($request->isXmlHttpRequest()) {
                $natureId = intval($request->request->all()['natureId']);
                $nature =  $repositories['Nature']->find($natureId);
                if(is_null($nature)) {
                    throw new \Exception("La nature d'id ".$natureId." n'esxiste pas.");
                }
                return new JsonResponse(json_encode(array('Atk' => $nature->getAtkBonus(), 
                                                          'Def' => $nature->getDefBonus(),
                                                          'Spa' => $nature->getSpABonus(),
                                                          'Spd' => $nature->getSpDBonus(),
                                                          'Spe' => $nature->getSpeBonus())));
            }
        }
    }

    /**
     * input : $build (empty or not)
     * return : form for add/edit build
     */
    private function createBuildForm($build) {
        //$repositories = self::getRepositories(array('Ability', 'Move'));

        if(is_null($build)) {
            throw new \Exception("Error");
        }

        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $build);
        $formBuilder->add('date', DateType::class)
                    ->add('title', TextType::class)
                    ->add('author', TextType::class)
                    ->add('pokemon', EntityType::class, ['class' => Pokemon::class, 'placeholder' => '', 'choice_label' => 'name'])
                    ->add('nature', EntityType::class, ['class' => Nature::class, 'choice_label' => 'name'])
                    ->add('evPv', IntegerType::class, array('required' => false, 'attr' => array('class' => 'ev pv')))
                    ->add('evAtk', IntegerType::class, array('required' => false, 'attr' => array('class' => 'ev atk')))
                    ->add('evDef', IntegerType::class, array('required' => false, 'attr' => array('class' => 'ev def')))
                    ->add('evSpa', IntegerType::class, array('required' => false, 'attr' => array('class' => 'ev spa')))
                    ->add('evSpd', IntegerType::class, array('required' => false, 'attr' => array('class' => 'ev spd')))
                    ->add('evSpe', IntegerType::class, array('required' => false, 'attr' => array('class' => 'ev spe')))
                    ->add('ivPv', IntegerType::class, array('required' => false, 'attr' => array('class' => 'iv pv')))
                    ->add('ivAtk', IntegerType::class, array('required' => false, 'attr' => array('class' => 'iv atk')))
                    ->add('ivDef', IntegerType::class, array('required' => false, 'attr' => array('class' => 'iv def')))
                    ->add('ivSpa', IntegerType::class, array('required' => false, 'attr' => array('class' => 'iv spa')))
                    ->add('ivSpd', IntegerType::class, array('required' => false, 'attr' => array('class' => 'iv spd')))
                    ->add('ivSpe', IntegerType::class, array('required' => false, 'attr' => array('class' => 'iv spe')))
                    ->add('content', TextareaType::class, array('required' => false))
                    ->add('ability', EntityType::class, ['class' => Ability::class, 'choice_label' => 'name'])
                    //->add('ability', EntityType::class, ['class' => Ability::class, 'query_builder' => function($repositories) {} ])
                    //->add('moves', EntityType::class, ['class' => Move::class, 'choice_label' => 'name'])
                    ->add('save', SubmitType::class);
        
        $form = $formBuilder->getForm();

        return $form;
    }

    /**
     * input : array of repo needed
     * return : repo var for all needed repo
     */
    private function getRepositories(array $reposNeeded) {
        if(empty($reposNeeded)) {
            throw new \Exception("Repo array empty.");
        }

        $repositories = array();
        foreach($reposNeeded as $repoNeeded) {
            $repoName = $repoNeeded;
            $repo = $this->getDoctrine()->getManager()->getRepository("App\Entity\\".$repoNeeded);
            $repositories[$repoName] = $repo;
        }

        return $repositories;
    }

    /**
     * build treatment for ajax post pokemon request
     */
    private function ajaxPostPokemonTreatment($request, $build, $repositories) {
        $pokemonId = intval($request->request->all()['pokemonId']);
        $pokemon = $repositories['Pokemon']->find($pokemonId);
        $image =  $repositories['Image']->find($pokemonId);
        if(is_null($pokemon) || is_null($image)) {
            throw new \Exception("Le pokemon d'id ".$pokemonId." n'esxiste pas.");
        }
        $build->setPokemon($pokemon);
        $build->setImage($image);

        return $build;
    }

    /**
     * build treatment for form submit post request
     */
    private function formPostTreatment($build, $repositories) {
        //update image
        $image =  $repositories['Image']->find($build->getPokemon());
        $build->setImage($image);

        //persist build
        $em = $this->getDoctrine()->getManager();
        $em->persist($build);
        $em->flush();

        return $build;
    }    
}
