<?php

namespace App\Controllers\Api;

use Flight;

use App\Models\Lang;

class Langs
{
    const KEY = 'key';
    const VISIBLE = 'visible';
    const EDITABLE = 'editable';
    const FORM_VIEW = 'langs.form';

    public static function normalizeKey(string $key): string
    {
        return trim(strtolower($key));
    }

    public static function order()
    {
        $req = Flight::request()->data;
        $order = [];

        foreach ($req as $value) {
            $order[] = $value;
        }

        $response = Lang::setOrder($order);

        Flight::json($response);
    }

    public static function put()
    {
        $req = Flight::request()->data;
        $values = [];

        foreach ($req as $key => $value) {
            $values[$key] = $value;
        }

        Lang::update($values);

        Flight::json($values);
    }

    public static function post()
    {
        $values = Flight::request()->data;

        Lang::updateOrCreate(self::normalizeKey($values->key), [
            Lang::VISIBLE => true,
            Lang::EDITABLE => true,
        ]);

        $response['values'] = $values;

        Flight::json($response);
    }

    public static function delete()
    {
        $values = Flight::request()->data;

        $key = trim(strtolower($values->key));

        Lang::delete($key);

        $response['values'] = $values;

        Flight::json($response);
    }

    public static function renderCreate(): void
    {
        $group = Flight::request()->query['group'];

        Flight::render(self::FORM_VIEW, [
            'title' => "Add language to manager",
            'action' => 'create',
            'button' => 'Add language',
            'button_icon' => '<i class="fas fa-plus"></i>',
            // 'group' => $group,
            // 'langs' => Lang::keys()
        ]);
    }
}
