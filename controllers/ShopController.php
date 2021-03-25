<?php

class ShopController
{
    public function ActionIndex($page = 1)
    {
        $_SESSION['uri'] = $_SERVER['REQUEST_URI'];
        
        $_SESSION['current_filters']['page'] = $page;
        $filters = $_SESSION['current_filters'];
        // print_r($filters);
        // foreach($filters['category'] as $filter)    {
        //     echo $filter;
        // }

        $categories = Product::selectProductsFilter('category');
        $sizes = Product::selectProductsFilter('size');
        $colors = Product::selectProductsFilter('color');
        // print_r($sizes);

        if(!empty($_SESSION['current_filters']['query']))   {
            $products = Product::getProductsByQuery($page, $_SESSION['current_filters']['query']);
            // print_r(count($products));
            $amountProducts = Product::getTotalAmountOfProducts($_SESSION['current_filters']['query']);
        }   else {
            $products = Product::getProducts( 'id', 'asc', $page);
            $amountProducts = Product::getTotalAmountOfProducts();
        }

        // echo $amountProducts;
        $pagination = new Pagination($amountProducts, $page, Product::AMOUNT_PRODUCTS_BY_DEFAULT, 'page-');
        // print_r($products);
        
        include_once(ROOT.'/views/shop/index.php');
    }

    public function ActionViewProduct($id)
    {
        $product = Product::getProductById($id);

        include_once(ROOT.'/views/shop/viewProduct.php');
    }
}

?>