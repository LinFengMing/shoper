<div class="t-header">
	<div class="t-logo">
		<a href="index">
			Shoper
		</a>
	</div>
	<div class="t-menu">
		<ul>
			<li class="item <?php if($menu == 'store') { echo 'active'; } ?>">
				<a href="index">首頁</a>
			</li>
			<li class="item <?php if ($menu == 'news') { echo 'active'; } ?>">
				<a href="news">最新消息</a>
			</li>
			<li class="item <?php if($menu == 'product') { echo 'active'; } ?>">
				<a href="products/all">所有產品</a>
			</li>
			<li class="item <?php if ($menu == 'about') { echo 'active'; } ?>">
				<a href="about">關於我們</a>
			</li>
		</ul>
	</div>
</div>