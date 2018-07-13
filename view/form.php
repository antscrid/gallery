<!DOCTYPE html>
<html>
<head>
    <title>Form</title>
    <link rel="stylesheet" href="pub/css/bootstrap.css">
    <link rel="stylesheet" href="pub/css/main.css">
</head>
<body>
<div>
    <div class="container">
        <div class="jumbotron">
            <h1>Upload the image</h1>
            <p>Choose the image and add the information about it</p>
        </div>
        <div>
            <a class="btn btn-dark" href="/">Go home</a><p>
        </div>
        <?php if ($errors): ?>
            <div class="alert alert-danger">
                <strong>Error:&nbsp;</strong><?php echo $errors ?>
            </div>
        <?php endif; ?>
        <form action="/process" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="authorname">Author Name</label>
                <input type="text" class="form-control" id="authorname" name="authorname">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Select Image</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>