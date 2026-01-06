<div x-data="{ show: false, message: '', type: 'success' }" x-init="@if (session('success')) message = '{{ session('success') }}';
            type = 'success';
            show = true;
        @elseif(session('error'))
            message = '{{ session('error') }}';
            type = 'danger';
            show = true;
        @elseif(session('warning'))
            message = '{{ session('warning') }}';
            type = 'warning';
            show = true;
        @elseif(session('info'))
            message = '{{ session('info') }}';
            type = 'info';
            show = true; @endif
if (show) setTimeout(() => show = false, 3000);" x-show="show" x-transition
    style="position: fixed; top: 1rem; right: 1rem; border-width:3px; z-index: 9999; min-width: 250px;background:white;"
    :class="{
        'alert alert-success': type === 'success',
        'alert alert-danger': type === 'danger',
        'alert alert-warning': type === 'warning',
        'alert alert-info': type === 'info',
    }"
    role="alert">
    <i :class="{
        'bi-check-circle-fill me-2 text-success': type === 'success',
        'bi-exclamation-triangle-fill me-2 text-warning': type === 'warning',
        'bi-info-circle-fill me-2 text-info': type === 'info',
        'bi-x-circle-fill me-2 text-danger': type === 'danger',
    }"
        aria-hidden="true"></i>

    <span x-text="message"></span>
</div>
