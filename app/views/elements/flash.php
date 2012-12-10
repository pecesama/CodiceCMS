<?php if($this->session->issetFlash()): ?>
	<div class="alert-message fade in messages">
		<?php echo $this->session->getFlash(); ?>
	</div>
<?php endif; ?>