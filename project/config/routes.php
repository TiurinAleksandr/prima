<?php
	use \Core\Route;
	
	return [
		new Route('/', 'form', 'show'),
		new Route('/select', 'form', 'select'),
        new Route('/hi', 'form', 'submit'),
        new Route('/admin', 'admin', 'show'),


        new Route('/groups', 'test', 'groups'),
        new Route('/students', 'test', 'students'),

        new Route('/dev', 'dev', 'show'),
        new Route('/dev/updateAllGroups', 'dev', 'updateAllGroups'),
        new Route('/dev/updateStudentsOfGroup/:id/', 'dev', 'updateStudentsOfGroup'),
	];
	
