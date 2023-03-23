<div class="top-header-main">
	<div class="top-header-menu">
		<div class="main-menu-icon">
			<a href="JavaScript:;" id="menu-icon"><span></span></a>
		</div>
		<div class="top-menu">
		</div>
		<div class="top-header-user">
			<div class="username-main">
				<a href="javascript:void(0);">Hi,
					<strong>
						@if(session()->has('username'))
						<?php
						{
							echo $value = session('username');
						}
						?>
						@endif
					</strong>
				</a>
				<br>
				@if(session()->has('username'))
					<a href="{{ url('/adminpanel/logout') }}"><span><i class="fas fa-sign-out-alt"></i></span>Logout</a>
				@endif
			</div>
			<div class="user-img">
				<a href="javascript:;" id="open-sign"><img src="{{ asset('adminpanel/images/u.png') }}"></a>
			</div>
			<div class="sign-out-pop">
				<a href="javascript:;" class="btn-main">Sign Out</a>
			</div>
		</div>
	</div>
</div>