<?php

return [
    'signature' => [
        'eRetailKeyFilePath' => env('E_RETAIL_KEY_FILE_PATH', '/eRetailKey/version1/'),
        'eRetailKeyPublicFileName' => env('E_RETAIL_KEY_PUBLIC_FILE_NAME', 'eRetailpublic.pfx'),
        'eRetailPublicPassPhrase' => env('E_RETAIL_PUBLIC_PASS_PHRASE', 'eRetail@1201'),
        'eRetailPublicAlias' => env('E_RETAIL_PUBLIC_ALIAS', 'eRetail'),

        'spRetailKeyFilePath' => env('SP_RETAIL_KEY_FILE_PATH', '/spRetailKey/version1/'),
        'spRetailKeyPublicFileName' => env('SP_RETAIL_KEY_PUBLIC_FILE_NAME', 'spRetailpublic.pfx'),
        'spRetailPublicPassPhrase' => env('SP_RETAIL_PUBLIC_PASS_PHRASE', 'spRetail@3412'),
        'spRetailPublicAlias' => env('SP_RETAIL_PUBLIC_ALIAS', 'spRetail'),

        'spRetailKeyPrivateFileName' => env('SP_RETAIL_KEY_PRIVATE_FILE_NAME', 'spRetailprivate.pfx'),
        'spRetailKeyPrivatePassPhrase' => env('SP_RETAIL_PRIVATE_PASS_PHRASE', 'spRetail@3412'),
        'spRetailPrivateAlias' => env('SP_RETAIL_PRIVATE_ALIAS', 'spRetail'),

        'deviceRetailKeyFilePath' => env('DEVICE_RETAIL_KEY_FILE_PATH', '/deviceRetailKey/version1/'),
        'deviceRetailKeyPublicFileName' => env('DEVICE_RETAIL_KEY_PUBLIC_FILE_NAME', 'deviceRetailpublic.pfx'),
        'deviceRetailPublicPassPhrase' => env('DEVICE_RETAIL_PUBLIC_PASS_PHRASE', 'deviceRetail@1201'),
        'deviceRetailPublicAlias' => env('DEVICE_RETAIL_PUBLIC_ALIAS', 'deviceRetail'),
    ]
];



