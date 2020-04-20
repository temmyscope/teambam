
<?php $__env->startSection('title', 'Wallet'); ?>
<?php $__env->startSection('content'); ?>

	<?php use App\Helpers\HTML; ?>

	<?= HTML::Card('<center><b>Withdraw From Wallet</b></center>'); ?>
		<form action="<?php echo route('profile/wallet'); ?>" method="POST">
		
            <div class="form-group">
              <div class="form-label-group">
			  <?php $banks = app(__DIR__.'/../config/banks.php')->all(); ?>
			  	<select name="bank_code" class="form-control" placeholder="Available Banks">
				<?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  	<option value="<?php echo $code; ?>"><?php echo $bank; ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
				<?php unset($banks); ?>
              </div>
            </div>
            
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="name" name="account_name" class="form-control" placeholder="<?php echo $_SESSION['name']; ?>" disabled>
                <label for="name"><?php echo $_SESSION['name']; ?></label>
              </div>
            </div>

			<div class='form-group row'>
            	<label for='acc_num' class='col-md-2 col-form-label text-md-right'> Account Number: </label>
				<div class='col-md-10'>
					<input id='acc_num' type='number' class='form-control' name='account_number' placeholder="0176986532" required>                        
            	</div>
            </div>

			<div class='form-group row'>
            	<label for='amount' class='col-md-2 col-form-label text-md-right'> Amount: </label>
				<div class='col-md-10'>
					<input id='amount' type='number' class='form-control' name='amount' placeholder="5000" required>                        
            	</div>
            </div>

            <button type="submit" class="btn btn-block btn-success" name="submit">Withdraw</button>
        </form>

	<br>

	<?php $__empty_1 = true; $__currentLoopData = $dataSource; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

		<?= HTML::Card('Pending Withdrawals'); ?>
			You have a pending withdrawal of <?php echo $data['amount']; ?> NGN been processed
		<?= HTML::closecard() ?>

	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
	<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bam\public\view/profile/wallet.blade.php ENDPATH**/ ?>