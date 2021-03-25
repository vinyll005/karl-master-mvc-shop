<?php include_once(ROOT.'/views/layouts/header.php'); ?>

<section class="top-discount-area d-md-flex align-items-center">
    <!-- Single Discount Area -->
    <div class="single-discount-area">
        <h5>Free Shipping &amp; Returns</h5>
        <h6><a href="#">BUY NOW</a></h6>
    </div>
    <!-- Single Discount Area -->
    <div class="single-discount-area">
        <h5>20% Discount for all dresses</h5>
        <h6>USE CODE: Colorlib</h6>
    </div>
    <!-- Single Discount Area -->
    <div class="single-discount-area">
        <h5>20% Discount for students</h5>
        <h6>USE CODE: Colorlib</h6>
    </div>
</section>

<?php foreach($products as $product)    { ?>
<!-- ****** Quick View Modal Area Start ****** -->
<div class="modal fade quickviews" id="quickview<?php echo $product['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

            <div class="modal-body">
                <div class="quickview_body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-5">
                                <div class="quickview_pro_img">
                                    <img src="<?php echo Product::getProductImage($product['id']); ?>">
                                </div>
                            </div>
                            <div class="col-12 col-lg-7">
                                <div class="quickview_pro_des">
                                    <h4 class="title"><?php echo $product['name'];?></h4>
                                    <h5 class="price">$<?php echo $product['finalPrice'];?> <span>$<?php if($product['discount'] != 0) echo $product['price']; ?></span></h5>
                                    <p><?php echo $product['description']; ?></p>
                                    <a href="/shop/<?php echo $product['id']; ?>">View Full Product Details</a>
                                </div>
                                <!-- Add to Cart Form -->
                                <form class="cart cart-form" method="post">
                                    <div class="quantity">
                                        <!-- <span class="qty-minus"
                                            onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i
                                                class="fa fa-minus" aria-hidden="true"></i></span>

                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="12"
                                            name="quantity" value="1">

                                        <span class="qty-plus"
                                            onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i
                                                class="fa fa-plus" aria-hidden="true"></i></span> -->
                                    </div>
                                    <input type='hidden' class='productId' value='<?php echo $product['id']; ?>'>
                                    <button type="submit" name="addtocart" value="5" class="cart-submit">Add to
                                        cart</button>
                                    <!-- Wishlist -->
                                    <!-- <div class="modal_pro_wishlist">
                                        <a href="wishlist.html" target="_blank"><i class="ti-heart"></i></a>
                                    </div> -->
                                    <!-- Compare -->
                                    <!-- <div class="modal_pro_compare">
                                        <a href="compare.html" target="_blank"><i class="ti-stats-up"></i></a>
                                    </div> -->
                                </form>

                                <!-- <div class="share_wf mt-30">
                                    <p>Share With Friend</p>
                                    <div class="_icon">
                                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ****** Quick View Modal Area End ****** -->
<?php } ?>

