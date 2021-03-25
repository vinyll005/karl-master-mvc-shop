<?php include_once(ROOT.'/views/layouts/header.php'); ?>

<div class='container admin-menu'>
<ul>
    <li><a href='/admin/products/addProduct' class='color-on-hover'>Add new product</a></li>
    <li style='margin-top:2%;'><a href='/admin' class='color-on-hover' >Go back to admin</a></li>
</ul>
</div>

<table class="table adminProduct-table">
  <thead class="thead-dark">
    <tr>
      <th scope="col"><a href='/admin/products/id/<?php echo $sort_order;?><?php echo '/page-'.$page;?>'>id</a></th>
      <th scope="col"><a href='/admin/products/name/<?php echo $sort_order;?><?php echo '/page-'.$page;?>'>Name</a></th>
      <th scope="col"><a href='/admin/products/category/<?php echo $sort_order;?><?php echo '/page-'.$page;?>'>Category</a></th>
      <th scope="col"><a href='/admin/products/description/<?php echo $sort_order;?><?php echo '/page-'.$page;?>'>Description</a></th>
      <th scope="col"><a href='/admin/products/color/<?php echo $sort_order;?><?php echo '/page-'.$page;?>'>Color</a></th>
      <th scope="col"><a href='/admin/products/size/<?php echo $sort_order;?><?php echo '/page-'.$page;?>'>Size</a></th>
      <th scope="col"><a href='/admin/products/price/<?php echo $sort_order;?><?php echo '/page-'.$page;?>'>Price</a></th>
      <th scope="col"><a href='/admin/products/discount/<?php echo $sort_order;?><?php echo '/page-'.$page;?>'>Discount</a></th>
      <th scope="col"><a href='/admin/products/finalprice/<?php echo $sort_order;?><?php echo '/page-'.$page;?>'>Final price</a></th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
      <?php foreach ($products as $product) { ?>

        <tr>
            <th scope="row"><?php echo $product['id']; ?></th>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['category']; ?></td>
            <td><?php echo $product['description']; ?></td>
            <th scope="row"><?php echo $product['color']; ?></th>
            <td><?php echo $product['size']; ?></td>
            <td><?php echo $product['price']; ?></td>
            <td><?php echo $product['discount']; ?></td>
            <td><?php echo $product['finalPrice']; ?></td>
            <td><a href='/admin/products/update/<?php echo $product['id'];?>' class='color-on-hover'>Update</a></td>
            <td><a href='/admin/products/delete/<?php echo $product['id'];?>' class='color-on-hover'>Delete</a></td>
        </tr>

      <?php } ?>
  </tbody>
</table>

      <!-- Pagination -->
      <!-- <div class="pagination flex-m flex-w p-t-26"> -->
                    <!-- <a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>
                    <a href="#" class="item-pagination flex-c-m trans-0-4">2</a> -->
                    <?php echo $pagination->get();?>
                <!-- </div> -->

<?php include_once(ROOT.'/views/layouts/footer.php'); ?>