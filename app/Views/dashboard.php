<?php echo view('layout/header'); ?>
<?php echo view('layout/sidemenu'); ?>
<?php echo view('layout/main-header'); ?>

<!--page-wrapper-->
<div class="page-wrapper">
	<!--page-content-wrapper-->
	<div class="page-content-wrapper">
		<div class="page-content">
		<?php if ($this->session->getFlashdata('success_msg')) { ?>
			<div class="lobibox-notify-wrapper center top" style="margin-left: -300px;"><div class="lobibox-notify lobibox-notify-success animated-fast rollIn" style="width: 600px;"><div class="lobibox-notify-icon-wrapper"><div class="lobibox-notify-icon"><div><div class="icon-el"><i class="bx bx-check-circle"></i></div></div></div></div><div class="lobibox-notify-body"><div class="lobibox-notify-title">Success<div></div></div><div class="lobibox-notify-msg" style="max-height: 40px;"><?php echo $this->session->getFlashdata('success_msg'); ?></div></div><span class="lobibox-close">×</span><div class="lobibox-delay-indicator"><div style="width: 100%;"></div></div></div></div>
			
		<?php } ?>
			<div class="row">
			


			</div>
		</div>
	</div>
	<!--end page-content-wrapper-->
</div>
<!--end page-wrapper-->

<?php echo view('layout/copyrights'); ?>
<?php echo view('layout/footer'); ?>