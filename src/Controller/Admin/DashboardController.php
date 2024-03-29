<?php

namespace App\Controller\Admin;

use App\Entity\Addresse;
use App\Entity\Caracteristic;
use App\Entity\CaracteristicDetail;
use App\Entity\Category;
use App\Entity\DeliveryMethod;
use App\Entity\Image;
use App\Entity\Option;
use App\Entity\Order;
use App\Entity\OrderDetails;
use App\Entity\Product;
use App\Entity\Specification;
use App\Entity\Stock;
use App\Entity\SubCategory;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        //return parent::index();
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(OrderCrudController::class)->generateUrl();

       return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('I-clope');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Adresses', 'fas fa-home', Addresse::class);
        yield MenuItem::linkToCrud('Catégories', 'fas fa-list-ul', Category::class);
        yield MenuItem::linkToCrud('Sous-catégories', 'fas fa-list-ul', SubCategory::class);
        yield MenuItem::linkToCrud('Produits', 'fab fa-product-hunt', Product::class);
        yield MenuItem::linkToCrud('Images', 'fas fa-images', Image::class);
        yield MenuItem::linkToCrud('Spécifications', 'fas fa-tags', Specification::class);
        yield MenuItem::linkToCrud('Options', 'fas fa-info-circle', Option::class);
        yield MenuItem::linkToCrud('Caractéristiques', 'fas fa-info-circle', Caracteristic::class);
        yield MenuItem::linkToCrud('Détails des caractéristiques', 'fas fa-sticky-note', CaracteristicDetail::class);
        yield MenuItem::linkToCrud('Mode de livraison', 'fas fa-truck', DeliveryMethod::class);
        yield MenuItem::linkToCrud('Commandes', 'fas fa-box', Order::class)->setDefaultSort(['createdAt'=>'DESC']);
        yield MenuItem::linkToCrud('Détails commandes', 'fas fa-box', OrderDetails::class)->setDefaultSort(['myOrder.createdAt'=>'DESC']);
        yield MenuItem::linkToCrud('Stock', 'fas fa-box-full', Stock::class);
        
    }
}