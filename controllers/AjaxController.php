<?php

class AjaxController
{

    public function ActionCheckLoginForm()
    {
        if($_POST)  {
            User::checkErrorsLogin($_POST['email'], $_POST['password']);
        }

        // if ($_POST['email']) {

        //     echo json_encode(array('success' => 1));
        // }   else {
        //     echo json_encode(array('success' => 2));
        // }
    }

    public function ActionCheckRegisterForm()
    {

        if($_POST)  {
            if($_POST['name'])  {
                User::checkErrorsRegister($_POST['name'], $_POST['email'], $_POST['password']);
            }   else {
                $name = User::createUserName();
                User::checkErrorsRegister($name, $_POST['email'], $_POST['password']);
            }
            
        }

        // if ($_POST['email']) {

        //     echo json_encode(array('success' => 1));
        // }   else {
        //     echo json_encode(array('success' => 2));
        // }
    }

    public function ActionFilterProducts()
    {
        // echo 'hi!';
        // print_r($_POST);
        if(!empty($_POST))  {
            $options = $_POST;
            $_SESSION['current_filters'] = $options;
            // if($options['page'] == 0)   {
            //     $options['page'] = 1;
            // }
            Product::getFilteredProducts($options);
        }   else {
            echo 'Ajax request doesnt work!';
        }
        
    }

    public function ActionUpdatePagination()
    {
        if(!empty($_POST))  {
            $options = $_POST;
            $query = Product::createQueryByOptions($options);
            
            $amountProducts = Product::getTotalAmountOfProducts($query);

            $_SERVER['REQUEST_URI'] = '/shop/';

            $pagination = new Pagination($amountProducts, 1, Product::AMOUNT_PRODUCTS_BY_DEFAULT, 'page-');
            echo $pagination->get();
        }   else {
            echo 'Ajax request doesnt work!';
        }
    }

}