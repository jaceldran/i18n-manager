<?php

use App\Models\Translation;

require_once './boot/app.php';

$data['translations'] = Translation::all();
$data['export'] = Translation::export();

print_r($data);
