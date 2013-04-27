<?php

return array(
    'acl' => array(
        'roles' => array(
            // role => parent1, a
            'guest' => null,
            'user' => 'guest',
            'admin' => 'user',
        ),
        
        'resources' => array(
            // perminssion => [resource => [subresource => role or array roles]]
            'ApplicationAccount\Controller' => array(
                'allow' => array(
                    '*' => 'user',
                ),
            ),
        ),
    ),
);
