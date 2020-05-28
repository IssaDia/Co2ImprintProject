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
        <form action='process.php' method='POST'>
            <form>
                <select class="form-control select" name='expense_select'>
                    <?php
                    foreach ($expenses as $expense) { ?>
                        <option value='<?php echo $expense['expense_type'] ?>' name='expense'><?php echo $expense['expense_type'] ?></option>

                    <?php  }  ?>
                </select>
                <label for="amount">Amount (€)</label>
                <input type="number" class="form-control" placeholder="Put an amount please" name='amount'>
                <button class="btn btn-success" name='calculate'>Calculate</button>
            </form>

           <?php if ($calculated == true) : ?>
                            <span>Your CO2 footsprint for this expense is : <?php echo $co2_footsprint ?></span>
                    
                        <?php endif ?>
                        <?php var_dump($calculated) ?>

    </div>
</div>
</div>

<?php require 'footer.php' ?>



