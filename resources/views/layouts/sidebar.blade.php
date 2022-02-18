		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="{{ asset('assets/img/pt.png')}}" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
                                {{ Auth::user()->username }}
									<span class="user-level">Administrator</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="#profile">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="#edit">
											<span class="link-collapse">Edit Profile</span>
										</a>
									</li>
									<li>
                                        <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
											<span class="link-collapse">Log Out</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                        </form>                                        
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
						@can('isSub')
						<li class="nav-item {{ request()->is('dashboard') ? ' active ' : ''}}">
							<a href="{{route('home')}}" aria-expanded="false">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						@endcan
						@can('isAdmin')
						<li class="nav-item {{ request()->is('dashboardadmin') ? ' active ' : ''}}">
							<a href="{{route('homeadmin')}}" aria-expanded="false">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						@endcan
						@can('isMain')
						<li class="nav-item {{ request()->is('dashboardmain') ? ' active ' : ''}}">
							<a href="{{route('homemain')}}" aria-expanded="false">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						@endcan
                        @can('isAdmin')
						<li class="nav-item {{ request()->is('list-user') ? ' active ' : ''}}">
							<a href="{{ route('list-user')}}" aria-expanded="false">
								<i class="fas fa-user-lock"></i>
								<p>List User</p>
							</a>
                        </li>
						<li class="nav-item {{ request()->is('list-dept') ? ' active ' : ''}}">
							<a href="{{ route('list-dept')}}" aria-expanded="false">
								<i class="fas fa-user-lock"></i>
								<p>List Departement</p>
							</a>
                        </li>
						@endcan
						@cannot('isAdmin')
						<li class="nav-item {{ request()->is('list-budget') ? ' active ' : ''}}">
							<a href="{{ route('list-budget')}}" aria-expanded="false">
								<i class="fas fa-money-check-alt"></i>
								<p>List Budget</p>
							</a>
						</li>
						@endcan
						@cannot('isAdmin')
						<li class="nav-item {{ request()->is('list-supplier') ? ' active ' : ''}}">
							<a href="{{ route('list-supplier')}}" aria-expanded="false">
								<i class="fas fa-store-alt"></i>
								<p>List Supplier</p>
							</a>
						</li>
						@endcan
						@cannot('isAdmin')
						<li class="nav-item {{ request()->is('list-material') ? ' active ' : ''}}">
							<a href="{{ route('list-material')}}" aria-expanded="false">
								<i class="fas fa-box"></i>
								<p>List Material</p>
							</a>
						</li>
						@endcan
						@can('isSub')
						<li class="nav-item {{ request()->is('list-materialkeluar','list-prpo','list-materialmasuk') ? ' active ' : ''}}">
							<a data-toggle="collapse" href="#base">
								<i class="fas fa-layer-group"></i>
								<p>Transaksi</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{route('list-materialkeluar')}}">
											<span class="sub-item">Data Material Keluar</span>
										</a>
									</li>
									<li>
										<a href="{{route('list-materialmasuk')}}">
											<span class="sub-item">Data Material Masuk</span>
										</a>
									</li>
									<li>
										<a href="{{route('list-prpo')}}">
											<span class="sub-item">List PR&PO By Material </span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						@endcan
						@cannot('isAdmin')
						<li class="nav-item {{ request()->is('list-mr','formadd-mr') ? ' active ' : ''}}">
							<a href="{{ route('list-mr')}}" aria-expanded="false">
								<i class="fas fa-box-open"></i>
								<p>Material Requisition</p>
							</a>
						</li>
						@endcan
						@cannot('isAdmin')
						<li class="nav-item {{ request()->is('list-pr','pending-pr','approved-pr','formadd-pr') ? ' active ' : ''}}">
							<a href="{{ route('list-pr')}}" aria-expanded="false">
								<i class="fas fa-shopping-basket"></i>
								<p>Purchase Requisition</p>
							</a>
						</li>
						@endcan
						@can('isMain')
						<li class="nav-item {{ request()->is('list-po','pending-po','received-po','formadd-po') ? ' active ' : ''}}">
							<a href="{{ route('list-po')}}" aria-expanded="false">
								<i class="fas fa-shopping-cart"></i>
								<p>Purchase Order</p>
							</a>
                        </li>						
						<li class="nav-item {{ request()->is('list-gr','pending-gr','received-gr','formadd-gr') ? ' active ' : ''}}">
							<a href="{{ route('list-gr')}}" aria-expanded="false">
								<i class="fas fa-box-open"></i>
								<p>Goods Receipt</p>
							</a>
						</li>
						@endcan
						<!-- <li class="nav-item {{ request()->is('list-gr','pending-gr','received-gr','formadd-gr') ? ' active ' : ''}}">
							<a href="{{ route('ocra')}}" aria-expanded="false">
								<i class="fas fa-box-open"></i>
								<p>Metode Ocra</p>
							</a>
						</li> -->
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->