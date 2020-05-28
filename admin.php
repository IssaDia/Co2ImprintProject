<?php require 'header.php' ?>

<?php

    if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>

        <div class="row justify-content-center">
            <div class="title col-md-12">
                <h2>
                    <span>Admin Page </span>
                </h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <table class="table highlight centered striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Ratio</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php
                foreach ($expenses as $single_expense) { ?>
                    <tr>
                        <td><?php echo $single_expense['expense_type'] ?></td>
                        <td><?php echo $single_expense['ratio'] ?></td>
                        <td>
                            <a href="admin.php?edit=<?php echo $single_expense['id']; ?>" class="btn btn-info amber accent-3" name="edit">Edit</a>
                            <a href="process.php?delete=<?php echo $single_expense['id']; ?>" class="btn btn-danger red accent-4" name="delete">Delete</a>
                        </td>

                    </tr>
                <?php } ?>
            </table>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <form action='process.php' method='POST'>
                        <input type='hidden' name='id' value=<?php echo $id; ?>>
                        <div class="input-field col s6">
                            <input type="text" class="validate" name="expense" placeholder="Veuillez entrer un nom pour cette dépense" value="<?php echo $expense; ?>">
                            <label for="expense">Dépense</label>
                        </div>
                        <div class="input-field col s6">

                            <input type="text" class="form-control" name="ratio" placeholder="Veuillez entrer un ratio pour cette dépense" value="<?php echo $ratio; ?>">
                            <label for="ratio">Ratio</label>
                        </div>
                        <?php
                        if ($update == true) : ?>
                            <button class="btn btn-info" name="update">Save</button>
                        <?php else : ?>
                            <button class="btn btn-primary" name="submit">Validate</button>
                        <?php endif ?>
                    </form>

                </div>

            </div>
        </div>
    </div>

    <?php require 'footer.php' ?>

  