<?php
    include "topbit.php";

// if find button pushed...
if(isset($_POST['find_rating']))
    
{

$amount = test_input(mysqli_real_escape_string($dbconnect, $_POST['amount']));
$stars = test_input(mysqli_real_escape_string($dbconnect, $_POST['stars']));
    
if ($amount=="exactly")
{
    $find_sql="SELECT *
FROM `91879_book_reviews`
WHERE `Rating` = $stars
LIMIT 0 , 30";  
}
  
elseif ($amount == "less")
    
{
    $find_sql="SELECT *
FROM `91879_book_reviews`
WHERE `Rating` <= $stars
LIMIT 0 , 30"; 
}
    
else
{
    $find_sql="SELECT *
FROM `91879_book_reviews`
WHERE `Rating` >= $stars
LIMIT 0 , 30"; 
}
    
$find_query=mysqli_query($dbconnect, $find_sql);
$find_rs=mysqli_fetch_assoc($find_query);
$count=mysqli_num_rows($find_query);

?>
        <div class="box main">
            <h2>Rating Search</h2>
          <?php
            
            // check if there are any results
            
            if ($count < 1) 
            {
            ?>
            <div class="error">
            Sorry! There are no results that match your search. Please use the search box in the sidebar to try again.
            </div>
            
            <?php
            } // end count 'if'
            
            
            // if there are no results, output an error
            else
            {
                do {
                ?>
                <!-- Results go here -->
            <div class="results">
            
                <p>Title: <span class="sub_heading"><?php echo $find_rs['Title']; ?></span></p>
                
                <p>Author: <span class="sub_heading"><?php echo $find_rs['Author']; ?></span></p>
                
                <p>Genre: <span class="sub_heading"><?php echo $find_rs['Genre']; ?></span></p>
                
                <p>Rating: <span class="sub_heading">
                    
                    <?php 
                    for($x=0; $x < $find_rs['Rating']; $x++)
                        
                    {
                       echo "&#9733"; 
                    }
                    
                    ?>
                    
                    </span></p>
                
                <p>
                Review / Response:
                </p>
                
                <p><span class="sub_heading"><?php echo $find_rs['Review']; ?></span></p>
                
            </div> <!-- / end results div -->
            <br />
                
                
                 <?php   
                } // end of 'do'
                while($find_rs=mysqli_fetch_assoc($find_query));
                
            } //end else
    
            // if there are results display them
}  //end isset
            ?>
            </div>
            
        
<?php
    include "bottombit.php";
?>
