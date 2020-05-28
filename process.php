<?php

include("functions/functions.php");
session_start();

$expense = '';
$ratio = '';
$update = false;
$id = 0;
$co2_footsprint = '';
$calculated = false;
$result='';

if (isset($_POST['submit'])) {

    $expense = filter_var($_POST['expense'], FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
    $ratio = filter_var($_POST['ratio'], FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);

    add_expense_to_database($expense, $ratio);
    $_SESSION['message'] = "Votre dépense a bien été ajoutée";
    $_SESSION['msg_type'] = "success";

    header("location: admin.php");
};

if (isset($_GET['delete'])) {

    $id = $_GET['delete'];
    delete_expense_from_database($id);
    $_SESSION['message'] = "Votre dépense a bien été supprimée";
    $_SESSION['msg_type'] = "danger";

    header("location: admin.php");
};


if (isset($_GET['edit'])) {
    $update = true;
    $id = $_GET['edit'];
    $result = get_expense_to_edit($id);
    $expense = $result['expense_type'];
    $ratio = $result['ratio'];
};

if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $expense =  $_POST['expense'];
    $ratio =  $_POST['ratio'];
    update_expense_from_database($id, $expense, $ratio);
    $_SESSION['message'] = "Votre dépense a bien été modifiée";
    $_SESSION['msg_type'] = "warning";

    header("location: admin.php");
};


if (isset($_POST['calculate'])) {

    $expense =  $_POST['expense_select'];
    $amount =  $_POST['amount'];
    $result = get_ratio_of_expense($expense);
    $calculated = true;
    header("location: index.php");
};
