<?php include 'login.php' ?>

<?php

function connectDB()
{
    try {
        global $bdd;
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    } catch (Exception $e) {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
    }
    return $bdd;
}

function add_expense_to_database($expense, $ratio)
{
    $bdd = connectDB();
    $sql = "INSERT INTO expense_table (expense_type, ratio) VALUES (:expense, :ratio);";
    $req = $bdd->prepare($sql);
    $req->bindValue(':expense', $expense, PDO::PARAM_STR);
    $req->bindValue(':ratio', $ratio, PDO::PARAM_STR);
    $req->execute();
}

function get_all_about_expenses()
{

    $bdd = connectDB();
    $sql = "SELECT * FROM expense_table";
    $req = $bdd->prepare($sql);
    $req->execute();
    $resultats = $req->fetchAll(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $resultats;
}


function delete_expense_from_database($id)
{

    $bdd = connectDB();
    $sql = "DELETE FROM expense_table WHERE id= $id";
    $req = $bdd->prepare($sql);
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
    $req->closeCursor();
}



function get_expense_to_edit($id)
{

    $bdd = connectDB();
    $sql = "SELECT * FROM expense_table WHERE id='$id'";
    $req = $bdd->prepare($sql);
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
    $result = $req->fetch();
    $req->closeCursor();
    return $result;
}

function update_expense_from_database($id, $expense, $ratio)
{
    $bdd = connectDB();
    $sql = "UPDATE expense_table SET expense_type='$expense',ratio='$ratio' WHERE id='$id'";
    $req = $bdd->prepare($sql);
    $req->bindValue(':expense', $expense, PDO::PARAM_STR);
    $req->bindValue(':ratio', $ratio, PDO::PARAM_STR);
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
    $req->closeCursor();
}

function get_ratio_of_expense($expense_name)
{
    $bdd = connectDB();
    $sql = "SELECT ratio FROM expense_table WHERE expense_type ='$expense_name'";
    $req = $bdd->prepare($sql);
    $req->bindValue(':expense_name', $expense_name, PDO::PARAM_STR);
    $req->execute();
    $ratio = $req->fetch();
    $req->closeCursor();
    return $ratio;
}