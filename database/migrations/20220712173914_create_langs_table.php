<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateLangsTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('langs', ['id' => false, 'primary_key'=>['id']]);

        $table->addColumn('id', 'char', ['length' => 2]);
        $table->addColumn('active', 'boolean', ['default' => true]);

        $table->create();
    }
}
