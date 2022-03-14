<?php
include 'header.php';
?>

<link rel="stylesheet" href="css/search.css">

    <form class="search-bar" action="" method="POST" autocomplete="off">
    <input type="text" class="form-control" id="search" name="keyword" placeholder="Search for doctor info" required>
    <input type="submit" class="btn btn-primary" name="search" value="Go">
    </form>
    <div class="search-result">
    </div>
    <div class="list">

<?php

$keyword = '';
if(isset($_POST['search']))
{
    $keyword = $_POST['keyword'];

    //$sql = "SELECT * FROM doctor WHERE MATCH(name,email,qualification,specialty) AGAINST('$keyword')";
    $sql = "SELECT * FROM doctor WHERE name LIKE '%$keyword%' OR email LIKE '%$keyword%' OR
            qualification LIKE '%$keyword%' OR specialty LIKE '%$keyword%'";
    $result = mysqli_query($connDB,$sql);
    function formatTime($time){
        $date = new DateTime("2020-09-27 ".$time);
        return $date->format('h:ia') ;
    }
    while($row = $result->fetch_assoc()) {
        $startTime = formatTime($row['startTime']);
        $endTime = formatTime($row['endTime']);

?>
        <form class="profile" name="profile" action="appointment.php" method="POST">
            <input type="text" name="id" value="<?= $row['id']; ?>" hidden>        
            <span><strong><?= $row['name']; ?></strong></span>
            <span><?= $row['qualification']; ?></span>
            <span><?= $row['specialty']; ?></span>
            <span>Email: <?= $row['email']; ?></span>
            <span>Visiting hour: <?= $startTime."-".$endTime; ?></span>
            <span><input type="submit" class="btn btn-outline-light mt-2" value="Appointment" name="fixedDoctor"></span>
        </form>
<?php
    }
}
?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="js/search.js"></script>
<script>
    var keyword = '<?php echo $keyword; ?>';
    if (keyword.length > 2) {
        keyword = keyword.toUpperCase();
        var data = document.querySelectorAll('span');
        data = Array.from(data);
        data.forEach(cur => {
            var text = cur.textContent;
            var index = text.toUpperCase().indexOf(keyword);
            if (index >= 0) {
                text = text.substring(0, index) + "<mark>" +
                    text.substring(index, index + keyword.length) + "</mark>" +
                    text.substring(index + keyword.length);
                cur.innerHTML = text;
            }
        });
    }

</script>