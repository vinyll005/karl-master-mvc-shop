<?php

class AdminProductsController
{
    public function ActionIndex($column = 'id', $sort_order = 'asc', $page = 1)
    {
        unset($_SESSION['current_filters']);
        $products = Product::getProducts($column, $sort_order, $page);
        // print_r($products);
        $sort_order = $sort_order == 'asc' ? 'desc' : 'asc';

        $amountProducts = Product::getTotalAmountOfProducts();

        $pagination = new Pagination($amountProducts, $page, Product::AMOUNT_PRODUCTS_BY_DEFAULT, 'page-');

        include_once(ROOT.'/views/adminProducts/index.php');
    }

    public function ActionAddProduct()
    {
        if(isset($_POST['submit']))    {
            $options['name'] = $_POST['name'];
            $options['price'] = $_POST['price'];
            $options['description'] = $_POST['description'];
            $options['color'] = $_POST['color'];
            $options['size'] = $_POST['size'];
            $options['category'] = $_POST['category'];
        
        if(!empty($_POST['discount']))  {
            $options['discount'] = $_POST['discount'];
            $total_discount = $options['price'] * $options['discount'] / 100;
            $options['finalPrice'] = $options['price'] - $total_discount;
        }   else    {
            $options['discount'] = 0;
            $options['finalPrice'] = $options['price'];
        }

        Product::createProduct($options);
        $id = Product::takeLastId();
        // print_r($_FILES);
        if($id) {
            if(is_uploaded_file($_FILES['image']['tmp_name'])) {
                move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/img/product-img/product-'.$id.'.jpg');
            }
        }
        header('Location: /admin/products');
    }
        include_once(ROOT.'/views/adminProducts/addProduct.php');
    }

    public function ActionUpdateProduct($id)
    {
        if(isset($_POST['submit']))    {
            $options['id'] = $id;
            $options['name'] = $_POST['name'];
            $options['price'] = $_POST['price'];
            $options['description'] = $_POST['description'];
            $options['color'] = $_POST['color'];
            $options['size'] = $_POST['size'];
            $options['category'] = $_POST['category'];
        
        if(isset($_POST['discount']))  {
            $options['discount'] = $_POST['discount'];
            $total_discount = $options['price'] * $options['discount'] / 100;
            $options['finalPrice'] = $options['price'] - $total_discount;
        }   else    {
            $options['discount'] = 0;
            $options['finalPrice'] = $options['price'];
        }

        if($id) {
            if(is_uploaded_file($_FILES['image']['tmp_name'])) {
                move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/img/product-img/product-'.$id.'.jpg');
            }
        }

        Product::updateProduct($options);
        header('Location: /admin/products');
    }
        $product = Product::getProductById($id);

        include_once(ROOT.'/views/adminProducts/updateProduct.php');
    } 

    public function ActionDeleteProduct($id)
    {
        Product::deleteProduct($id);

        header('Location: /admin/products');
    }
}