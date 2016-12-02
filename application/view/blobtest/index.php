<div id="wrapper" class="home">
    <h3>UPLOAD IMAGE TEST</h3>
    <form action="<?php echo URL; ?>blobtest/handle_blob" method="POST" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="image" id="image">
        <input type="submit" value="submit" name="submit">

    </form>
</div>
