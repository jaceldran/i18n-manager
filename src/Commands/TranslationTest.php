<?php

use App\Models\Translation;

require './boot/app.php';

// $data = Translation::all();
// print_r($data);

$data['export'] = Translation::export();



print_r ($data);