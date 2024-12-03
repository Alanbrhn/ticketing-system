


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="dist/css/tabler.min.css?1692870487" rel="stylesheet"/>
    <link href="dist/css/tabler-flags.min.css?1692870487" rel="stylesheet"/>
    <link href="dist/css/tabler-payments.min.css?1692870487" rel="stylesheet"/>
    <link href="dist/css/tabler-vendors.min.css?1692870487" rel="stylesheet"/>
    <link href="dist/css/demo.min.css?1692870487" rel="stylesheet"/>
    @livewireStyles
    <title>Document</title>
</head>
<body>
    <script src="dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page">
        <!-- Sidebar -->
        {{-- @include('layout.sidebar') --}}
        @livewire('core.sidebar-menu')
        <!-- Navbar -->
        @include('layout.navbar')
        <div class="page-wrapper">
            <!-- Page header -->
            {{-- <div class="page-header d-print-none">
                <div class="container-xl">
                  <div class="row g-2 align-items-center">
                    <div class="col">
                      <!-- Page pre-title -->
                      <div class="page-pretitle">
                        Overview
                      </div>
                      <h2 class="page-title">
                        Combo layout
                      </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                      <div class="btn-list">
                        <span class="d-none d-sm-inline">
                          <a href="#" class="btn">
                            New view
                          </a>
                        </span>
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                          <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                          Create new report
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                          <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> --}}
            <!-- Page body -->
            @include('layout.pageBody')
            <!-- footer -->
            @include('layout.footer')
        </div>
    </div>

<script src="dist/libs/apexcharts/dist/apexcharts.min.js?1692870487" defer></script>
<script src="dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1692870487" defer></script>
<script src="dist/libs/jsvectormap/dist/maps/world.js?1692870487" defer></script>
<script src="dist/libs/jsvectormap/dist/maps/world-merc.js?1692870487" defer></script>

<!-- datatable -->
<script src="dist/libs/list.js/dist/list.min.js?1692870487" defer></script>

<!-- Tabler Core -->
<script src="dist/js/tabler.min.js?1692870487" defer></script>
<script src="dist/js/demo.min.js?1692870487" defer></script>

<!-- Livewire -->
@livewireScripts

<!-- Modal Sukses-->
<div class="modal modal-blur fade" id="modal-success" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-status bg-success"></div>
      <div class="modal-body text-center py-4">
        <!-- Download SVG icon from http://tabler-icons.io/i/circle-check -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-green icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" /></svg>
        <h3>Payment succedeed</h3>
        <div class="text-secondary">Your payment of $290 has been successfully submitted. Your invoice has been sent to support@tabler.io.</div>
      </div>
      <div class="modal-footer">
        <div class="w-100">
          <div class="row">
            <div class="col"><a href="#" class="btn me-auto" data-bs-dismiss="modal">
              Close
              </a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal Danger-->
<div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-status bg-danger"></div>
      <div class="modal-body text-center py-4">
        <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" /><path d="M12 9v4" /><path d="M12 17h.01" /></svg>
        <h3>Are you sure?</h3>
        <div class="text-secondary">Do you really want to remove 84 files? What you've done cannot be undone.</div>
      </div>
      <div class="modal-footer">
        <div class="w-100">
          <div class="row">
            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                Cancel
              </a></div>
            <div class="col"><a href="#" class="btn btn-danger w-100" data-bs-dismiss="modal">
                Delete
              </a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>

