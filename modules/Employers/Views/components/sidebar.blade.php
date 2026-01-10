<main class="d-flex flex-nowrap sidebar">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi pe-none me-2" width="40" height="32" aria-hidden="true">
                <use xlink:href="#bootstrap"></use>
            </svg>
            <span class="fs-4">Sidebar</span>
        </a>
        <hr />
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href='{{ route('employee.dashboard') }}'
                    class="nav-link {{ ($active ?? '') === 'dashboard' ? 'active' : 'text-white' }}"
                    aria-current="page">
                    <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                        <use xlink:href="#home"></use>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('jobs.post') }}"
                    class="nav-link {{ ($active ?? '') === 'jobs' ? 'active' : 'text-white' }}">
                    <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                        <use xlink:href="#grid"></use>
                    </svg>
                    Create Job Posts
                </a>
            </li>
            <li>
                <a href="{{ route('jobs.list.view') }}"
                    class="nav-link {{ ($active ?? '') === 'jobs' ? 'active' : 'text-white' }}">
                    <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                        <use xlink:href="#grid"></use>
                    </svg>
                    Job Posts
                </a>
            </li>
            <li>
                <a href='{{ route('employee.profile') }}'
                    class="nav-link {{ ($active ?? '') === 'profile' ? 'active' : 'text-white' }}">
                    <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                        <use xlink:href="#people-circle"></use>
                    </svg>
                    Profile
                </a>
            </li>
        </ul>
        <hr />
        <div>
            <a href='{{ route('employee.logout') }}'
                class="nav-link d-flex align-items-center justify-content-center {{ ($active ?? '') === 'profile' ? 'active' : 'text-white' }}">
                <div class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                    <i class="bi bi-box-arrow-left"></i>
                </div>
                Log Out
            </a>
        </div>
    </div>
