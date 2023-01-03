<?php

namespace App\Controller\Admin;

use App\Entity\SharedPlaylist;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;


class SharedPlaylistCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SharedPlaylist::class;
    }


    public function configureActions(Actions $actions): Actions
    {

    return $actions
        ->add(Crud::PAGE_INDEX, Action::DETAIL)
    ;
    }


    public function configureFields(string $pageName): iterable
    {

    return [
        AssociationField::new('creator'),
        BooleanField::new('published')
            ->onlyOnForms(),
        TextField::new('description'),
        AssociationField::new('musics')->setCrudController(MusicCrudController::class),
        AssociationField::new('musics')
            ->onlyOnDetail()
            ->setTemplatePath('admin/fields/playlist_music.html.twig'),

/*
        AssociationField::new('musics')
            ->onlyOnForms()
            // on ne souhaite pas gérer l'association entre les
            // [objets] et la [galerie] dès la crétion de la
            // [galerie]
            ->hideWhenCreating()
            ->setTemplatePath('admin/fields/playlist_music.html.twig')
            // Ajout possible seulement pour des [objets] qui
            // appartiennent même propriétaire de l'[inventaire]
            // que le [createur] de la [galerie]
            ->setQueryBuilder(
                function (QueryBuilder $queryBuilder) {
                // récupération de l'instance courante de [galerie]
                $currentSharedPlaylist = $this->getContext()->getEntity()->getInstance();
                $creator = $currentSharedPlaylist->getCreator();
                $membreId = $creator->getId();
                // charge les seuls [objets] dont le 'owner' de l'[inventaire] est le [createur] de la galerie
                $queryBuilder->leftJoin('entity.playlist', 'i')
                    ->leftJoin('i.owner', 'm')
                    ->andWhere('m.id = :membre_id')
                    ->setParameter('membre_id', $membreId);    
                return $queryBuilder;
            }
           ),
           
                  */
        ];
    }
}
