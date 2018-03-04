<div class="contentSpec">
	<div class="ui container containerSpec">
		<div class="ui grid">
			<div class="sixteen wide column">
				<h2 class="ui dividing header">
					<i class="icon spy"></i>
					<div class="content">
						新增商品分類
						<div class="sub header">此處可以針對商品分類進行新增。</div>
					</div>
				</h2>
				<?php if(isset($sys_code)) { ?>
				<div class="ui bottom attached warning message">
					<i class="icon warning"></i>
					<?=$sys_msg; ?>
				</div>
				<?php } ?>
				<form class="ui form tableForm" method="post">
					<h4 class="ui dividing header">Basic</h4>
					<input type="hidden" name="rule" value="insert">
					<div class="field required">
						<label>Category</label>
						<input type="text" name="type">
					</div>
					<button class="ui green button" type="submit" tabindex="0">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>