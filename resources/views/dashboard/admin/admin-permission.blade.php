@include('dashboard.partials.main')

<head>

    @include('dashboard.partials.head-title-meta', ["title" => "Admin"])

     <!-- link css -->

    @include('dashboard.partials.head-css')

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('dashboard.partials.topbar')
        @include('dashboard.partials.sidebar')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content overflow-hidden">

            <div class="page-content">
                <div class="container-fluid">

                    @include('dashboard.partials.page-title', ["pagetitle" => "Admin Permission", "title" => "Admin Permission"])
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-md-6 col-lg-12">
                                    <x-card :title="'Data Akun'">
                                        <div class="px-2">
                                            <p><strong>Email:</strong> {{ $userData['email'] }}</p>
                                            <p><strong>Username:</strong> {{ $userData['username'] }}</p>
                                            <p><strong>Fullname:</strong> {{ $userData['fullname'] }}</p>
                                            <p><strong>Divisi:</strong>
                                               {{ $userData['group']['name'] }}
                                            </p>
                                            <p><strong>Jabatan:</strong> {{ $userData['role'] }}</p>
                                        </div>
                                    </x-card>
                                </div>
                                <div class="col-md-6 col-lg-12">
                                    <x-card :title="'Permission'">

                                        @if(!empty($userData['permissions']) && count($userData['permissions']) > 0)
                                            @foreach($userData['permissions'] as $group => $permissions)
                                                <span class="fw-bold px-2">{{ $group }}</span>
                                                <ul>
                                                    @foreach($permissions as $perm)
                                                        <li>{{ $perm }}</li>
                                                    @endforeach
                                                </ul>
                                            @endforeach
                                        @else
                                            <span class="text-center">Tidak memiliki permission</span>
                                        @endif

                                    </x-card>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h4 class="mb-0">Edit Permission
                                </h4>
                                <div class="d-flex align-items-center gap-3">
                                      <form id="permissionForm" class="mt-3 text-end">
                                        <button id="submitButton" class="btn btn-primary fw-bold" type="submit"><span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span> <span id="buttonText"><i class="mdi mdi-send-outline"></i> Kirim Data</span></button>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="returned-error"></div>
                                    <div class="minimal-border w-100">
                                        <!-- Accordion Grid -->
                                        <div class="row g-3">
                                            @foreach ($categories as $category)
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="accordion" id="accordion-{{ $category['id'] }}">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="heading-{{ $category['id'] }}">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $category['id'] }}" aria-expanded="false" aria-controls="collapse-{{ $category['id'] }}">
                                                                    {{ $category['name'] }}
                                                                </button>
                                                            </h2>
                                                            <div id="collapse-{{ $category['id'] }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $category['id'] }}">
                                                                <div class="accordion-body">
                                                                    <!-- Permissions List -->
                                                                    <ul class="list-group">
                                                                        @foreach ($category['permissions'] as $permission)
                                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                                <span>{{ $permission['name'] }}</span>
                                                                                <input type="checkbox"
                                                                                        name="permissions[]"
                                                                                        value="{{ $permission['id'] }}"
                                                                                        data-id="{{ $permission['id'] }}"
                                                                                        data-category="{{ $category['id'] }}"
                                                                                        {{ checkPermission($permission['name'], $userData['permissions']) ? 'checked' : '' }}>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>

                            <!-- Add this function in your Blade template or Controller to check the permission dynamically -->
                            @php
                                function checkPermission($permissionName, $permissions) {
                                    foreach ($permissions as $category => $categoryPermissions) {
                                        if (in_array($permissionName, $categoryPermissions)) {
                                            return true;
                                        }
                                    }
                                    return false;
                                }
                            @endphp

                        </div>
                    </div>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include("dashboard.partials.footer")
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->
    @include("dashboard.partials.scripts-js")
    <script>
        $(document).ready(function() {
            let permissionsToGrant = [];
            let permissionsToRevoke = [];
            let alreadyGrantedPermissions = [];
            let paramId = {{ $userData['id'] }};
            let submitButton = $('#submitButton');
            let totalRequests = 0;
            let completedRequests = 0;

            submitButton.prop('disabled', true);
            $('input[type="checkbox"]').each(function() {
                if ($(this).is(':checked')) {
                    alreadyGrantedPermissions.push($(this).val());
                }
            });
            $('input[type="checkbox"]').change(function() {
                const permissionId = $(this).val();
                const isChecked = $(this).is(':checked');
                if (isChecked) {
                    if (!alreadyGrantedPermissions.includes(permissionId) && !permissionsToGrant.includes(permissionId)) {
                        permissionsToGrant.push(permissionId);
                    }
                    permissionsToRevoke = permissionsToRevoke.filter(id => id !== permissionId);
                } else {
                    if (!alreadyGrantedPermissions.includes(permissionId) && permissionsToGrant.includes(permissionId)) {
                        permissionsToGrant = permissionsToGrant.filter(id => id !== permissionId);
                    } else if (alreadyGrantedPermissions.includes(permissionId)) {
                        permissionsToRevoke.push(permissionId);
                    }
                }
                submitButton.prop('disabled', permissionsToGrant.length === 0 && permissionsToRevoke.length === 0);
            });
            $('#permissionForm').on('submit', function(e) {
                e.preventDefault();
                const dataToSendGrant = { permission_ids: permissionsToGrant };
                const dataToSendRevoke = { permission_ids: permissionsToRevoke };
                totalRequests = (permissionsToGrant.length > 0 ? 1 : 0) + (permissionsToRevoke.length > 0 ? 1 : 0);

                $('#spinner').removeClass('d-none');
                $('#buttonText').text('Processing...');
                submitButton.prop('disabled', true);
                if (permissionsToGrant.length > 0) {
                    sendGrantRequest(dataToSendGrant);
                }
                if (permissionsToRevoke.length > 0) {
                    sendRevokeRequest(dataToSendRevoke);
                }
                if (totalRequests === 0) {
                    handlePageReload();
                }
            });
            function sendGrantRequest(permissionIds) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('permission-grant', ':paramId') }}".replace(':paramId', paramId),
                    method: 'POST',
                    data: permissionIds,
                    dataType: 'json',
                    success: function(data) {
                        if (!data.error) {
                            $('#returned-error').html(data.message.returned);
                        }
                    },
                    complete: function() {
                        trackRequestCompletion();
                    }
                });
            }
            function sendRevokeRequest(permissionIds) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('permission-revoke', ':paramId') }}".replace(':paramId', paramId),
                    method: 'POST',
                    data: permissionIds,
                    dataType: 'json',
                    success: function(data) {
                        if (!data.error) {
                            $('#returned-error').html(data.message.returned);
                        }
                    },
                    complete: function() {
                        trackRequestCompletion();
                    }
                });
            }
            function trackRequestCompletion() {
                completedRequests++;
                if (completedRequests === totalRequests) {
                    handlePageReload();
                }
            }
            function handlePageReload() {
                $('#spinner').addClass('d-none');
                $('#buttonText').text('Kirim Data');
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }
        });
    </script>
</body>

</html>
