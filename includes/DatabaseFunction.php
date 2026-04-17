<?php
function query($pdo, $sql, $parameters = []) {
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}

function findAllWithJoin($pdo, $sql) {
    $result = query($pdo, $sql);
    return $result->fetchAll();
}

function findById($pdo, $table, $primaryKey, $value) {
    $query = 'SELECT * FROM ' . $table . ' WHERE ' . $primaryKey . ' = :value';
    $parameters = ['value' => $value];
    $result = query($pdo, $query, $parameters);
    return $result->fetch();
}

function countRecords($pdo, $table) {
    $query = "SELECT COUNT(*) FROM `" . $table . "`";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function insert($pdo, $table, $fields) {
    $query = 'INSERT INTO ' . $table . ' (';
    foreach ($fields as $key => $value) {
        $query .= '`' . $key . '`,';
    }
    $query = rtrim($query, ',');
    $query .= ') VALUES (';
    foreach ($fields as $key => $value) {
        $query .= ':' . $key . ',';
    }
    $query = rtrim($query, ',');
    $query .= ')';

    query($pdo, $query, $fields);
}

function update($pdo, $table, $primaryKey, $fields) {
    $query = ' UPDATE ' . $table . ' SET ';
    foreach ($fields as $key => $value) {
        $query .= '`' . $key . '` = :' . $key . ',';
    }
    $query = rtrim($query, ',');
    $query .= ' WHERE ' . $primaryKey . ' = :primaryKey';
    
    $fields['primaryKey'] = $fields['id'];
    query($pdo, $query, $fields);
}

function delete($pdo, $table, $primaryKey, $id) {
    $parameters = [':id' => $id];
    query($pdo, 'DELETE FROM ' . $table . ' WHERE ' . $primaryKey . ' = :id', $parameters);
}
?>