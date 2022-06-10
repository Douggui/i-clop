<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\CaracteristicDetailRepository;
use App\Repository\ImageRepository;
use App\Repository\OptionRepository;
use App\Repository\ProductRepository;
use App\Repository\SubCategoryRepository;
use App\Services\FullProduct;
use App\Services\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InfusionController extends AbstractController
{
    /**
     * @Route("/cbd/infusion", name="infusion")
     */
    public function index(Paginator $paginator,FullProduct $fullProduct,$page=1,SubCategoryRepository $subCatRepo,ProductRepository $repo): Response
    {
        /* find the id of the subCategory*/
        $idSubCategory=$subCatRepo->findOneByName('infusion');
        
         /* find all products relate to the subCategory */
        $data=$repo->findBySubCategory($idSubCategory->getId());
        
        /* paginate the products($data) */ 
        $products=$paginator->pagination($data,$page,1);
        
        return $this->render('infusion/index.html.twig', [
            'products'=>$fullProduct->getProductsInformation($products),
            'productPagination'=>$products
        ]);
    }
    /**
     * @Route("/cbd/produit-details/{slug}", name="cbd_show_details")
     */
    public function ProductShow(FullProduct $fullProduct,Product $product): Response
    {
        /* return all the informations of product found by the param converter to twig */
        return $this->render('cbd/product_show.html.twig', [
            'productInformation'=>$fullProduct->getFullProductInformation($product)
        ]);
    }
}