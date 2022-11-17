<?php

namespace App\Controller\Admin;

use App\Entity\Membre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class MembreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Membre::class;
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
            'nom',
            AssociationField::new('playlists')->setCrudController(PlaylistCrudController::class),
            AssociationField::new('playlists')
                  ->onlyOnDetail()
                  ->setTemplatePath('admin/fields/membre_playlist.html.twig')

        ];
        
        
    }
}
