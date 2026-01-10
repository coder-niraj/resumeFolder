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
                <a href='{{ route('user.dashboard') }}'
                    class="nav-link {{ ($active ?? '') === 'dashboard' ? 'active' : 'text-white' }}"
                    aria-current="page">
                    <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                        <use xlink:href="#home"></use>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href='{{ route('application.list') }}'
                    class="nav-link {{ ($active ?? '') === 'application' ? 'active' : 'text-white' }}"
                    aria-current="page">
                    <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                        <use xlink:href="#home"></use>
                    </svg>
                    Applications
                </a>
            </li>
            <li class="nav-item">
                <a href='{{ route('user.jobs') }}'
                    class="nav-link {{ ($active ?? '') === 'jobs' ? 'active' : 'text-white' }}" aria-current="page">
                    <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                        <use xlink:href="#home"></use>
                    </svg>
                    Search jobs
                </a>
            </li>
            <li class="nav-item">
                <a href='{{ route('user.saved') }}'
                    class="nav-link {{ ($active ?? '') === 'saved' ? 'active' : 'text-white' }}" aria-current="page">
                    <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                        <use xlink:href="#home"></use>
                    </svg>
                    Saved jobs
                </a>
            </li>

            <li class="nav-item">
                <a href='{{ route('user.profile') }}'
                    class="nav-link {{ ($active ?? '') === 'profile' ? 'active' : 'text-white' }}" aria-current="page">
                    <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                        <use xlink:href="#home"></use>
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
