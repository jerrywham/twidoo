<?php
require_once("constant.php");
  
function update_task($task){
	delete_task($task['i']);
	add_task($task);
}

function delete_task($id){
	$newList = array();
	$tasks = get_tasks();
	foreach($tasks as $task){
		if($task['i']!=$id) $newList[]= $task;
	}
	file_append(DATA_FILE,stock($newList),false);
}

function get_task($id){
	$target = array();
	$tasks = get_tasks();
	foreach($tasks as $task){
		if($task['i']==$id) $target = $task;
	}
	return $target;
}

function get_tasks($filter='all'){
	if($filter=='all'){
		return unstock(file_read(DATA_FILE));
	}else{
		$newList = array();
		$tasks = unstock(file_read(DATA_FILE));
			foreach($tasks as $task){
			if($task['s']==$filter) $newList[]= $task;
		}
		return $newList;
	}
}

function add_task($task){
	$tasks = unstock(file_read(DATA_FILE));
	$tasks[]= $task;
	file_append(DATA_FILE,stock($tasks),false);
}


function stock($data){
	//return gzdeflate(serialize($data));
	return gzdeflate(serialize($data));
}

function unstock($data){
	//return ($data!=''?unserialize(gzinflate($data)):array());
	return ($data!=''?unserialize(gzinflate($data)):array());
}



function secure($msg){
	return htmlentities($msg);
}
function file_read($file){
	touch($file);
	return file_get_contents($file);
}
function file_append($file,$data,$append=true){
	return file_put_contents($file,$data,($append?FILE_APPEND:0));
}
function toJson($msg){
	return json_encode($msg);
}
function toObject($data){
	return json_decode($data);
}
?>