<?php
require_once('common.php');

$return = array(); 

//Execution du code en fonction de l'action
switch ($_['action']){

	case 'addTask':
	 if($myUser!=false){
			$task['i'] = time().rand(0,200);
			$task['n'] = stripslashes(html_entity_decode($_['n']));
			$task['d'] = $_['d'];
			$task['s'] = 0;
			add_task($task);
			$return['info'] = 'T&acirc;che correctement ajout&eacute;e.';
		}else{
			$return['error'] = 'Vous devez &eacute;tre connect&eacute; pour effectuer cette action';
		}
	break;

	case 'updateTask':
		if($myUser!=false){
			$task = array(
				'i'=>$_['i'],
				'n'=>$_['n'],
				'd'=>$_['d'],
				's'=>$_['s']
				);
			update_task($task);
			$return['info'] = 'T&acirc;che correctement modifi&eacute;e.';
		}else{
			$return['error'] = 'Vous devez &eacute;tre connect&eacute; pour effectuer cette action';
		}
	break;

	case 'deleteTask':
		if($myUser!=false){
			delete_task($_['i']);
			$return['info'] = 'T&acirc;che correctement suprim&eacute;e.';
		}else{
			$return['error'] = 'Vous devez &eacute;tre connect&eacute; pour effectuer cette action';
		}
	break;


	case 'changeTaskState':
		if($myUser!=false){
			$task = get_task($_['i']);
			$task['s'] = $_['s'];
			update_task($task);
		}else{
			$return['error'] = 'Vous devez &eacute;tre connect&eacute; pour effectuer cette action';
		}
	break;

	case 'login':
			if($_['login']==USER_LOGIN && $_['password']==USER_PASSWORD){
				$user->login = USER_LOGIN;
				$user->password = USER_PASSWORD;
				$_SESSION['currentUser'] = serialize($user);
			}
			header('location: ./index.php');	
	break;



	case 'logout':
		$_SESSION = array();
		session_unset();
		session_destroy();
		header('location: ./index.php');
	break;
	
	default:
		$return['error'] = 'Aucune action définie';
	break;
}

$return['state'] = (!isset($return['error'])?1:0);

echo '('.toJson($return).')';

?>