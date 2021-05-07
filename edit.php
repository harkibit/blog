<?php 
include "header.php";
include "db.php";

if(isset($_GET['edit'])){
    $edit_id = $_GET['edit'];
}
if(isset($_POST['edit'])){
    $edited_title = $_POST['edited-title'];
    $edited_body = $_POST['edited-post'];
    $date = date("Y.m.d");

    $sqlie = "UPDATE `articles` SET `title`='$edited_title',`post`='$edited_body',`date`='$date' WHERE id = $edit_id";
    $run = mysqli_query($con, $sqlie);
    
    if(!$run){
        die("Failed");
    } else{
        header("Location:index.php?edit");
    }
}

?>

<div style = "margin : 0 50px;">
    <h1 class="uk-heading-small">Edit your post</h1>

    <form action= "" method="POST">

        <?php 
            $sql = "SELECT * FROM `articles` WHERE id = $edit_id";
            $text = mysqli_query($con, $sql);
            $data = mysqli_fetch_array($text);
        ?>
        <div class="uk-margin">
            <div class="uk-inline">
                <a class="uk-form-icon" href="#" uk-icon="icon: pencil"></a>
                <input 
                    name = "edited-title" 
                    class="uk-input" 
                    placeholder="Edited title" 
                    type="text" 
                    value = "<?php echo $data['title']; ?>"
                >
            </div>
        </div>
        <div class="uk-margin">
            <textarea 
                name = "edited-post" 
                class="uk-textarea" 
                rows="5" columns = "800" 
                placeholder="Edited post"
                value = "<?php echo $data['post']; ?>"
                >
            </textarea>
        </div>
        <button type = "submit" name = "edit" class="uk-button uk-width-1-1 uk-button-primary">Submit edit</button>
    </form>
</div>

<?php 
// header("Location:index.php");