<section class="shop_grid_area section_padding_100">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3">
                <div class="shop_sidebar_area">

                    <div class="widget catagory mb-50">
                        <!--  Side Nav  -->
                        <div class="nav-side-menu">
                            <h6 class="mb-0">Catagories</h6>
                            <div class="menu-list">
                                <ul id="menu-content" class="menu-content collapse out">
                                    <!-- Single Item -->
                                    <?php foreach($categories as $category) { ?>
                                        <li class="collapsed">
                                        
                                        <label class='categoryButton'><input type='checkbox' class='common_selector category ' value='<?php echo $category['category'];?>'
                                         <?php  if(!empty($filters['category']))    {
                                          foreach($filters['category'] as $filter)   {
                                             if($filter == $category['category']) echo 'checked="checked"';
                                             }
                                            } ?>
                                            >
                                            <?php echo ucfirst($category['category']); ?> wear</label>
                                        
                                    </li>
                                        <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="widget price mb-50">
                        <h6 class="widget-title mb-30">Filter by Price</h6>
                        <div class="widget-desc">
                            <div class="slider-range">
                                <div data-min="1" data-max="3000" data-unit="$"
                                    class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                                    data-value-min="1" data-value-max="3000" data-label-result="Price:">
                                    <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    <input type='hidden' id='hidden_minimum_price' value='1'>
                                    <input type='hidden' id='hidden_maximum_price' value='3000'>
                                </div>
                                <div class="range-price">Price: 1 - 3000</div>
                            </div>
                        </div>
                    </div>

                    <div class="widget color mb-70">
                        <h6 class="widget-title mb-30">Filter by Color</h6>
                        <div class="widget-desc">
                            <ul class="d-flex justify-content-between">
                                <?php foreach($colors as $color) { ?>
                                    <li><label><input type='checkbox' class='common_selector color' 
                                    value='<?php echo $color['color']; ?>'
                                    <?php  if(!empty($filters['color']))    {
                                          foreach($filters['color'] as $filter)   {
                                             if($filter == $color['color']) echo 'checked="checked"';
                                             }
                                            } ?>
                                    >
                                    <?php echo $color['color']; ?></label></li>
                                <?php } ?>
                                <!-- <li class="gray"><a href="#"><span>(3)</span></a></li>
                                <li class="red"><a href="#"><span>(25)</span></a></li>
                                <li class="yellow"><a href="#"><span>(112)</span></a></li>
                                <li class="green"><a href="#"><span>(72)</span></a></li>
                                <li class="teal"><a href="#"><span>(9)</span></a></li>
                                <li class="cyan"><a href="#"><span>(29)</span></a></li> -->
                            </ul>
                        </div>
                    </div>

                    <div class="widget size mb-50">
                        <h6 class="widget-title mb-30">Filter by Size</h6>
                        <div class="widget-desc">
                            <ul class="d-flex justify-content-between">
                                <?php foreach($sizes as $size) { ?>
                                    <li><label><input type='checkbox' class='common_selector size' value='<?php echo $size['size']; ?>'
                                    <?php  if(!empty($filters['size']))    {
                                          foreach($filters['size'] as $filter)   {
                                             if($filter == $size['size']) echo 'checked="checked"';
                                             }
                                        } ?>
                                    >
                                    <?php echo $size['size']; ?></label></li>
                                <?php } ?>
                                <!-- <li><a href="#">XS</a></li>
                                <li><a href="#">S</a></li>
                                <li><a href="#">M</a></li>
                                <li><a href="#">L</a></li>
                                <li><a href="#">XL</a></li>
                                <li><a href="#">XXL</a></li> -->
                            </ul>
                        </div>
                    </div>

                    <div class="widget recommended">
                        <h6 class="widget-title mb-30">Recommended</h6>

                        <div class="widget-desc">
                            <!-- Single Recommended Product -->
                            <div class="single-recommended-product d-flex mb-30">
                                <div class="single-recommended-thumb mr-3">
                                    <img src="img/product-img/product-10.jpg" alt="">
                                </div>
                                <div class="single-recommended-desc">
                                    <h6>Men’s T-shirt</h6>
                                    <p>$ 39.99</p>
                                </div>
                            </div>
                            <!-- Single Recommended Product -->
                            <div class="single-recommended-product d-flex mb-30">
                                <div class="single-recommended-thumb mr-3">
                                    <img src="img/product-img/product-11.jpg" alt="">
                                </div>
                                <div class="single-recommended-desc">
                                    <h6>Blue mini top</h6>
                                    <p>$ 19.99</p>
                                </div>
                            </div>
                            <!-- Single Recommended Product -->
                            <div class="single-recommended-product d-flex">
                                <div class="single-recommended-thumb mr-3">
                                    <img src="img/product-img/product-12.jpg" alt="">
                                </div>
                                <div class="single-recommended-desc">
                                    <h6>Women’s T-shirt</h6>
                                    <p>$ 39.99</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8 col-lg-9">
                <div class="shop_grid_product_area">
                    <div class="row filter_data">

                      <?php foreach ($products as $product) { ?>
                        <div class="col-12 col-sm-6 col-lg-4 single_gallery_item wow fadeInUpBig" data-wow-delay="0.2s">
                            
                            <div class="product-img">
                                <img src='<?php echo Product::getProductImage($product['id']); ?>'>
                                <div class="product-quicview">
                                    <a href="#" data-toggle="modal" data-target="#quickview<?php echo $product['id']; ?>"><i class="ti-plus"></i></a>
                                </div>
                            </div>
                            
                            <div class="product-description">
                                <?php if(!empty($product['discount'])) { ?>
                                <h4 class="product-price" style='text-decoration:line-through;'>$<?php echo $product['price']; ?></h4>
                                <h4 class="product-price">$<?php echo $product['finalPrice']; ?></h4>
                                <?php } else { ?>
                                    <h4 class="product-price">$<?php echo $product['finalPrice']; ?></h4>
                                <?php } ?>
                                <p><?php echo $product['description']; ?></p>
                                
                                <!-- <a href="#" class="add-to-cart-btn">ADD TO CART</a> -->
                            </div>
                        </div>
                        <?php } ?> 
                    
                    </div>
                </div>
                
            <div class="updPagination">
                <?php echo $pagination->get();?>
            </div>
                <input type='hidden' id='pageNumber' value='<?php echo $page; ?>'>
            
                <!-- <div class="shop_pagination_area wow fadeInUp" data-wow-delay="1.1s">
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm">
                                    <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                    <li class="page-item"><a class="page-link" href="#">02</a></li>
                                    <li class="page-item"><a class="page-link" href="#">03</a></li>
                                </ul>
                            </nav>
                        </div> -->

            </div>
        </div>
    </div>
</section>

<?php include_once(ROOT.'/views/layouts/footer.php'); ?>