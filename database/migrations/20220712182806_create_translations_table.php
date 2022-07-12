<?php

use Phinx\Migration\AbstractMigration;

final class CreateTranslationsTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('translations', [
            'id' => false,
            'primary_key' => ['group', 'id']
        ]);

        $table->addcolumn('group', 'string', []);
        $table->addColumn('id', 'string', []);
        $table->addcolumn('en', 'string', ['null' => true,]);
        $table->addcolumn('es', 'string', ['null' => true,]);
        $table->addcolumn('fr', 'string', ['null' => true,]);
        $table->addcolumn('it', 'string', ['null' => true,]);
        $table->addcolumn('pt', 'string', ['null' => true,]);
        $table->addcolumn('de', 'string', ['null' => true,]);

        $table->create();
    }
}
