@include('components.actions-bar', [
    'groups' => [
        'group-2' => [
            'add-lang' => (object) [
                'label' => 'New',
                'icon' => 'fas fa-plus',
            ],
        ],
        'group-1' => [
            'iso-reference' => (object) [
                'label' => 'ISO Code Lang Reference',
                'icon' => 'fas fa-up-right-from-square',
                'url' => 'https://es.wikipedia.org/wiki/ISO_639-1'
            ]
        ],
    ],
])
