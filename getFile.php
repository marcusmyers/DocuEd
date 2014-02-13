<?php

$data = file_get_contents("./nhs_interims_gp3/txts/nhs_interims_gp3_100.txt");

$convert = explode("\n", $data);

var_dump($convert);
