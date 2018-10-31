<?php

require_once 'lib/common.php';

// Connect to the database, run a query, handle errors
$pdo = getPDO();
$stmt = $pdo->query(
    'SELECT
        id, title, created_at, body
    FROM 
        post
    ORDER BY
        created_at DESC'
);
if ($stmt === false)
{
    throw new Exception('There was a problem running this query');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Blog</title>
    <!--build:css css/main.min.css -->
    <link rel="stylesheet" href="css/custom.css">
    <!-- endbuild -->

    <!--build:js js/main.min.js -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <!-- endbuild -->
    </head>
    <body>
        <?php require 'templates/title.php' ?>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <h2>
                <?php echo htmlEscape($row['title']) ?>
            </h2>
            <div>
                <?php echo $row['created_at'] ?>
            </div>
            <p>
                <?php echo htmlEscape($row['body']) ?>
            </p>
            <p>
                <a href="view-post.php?post_id=<?php echo $row['id'] ?>">Read more...</a>
            </p>
        <?php endwhile ?>
    </body>
</html>