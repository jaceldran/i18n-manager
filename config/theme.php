<?php return (object) [
    'body' => ' text-gray-500 bg-gray-100',
    'header' => (object) [
        'bg' => 'bg-gray-900',
        'logo' => 'text-gray-300',
    ],
    'navigation' => (object) [
        'main' => (object) [
            'nav' => 'flex',
            'link' => 'p-4 text-white bg-transparent hover:bg-gray-800',
            'link_active' => 'p-4 text-white bg-gray-700',
        ],
        'config' => (object) [
            'nav' => 'flex uppercase text-sm font-medium pb-4',
            'link' => 'flex-1 px-8 py-2 text-center border-b  hover:bg-gray-100',
            'link_active' => 'flex-1 px-8 py-2 text-center border-b-2 bg-gray-100 border-gray-400',
        ],
    ],
    '_compile_these' => 'grid-cols-1 grid-cols-2 grid-cols-3 grid-cols-4 grid-cols-5 grid-cols-6 grid-cols-7 grid-cols-8 grid-cols-9 grid-cols-10 grid-cols-11 grid-cols-12',
];
