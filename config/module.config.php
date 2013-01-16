<?php
return array(
    'phpbnl13_status_api' => array(
        'table'     => 'status',
        'page_size' => 10, // number of status items to return by default
    ),
    'router' => array('routes' => array(
        'phpbnl13_status_api' => array(
            'type' => 'Segment',
            'options' => array(
                'route'    => '/api/status[/]',
                'defaults' => array(
                    'controller' => 'Phpbnl13StatusApi\StatusResourcePublicController',
                ),
            ),
            'may_terminate' => true,
            'child_routes' => array(
                'user' => array(
                    'type' => 'Segment',
                    'options' => array(
                        'route'    => ':user[/[:id]]',
                        'defaults' => array(
                            'controller' => 'Phpbnl13StatusApi\StatusResourceUserController',
                        ),
                        'constraints' => array(
                            'user' => '[a-z0-9_-]+',
                            'id'   => '[a-f0-9]{5,40}',
                        ),
                    ),
                ),
            ),
        ),
    )),
    'service_manager' => array(
        'aliases' => array(
            'Phpbnl13StatusApi\DbAdapter' => 'Zend\Db\Adapter\Adapter',
            'Phpbnl13StatusApi\PersistenceListener' => 'Phpbnl13StatusApi\StatusDbPersistence',
        ),
        'factories' => array(
            'Phpbnl13StatusApi\DbTable' => 'Phpbnl13StatusApi\Service\DbTableFactory',
            'Phpbnl13StatusApi\StatusDbPersistence' => 'Phpbnl13StatusApi\Service\StatusDbPersistenceFactory',
            'Phpbnl13StatusApi\StatusResource' => 'Phpbnl13StatusApi\Service\StatusResourceFactory',
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'Phpbnl13StatusApi\StatusResourcePublicController' => 'Phpbnl13StatusApi\Service\StatusResourcePublicControllerFactory',
            'Phpbnl13StatusApi\StatusResourceUserController' => 'Phpbnl13StatusApi\Service\StatusResourceUserControllerFactory',
        ),
    ),
);
