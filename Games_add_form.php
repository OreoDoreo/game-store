<?php 
    include ('header.php');
    require ('DB_connection.php');

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
      
    
    <style>
        
        .bold-txt{
            font-weight: bold;
        }

    </style>

</head>

<body> 
    
    <!-- Background Image -->
    <div style="background-image: url(img/4848691.jpg);">
    
    <div class="row pt-5 pb-3 justify-content center" style="align-items: center;">
        
                <!-- Add Game Form -->
        <div class="col-lg-12" style="align-items: center;">
            <div class="container" style="border:#000 solid; width: 700px; height: 850px; background: #252525b8;">
               
                <div class="contact-form p-3">
                    <div class="title text-center mb-3 pt-4 text-white">
                        <h3 class="font-weight bolder">Add Game</h3>
                    </div>
                    <form action="Games_manager_backend.php" class="m-auto bold-txt text-white" method="post" enctype="multipart/form-data">
                        
                        <div class="form-group pt-5">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" required>
                        </div>

                        <div class="form-group pt-5">
                             <label class="my-1 mr-2" for="category">Category </label>
                             <select class="custom-select my-1 mr-sm-2" id="category" name="category">
                             <option selected>Choose...</option>
                             <!-- shows the category that are available in the categry list -->
                             <?php
                                $sql= 'SELECT * FROM category WHERE active = "true";';
                                $result = mysqli_query($connected, $sql); 

                                while ($category = mysqli_fetch_array($result)) {?>
                             <option value="<?php echo $category['title']; ?>"><?php echo " $category[title] "; ?></option>
                             <?php } ?>
                        </select>
                        </div> 


                        <div class="form-group pt-5">
                            <label for="image">Enter Image</label>
                             <input type="file" class="form-control-file" id="image" name="image">
                        </div>

                        <div class="form-group pt-5">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>

                        <div class="form-group pt-5">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" name="price" id="price" min="0" required>
                        </div>

                        <div class="form-group pt-5 m-2">
                            <label for="location">Active </label>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="active" id="active1" value="true">
                              <label class="form-check-label" for="active1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="active" id="active2" value="false">
                              <label class="form-check-label" for="active2">No</label>
                            </div>
                        </div>

                        <div class="form-group pt-3 m-2">
                            <label for="location">Exclusive </label>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="exclusive" id="exclusive1" value="true">
                              <label class="form-check-label" for="exclusive1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="exclusive" id="exclusive2" value="false">
                              <label class="form-check-label" for="exclusive2">No</label>
                            </div>
                        </div>
            
                </div>

                        <div class="form-group text-center pt-5 bold-txt">
                            <button type="submit" name="add" class="frm-btn btn btn-warning text-center"> Confirm </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
    
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<!-- Footer Added -->
<?php 
    include ('footer.php');
 ?>

</body>
</html>