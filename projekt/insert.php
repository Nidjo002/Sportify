<?php
include 'connect.php';
if(isset($_POST['submit'])) {
$picture = $_FILES['pphoto']['name'];
$title=$_POST['title'];
$about=$_POST['about'];
$content=$_POST['content'];
$category=$_POST['category'];
$date= date('d.m.Y.');
if(isset($_POST['archive'])){
 $archive=1;
}else{
 $archive=0;
}
$target_dir = 'images/'.$picture;
move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);
$query = "INSERT INTO vijesti (datum,naslov, sazetak, tekst, slika, kategorija,
arhiva ) VALUES ('$date','$title', '$about', '$content', '$picture',
'$category', '$archive')";
$result = mysqli_query($dbc, $query) or die('Error querying databese.');
mysqli_close($dbc);
header("Location: skripta.php?title=" . urlencode($title) . "&about=" . urlencode($about) . "&content=" . urlencode($content) . "&image=" . urlencode($picture) .  "&date=" . urlencode($date));
exit();

}
?>