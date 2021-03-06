<?php
    $backgroundImage = "img/sea.jpg"; 
    
    if(isset($_GET['keyword'])){
        
        include 'api/pixabayAPI.php';
        $keyword = $_GET['keyword'];
        
        if (!empty($_GET['category'])) {  //User selected a category
             
            $keyword = $_GET['category'];
        }
        if (isset($_GET['layout'])) {
            
            $imageURLs = getImageURLs($keyword, $_GET['layout']);
        } else {
            $imageURLs = getImageURLs($keyword);
        }
        $backgroundImage = $imageURLs[array_rand($imageURLs)]; 
    }
?> 
<!DOCTYPE html>
<html>
    <head>
        <title>Image Carousel</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <style>
            @import url("css/styles.css"); 
            body{
                background-image: url('<?=$backgroundImage ?>');
            }
        </style>
    </head>
    <body>
        <br /><br />
        <form>
            <input type="text" name="keyword" placeholder="keyword" value="<?=$_GET['keyword']?>"/>
            <input type = "radio" id = "lhorizontal" name = "layout" value = "horizontal">
            <label for = "Horizontal"></label><label for="lhorizontal"> Horizontal </label>
            <input type = "radio" id = "lvertical" name = "layout" value = "vertical">
            <?php
                if ($_GET['layout']=="vertical") {
                    echo "checked";
                }

             ?>
            
            <label for = "Vertical"></label><label for="lvertical"> Vertical </label>
            <select name = "category">
                <option value ="">Select One</option>
                <option value="ocean">Sea</option>
                <option>Forest</option>
                <option>Mountain</option>
                <option>Snow</option>
            </select>
            <br>
            <input type="submit" value="Search"/>
                                    <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </form>

        <br /><br />
        <?php
                if(!isset($imageURLs)){
                    echo "<h2> Type a keyword to display a slideshow <br/> with random images from Pixabay.com </h2>"; 
                } else { //form was submitted
                    //print_r($imageURLS); // checking that $
        ?> 
        
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators Here -->
            <ol class="carousel-indicators">
                <?php
                    for($i = 0; $i < 7; $i++) {
                        echo "<li data-target='#carousel-example-generic' data-slide-to='$i'";
                        echo ($i == 0) ? "class='active'" : "";
                        echo "></li>";
                    }
                ?>
            </ol>

            <div class ="carousel-inner" role="listbox">
                <?php
                    // Display Carousel Here
                    for($i =0; $i<7; $i++){
                        do{
                            $randomIndex = rand(0,count($imageURLs));
                        }
                        while(!isset($imageURLs[$randomIndex]));
                        
                        echo '<div class="item ';
                        echo ($i == 0)?"active": "";
                        echo '">'; 
                        echo "<img src='" . $imageURLs[rand(0,count($imageURLs))] . '">'; 
                        echo '</div>'; 
                        unset($imageURLs[$randomIndex]); 
                    }
                ?>
            </div>

        </div>
        <?php
            } // End of the else statement  
        ?>
        <br> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>