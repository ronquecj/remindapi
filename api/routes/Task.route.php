<?php

if ($req[0] == 'createtask'):
  echo json_encode($gm->createTask('createTask', $d));
  return;
endif;

if ($req[0] == 'tasks'):
  echo json_encode($gm->callNoData('getTasks'));
  return;
endif;

if ($req[0] == 'updatetask'):
  echo json_encode($gm->updateTask('updateTask', $d));
  return;
endif;

if ($req[0] == 'deletetask'):
  echo json_encode($gm->deleteTask('deleteTask', $d));
  return;
endif;