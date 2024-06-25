<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
  <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
    <i class="la la-close">
    </i>
  </button>
  <div id="m_aside_left" style="background: black" class="m-grid__item  m-aside-left  m-aside-left--skin-dark ">
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
      <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
        <li class="m-menu__item  m-menu__item @yield('dashboard-active')" aria-haspopup="true">
          <a href="{{ route('admins.home') }}" class="m-menu__link ">
            <i class="m-menu__link-icon flaticon-line-graph">
            </i>
            <span class="m-menu__link-title">
              <span class="m-menu__link-wrap">
                <span class="m-menu__link-text">Dashboard
                </span>
              </span>
            </span>
          </a>
        </li>
        <li class="m-menu__section ">
          <h4 class="m-menu__section-text">Components
          </h4>
          <i class="m-menu__section-icon flaticon-more-v2">
          </i>
        </li>
        <!-- Start Admin Module -->
        <li class="m-menu__item  m-menu__item--submenu @yield('admins-active')" aria-haspopup="true"
            m-menu-submenu-toggle="hover">
          <a href="javascript:;" class="m-menu__link m-menu__toggle">
            <i class="m-menu__link-icon fa fa-users"> </i>
            <span class="m-menu__link-text">Admins </span>
            <i class="m-menu__ver-arrow la la-angle-right"></i>
          </a>
          <div class="m-menu__submenu ">
            <span class="m-menu__arrow"></span>
            <ul class="m-menu__subnav">
              <li class="m-menu__item @yield('admins-create-active')" aria-haspopup="true">
                <a href="{{route('admins.admin.create')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-icon fa fa-plus">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text"> Add New</span>
                </a>
              </li>
              <li class="m-menu__item @yield('admins-view-active')" aria-haspopup="true">
                <a href="{{route('admins.admin.index').'?view=view'}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-icon fa fa-eye">
                    <span> </span>
                  </i>
                  <span class="m-menu__link-text">View</span>
                </a>
              </li>
              <li class="m-menu__item @yield('admins-trash-active')" aria-haspopup="true">
                <a href="{{route('admins.admin.index').'?view=trash'}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-icon fa fa-trash">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text"> Recycle bin
                    <span class="m-menu__link-badge">
                      <span class="m-badge m-badge--danger" id="module-admins">
                        {{$adminTrashesCount}}
                      </span>
                    </span>
                  </span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <!-- End Admin Module -->

          <!-- Start Task Module -->
          <li class="m-menu__item  m-menu__item--submenu @yield('tasks-active')" aria-haspopup="true"
              m-menu-submenu-toggle="hover">
              <a href="javascript:;" class="m-menu__link m-menu__toggle">
                  <i class="m-menu__link-icon fa fa-users"> </i>
                  <span class="m-menu__link-text">Task </span>
                  <i class="m-menu__ver-arrow la la-angle-right"></i>
              </a>
              <div class="m-menu__submenu ">
                  <span class="m-menu__arrow"></span>
                  <ul class="m-menu__subnav">
                      <li class="m-menu__item @yield('tasks-create-active')" aria-haspopup="true">
                          <a href="{{route('admins.task.create')}}" class="m-menu__link ">
                              <i class="m-menu__link-bullet m-menu__link-icon fa fa-plus">
                                  <span></span>
                              </i>
                              <span class="m-menu__link-text"> Add New</span>
                          </a>
                      </li>
                      <li class="m-menu__item @yield('tasks-view-active')" aria-haspopup="true">
                          <a href="{{route('admins.task.index').'?view=view'}}" class="m-menu__link ">
                              <i class="m-menu__link-bullet m-menu__link-icon fa fa-eye">
                                  <span> </span>
                              </i>
                              <span class="m-menu__link-text">View</span>
                          </a>
                      </li>
                      <li class="m-menu__item @yield('tasks-trash-active')" aria-haspopup="true">
                          <a href="{{route('admins.task.index').'?view=trash'}}" class="m-menu__link ">
                              <i class="m-menu__link-bullet m-menu__link-icon fa fa-trash">
                                  <span></span>
                              </i>
                              <span class="m-menu__link-text"> Recycle bin
                    <span class="m-menu__link-badge">
                      <span class="m-badge m-badge--danger" id="module-tasks">
                        {{$taskTrashesCount}}
                      </span>
                    </span>
                  </span>
                          </a>
                      </li>
                  </ul>
              </div>
          </li>
          <!-- End Task Module -->
      </ul>
    </div>
  </div>
</div>
