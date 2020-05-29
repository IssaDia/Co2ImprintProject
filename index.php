<?php require 'header.php' ?>

<div class="row justify-content-center">
    <div class="title col-md-12">
        <h2>
            <span>Calculate your footprint</span>
        </h2>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-12 calculate">
        <form action='model.php' method='POST'>
            <label for="expense_type">Expense Type</label>
            <select class="form-control select" name='expense_selected'>
                <?php
                foreach ($expenses as $expense) { ?>
                    <option value='<?php echo $expense['expense_type'] ?>' name='expense'><?php echo $expense['expense_type'] ?></option>

                <?php  }  ?>
            </select>
            <label for="amount">Amount (€)</label>
            <input type="number" class="form-control" placeholder="Put an amount please" name='amount'>
            <button class="btn btn-success" name="calculate">Calculate</button>
        </form>
        <?php if (isset($_GET['footprint'])) : ?>
            <span>Your CO2 footsprint for this expense is : <?php echo $_GET['footprint']; ?> kgs</span>
        <?php endif ?>

    </div>
</div>
</div>

<?php require 'footer.php' ?>