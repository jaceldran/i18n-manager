<?php

use Phinx\Seed\AbstractSeed;

class TranslationsSeeder extends AbstractSeed
{
	const SYSTEM_NAVIGATION_MAIN = 'system.navigation.main';
	const FORM_BUTTON = 'form.button';
	const FORM_LEGAL = 'form.legal';

	public function run()
	{
		$data = [
			[
				'group' => self::SYSTEM_NAVIGATION_MAIN,
				'id' => 'manage',
				'en' => 'Manage',
				'es' => 'Gestionar'
			],
			[
				'group' => self::SYSTEM_NAVIGATION_MAIN,
				'id' => 'upload',
				'en' => 'Upload',
				'es' => 'Cargar'
			],
			[
				'group' => self::SYSTEM_NAVIGATION_MAIN,
				'id' => 'download',
				'en' => 'Download',
				'es' => 'Descargar'
			],
			[
				'group' => self::SYSTEM_NAVIGATION_MAIN,
				'id' => 'config',
				'en' => 'Configuration',
				'es' => 'Configuración'
			],

			[
				'group' => self::FORM_BUTTON,
				'id' => 'accept',
				'en' => 'Accept',
				'es' => 'Aceptar'
			],
			[
				'group' => self::FORM_BUTTON,
				'id' => 'cancel',
				'en' => 'Cancel',
				'es' => 'Cancelar'
			],
			[
				'group' => self::FORM_BUTTON,
				'id' => 'confirm',
				'en' => 'Confirm',
				'es' => 'Confirmar'
			],
			[
				'group' => self::FORM_BUTTON,
				'id' => 'submit',
				'en' => 'Submit',
				'es' => 'submit'
			],
			[
				'group' => self::FORM_LEGAL,
				'id' => 'disclaimer',
				'en' => 'Disclaimer',
				'es' => 'Descargo'
			],
		];

		$langs = $this->table('translations');
		$langs->insert($data)->saveData();
	}
}
