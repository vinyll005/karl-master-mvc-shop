<?php include_once(ROOT.'/views/layouts/header.php'); ?>

<div class ='container'>
    <h2>Add product</h2>
    <form action='#' method='POST' enctype="multipart/form-data">

        <input type ='text' name='name' placeholder='Product name' required>

        <input type ='text' name='price' placeholder='Product price' required>

        <textarea rows='5' cols='117' name='description' placeholder="Product description" style='padding:1%;' required></textarea>

        <select name='category'>
            <option value='man'>Man</option>
            <option value='woman'>Woman</option>
            <option value='children'>Children</option>
        </select>

        <input type="file" name="image" placeholder="" value="" required>

        <select name='color'>
            <option value='green'>Green</option>
            <option value='gray'>Gray</option>
            <option value='red'>Red</option>
            <option value='blue'>Blue</option>
            <option value='white'>White</option>
            <option value='Black'>Black</option>
            <option value='violet'>Violet</option>
            <option value='Yellow'>Yellow</option>
        </select>

        <select name='size'>
            <option value='xs'>XS</option>
            <option value='s'>S</option>
            <option value='m'>M</option>
            <option value='l'>L</option>
            <option value='xl'>XL</option>
            <option value='xxl'>XXL</option>
        </select>

        <input type ='text' name='discount' placeholder='Product discount (%)'>

        <input type='submit' class='login-button' name='submit' value='Add product'>
    </form>
</div>

<?php include_once(ROOT.'/views/layouts/footer.php'); ?>