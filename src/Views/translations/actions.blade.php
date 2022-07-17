@include('components.actions-bar', [
    'groups' => [
        'group-1' => [
            'open-all' => (object)  [
                'label' => 'Open',
                'icon' => 'fas fa-plus',
            ],
            'close-all' => (object)  [
                'label' => 'Close',
                'icon' => 'fas fa-minus',
            ],
        ],
        'group-2' => [
            'export' => (object)  [
                'label' => 'Export',
                'icon' => 'fas fa-arrow-right-from-bracket',
            ],
            'add-group' => (object)  [
                'label' => 'Group',
                'icon' => 'fas fa-plus',
            ],
            'search' => (object)  [
                'label' => 'Search',
                'icon' => 'fas fa-magnifying-glass',
            ],
        ],
    ]
])