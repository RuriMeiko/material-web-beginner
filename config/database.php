<?php
function createConn()
{
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "member_manager";

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function closeConn($conn)
{
    $conn->close();
}

function executeQuery($conn, $query, $params = array())
{
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        echo "Lỗi: " . $conn->error;
        return null;
    }

    $queryType = strtoupper(substr(trim($query), 0, 6));

    if ($queryType === "SELECT") {
        if (!empty($params)) {
            $stmt->bind_param(str_repeat('s', count($params)), ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    } elseif ($queryType === "UPDATE" || $queryType === "INSERT" || $queryType === "DELETE") {
        if (!empty($params)) {
            $stmt->bind_param(str_repeat('s', count($params)), ...$params);
        }
        $stmt->execute();
        return $stmt;
    }

    $stmt->close();

    return null;
}
