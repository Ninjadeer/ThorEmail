<?php
return array(
    'controller_plugins' => array(
        'factories' => array(
            'thoremail' => function($pluginManager) {
            	$sm = $pluginManager->getServiceLocator();
            	$renderer = $sm->get('thoremail-view-renderer');
            	$mailTransport =  $sm->get('thoremail-mail-transport');

            	$thorEmail = new \ThorEmail\Controller\Plugin\ThorEmail();
            	$thorEmail->setRenderer($renderer);
            	$thorEmail->setMailTransport($mailTransport);

            	return $thorEmail;
			}
        ),
    )
);
