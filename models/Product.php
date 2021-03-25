<?php

class Product
{

    const AMOUNT_PRODUCTS_BY_DEFAULT = 9;

    public static function createProduct($options)
    {
        $db = Db::getDbConn();

        $request = $db->prepare("INSERT INTO products(name, category, description, color, size, price, discount, finalPrice) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $request->bind_param('sssssiii', $options['name'], $options['category'], $options['description'], $options['color'], $options['size'], $options['price'], $options['discount'], $options['finalPrice']);
        $request->execute();

        // if($request->execute()) {
        //     return Product::takeLastId();
        // }
        // return false;
    }

    public static function takeLastId()
    {
        $db = Db::getDbConn();

        $request = $db->query("SELECT * FROM products ORDER BY id desc LIMIT 1");

        $row = $request->fetch_assoc();
        return $row['id'];
    }

    public static function getProducts($column = 'id', $sort_order = 'asc', $page)
    {
        $db = Db::getDbConn();

        $count = self::AMOUNT_PRODUCTS_BY_DEFAULT;
        $offset = ($page - 1) * $count;

        $request = $db->query("SELECT * FROM products ORDER BY ".$column." ".$sort_order." LIMIT ".$count." OFFSET ".$offset);

        $products = array();
        $i = 0;
        while($row = $request->fetch_assoc())  {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['category'] = $row['category'];
            $products[$i]['description'] = $row['description'];
            $products[$i]['color'] = $row['color'];
            $products[$i]['size'] = $row['size'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['discount'] = $row['discount'];
            $products[$i]['finalPrice'] = $row['finalPrice'];
            $i++;
        }

        return $products;
    }

    public static function getTotalAmountOfProducts($query = "SELECT * FROM products")
    {
        $db = Db::getDbConn();

        $request = $db->query($query);
        $count = 0;
        while($row = $request->fetch_assoc())   {
            $count++;
        }
        // echo $count;
        // $count = count($request->fetch_assoc());
        // print_r($request->fetch_assoc());
        return $count;
    }

    public static function getProductById($id)
    {
        $db = Db::getDbConn();

        $request = $db->prepare("SELECT * FROM products WHERE id = ?");
        $request->bind_param('s', $id);
        $request->execute();

        $result = $request->get_result();

        return $result->fetch_assoc();
    }

    public static function getProductImage($id)
    {
        $file = '/img/product-img/product-'.$id.'.jpg';

        if(file_exists($_SERVER['DOCUMENT_ROOT'].$file)) {
            return $file;
        }
        return false;
    }

    public static function updateProduct($options)
    {
        $db = Db::getDbConn();

        $request = $db->prepare("UPDATE products SET name = ?, category = ?, description = ?, color = ?, size = ?, price = ?, discount = ?, finalPrice = ? WHERE id=?");
        $request->bind_param('sssssiiii', $options['name'], $options['category'], $options['description'], $options['color'], $options['size'], $options['price'], $options['discount'], $options['finalPrice'], $options['id']);
        $request->execute();
    }

    public static function deleteProduct($id)
    {
        $db = Db::getDbConn();

        $request = $db->prepare("DELETE FROM products WHERE id=?");
        $request->bind_param('i', $id);
        $request->execute();
    }

    public static function selectProductsFilter($filter)
    {
        $db = Db::getDbConn();

        $request = $db->prepare("SELECT DISTINCT(".$filter.") FROM products ORDER BY ".$filter." desc");
        $request->execute();

        $result = $request->get_result();

        $res = array();
        $i = 0;
        while($row = $result->fetch_assoc())    {
            $res[$i][$filter] = $row[$filter];
            $i++;
        }
        return $res;
    }

    public static function createQueryByOptions($options)
    {
        $query = "SELECT * FROM products WHERE id > 0";

        if(isset($options['minimum_price'], $options['maximum_price']) && !empty($options['minimum_price']) && !empty($options['maximum_price']))  {
            $query .= " AND finalPrice BETWEEN ".$options['minimum_price']." AND ".$options['maximum_price'];
        }

        if(!empty($options['category']))    {
            $category = implode('","', $options['category']);
            $query .= " AND category IN (\"".$category."\")";
        }

        if(!empty($options['color']))    {
            $color = implode('","', $options['color']);
            $query .= " AND color IN (\"".$color."\")";
        }

        if(!empty($options['size']))    {
            $size = implode('","', $options['size']);
            $query .= " AND size IN (\"".$size."\")";
        }

        return $query;
    }

    public static function getFilteredProducts($options)
    {
        $db = Db::getDbConn();

        $count = self::AMOUNT_PRODUCTS_BY_DEFAULT;
        // $offset = ($options['page'] - 1) * $count;

        $query = Product::createQueryByOptions($options);

        $_SESSION['current_filters']['query'] = $query;

        if(Product::getTotalAmountOfProducts($query) > $count)   {
            $query .= " LIMIT ".$count." OFFSET 0";
        }

        // $query .= " LIMIT ".$count." OFFSET ".$offset;

        $request = $db->query($query);
        $output = '';
        // $_SESSION['current_filters']['amountProducts'] = count($request->fetch_assoc());
        while($row = $request->fetch_assoc())   {
            // print_r($row);

            $output .= '
                <div class="col-12 col-sm-6 col-lg-4 single_gallery_item wow fadeInUpBig" data-wow-delay="0.2s">

                    <div class="product-img">
                        <img src='. Product::getProductImage($row['id']) .'>
                        <div class="product-quicview">
                            <a href="#" data-toggle="modal" data-target="#quickview'.$row['id'].'"><i class="ti-plus"></i></a>
                        </div>
                    </div>
                    
                    <div class="product-description">
                        <h4 class="product-price">$'.$row['price'].'</h4>
                        <p>'.$row['description'].'</p>
                        
                    </div>
                </div>
                ';
        }

        echo $output;
    }

    public static function getProductsByQuery($page, $query)
    {
        $db = Db::getDbConn();

        $count = self::AMOUNT_PRODUCTS_BY_DEFAULT;
        $offset = ($page - 1) * $count;
        $pageFilter = " LIMIT ".$count." OFFSET ".$offset;

        // $testQuery = $query;
        // $testQuery .= $pageFilter;

        // while(Product::getTotalAmountOfProducts($testQuery) == 0)   {
        //     $offset = ($page - 1) * $count;
        //     $testQuery = $query;
        //     $testQuery .= $pageFilter;
        //     $page--;
        // }

        $query .= $pageFilter;

        $request = $db->query("$query");

        $products = array();
        $i = 0;
        while($row = $request->fetch_assoc())  {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['category'] = $row['category'];
            $products[$i]['description'] = $row['description'];
            $products[$i]['color'] = $row['color'];
            $products[$i]['size'] = $row['size'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['discount'] = $row['discount'];
            $products[$i]['finalPrice'] = $row['finalPrice'];
            $i++;
        }

        return $products;
        
    }
}