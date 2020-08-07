
<?php include 'model.php' ?>

<?php

session_start();

$expense = '';
$ratio = '';
$id = 0;
$result = '';
$calculated = false;



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

$update = false;
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
    $calculated = true;
    $expense_name = filter_var($_POST['expense_selected'], FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
    $amount = filter_var($_POST['amount'], FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
    $result = get_ratio_of_expense($expense_name);
    $ratio_number = $result['ratio'];
    $footprint = $amount * ($ratio_number / 1000);
    $_SESSION['calculated'] = $calculated;
    $_SESSION['footprint'] = $footprint;
    header("location: index.php?footprint=$footprint");

}

