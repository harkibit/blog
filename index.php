<?php
include "db.php";

$query = "SELECT * FROM `articles`";
$res = mysqli_query($con, $query);

// add post
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $title = $_POST['title'];
    $post = $_POST['post'];
    $date = date("Y.m.d");

    $sql = "INSERT INTO `articles`(`title`, `post`, `date`) VALUES ('$title', '$post', '$date')";
    $added = mysqli_query($con, $sql);

    if(!$added){
        die("Failed");
    } else{
        header("Location:index.php");
    }
}

// remove post
if(isset($_GET['deleted'])){
    $delete = $_GET['deleted'];
    $sqli = "DELETE FROM `articles` WHERE id = $delete";
    $deleted = mysqli_query($con, $sqli);

    if(!$deleted){
        die("Failed");
    } else{
        header("Location:index.php");
    }
}


include "header.php";
?>

<body>
    <div style = "margin : 0 50px;">
        <h1 class="uk-heading-small">Create a post</h1>

        <form action= "<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="uk-margin">
                <div class="uk-inline">
                    <a class="uk-form-icon" href="#" uk-icon="icon: pencil"></a>
                    <input name = "title" class="uk-input" placeholder="Title" type="text">
                </div>
            </div>
            <div class="uk-margin">
                <textarea name = "post" class="uk-textarea" rows="5" columns = "800" placeholder="Post body"></textarea>
            </div>
            <button type = "submit" name = "add" class="uk-button uk-width-1-1 uk-button-primary">Post article</button>
        </form>
    </div>

    <!-- post card -->

    <div class="uk-child-width-expand@s" uk-grid>

        <?php 
            // $dataArray = array();
            while($row = mysqli_fetch_assoc($res)){
                $id =  $row["id"];
                $title = $row["title"];
                $post = $row["post"];
                $date = $row["date"];

                // $dataArray[] = array(
                //     "id" => $row["id"],
                //     "title" => $row["title"],
                //     "post" => $row["post"],
                //     "date" => $row["date"]
                // );
        ?>
        <div class="uk-card uk-card-hover uk-width-1-3@m" style = "margin : 100px auto">
            <div class="uk-card-header">
                <div class="uk-grid-small uk-flex-middle" uk-grid>
                    <div class="uk-width-expand">
                        <h3 class="uk-card-title uk-margin-remove-bottom">
                            <?php echo $title; ?>
                        </h3>
                        <p class="uk-text-meta uk-margin-remove-top">
                            <time datetime="2016-04-01T19:00">
                                <?php echo $date; ?>
                            </time>
                        </p>
                    </div>
                </div>
            </div>
            <div class="uk-card-body">
                <p>
                    <?php echo $post; ?>
                </p>
            </div>
            <div class="uk-card-footer" style = "display: flex; justify-content : space-between;">
                <a href = "edit.php?edit=<?php echo $id; ?>"> 
                    <button class="uk-button uk-button-default">
                            Update 
                    </button>
                </a>
                <a href = "index.php?deleted=<?php echo $id; ?>"> 
                    <button class="uk-button uk-button-danger">Delete</button>
                </a>
            </div>
        </div>

        <?php 
            }
        ?>

        
    </div>
</body>
</html>