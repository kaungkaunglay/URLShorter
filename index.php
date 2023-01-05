<?php require "config.php"; ?>
<?php
    $select = $conn->query("SELECT * FROM urls");
    $select->execute();
    $rows = $select->fetchAll(PDO::FETCH_OBJ);

    if(isset($_POST['submit'])){
        if(isset($_POST['url']) == ''){
            echo "The input is empty";
        }else{
            $url = trim($_POST['url']);
            if(filter_var($url,FILTER_VALIDATE_URL)){

                $insert = $conn->prepare("INSERT INTO urls(url) VALUES (:url)");
                $insert->execute([
                    ":url" => $url
                ]);
            }else{
                echo "<script>alert('Invalid URL is not allowed here')</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body {overflow: hidden;}

        .margin {
            margin-top: 200px
        }
    </style>
</head>
<body>

<div class="conatiner">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <form action="index.php" method="post" class="card p-2 margin">
                <div class="input-group">
                    <input name="url" type="text" class="form-control" placeholder="your url">
                    <div class="input-group-append">
                        <button name="submit" type="submit" class="btn btn-success">Shorten</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="conatiner" id="refresh">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <table class="table mt-4">
                <thead>
                <tr>
                    <th scope="col">Urls</th>
                    <th scope="col">Short URL</th>
                    <th scope="col">Clicks</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($rows as $row):
                ?>
                <tr>
                    <th scope="row"><?php echo $row->url; ?></th>
                    <td><a target="_blank" href="<?php echo HOME ?>/u/index.php?id=<?php echo $row->id; ?>"><?php echo HOME ?>/<?php echo $row->id; ?></a></td>
                    <td><?php echo $row->clicks; ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" ></script>
<!-- Core theme JS-->
<script>
    $(document).ready(function(){
        $("#refresh").click(function(){
            setInterval(function(){
                $("body").load("index.php")
            },5000);
        })
    })
</script>
</body>
</html>


