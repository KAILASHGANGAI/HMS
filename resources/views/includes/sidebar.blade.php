
<div class="sidebar">
    <h3 class="text-center sidebar-text"> </h3>
    @if (auth()->user()->is_admin)
    <!-- Tours Dropdown in Sidebar -->
    <a href="#Deposits" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="fas fa-dollar-sign"></i> <span class="sidebar-text">Deposits</span>
    </a>
    <ul class="collapse list-unstyled" id="Deposits">

        <li><a href="{{ route('deposits.index') }}" class="ms-4"><i class="fas fa-tasks"></i> <span
                    class="sidebar-text">Deposits List</span></a></li>
    </ul>
    <!-- Tours Dropdown in Sidebar -->
    <a href="#user" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="fas fa-user"></i> <span class="sidebar-text">Users</span>
    </a>
    <ul class="collapse list-unstyled" id="user">
        <li><a href="{{ route('users.create') }}" class="ms-4"><i class="fas fa-plus"></i> <span
                    class="sidebar-text">Add Users</span></a></li>
        <li><a href="{{ route('users.index') }}" class="ms-4"><i class="fas fa-tasks"></i> <span
                    class="sidebar-text">User List</span></a></li>
    </ul>

    <!-- Tours Dropdown in Sidebar -->
    <a href="#customer" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="fas fa-users"></i> <span class="sidebar-text">Customer</span>
    </a>
    <ul class="collapse list-unstyled" id="customer">
        <li><a href="{{ route('customers.create') }}" class="ms-4"><i class="fas fa-plus"></i> <span
                    class="sidebar-text">Add Customer</span></a></li>
        <li><a href="{{ route('customers.index') }}" class="ms-4"><i class="fas fa-tasks"></i> <span
                    class="sidebar-text">Customer List</span></a></li>
                    <li><a href="{{ route('runnungCustomer') }}" class="ms-4"><i class="fas fa-tasks"></i> <span
                        class="sidebar-text">Running Sites List</span></a></li>      


    </ul>

    <!-- Tours Dropdown in Sidebar -->
    <a href="#Expences" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="fas fa-dollar-sign"></i> <span class="sidebar-text">Expenses</span>
    </a>
    <ul class="collapse list-unstyled" id="Expences">
        <li><a href="{{ route('expenses.create') }}" class="ms-4"><i class="fas fa-plus"></i> <span
                    class="sidebar-text">Add Expenses</span></a></li>
        <li><a href="{{ route('expenses.index') }}" class="ms-4"><i class="fas fa-tasks"></i> <span
                    class="sidebar-text">Expenses List</span></a></li>
    </ul>

    <!-- Tours Dropdown in Sidebar -->
    <a href="#estimate" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="fas fa-globe"></i> <span class="sidebar-text">Contractors</span>
    </a>
    <ul class="collapse list-unstyled" id="estimate">
        <li><a href="{{ route('contractors.create') }}" class="ms-4"><i class="fas fa-plus"></i> <span
                    class="sidebar-text">Add Contractors</span></a></li>
        <li><a href="{{ route('contractors.index') }}" class="ms-4"><i class="fas fa-tasks"></i> <span
                    class="sidebar-text">Contractors List </span></a></li>
    </ul>
    @else

    
    <a href="{{ route('myCustomers') }}" >
        <i class="fas fa-route"></i> <span class="sidebar-text">My Custoers List</span>
    </a>
    <a href="{{ route('customers.index') }}" >
        <i class="fas fa-route"></i> <span class="sidebar-text">All Custoers List</span>
    </a>


    @endif
</div>
