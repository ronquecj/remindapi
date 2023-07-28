<?php
class GlobalMethods
{
  protected $gm, $pdo;

  public function __construct(\PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  function callNoData($proc)
  {
    $data = null;
    $msg = 'Unable to retrieve records';
    $code = 400;
    $remarks = 'failed';

    $sql = 'CALL ' . $proc . '()';

    $stmt = $this->pdo->prepare($sql);

    try {
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        if ($res = $stmt->fetchAll()) {
          $msg = 'success';
          $code = 200;
          $remarks = 'successfully retrieved data';
          $data = $res;
        }
      }
    } catch (\PDOException $e) {
      return $e->getMessage();
    }
    return ['payload' => $data];
  }

  function deleteTask($proc, $d)
  {
    $data = null;
    $msg = 'Unable to delete records';
    $code = 400;
    $remarks = 'failed';
    $dt = $d->payload->id;

    $sql =
      'CALL ' .
      $proc .
      '(?)';
    $stmt = $this->pdo->prepare($sql);

    try {
      $stmt->execute([$dt]);
      if ($stmt->rowCount() > 0) {
       http_response_code(200);
      }
    } catch (\PDOException $e) {
      return $e->getMessage();
    }
    http_response_code(200);
    return ['payload' => $data];
  }

  function createTask($proc, $d){
    $data = null;
    $msg = 'Unable to insert records';
    $code = 400;
    $remarks = 'failed';
    $dt = $d->payload;

    $sql =
      'CALL ' .
      $proc .
      '(?,?)';
    $stmt = $this->pdo->prepare($sql);

    try {
      $stmt->execute([$dt->day, $dt->title]);
      if ($stmt->rowCount() > 0) {
       http_response_code(200);
      }
    } catch (\PDOException $e) {
      return $e->getMessage();
    }
    http_response_code(200);
    return ['payload' => $data];
  }

  function updateTask($proc, $d){
    $data = null;
    $msg = 'Unable to update records';
    $code = 400;
    $remarks = 'failed';
    $dt = $d->payload;

    $sql =
      'CALL ' .
      $proc .
      '(?)';
    $stmt = $this->pdo->prepare($sql);

    try {
      $stmt->execute([$dt->id]);
      if ($stmt->rowCount() > 0) {
       http_response_code(200);
      }
    } catch (\PDOException $e) {
      return $e->getMessage();
    }
    http_response_code(200);
    return ['payload' => $data];
  }
}
