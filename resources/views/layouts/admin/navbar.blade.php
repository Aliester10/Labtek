<?php
use App\Models\Order;
use App\Models\Payment;
use App\Models\TParameter;

$unseenOrders = Order::where('is_viewed_by_admin', false)->get();

// Fetch unpaid or pending payments (you can adjust the status as needed)
$unseenPayments = Payment::where('is_viewed_by_admin', false)
                          ->whereIn('status', [Payment::STATUS_UNPAID, Payment::STATUS_PENDING])
                          ->get();

$unseenOrderCount = $unseenOrders->count();
$unseenPaymentCount = $unseenPayments->count();

$parameter = TParameter::first();

$totalUnseenCount = $unseenOrderCount + $unseenPaymentCount;
        

?>
<div class="main-panel">
    <div class="main-header">
      <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
          <a href="{{ route('dashboard') }}" class="logo">
            <img
              src=""
              alt="navbar brand"
              class="navbar-brand"
              height="20"
            />
          </a>
          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
              <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
              <i class="gg-menu-left"></i>
            </button>
          </div>
          <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
          </button>
        </div>
        <!-- End Logo Header -->
      </div>
      <!-- Navbar Header -->
      <nav
        class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
      >
        <div class="container-fluid">

          <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
            <li
              class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none"
            >
              <a
                class="nav-link dropdown-toggle"
                data-bs-toggle="dropdown"
                href="#"
                role="button"
                aria-expanded="false"
                aria-haspopup="true"
              >
                <i class="fa fa-search"></i>
              </a>
              <ul class="dropdown-menu dropdown-search animated fadeIn">
                <form class="navbar-left navbar-form nav-search">
                  <div class="input-group">
                    <input
                      type="text"
                      placeholder="Search ..."
                      class="form-control"
                    />
                  </div>
                </form>
              </ul>
            </li>
            {{-- <li class="nav-item topbar-icon dropdown hidden-caret">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="messageDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="fa fa-envelope"></i>
              </a>
              <ul
                class="dropdown-menu messages-notif-box animated fadeIn"
                aria-labelledby="messageDropdown"
              >
                <li>
                  <div
                    class="dropdown-title d-flex justify-content-between align-items-center"
                  >
                    Messages
                    <a href="#" class="small">Mark all as read</a>
                  </div>
                </li>
                <li>
                  <div class="message-notif-scroll scrollbar-outer">
                    <div class="notif-center">
                      <a href="#">
                        <div class="notif-img">
                          <img
                            src="assets/img/jm_denis.jpg"
                            alt="Img Profile"
                          />
                        </div>
                        <div class="notif-content">
                          <span class="subject">Jimmy Denis</span>
                          <span class="block"> How are you ? </span>
                          <span class="time">5 minutes ago</span>
                        </div>
                      </a>
                      <a href="#">
                        <div class="notif-img">
                          <img
                            src="assets/img/chadengle.jpg"
                            alt="Img Profile"
                          />
                        </div>
                        <div class="notif-content">
                          <span class="subject">Chad</span>
                          <span class="block"> Ok, Thanks ! </span>
                          <span class="time">12 minutes ago</span>
                        </div>
                      </a>
                      <a href="#">
                        <div class="notif-img">
                          <img
                            src="assets/img/mlane.jpg"
                            alt="Img Profile"
                          />
                        </div>
                        <div class="notif-content">
                          <span class="subject">Jhon Doe</span>
                          <span class="block">
                            Ready for the meeting today...
                          </span>
                          <span class="time">12 minutes ago</span>
                        </div>
                      </a>
                      <a href="#">
                        <div class="notif-img">
                          <img
                            src="assets/img/talha.jpg"
                            alt="Img Profile"
                          />
                        </div>
                        <div class="notif-content">
                          <span class="subject">Talha</span>
                          <span class="block"> Hi, Apa Kabar ? </span>
                          <span class="time">17 minutes ago</span>
                        </div>
                      </a>
                    </div>
                  </div>
                </li>
                <li>
                  <a class="see-all" href="javascript:void(0);"
                    >See all messages<i class="fa fa-angle-right"></i>
                  </a>
                </li>
              </ul>
            </li> --}}

      <li class="nav-item topbar-icon dropdown hidden-caret">
          <a
              class="nav-link dropdown-toggle"
              href="#"
              id="notifDropdown"
              role="button"
              data-bs-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
          >
          <i class="fa fa-bell position-relative"></i>
          @if ($totalUnseenCount > 0)
              <span class="badge badge-danger position-absolute translate-middle rounded-circle">
                  {{ $totalUnseenCount }}
              </span>
          @endif
          
          </a>
          <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
            <li>
                <div class="dropdown-title">
                    You have new notifications
                </div>
            </li>
            <li>
                <div class="notif-scroll scrollbar-outer">
                    <div class="notif-center">
        
                        <!-- Unseen Orders -->
                        @foreach($unseenOrders as $order)
                            <a href="{{ route('admin.orders.show', $order->id) }}">
                                <div class="notif-icon notif-primary">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                                <div class="notif-content">
                                    <span class="block">New Order #{{ $order->id }} - {{ $order->user->userdetail->perusahaan ?? 'Unknown Company' }}</span>
                                    <span class="time">{{ $order->created_at->diffForHumans() }}</span>
                                    <span class="status">{{ $order->statusMessage() }}</span> <!-- Displaying the status message -->
                                </div>
                            </a>
                        @endforeach
        
                        <!-- Unseen Payments -->
                        @foreach($unseenPayments as $payment)
                            <a href="{{ route('admin.payments.index') }}">
                                <div class="notif-icon notif-success">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <div class="notif-content">
                                    <span class="block">New Payment for Order #{{ $payment->order->id }} - Status: {{ $payment->statusMessage() }}</span>
                                    <span class="time">{{ $payment->created_at->diffForHumans() }}</span>
                                </div>
                            </a>
                        @endforeach
        
                    </div>
                </div>
            </li>
            <li>
                <a class="see-all" href="{{ route('admin.orders.index') }}">
                    See all notifications <i class="fa fa-angle-right"></i>
                </a>
            </li>
        </ul>
        
      </li>

          
            <li class="nav-item topbar-icon dropdown hidden-caret">
              <a
                class="nav-link"
                data-bs-toggle="dropdown"
                href="#"
                aria-expanded="false"
              >
                <i class="fas fa-layer-group"></i>
              </a>
              <div class="dropdown-menu quick-actions animated fadeIn">
                <div class="quick-actions-header">
                  <span class="title mb-1">Quick Actions</span>
                  <span class="subtitle op-7">Shortcuts</span>
                </div>
                <div class="quick-actions-scroll scrollbar-outer">
                  <div class="quick-actions-items">
                    <div class="row m-0">
                      <a class="col-6 col-md-4 p-0" href="{{ route('admin.orders.index') }}">
                        <div class="quick-actions-item">
                            <div class="avatar-item bg-warning rounded-circle">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <span class="text">Order</span>
                        </div>
                    </a>                    
                    <a class="col-6 col-md-4 p-0" href="{{ route('admin.product.create') }}">
                      <div class="quick-actions-item">
                          <div class="avatar-item bg-info rounded-circle">
                              <i class="fas fa-plus-circle"></i>
                          </div>
                          <span class="text">Create Product</span>
                      </div>
                  </a>
                  
                  <a class="col-6 col-md-4 p-0" href="{{-- {{ route('bigsale.index') }} --}}">
                    <div class="quick-actions-item">
                        <div class="avatar-item bg-success rounded-circle">
                            <i class="fas fa-tags"></i>
                        </div>
                        <span class="text">Big Sale</span>
                    </div>
                </a>
                
                      <a class="col-6 col-md-4 p-0" href="{{ route('users.index') }}">
                        <div class="quick-actions-item">
                            <div class="avatar-item bg-primary rounded-circle">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <span class="text">Cek User</span>
                        </div>
                    </a>
                    
                    <a class="col-6 col-md-4 p-0" href="{{ route('admin.product.index') }}">
                      <div class="quick-actions-item">
                          <div class="avatar-item bg-secondary rounded-circle">
                              <i class="fas fa-boxes"></i>
                          </div>
                          <span class="text">Product</span>
                      </div>
                  </a>
                  
                    </div>
                  </div>
                </div>
              </div>
            </li>

            <li class="nav-item topbar-user dropdown hidden-caret">
              <a
                class="dropdown-toggle profile-pic"
                data-bs-toggle="dropdown"
                href="#"
                aria-expanded="false"
              >
                <div class="avatar-sm">
                  <img
                    src="{{ asset('assets/images/labtek_wo_text.png') }}"
                    alt="..."
                    class="avatar-img rounded-circle"
                  />
                </div>
                <span class="profile-username">
                  <span class="op-7">Hi,</span>
                  <span class="fw-bold">{{ Auth::user()->name }}</span>
                </span>
              </a>
              <ul class="dropdown-menu dropdown-user animated fadeIn">
                <div class="dropdown-user-scroll scrollbar-outer">
                  <li>
                    <div class="user-box">
                      <div class="avatar-lg">
                        <img
                          src="{{ asset('assets/images/labtek_wo_text.png') }}"
                          alt="image profile"
                          class="avatar-img rounded"
                        />
                      </div>
                      <div class="u-text">
                        <h4>{{ Auth::user()->name }}</h4>
                        <p class="text-muted">{{ Auth::user()->email }}</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                     Logout
                 </a>
                 
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                 </form>
                 
                  </li>
                </div>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
      <!-- End Navbar -->
    </div>