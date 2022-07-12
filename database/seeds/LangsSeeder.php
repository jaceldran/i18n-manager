<?php

use Phinx\Seed\AbstractSeed;

class LangsSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            ['id' => 'de', 'active' => false],
            ['id' => 'en', 'active' => true],
            ['id' => 'es', 'active' => true],
            ['id' => 'fr', 'active' => false],
            ['id' => 'it', 'active' => false],
            ['id' => 'pt', 'active' => false],
        ];

        $langs = $this->table('langs');
        $langs->insert($data)->saveData();
    }
}
