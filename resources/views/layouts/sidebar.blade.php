
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
     
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          
          <a href="{{route('home')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>

        <li class="treeview">
           @can('user_index')
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>User management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">     
        <li><a href="{{route('Users.index')}}"><i class="fa fa-circle-o"></i> Users</a></li>
         </ul>
         @endcan
        </li>
         <li class="treeview">
          @can('role_index')
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Role management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
            <li><a href="{{route('Roles.index')}}"><i class="fa fa-circle-o"></i>Roles</a></li>
         </ul>
         @endcan
        </li>
          <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Permission management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
            <li><a href="{{route('permission.index')}}"><i class="fa fa-circle-o"></i>Permissions</a></li>
         </ul>
        </li>
        <li class="treeview">
          @can('banner_index')
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Banner management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('banners.index')}}"><i class="fa fa-circle-o"></i>Banner</a></li>
            
            <!-- -->
        </ul>
        @endcan
        </li>

         <li class="treeview">
           @can('category_index')
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Category management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('category.index')}}"><i class="fa fa-circle-o"></i>categories</a></li>
           </ul>
           @endcan
        </li>
       
         <li class="treeview">
           @can('product_index')
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Product management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('products.index')}}"><i class="fa fa-circle-o"></i>Products</a></li>
           </ul>
            @endcan
        </li>
        <li class="treeview">
           @can('coupon_index')
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Coupon Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('coupon.index')}}"><i class="fa fa-circle-o"></i>Coupons</a></li>
           </ul>
           @endcan
        </li>

          <li class="treeview">
            @can('contact_us_index')
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Manage User Contacts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('manage_user_contacts.index')}}"><i class="fa fa-circle-o"></i>Contacts</a></li>
           </ul>
           @endcan
        </li>
         <li class="treeview">
           @can('email_template_index')
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Manage User mails</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('manage_user_email.index')}}"><i class="fa fa-circle-o"></i>Manage Mails</a></li>
           </ul>
           @endcan
        </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Cms</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('cms.index')}}"><i class="fa fa-circle-o"></i>Manage Cms</a></li>
           </ul>
        </li>
         <li class="treeview">
           @can('order_detail_index')
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Order Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('order_management.index')}}"><i class="fa fa-circle-o"></i>Manage Order</a></li>
           </ul>
           @endcan
        </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('report')}}"><i class="fa fa-circle-o"></i>Sales Report</a></li>
            <li><a href="{{url('/customer-report')}}"><i class="fa fa-circle-o"></i>Customers Report</a></li>
           </ul>
           
        </li>
       
       
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li>
        
      </ul>
     
    </section>
    <!-- /.sidebar -->
  </aside>
  
