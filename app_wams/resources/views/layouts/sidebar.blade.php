<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href=""><img src="{{asset('image/Logo.png')}}" alt="Logo" srcset=""> <b style="font-size: 20px">WAMS</b></a>
                </div>
                <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21"><g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path><g transform="translate(-210 -1)"><path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path><circle cx="220.5" cy="11.5" r="4"></circle><path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path></g></g></svg>
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" >
                        <label class="form-check-label" ></label>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z"></path></svg>
                </div>
                <div class="sidebar-toggler  x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
            </div>
            <div class="card">
                <div class="card-body px-5">
                    <div class="dropdown">
                        <a href="#" id="topbarUserDropdown" class="user-dropdown d-flex align-items-center dropend dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false">
                           
                            @php($avatar = auth()->user()->avatar)  
                            @if($avatar == null)
                            <div class="avatar bg-warning me-3">
                                <span class="avatar-content">{{ Auth::user()->getNameInitials() }}</span>
                            </div>
                            @else
                            <div class="avatar avatar-md2" >
                                <img src="{{ asset('storage/users/'.auth()->user()->avatar) }}" alt="Avatar" class="border">
                            </div>
                            @endif
                            <div class="text">
                                <h6 class="user-dropdown-name">{{ Str::limit(Auth::user()->name, 12) }}</h6>
                                <p class="user-dropdown-status text-sm text-muted">{{ auth()->user()->roles->pluck('name')[0] ?? '' }}</p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-sm shadow-lg" aria-labelledby="topbarUserDropdown">
                          <li><a class="dropdown-item" href="{{route('profile-all')}}">My Account</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                @if (Auth::user()->hasRole('Super Admin'))
                <ul class="menu">
                    <li class="sidebar-title">SUPER ADMIN TOOLS</li>
                    
                    <li
                        class="sidebar-item {{request()->is('dashboardSuperAdmin') ? 'active' : ''}}">
                        <a href="/dashboardSuperAdmin" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <li
                        class="sidebar-item {{request()->is('superAdminAllMenu') ? 'active' : ''}}">
                        <a href="/superAdminAllMenu" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>All Menu</span>
                        </a>
                    </li>

                    <li
                        class="sidebar-item {{request()->is('dashboard/role') || request()->is('dashboard/addUser') || request()->is('editUser*') || request()->is('editPermission*') || request()->is('dashboard/addRole') || request()->is('editRole*') || request()->is('dashboardPermision') || request()->is('dashboard/user') ? 'active' : ''}} has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-people-fill"></i>
                            <span>User Management</span>
                        </a>
                        <ul class="submenu {{request()->is('dashboard/role')  || request()->is('dashboard/addUser') || request()->is('editUser*') || request()->is('editPermission*') || request()->is('dashboard/addRole') || request()->is('editRole*') || request()->is('dashboardPermision') || request()->is('dashboard/user') ? 'active' : ''}}">
                            <li class="submenu-item {{request()->is('dashboard/role') || request()->is('dashboard/addRole') || request()->is('editRole*') ? 'active' : ''}}">
                                <a href="{{route('/dashboard/role')}}">Role</a>
                            </li>
                            <li class="submenu-item {{request()->is('editPermission*') || request()->is('dashboardPermision') ? 'active' : ''}}">
                                <a href="{{route('/dashboardPermision')}}">Permission</a>
                            </li>
                            <li class="submenu-item {{request()->is('dashboard/user') || request()->is('dashboard/addUser') || request()->is('editUser*') ? 'active' : ''}}">
                                <a href="{{route('/dashboard/user')}}">User Setting</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li
                        class="sidebar-item {{request()->is('adminproject/sales') || request()->is('dashboard/salesOrder') || request()->is('slsorder') ? 'active' : ''}} has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-people-fill"></i>
                            <span>Sales Monitoring</span>
                        </a>
                        <ul class="submenu {{request()->is('adminproject/sales') || request()->is('dashboard/salesOrder') || request()->is('slsorder') ? 'active' : ''}}">
                            <li class="submenu-item {{request()->is('adminproject/sales') ? 'active' : ''}}">
                                <a href="/adminproject/sales">Sales Pipelane</a>
                            </li>
                            <li class="submenu-item {{request()->is('slsorder') ? 'active' : ''}}">
                                <a href="/slsorder">Sales Order</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li
                        class="sidebar-item {{request()->is('umViewPiplane') || request()->is('reportp') || request()->is('umViewPm') || request()->is('umViewAdmin')  ? 'active' : ''}} has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-clipboard-fill"></i>
                            <span>Report</span>
                        </a>
                        <ul class="submenu {{request()->is('umViewPiplane') || request()->is('reportp') || request()->is('umViewPm') || request()->is('umViewAdmin')  ? 'active' : ''}}">
                            <li class="submenu-item {{request()->is('umViewPiplane') ? 'active' : ''}}">
                                <a href="/umViewPiplane">Report Admin</a>
                            </li>
                            <li class="submenu-item {{request()->is('reportp') ? 'active' : ''}}">
                                <a href="/reportp">Report Pipeline</a>
                            </li>
                            <li class="submenu-item {{request()->is('umViewPm') ? 'active' : ''}}">
                                <a href="/umViewPm">Report Technikal</a>
                            </li>
                            <li class="submenu-item {{request()->is('umViewAdmin') ? 'active' : ''}}">
                                <a href="/umViewAdmin">Report Timeline</a>
                            </li>
                        </ul>
                    </li>

                    {{-- <li
                        class="sidebar-item {{request()->is('timeline') ? 'active' : ''}} has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-people-fill"></i>
                            <span>Project Management</span>
                        </a>
                        <ul class="submenu {{request()->is('timeline') ? 'active' : ''}}">
                            <li class="submenu-item {{request()->is('timeline') ? 'active' : ''}}">
                                <a href="/timeline">Project Timeline</a>
                            </li>
                        </ul>
                    </li> --}}

                    <li
                        class="sidebar-item {{request()->is('telearning') ? 'active' : ''}}">
                        <a href="/telearning" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Elearning</span>
                        </a>
                    </li>
                    
                    <li
                        class="sidebar-item  ">
                        <form action="/logout" method="POST" style="">
                            @csrf
                            <button class="btn btn-danger text-white w-100">Logout</button>
                        </form>
                    </li>
                    
                </ul>
                @endif

                {{-- admin --}}
                @if (Auth::user()->hasRole('Project Admins'))
                <ul class="menu">
                    <li class="sidebar-title bold">PROJECT ADMIN TOOLS</li>
                    
                    <li
                        class="sidebar-item {{request()->is('dashboardAdmin') ? 'active' : ''}}">
                        <a href="/dashboardAdmin" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li 
                    class="sidebar-item {{request()->is('disti') || request()->is('customer/edit/*') || request()->is('customer/show/*') || request()->is('editDisti*') || request()->is('reportp') || request()->is('customer') || request()->is('departemen')   ? 'active' : ''}} has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-clipboard-fill"></i>
                            <span>Master Data</span>
                        </a>
                        <ul class="submenu {{request()->is('umViewPiplane') || request()->is('customer/edit/*') || request()->is('editDisti*') || request()->is('disti') || request()->is('customer') || request()->is('departemen') || request()->is('distiShow/*') || request()->is('customer/show/*') ? 'active' : ''}}">
                            <li class="submenu-item {{request()->is('disti') || request()->is('editDisti*') || request()->is('distiShow/*') ? 'active' : ''}}">
                                <a href="{{ route('/disti') }}">Distributor</a>
                            </li>
                            <li class="submenu-item {{request()->is('customer') || request()->is('customer/edit/*') || request()->is('customer/show/*') ? 'active' : ''}}">
                                <a href="{{ route('/customer') }}">Customer</a>
                            </li>
                            <li class="submenu-item {{request()->is('departemen') ? 'active' : ''}}">
                                <a href="{{ route('departemen') }}">Department</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li
                        class="sidebar-item {{request()->is('adminproject') || request()->is('adminproject/create') || request()->is('adminprojectShow*') ? 'active' : ''}}">
                        <a href="/adminproject" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Project Admin</span>
                        </a>
                    </li>

                    <li
                        class="sidebar-item {{request()->is('adminproject/sales') || request()->is('adminShowSales*') || request()->is('adminprojectSalesEdits/*') ? 'active' : ''}}">
                        <a href="/adminproject/sales" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>List Sales Pipeline</span>
                        </a>
                    </li>

                    <li
                        class="sidebar-item  ">
                        <form action="/logout" method="POST" style="">
                            @csrf
                            <button class="btn btn-danger text-white w-100">Logout</button>
                        </form>
                    </li>
                    
                </ul>
                @endif

                {{-- Finance --}}
                @if (Auth::user()->hasRole('Finance'))
                <ul class="menu">
                    <li class="sidebar-title bold">PROJECT FINANCE TOOLS</li>
                    
                    <li
                        class="sidebar-item {{request()->is('dashboardFinance') ? 'active' : ''}}">
                        <a href="/dashboardFinance" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li
                    class="d-none sidebar-item {{request()->is('Barang*') || request()->is('bank*') ? 'active' : ''}} has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-clipboard-fill"></i>
                            <span>Master Data</span>
                        </a>
                        <ul class="submenu {{request()->is('Barang*') || request()->is('bank*') ? 'active' : ''}}">
                            <li class="submenu-item {{request()->is('Barang*') ? 'active' : ''}}">
                                <a href="{{ route('barang') }}">Stuff</a>
                            </li>
                            <li class="submenu-item {{request()->is('bank*') ? 'active' : ''}}">
                                <a href="{{ route('/bank') }}">Bank</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li
                        class="sidebar-item {{request()->is('projectF*') ? 'active' : ''}}">
                        <a href="/projectF" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Project</span>
                        </a>
                    </li>
                    <li
                    class="d-none sidebar-item {{request()->is('data-faktur') || request()->is('Faktur*') || request()->is('data-pesanan') || request()->is('data-penawaran') || request()->is('Penagihan-Penjualan*') || request()->is('Penjualan*') || request()->is('Penawaran*') || request()->is('Pesanan-Penjualan*') || request()->is('penawaran-Penjualan*') || request()->is('Faktur-Penjualan*') || request()->is('detailFaktur-Penjualan*') || request()->is('Penerimaan-Penjualan*') || request()->is('Pembayaran*') ? 'active' : ''}} has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-clipboard-fill"></i>
                            <span>Sale</span>
                        </a>
                        <ul class="submenu {{request()->is('data-faktur') || request()->is('Faktur*') || request()->is('data-pesanan') || request()->is('Penagihan-Penjualan*') || request()->is('Penjualan*') || request()->is('data-penawaran') || request()->is('Penawaran*') || request()->is('Pesanan-Penjualan*') || request()->is('penawaran-Penjualan*') || request()->is('Faktur-Penjualan*') || request()->is('detailFaktur-Penjualan*') || request()->is('Penerimaan-Penjualan*') || request()->is('Pembayaran*') ? 'active' : ''}}">
                            <li class="submenu-item {{request()->is('Penagihan-Penjualan*') || request()->is('Faktur*') || request()->is('Penjualan*') || request()->is('Penawaran*') || request()->is('Pesanan-Penjualan*') || request()->is('penawaran-Penjualan*') || request()->is('Faktur-Penjualan*') || request()->is('detailFaktur-Penjualan*') || request()->is('Penerimaan-Penjualan*') || request()->is('Pembayaran*') ? 'active' : ''}}">
                                <a href="/Penagihan-Penjualan">Billing/Sales</a>
                            </li>
                            <li class="submenu-item {{request()->is('data-faktur') || request()->is('data-pesanan') || request()->is('data-penawaran') ? 'active' : ''}}">
                                <a href="{{ route('data-penjualan') }}">Sales Reports</a>
                            </li>
                        </ul>
                    </li>

                    <li
                    class="d-none sidebar-item {{request()->is('data-faktur-pembelian') || request()->is('pembelian') || request()->is('data-pesanan-pembelian') || request()->is('data-pembelian') || request()->is('pesananPembelian/*') || request()->is('showPembelian/*') || request()->is('fakturPembelian/*') || request()->is('detailFaktur/*') || request()->is('pembayaranPembeli/*') || request()->is('createPesananPembelian/*') || request()->is('pembelian/edit/*') || request()->is('detailSyaratFaktur/*') || request()->is('PembeliShow/*')  ? 'active' : ''}} has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Purchase</span>
                        </a>
                        <ul class="submenu {{request()->is('data-faktur-pembelian') || request()->is('pembelian') || request()->is('data-pesanan-pembelian') || request()->is('data-pembelian') || request()->is('pesananPembelian/*') || request()->is('showPembelian/*') || request()->is('fakturPembelian/*') || request()->is('detailFaktur/*') || request()->is('pembayaranPembeli/*') || request()->is('createPesananPembelian/*') || request()->is('pembelian/edit/*') || request()->is('detailSyaratFaktur/*') || request()->is('PembeliShow/*') ? 'active' : ''}}">
                            <li 
                                class="submenu-item {{request()->is('pembelian') || request()->is('pesananPembelian/*') || request()->is('showPembelian/*') || request()->is('fakturPembelian/*') || request()->is('detailFaktur/*') || request()->is('pembayaranPembeli/*') || request()->is('createPesananPembelian/*') || request()->is('pembelian/edit/*') || request()->is('detailSyaratFaktur/*') || request()->is('PembeliShow/*') || request()->is('FakturPembelian/*')    ? 'active' : '' }}">
                                <a href="{{ route('pembelian') }}" class='sidebar-link'>
                                    Purchase
                                </a>
                            </li>
                            <li class="submenu-item {{request()->is('data-faktur-pembelian') || request()->is('data-pembelian') || request()->is('data-pesanan-pembelian') || request()->is('data-penawaran') ? 'active' : ''}}">
                                <a href="{{ route('data-pembelian') }}">Purchase Report</a>
                            </li>
                        </ul>
                    </li>

                    <li
                        class="sidebar-item  ">
                        <form action="/logout" method="POST" style="">
                            @csrf
                            <button class="btn btn-danger text-white w-100">Logout</button>
                        </form>
                    </li>
                    
                </ul>
                @endif
                
                {{-- Corporate --}}
                @if (Auth::user()->hasRole('Corporate'))
                <ul class="menu">
                    <li class="sidebar-title bold">CORPORATE TOOLS</li>
                    
                    <li class="sidebar-item {{request()->is('dashboardCorporate') ? 'active' : ''}}">
                        <a href="/dashboardCorporate" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-item {{request()->is('projectF*') ? 'active' : ''}}">
                        <a href="/projectF" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Project</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{request()->is('index-createprincipal*') || request()->is('index-createclient') || request()->is('index-createproject') || request()->is('CreateProject') || request()->is('showCPT*') ? 'active' : ''}} has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-people-fill"></i>
                            <span>ACDC</span>
                        </a>
                        <ul class="submenu {{request()->is('index-createprincipal*') || request()->is('index-createclient') || request()->is('index-createproject') || request()->is('CreateProject') || request()->is('showCPT*') ? 'active' : ''}}">
                            <li class="submenu-item {{request()->is('index-createprincipal*') ? 'active' : ''}}">
                                <a href="/index-createprincipal">Create Principal</a>
                            </li>
                            <li class="submenu-item {{request()->is('index-createclient') ? 'active' : ''}}">
                                <a href="/index-createclient">Create Client</a>
                            </li>
                            <li class="submenu-item {{request()->is('index-createproject') || request()->is('CreateProject') || request()->is('showCPT*') ? 'active' : ''}}">
                                <a href="/index-createproject">Create Project</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="sidebar-item {{request()->is('PersonelTeam*') || request()->is('Client-Reimbursement*') || request()->is('OpptyProject*') || request()->is('Transaction-Maker/Reimbursement*') ? 'active' : ''}} has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-people-fill"></i>
                            <span>Reimbursement</span>
                        </a>
                        <ul class="submenu {{request()->is('PersonelTeam*') || request()->is('Client-Reimbursement*') || request()->is('OpptyProject*') || request()->is('Transaction-Maker/Reimbursement*') ? 'active' : ''}}">
                            <li class="submenu-item {{request()->is('PersonelTeam*') ? 'active' : ''}}">
                                <a href="{{ route('personelindex') }}">Create Personel Team</a>
                            </li>
                            <li class="submenu-item {{request()->is('Client-Reimbursement*') ? 'active' : ''}}">
                                <a href="{{ route('clientindex') }}">Create Client</a>
                            </li>
                            <li class="submenu-item {{request()->is('OpptyProject*') ? 'active' : ''}}">
                                <a href="{{ route('opptyprojectindex') }}">Create ID Oppty/Project</a>
                            </li>
                            {{-- <li class="submenu-item {{request()->is('Transaction-Maker/Reimbursement*') ? 'active' : ''}}">
                                <a href="{{ route('TMReimbursement') }}">Transaction Maker</a>
                            </li>
                            <li class="submenu-item {{request()->is('slistpa') ? 'active' : ''}}">
                                <a href="/">Transaction Maker Report</a>
                            </li> --}}
                        </ul>
                    </li>
                    
                    <li class="sidebar-item {{request()->is('DCL-DISTRIBUTOR*') || request()->is('DCL-SBU*') || request()->is('PIC-Distributor*') || request()->is('Transaction-Maker/DCL*') ? 'active' : ''}} has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-people-fill"></i>
                            <span>DCL</span>
                        </a>
                        <ul class="submenu {{request()->is('DCL-DISTRIBUTOR*') || request()->is('DCL-SBU*') || request()->is('PIC-Distributor*') || request()->is('Transaction-Maker/DCL*') ? 'active' : ''}}">
                            <li class="submenu-item {{request()->is('DCL-DISTRIBUTOR*') ? 'active' : ''}}">
                                <a href="{{ route('dcldistiindex') }}">Create Distributor</a>
                            </li>
                            <li class="submenu-item {{request()->is('DCL-SBU*') ? 'active' : ''}}">
                                <a href="{{ route('dclsbuindex') }}">Create SBU</a>
                            </li>
                            <li class="submenu-item {{request()->is('PIC-Distributor*') ? 'active' : ''}}">
                                <a href="{{ route('picdistiindex') }}">Create PIC Distributor</a>
                            </li>
                            {{-- <li class="submenu-item {{request()->is('Transaction-Maker/DCL*') ? 'active' : ''}}">
                                <a href="{{ route('TMDLCindex') }}">Transaction Maker</a>
                            </li>
                            <li class="submenu-item {{request()->is('slistpa') ? 'active' : ''}}">
                                <a href="/">Transaction Maker Report</a>
                            </li> --}}
                        </ul>
                    </li>
                    
                    <li class="sidebar-item {{request()->is('Project*') || request()->is('slistpa') ? 'active' : ''}} has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-people-fill"></i>
                            <span>CCM</span>
                        </a>
                        <ul class="submenu {{request()->is('Project*') || request()->is('slistpa') ? 'active' : ''}}">
                            <li class="submenu-item {{request()->is('Project*') ? 'active' : ''}}">
                                <a href="/index-createbank">Create Bank</a>
                            </li>
                            <li class="submenu-item {{request()->is('slistpa') ? 'active' : ''}}">
                                <a href="/index-PRK">Create PRK</a>
                            </li>
                            {{-- <li class="submenu-item {{request()->is('slistpa') ? 'active' : ''}}">
                                <a href="/index-TransactionMakerCMM">Transaction Maker</a>
                            </li>
                            <li class="submenu-item {{request()->is('slistpa') ? 'active' : ''}}">
                                <a href="/">Transaction Maker Report</a>
                            </li> --}}
                        </ul>
                    </li>

                    <li class="sidebar-item {{request()->is('SaldoAwal') || request()->is('Transaction-Maker/RevenuevsCost') || request()->is('Create/RevenuevsCost') || request()->is('Report-Transaction-Maker/RevenuevsCost') ? 'active' : ''}} has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-people-fill"></i>
                            <span>Revenue vs Cost</span>
                        </a>
                        <ul class="submenu {{request()->is('SaldoAwal') || request()->is('Transaction-Maker/RevenuevsCost') || request()->is('Create/RevenuevsCost') || request()->is('Report-Transaction-Maker/RevenuevsCost') ? 'active' : ''}}">
                            <li class="submenu-item {{request()->is('SaldoAwal') ? 'active' : ''}}">
                                <a href="{{ route('create-saldo') }}">Initial Balance</a>
                            </li>
                            {{-- <li class="submenu-item {{request()->is('Transaction-Maker/RevenuevsCost') || request()->is('Create/RevenuevsCost') ? 'active' : ''}}">
                                <a href="{{ route('TMRevCost') }}">Transaction Maker</a>
                            </li>
                            <li class="submenu-item {{request()->is('Report-Transaction-Maker/RevenuevsCost') ? 'active' : ''}}">
                                <a href="{{ route('TMakerRevCost') }}">Transaction Maker Report</a>
                            </li> --}}
                        </ul>
                    </li>
                    
                    <li class="sidebar-item  ">
                        <form action="/logout" method="POST" style="">
                            @csrf
                            <button class="btn btn-danger text-white w-100">Logout</button>
                        </form>
                    </li>
                    
                </ul>
                @endif

                @if (Auth::user()->hasRole('AM/Sales'))
                <ul class="menu">
                    <li class="sidebar-title">AM/SALES TOOLS</li>
                    
                    <li
                        class="sidebar-item {{request()->is('dashboardAmSales') ? 'active' : ''}}">
                        <a href="/dashboardAmSales" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <li
                        class="sidebar-item {{request()->is('slsorder') || request()->is('createodr') || request()->is('Sshow*') || request()->is('Sedit*') ? 'active' : ''}}">
                        <a href="/slsorder" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>LTO</span>
                        </a>
                    </li>

                    <li
                        class="sidebar-item {{request()->is('index-sales') || request()->is('inputsales') || request()->is('Ydetail*') || request()->is('Yedit*') ? 'active' : ''}}">
                        <a href="/index-sales" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Sales Pipeline</span>
                        </a>
                    </li>
                    
                    {{-- <li
                        class="sidebar-item {{request()->is('reportPTech') ? 'active' : ''}}">
                        <a href="/reportPTech" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Report Task Progress</span>
                        </a>
                    </li> --}}
                    <li
                        class="sidebar-item {{request()->is('Project*') || request()->is('slistpa') ? 'active' : ''}} has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-people-fill"></i>
                            <span>Project</span>
                        </a>
                        <ul class="submenu {{request()->is('Project*') || request()->is('slistpa') ? 'active' : ''}}">
                            <li class="submenu-item {{request()->is('Project*') ? 'active' : ''}}">
                                <a href="{{ route('VIEWLTODONE') }}">Project Deals</a>
                            </li>
                            <li class="submenu-item {{request()->is('slistpa') ? 'active' : ''}}">
                                <a href="/slistpa">Project Admin</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li
                        class="sidebar-item {{request()->is('selearning') ? 'active' : ''}}">
                        <a href="/selearning" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Elearning</span>
                        </a>
                    </li>
                    
                    <li
                        class="sidebar-item  ">
                        <form action="/logout" method="POST" style="">
                            @csrf
                            <button class="btn btn-danger text-white w-100">Logout</button>
                        </form>
                    </li>
                    
                </ul>
                @endif

                @if (Auth::user()->hasRole('Management'))
                <ul class="menu">
                    <li class="sidebar-title">MANAGEMENT TOOLS</li>
                    
                    <li 
                        class="sidebar-item {{request()->is('umdashboard') || request()->is('ProjectsAll') || request()->is('ProjectMenang') || request()->is('ProjectKalah') || request()->is('ProjectBastOven') || request()->is('projectBastHold')|| request()->is('projectBastCompleted')  ? 'active' : ''}}">
                        <a href="/umdashboard" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    
                    <li
                    class="sidebar-item {{request()->is('approval') || request()->is('inputTwo') || request()->is('detailapproval/*') ? 'active' : ''}} has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-clipboard-fill"></i>
                        <span>LTO</span>
                    </a>
                    <ul class="submenu {{request()->is('approval') || request()->is('inputTwo')|| request()->is('detailapproval/*') ? 'active' : ''}}">
                        <li
                            class="submenu-item {{request()->is('approval') || request()->is('detailapproval/*') ? 'active' : ''}}">
                            <a href="{{ route('approval') }}" class=''>
                                <span>List LTO</span>
                            </a>
                        </li>
                        <li
                            class="submenu-item {{request()->is('inputTwo') || request()->is('detailapproval*') ? 'active' : ''}}">
                            <a href="{{ route('inputTwo') }}" class=''>
                                <span>Approval</span>
                            </a>
                        </li>
                    </ul>
                    <li
                        class="sidebar-item {{request()->is('projects-all') ||request()->is('showP/*')  ? 'active' : ''}}">
                        <a href="{{route('projects-all')}}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Projects</span>
                        </a>
                    </li>

                    {{-- pembelian / penagihan --}}
                    <li
                    class="d-none sidebar-item {{request()->is('') || request()->is('') || request()->is('') ? 'active' : ''}} has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-clipboard-fill"></i>
                        <span>Finance</span>
                    </a>
                    <ul class="submenu {{request()->is('') || request()->is('')|| request()->is('') ? 'active' : ''}}">
                        <li
                            class="submenu-item {{request()->is('') || request()->is('') ? 'active' : ''}}">
                            <a href="" class=''>
                                <span>Billing</span>
                            </a>
                        </li>
                        <li
                            class="submenu-item {{request()->is('') || request()->is('') ? 'active' : ''}}">
                            <a href="" class=''>
                                <span>Purchase</span>
                            </a>
                        </li>
                    </ul>

                    <li
                    class="sidebar-item {{request()->is('umViewAdmin') || request()->is('umViewPiplane') || request()->is('umShowPiplane/*') || request()->is('umShowAdmin/*') ? 'active' : ''}} has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-clipboard-fill"></i>
                            <span>Report</span>
                        </a>
                        <ul class="submenu {{request()->is('umViewAdmin') || request()->is('umViewPiplane')|| request()->is('umShowPiplane/*') || request()->is('umShowAdmin/*') ? 'active' : ''}}">
                            <li
                                class="submenu-item {{request()->is('umViewAdmin') || request()->is('umShowAdmin/*') ? 'active' : ''}}">
                                <a href="{{ route('umViewAdmin') }}" class=''>
                                    <span>Report Admin</span>
                                </a>
                            </li>
                            <li
                            class="submenu-item {{request()->is('umViewPiplane') || request()->is('umShowPiplane/*') ? 'active' : ''}}">
                                <a href="{{ route('umViewPiplane') }}" class=''>
                                    <span>Report Pipeline</span>
                                </a>
                            </li>
                        </ul>
                        
                    </li>
                    <li
                        class="sidebar-item  ">
                        <form action="/logout" method="POST" style="">
                            @csrf
                            <button class="btn btn-danger text-white w-100">Logout</button>
                        </form>
                    </li>
                    
                </ul>
                @endif

                @if (Auth::user()->hasRole('PM'))
                <ul class="menu">
                    <li class="sidebar-title">PM TOOLS</li>
                    
                    <li
                        class="sidebar-item {{request()->is('dashboardpm') ? 'active' : ''}}">
                        <a href="/dashboardpm" class='sidebar-link'>
                            <i class="bi bi-box-seam"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li
                    class="sidebar-item {{request()->is('projects') || request()->is('detail_project*') ? 'active' : ''}}">
                        <a href="/projects" class='sidebar-link'>
                            <i class="bi bi-grid"></i>
                            <span>Projects</span>
                        </a>
                    </li>

                    <li
                    class="sidebar-item {{request()->is('data_report') ? 'active' : ''}} ">
                        <a href="/data_report" class='sidebar-link'>
                            <i class="bi bi-clipboard2"></i>
                            <span>Report</span>
                        </a>
                    </li>

                    {{-- <li
                        class="sidebar-item {{request()->is('list_project') || request()->is('list_so') || request()->is('list_sp') || request()->is('detail_pa*') || request()->is('detail_so*') || request()->is('detail_sp*') ? 'active' : ''}} has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-clipboard2"></i>
                            <span>Report</span>
                        </a>
                        <ul class="submenu {{request()->is('list_project') || request()->is('list_so') || request()->is('list_sp') || request()->is('detail_pa*') || request()->is('detail_so*') || request()->is('detail_sp*') ? 'active' : ''}}">
                            <li class="submenu-item {{request()->is('list_project') || request()->is('detail_pa*') ? 'active' : ''}}">
                                <a href="/list_project">Project Admin</a>
                            </li>
                            <li class="submenu-item {{request()->is('list_sp') || request()->is('detail_sp*') ? 'active' : ''}}">
                                <a href="/list_sp">Project Sales Pipeline</a>
                            </li>
                        </ul>
                    </li> --}}
                    

                    {{-- <li
                        class="sidebar-item {{request()->is('report-timeline') || request()->is('detail_report*') ? 'active' : ''}}">
                        <a href="/report-timeline" class='sidebar-link'>
                            <i class="bi-regular bi-files"></i>
                            <span>Report Timeline</span>
                        </a>
                    </li>

                    <li
                        class="sidebar-item {{request()->is('task') ? 'active' : ''}}">
                        <a href="/task" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Report Task Progress</span>
                        </a>
                    </li> --}}
                    
                    <li
                        class="sidebar-item  ">
                        <form action="/logout" method="POST" style="">
                            @csrf
                            <button class="btn btn-danger text-white w-100">Logout</button>
                        </form>
                    </li>
                    
                </ul>
                @endif

                @if (Auth::user()->hasRole('Technikal'))
                <ul class="menu">
                    <li class="sidebar-title">Technical TOOLS</li>
                    
                    <li
                        class="sidebar-item {{request()->is('dashboardTeknikal') ? 'active' : ''}}">
                        <a href="/dashboardTeknikal" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li
                        class="sidebar-item {{request()->is('viewproject') || request()->is('sales_order') || request()->is('viewtime') || request()->is('edit_list*') || request()->is('detailso*') || request()->is('detailtime*') || request()->is('projectsT*') ? 'active' : ''}} has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-clipboard-fill"></i>
                            <span>List View Project</span>
                        </a>
                        <ul class="submenu {{request()->is('viewproject') || request()->is('sales_order') || request()->is('viewtime') || request()->is('edit_list*') || request()->is('detailso*') || request()->is('detailtime*') || request()->is('projectsT*') ? 'active' : ''}}">
                            <li class="submenu-item {{request()->is('viewproject') || request()->is('edit_list*') ? 'active' : ''}}">
                                <a href="/viewproject">View Project Admin</a>
                            </li>
                            {{-- <li class="submenu-item {{request()->is('sales_order') || request()->is('detailso*') ? 'active' : ''}}">
                                <a href="/sales_order">View Project LTO</a>
                            </li> --}}
                            {{-- <li class="submenu-item {{request()->is('sales_pipeline') ? 'active' : ''}}">
                                <a href="/sales_pipeline">View Sales Pipeline</a>
                            </li> --}}
                            {{-- <li class="submenu-item {{request()->is('viewtime') || request()->is('detailtime*') ? 'active' : ''}}">
                                <a href="/viewtime">View Timeline</a>
                            </li> --}}
                            <li class="submenu-item {{request()->is('projectsT*')  ? 'active' : ''}}">
                                <a href="/projectsT">Project</a>
                            </li>
                        </ul>
                    </li>

                    <li
                    class="sidebar-item {{request()->is('sales_pipeline')  ? 'active' : ''}}">
                    <a href="/sales_pipeline" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Sales Pipeline</span>
                    </a>
                    </li>

                    <li
                        class="sidebar-item {{request()->is('telearning') || request()->is('create-elearning') || request()->is('Eedit*') ? 'active' : ''}}">
                        <a href="/telearning" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Elearning</span>
                        </a>
                    </li>
                    
                    
                    <li
                        class="sidebar-item  ">
                        <form action="/logout" method="POST" style="">
                            @csrf
                            <button class="btn btn-danger text-white w-100">Logout</button>
                        </form>
                    </li>
                    
                </ul>
                @endif
            </div>
        </div>
    </div>
</div>