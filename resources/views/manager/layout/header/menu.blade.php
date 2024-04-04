  <div class="menu menu-rounded menu-active-bg menu-state-primary menu-column menu-lg-row menu-title-gray-700 menu-icon-gray-500 menu-arrow-gray-500 menu-bullet-gray-500 my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0"
      id="kt_app_header_menu" data-kt-menu="true">
      <!--begin:Menu item-->
      <div data-kt-menu-placement="bottom-start"
          class="menu-item {{ str_contains(request()->url(), 'manager/dashboard') ? 'here show' : '' }}  menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
          <!--begin:Menu link-->
          <a class="menu-link" href="{{ route('manager.dashboard.index') }}">
              <span class="menu-title">Bảng điều kiển</span>
          </a>
          <!--end:Menu link-->
      </div>
      <!--end:Menu item-->

      <!--begin:Menu item-->
      <div data-kt-menu-placement="bottom-start"
          class="menu-item {{ str_contains(request()->url(), 'manager/user') ? 'here show' : '' }}  menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
          <!--begin:Menu link-->
          <a class="menu-link" href="{{ route('manager.user.list-page') }}">
              <span class="menu-title">Danh sách người dùng</span>
          </a>
          <!--end:Menu link-->
      </div>
      <!--end:Menu item-->

      <!--begin:Menu item-->
      <div data-kt-menu-placement="bottom-start"
          class="menu-item {{ str_contains(request()->url(), 'manager/course') ? 'here show' : '' }}  menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
          <!--begin:Menu link-->
          <a class="menu-link" href="{{ route('manager.course.list-page') }}">
              <span class="menu-title">Danh sách khóa học</span>
          </a>
          <!--end:Menu link-->
      </div>
      <!--end:Menu item-->

      <!--begin:Menu item-->
      <div data-kt-menu-placement="bottom-start"
          class="menu-item {{ str_contains(request()->url(), 'manager/resource-management') ? 'here show' : '' }} menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
          <!--begin:Menu link-->
          <a class="menu-link" href="{{ route('manager.resource-management.list-page') }}">
              <span class="menu-title">Quản lý tài nguyên</span>
          </a>
          <!--end:Menu link-->
      </div>
      <!--end:Menu item-->

  </div>
