
<?php

$url = 'http://web/feeds/cines.rss'; 
$rss = simplexml_load_file($url);

$arraypeliculas = array();
$count = 0;

foreach ($rss->channel->item as $item) {
  //  $arraypeliculas['titles'][$count]             = $item->title;

    $posicion_inicial_1er_h1                      = strpos($item->description, '<h1>');
    $posicion_final_1er_h1                        = strpos($item->description, '</h1>');

 //   print "<br> posicion inicial = ".$posicion_inicial_1er_h1;
 //   print "<br> posicion final = ".$posicion_final_1er_h1;
 //   print "<br> result = ".substr($arraypeliculas['description'][$count],$posicion_inicial_1er_h1,$posicion_final_1er_h1);

    $arraypeliculas['descriptionf'][$count]        = substr($item->description,$posicion_final_1er_h1);

    $arraypeliculas['descriptionf'][$count]        = str_replace('h1', 'h3', $arraypeliculas['descriptionf'][$count]);
    $arraypeliculas['descriptionf'][$count]        = str_replace('Horarios', 'Horarios en cines '.$item->title, $arraypeliculas['descriptionf'][$count]);
    $arraypeliculas['descriptionf'][$count]        = str_replace('Sinopsis', 'Sinopsis de la película '.$item->title, $arraypeliculas['descriptionf'][$count]);
    $arraypeliculas['descriptionf'][$count]        = str_replace('Trailer', 'Trailer de la película '.$item->title, $arraypeliculas['descriptionf'][$count]);
    $arraypeliculas['descriptionf'][$count]        = str_replace('Detalles', 'Detalles de la película '.$item->title, $arraypeliculas['descriptionf'][$count]);
    $arraypeliculas['descriptionf'][$count]        = str_replace('src="/images/', 'src="http://cines.com.py/images/', $arraypeliculas['descriptionf'][$count]);
    $posicion                                     = strpos($arraypeliculas['descriptionf'][$count], 'https://www.youtube.com/watch?v=');
    $video_youtube                                = parseyoutubevid(substr($arraypeliculas['descriptionf'][$count],$posicion,43));

    
	
	
	$arraypeliculas['descriptionf'][$count]		  = str_replace(substr($arraypeliculas['descriptionf'][$count],$posicion,43),$video_youtube,$arraypeliculas['descriptionf'][$count]);

    $arraypeliculas['video_youtube'][$count]      = $video_youtube;

	print "<h2>Película ".$item->title."</h2>";
	print $arraypeliculas['descriptionf'][$count];

    $count++;
}





?>