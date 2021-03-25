<?php

    return array(
        '' => 'home/index',
        'register' => 'home/register',
        'login' => 'home/login',
        'test' => 'home/test',
        'exit' => 'home/exit',

        'shop' => 'shop/index',
        'shop/page-([1-9]+)' => 'shop/index/$1',
        'shop/([1-9]+)' => 'shop/viewProduct/$1',
    
        // Ajax Queries
        'ajax/checkLoginForm' => 'ajax/CheckLoginForm',
        'ajax/checkRegisterForm' => 'ajax/CheckRegisterForm',
        'ajax/filterProducts' => 'ajax/FilterProducts',
        'ajax/updatePagination' => 'ajax/updatePagination',
    
        // Admin 
        'admin' => 'admin/index',
        'admin/products' => 'adminProducts/index',
        'admin/products/([a-z]+)/([a-z]+)' => 'adminProducts/index/$1/$2',
        'admin/products/page-([1-9]+)' => 'adminProducts/index/id/asc/$1',
        'admin/products/([a-z]+)/([a-z]+)/page-([1-9]+)' => 'adminProducts/index/$1/$2/$3',
        'admin/products/addProduct' => 'adminProducts/addProduct',
        'admin/products/update/([0-9]+)' => 'adminProducts/updateProduct/$1',
        'admin/products/delete/([0-9]+)' => 'adminProducts/deleteProduct/$1');