<?php
//This script will update missing records in the movieinfo table where the release has a imdbID set
// credit goes to Tigggger
//Save this file as /testing/update_missing_movies.php
define('FS_ROOT', realpath(dirname(__FILE__)));
require_once(FS_ROOT."/../../www/config.php");
require_once(FS_ROOT."/../../www/lib/framework/db.php");
require_once(FS_ROOT."/../../www/lib/movie.php");

$movie = new Movie(true);

$db = new Db;
$count = 0;

$movies = $db->query("SELECT releases.imdbID FROM releases LEFT JOIN movieinfo ON releases.imdbID = movieinfo.imdbID WHERE releases.imdbID != '0000000' AND movieinfo.imdbID IS NULL");

foreach ($movies as $mov) {
        $mov = $movie->updateMovieInfo($mov['imdbID']);
        $count = $count+1;
        sleep(1);
}
echo "MovUpd : ".$count." IMDB records were updated\n";

?>
