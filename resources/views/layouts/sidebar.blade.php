<div class="sidebar-wrapper">
                <div class="logo">
                    <a href="/home" class="simple-text">
                       Store
                    </a>
                </div>
                <ul class="nav">
                    <li class="nav-item @if($selected == 'dashboard') active @endif">
                        <a class="nav-link" href="/home">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    @if(Auth::user()->role == "Administrator")
                    <li class="@if($selected == 'employee') active @endif">
                        <a class="nav-link" href="{{route('employee.index')}}">
                            <i class="nc-icon nc-circle-09"></i>
                            <p>Employees</p>
                        </a>
                    </li>
                    @endif
                    <li class="@if($selected == 'product') active @endif">
                        <a class="nav-link" href="{{route('product.index')}}">
                            <i class="nc-icon nc-credit-card"></i>
                            <p>Products</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="">
                            <i class="nc-icon nc-paper-2"></i>
                            <p>Customers</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="">
                            <i class="nc-icon nc-atom"></i>
                            <p>Complaints</p>
                        </a>
                    </li>
                  
                    <li>
                        <a class="nav-link" href="">
                            <i class="nc-icon nc-bell-55"></i>
                            <p>Reports</p>
                        </a>
                    </li>
                    <li class="nav-item active active-pro">
                        <a class="nav-link active" href="upgrade.html">
                            <i class="nc-icon nc-alien-33"></i>
                            <p>Upgrade to PRO</p>
                        </a>
                    </li>
                </ul>
            </div>