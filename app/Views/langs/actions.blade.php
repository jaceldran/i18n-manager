@include('components.actions-bar', [
    'groups' => [
        'group-1' => [
            'iso-reference' => (object) [
                'label' => 'ISO Code Lang Reference',
                'icon' => 'fas fa-up-right-from-square',
                'url' => 'https://es.wikipedia.org/wiki/ISO_639-1'
            ]
        ],
        'group-2' => [
            'add-lang' => (object)  [
                'label' => 'New',
                'icon' => 'fas fa-plus --w-8 --h-8 --bg-gray-200 --rounded-full',
                '--icon_style' => 'line-height: 2rem',
            ],
        ],
    ],
])
