<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('build/assets/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/css/app.css') }}">
    <style>
        #liveToast {
            margin-top: 3rem !important
        }

        #liveToast .toast-body.success {
            background-color: #6eff75;
        }

        #liveToast .toast-body.error {
            background-color: #ff5e14;
        }
    </style>
    @stack('styles')
</head>

<body>
    @auth('admin')
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 px-0">
                @include('admin.includes.sidebar')
            </div>

            <!-- Main Content -->
            <div class="col-md-10 main-wrapper">
                <div class="main-content">
                    <!-- Top Header -->
                    @include('admin.includes.header')
                    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <strong class="me-auto">Notification</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                <!-- هنا يمكنك وضع الرسالة التي تريد عرضها -->
                            </div>
                        </div>
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @else
    @yield('content')
    @endauth

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

    <script src="{{ asset('js/admin-sidebar.js') }}"></script>
    <script>
        // Function to show a toast
        function showToast(type, message) {
            $('#liveToast .toast-body').addClass(type).text(message);
            var toastElement = new bootstrap.Toast(document.getElementById('liveToast'));
            toastElement.show({
                delay: 50000 // 5 seconds
            });
        }

        $(document).ready(function() {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

            // Initialize all dropdowns
            $('.dropdown-toggle').dropdown();

            // Close other dropdowns when one is opened
            $('.dropdown').on('show.bs.dropdown', function() {
                $('.dropdown.show').not(this).removeClass('show').find('.dropdown-menu').removeClass('show');
            });

            // Close dropdown when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.dropdown').length) {
                    $('.dropdown').removeClass('show').find('.dropdown-menu').removeClass('show');
                }
            });

        });
    </script>

    <!-- Show a toast when a notification is triggered -->
    <!-- Check for session messages and show toast -->
    @if(session('success'))
    <script>
        showToast("success", "{{ session('success') }}");
    </script>
    @endif

    @if(session('error'))
    <script>
        showToast("error", "{{ session('error') }}");
    </script>
    @endif

    @if(session('info'))
    <script>
        showToast("info", "{{ session('info') }}");
    </script>
    @endif

    @if(session('warning'))
    <script>
        showToast("warning", "{{ session('warning') }}");
    </script>
    @endif
    @stack('scripts')
</body>

</html>