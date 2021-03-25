<?php include_once(ROOT.'/views/layouts/header.php'); ?>

<div class ='container'>
    <h2>Add product</h2>
    <form action='#' method='POST' enctype="multipart/form-data">

        <input type ='text' name='name' value='<?php echo $product['name'];?>' required>

        <input type ='text' name='price' value='<?php echo $product['price'];?>' required>

        <textarea rows='5' cols='117' name='description' style='padding:1%;' required><?php echo $product['description'];?></textarea>

        <select name='category'>
            <option value='man' <?php if($product['category'] == 'man') echo 'selected="selected"';?>>Man</option>
            <option value='woman' <?php if($product['category'] == 'woman') echo 'selected="selected"';?>>Woman</option>
            <option value='children' <?php if($product['category'] == 'children') echo 'selected="selected"';?>>Children</option>
        </select>

        <img src='<?php echo Product::getProductImage($product['id']); ?>'>
        <input type="file" name="image" placeholder="" value="">

        <select name='color'>
            <option value='green' <?php if($product['color'] == 'green') echo 'selected="selected"';?>>Green</option>
            <option value='gray' <?php if($product['color'] == 'gray') echo 'selected="selected"';?>>Gray</option>
            <option value='red' <?php if($product['color'] == 'red') echo 'selected="selected"';?>>Red</option>
            <option value='blue' <?php if($product['color'] == 'blue') echo 'selected="selected"';?>>Blue</option>
            <option value='white' <?php if($product['color'] == 'white') echo 'selected="selected"';?>>White</option>
            <option value='black' <?php if($product['color'] == 'black') echo 'selected="selected"';?>>Black</option>
            <option value='violet' <?php if($product['color'] == 'violet') echo 'selected="selected"';?>>Violet</option>
            <option value='yellow' <?php if($product['color'] == 'yellow') echo 'selected="selected"';?>>Yellow</option>
        </select>

        <select name='size'>
            <option value='xs' <?php if($product['size'] == 'xs') echo 'selected="selected"';?>>XS</option>
            <option value='s' <?php if($product['size'] == 's') echo 'selected="selected"';?>>S</option>
            <option value='m' <?php if($product['size'] == 'm') echo 'selected="selected"';?>>M</option>
            <option value='l' <?php if($product['size'] == 'l') echo 'selected="selected"';?>>L</option>
            <option value='xl' <?php if($product['size'] == 'xl') echo 'selected="selected"';?>>XL</option>
            <option value='xxl' <?php if($product['size'] == 'xxl') echo 'selected="selected"';?>>XXL</option>
        </select>

        <input type ='text' name='discount' value='<?php echo $product['discount'];?>'>

        <input type='submit' class='login-button' name='submit' value='Update product'>
    </form>
</div>

<?php include_once(ROOT.'/views/layouts/footer.php'); ?>