<?php
include_once 'dbconnect.php';
?>

<!DOCTYPE html>
<head>
    <title>Search results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<?php
        $query = $_GET['query'];
        // gets value sent over search form

        $query = htmlspecialchars($query);
        // changes characters used in html to their equivalents, for example: < to &gt;

        $raw_results = mysqli_query($db, "SELECT * FROM products
            WHERE (`title` LIKE '%".$query."%') OR (`tag1` LIKE '%".$query."%') OR (`tag2` LIKE '%".$query."%') OR (`tag3` LIKE '%".$query."%') OR (`tag4` LIKE '%".$query."%') OR (`tag5` LIKE '%".$query."%')") or die(mysqli_error());

        // * means that it selects all fields, you can also write: `id`, `title`, `text`

        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'

        if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following

            while($results = mysqli_fetch_array($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop

                echo "<p><h3>".$results['title']."</h3>".$results['description'].$results['tag1'].$results['tag2'].$results['tag3'].$results['tag4'].$results['tag5']."</p>";
                // posts results gotten from database(title and text) you can also show id ($results['id'])

            }

        }
        else{ // if there is no matching rows do following
            echo "No results";
        }

?>
</body>
</html>
