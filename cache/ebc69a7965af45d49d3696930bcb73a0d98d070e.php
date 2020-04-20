
<?php $__env->startSection('title', 'Cart'); ?>
<?php $__env->startSection('content'); ?>

	<?php use App\Helpers\HTML; ?>

    <div class="row">
        <div class="col-lg-8">
			<?= HTML::Card('Order Summary'); ?>

				<div class="table-responsive">
					<table class="table " width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Image</th>
								<th>Product</th>
								<th width="300">Quantity</th>
								<th width="300">Price</th>
								<th>Total</th> 
								<th>Option</th>
							</tr>
						</thead>

						<tbody>
							<?php if( !empty($_SESSION["cart"]) ): ?>
								<?php $_SESSION['mm'] = 0; ?>
								<?php $__currentLoopData = $_SESSION["cart"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><img src=" <?php echo e(app()->get('assets').'/images/images.png'); ?>" style="width: 100px"></td>
										<td><?php echo e($values["name"]); ?> </td>
										<td> <?php echo e($values["quantity"]); ?></td>
										<td>&#8369 <?php echo e($values["price"]); ?></td>
										<td>&#8369 <?php echo e($values["quantity"] * $values["price"]); ?> </td>
										<td>
											<a class="btn btn-danger" type="button" onclick="return confirm('Are you sure?')" href="<?php echo e(route('order/remove_product').'?id='.$values['ids']); ?>">Remove</a>
										</td>
									</tr>
									<?php $name= $values["name"];  $_SESSION['mm'] = $_SESSION['mm'] + ($values["quantity"] * $values["price"]); ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								
							<?php endif; ?>
						</tbody>
					</table>
				</div>
            <?= HTML::closeCard(); ?>
        </div>

        <div class="col-lg-4">
			<div class="container">
				<?= HTML::Card('Checkout'); ?>
					<form role="form" method="POST" action="<?php echo e(route('order/checkout')); ?>" id="paymentForm">
						<h5><i class="fas fa-user-alt"></i> <?php echo $dataSource->name; ?> </h5><br>
						<h5><i class="fas fa-envelope"></i> <?php echo $dataSource->email; ?></h5><br>
						<?php if(empty($dataSource->contact)): ?>
							<h5><i class="fas fa-phone"></i> <input type="number" maxlength="12" name="phonenumber" placeholder="Your phone number" required></h5><br>
						<?php else: ?>
							<h5><i class="fas fa-phone"></i> <?php echo $dataSource->contact; ?></h5><br>
							<input type="hidden" maxlength="12" name="phonenumber" value="<?php echo $dataSource->contact; ?>" >
						<?php endif; ?>
						<h2>Order Summary</h2><br>
						<div class="row">
							<div class="col-lg-7" >
							<h5>Cost</h5><br>
							</div>

							<div align="right" class="col-lg-4">
								<h5>&#8369 <?php echo $_SESSION['mm']; ?></h5><br>
							</div> 
							


							<div class="col-lg-7">
								<h5>Total</h5><br>
							</div>

							<div align="right" class="col-lg-4">
								<h5>&#8369 <?php echo $_SESSION['mm']; ?></h5><br>
							</div>

						</div>

						<?php [$firstname, $lastname] = explode(' ', $dataSource->name); ?>
							<input type="hidden" name="amount" value="<?php echo $_SESSION['mm']+150; ?>" /> <!-- Replace the value with your transaction amount -->
							<input type="hidden" name="payment_method" value="both" /> <!-- Can be card, account, both -->
							<input type="hidden" name="description" value="Payment For Products Purchased" /> <!-- Replace the value with your transaction description -->
							<input type="hidden" name="logo" value="<?php echo app()->get('assets').'/images/images.png'; ?>" /> <!-- Replace the value with your logo url -->
							<input type="hidden" name="title" value="Agri-Trading Checkout" /> <!-- Replace the value with your transaction title -->
							<input type="hidden" name="country" value="NG" /> <!-- Replace the value with your transaction country -->
							<input type="hidden" name="currency" value="NGN" /> <!-- Replace the value with your transaction currency -->
							<input type="hidden" name="email" value="<?php echo $dataSource->email; ?>" /> <!-- Replace the value with your customer email -->
							<input type="hidden" name="firstname" value="<?php echo $firstname; ?>" /> <!-- Replace the value with your customer firstname -->
							<input type="hidden" name="lastname"value="<?php echo $lastname; ?>" /> <!-- Replace the value with your customer lastname -->
							 <!-- Replace the value with your customer phonenumber -->
							<input type="hidden" name="pay_button_text" value="Complete Payment" /> <!-- Replace the value with the payment button text you prefer -->
							<input type="hidden" name="ref" value="<?php echo $dataSource->txref; ?>" /> <!-- Replace the value with your transaction reference. It must be unique per transaction. You can delete this line if you want one to be generated for you. -->
						
						<center>
							<button type="submit" onclick="return confirm('Do you want to submit order and Checkout?')" class="btn btn-lg btn-success">Submit Order</button>
						</center>						
					</form>

					
				<?= HTML::closeCard(); ?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bam\public\view/order/checkout.blade.php ENDPATH**/ ?>