@extends('layout.master')

@section('sidebar')

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">

            <div class="sidebar-brand-text">Spinning Tracing</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="dashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>
        @if(Session('role')==='admin')

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
               aria-expanded="true" aria-controls="collapseFour">
                <i class="fas fa-fw fa-cog"></i>
                <span>Pending List</span>
            </a>



            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded"  id="zsml_pending" style="display: none">
                    <h6 class="collapse-header"></h6>
                    <a class="collapse-item" href="/ZSML/pr_pending_list">PR Pending List</a>
                    <a class="collapse-item" href="/ZSML/po_pending_list">PO Pending List</a>
                </div>
                <div class="bg-white py-2 collapse-inner rounded"  id="ysml_pending" style="display: none">
                    <h6 class="collapse-header"></h6>
                    <a class="collapse-item" href="/YSML/pr_pending_list">PR Pending List</a>
                    <a class="collapse-item" href="/YSML/po_pending_list">PO Pending List</a>
                </div>
                <div class="bg-white py-2 collapse-inner rounded"  id="zusml_pending" style="display: none">
                    <h6 class="collapse-header"></h6>
                    <a class="collapse-item" href="/ZuSML/pr_pending_list">PR Pending List</a>
                    <a class="collapse-item" href="/ZuSML/po_pending_list">PO Pending List</a>
                </div>
            </div>
        </li>
        @endif


        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Setting</span>
            </a>


         <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             @if(Session('role')!='admin')

             <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header"></h6>
                 <a class="collapse-item" href="/{{Session('role')}}/lc_buyer">LC Buyer</a>
                 <a class="collapse-item" href="/{{Session('role')}}/lc_buyer_list">LC Buyer List</a>
                 <a class="collapse-item" href="/{{Session('role')}}/type_of_raw_material">Type Of Raw Material</a>
                 <a class="collapse-item" href="/{{Session('role')}}/type_of_raw_material_list">Type Of Raw Material List</a>
                 <a class="collapse-item" href="/{{Session('role')}}/name_of_material">Name Of Material</a>
                 <a class="collapse-item" href="/{{Session('role')}}/name_of_material_list">Name Of Material List</a>
                 <a class="collapse-item" href="/{{Session('role')}}/seller">Seller</a>
                 <a class="collapse-item" href="/{{Session('role')}}/seller_list">Seller List</a>


                </div>

             @endif
             @if(Session('role')==='admin')

             <div class="bg-white py-2 collapse-inner rounded"  id="ZSML" style="display: none">
                 <h6 class="collapse-header"></h6>
                 <a class="collapse-item" href="/ZSML/lc_buyer">LC Buyer</a>
                 <a class="collapse-item" href="/ZSML/lc_buyer_list">LC Buyer List</a>
                 <a class="collapse-item" href="/ZSML/type_of_raw_material">Type Of Raw Material</a>
                 <a class="collapse-item" href="/ZSML/type_of_raw_material_list">Type Of Raw Material List</a>
                 <a class="collapse-item" href="/ZSML/name_of_material">Name Of Material</a>
                 <a class="collapse-item" href="/ZSML/name_of_material_list">Name Of Material List</a>
                 <a class="collapse-item" href="/ZSML/seller">Seller</a>
                 <a class="collapse-item" href="/ZSML/seller_list">Seller List</a>
             </div>

              <div class="bg-white py-2 collapse-inner rounded" id="YSML" style="display: none">
                         <h6 class="collapse-header"></h6>
                  <a class="collapse-item" href="/YSML/lc_buyer">LC Buyer</a>
                  <a class="collapse-item" href="/YSML/lc_buyer_list">LC Buyer List</a>
                  <a class="collapse-item" href="/YSML/type_of_raw_material">Type Of Raw Material</a>
                  <a class="collapse-item" href="/YSML/type_of_raw_material_list">Type Of Raw Material List</a>
                  <a class="collapse-item" href="/YSML/name_of_material">Name Of Material</a>
                  <a class="collapse-item" href="/YSML/name_of_material_list">Name Of Material List</a>
                  <a class="collapse-item" href="/YSML/seller">Seller</a>
                  <a class="collapse-item" href="/YSML/seller_list">Seller List</a>
              </div>

               <div class="bg-white py-2 collapse-inner rounded" id="ZuSML" style="display: none" >
                         <h6 class="collapse-header"></h6>
                   <a class="collapse-item" href="/ZuSML/lc_buyer">LC Buyer</a>
                   <a class="collapse-item" href="/ZuSML/lc_buyer_list">LC Buyer List</a>
                   <a class="collapse-item" href="/ZuSML/type_of_raw_material">Type Of Raw Material</a>
                   <a class="collapse-item" href="/ZuSML/type_of_raw_material_list">Type Of Raw Material List</a>
                   <a class="collapse-item" href="/ZuSML/name_of_material">Name Of Material</a>
                   <a class="collapse-item" href="/ZuSML/name_of_material_list">Name Of Material List</a>
                   <a class="collapse-item" href="/ZuSML/seller">Seller</a>
                   <a class="collapse-item" href="/ZuSML/seller_list">Seller List</a>
                </div>

                 @endif
            </div>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
               aria-expanded="true" aria-controls="collapseThree">
                <i class="fas fa-fw fa-cog"></i>
                <span>Store</span>
            </a>

            <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                @if(Session('role')!='admin')
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/{{Session('role')}}/pr_creation">PR Creation</a>
                    <a class="collapse-item" href="/{{Session('role')}}/pr_list">PR List</a>
                    <a class="collapse-item" href="/{{Session('role')}}/po_creation">PO Creation</a>
                    <a class="collapse-item" href="/{{Session('role')}}/po_list">PO List</a>
                    <a class="collapse-item" href="/{{Session('role')}}/po_receive">PO Receive</a>
                    <a class="collapse-item" href="/{{Session('role')}}/barcode">Barcode</a>
{{--                    <a class="collapse-item" href="raw_material_report">Raw Material Report</a>--}}
                    <a class="collapse-item" href="/{{Session('role')}}/raw_material">Raw Material Report</a>

                </div>
                @endif

                 @if(Session('role')==='admin')


                 <div class="bg-white py-2 collapse-inner rounded" id="zsml_store" style="display: none">
                    <a class="collapse-item" href="/ZSML/pr_creation">PR Creation</a>
                     <a class="collapse-item" href="/ZSML/pr_list">PR List</a>

                     <a class="collapse-item" href="/ZSML/po_creation">PO Creation</a>
                     <a class="collapse-item" href="/ZSML/po_list">PO List</a>

                     <a class="collapse-item" href="/ZSML/po_receive">PO Receive</a>
                    <a class="collapse-item" href="/ZSML/barcode">Barcode</a>
                    {{--                    <a class="collapse-item" href="raw_material_report">Raw Material Report</a>--}}
                    <a class="collapse-item" href="/ZSML/raw_material">Raw Material Report</a>
                 </div>

                    <div class="bg-white py-2 collapse-inner rounded" id="ysml_store" style="display: none">
                            <a class="collapse-item" href="/YSML/pr_creation">PR Creation</a>
                        <a class="collapse-item" href="/YSML/pr_list">PR List</a>

                        <a class="collapse-item" href="/YSML/po_creation">PO Creation</a>
                        <a class="collapse-item" href="/YSML/po_list">PO List</a>

                        <a class="collapse-item" href="/YSML/po_receive">PO Receive</a>
                            <a class="collapse-item" href="/YSML/barcode">Barcode</a>
                            {{--                    <a class="collapse-item" href="raw_material_report">Raw Material Report</a>--}}
                            <a class="collapse-item" href="/YSML/raw_material">Raw Material Report</a>
                    </div>

                        <div class="bg-white py-2 collapse-inner rounded" id="zusml_store" style="display: none">
                            <a class="collapse-item" href="/ZuSML/pr_creation">PR Creation</a>
                            <a class="collapse-item" href="/ZuSML/pr_list">PR List</a>
                            <a class="collapse-item" href="/ZuSML/po_creation">PO Creation</a>
                            <a class="collapse-item" href="/ZuSML/po_list">PO List</a>
                            <a class="collapse-item" href="/ZuSML/po_receive">PO Receive</a>
                            <a class="collapse-item" href="/ZuSML/barcode">Barcode</a>
                            {{--                    <a class="collapse-item" href="raw_material_report">Raw Material Report</a>--}}
                            <a class="collapse-item" href="/ZuSML/raw_material">Raw Material Report</a>
                        </div>
                    @endif

            </div>
        </li>
    </ul>

    <!-- End of Sidebar -->

@endsection

@section('main_content')

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <div>User Role Is : </div>{{Session('role')}}
            @if('admin'===Session('role'))
           <div   class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
               <div class="input-group">
                   <div class="input-group-append">
                       <button class="btn btn-primary" type="button" onclick="org_name()">
                           Change Org

                       </button>
                   </div>
                   <select class="form-control" name="org" id="org" v-model="pr_number">
                       <option value="selected">Select Org.</option>

                       <option value="ZSML">ZSML</option>
                       <option value="YSML">YSML</option>
                       <option value="ZuSML">ZuSML</option>
                   </select>

                </div>
           </div>
            @endif

            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                         aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                       placeholder="Search for..." aria-label="Search"
                                       aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter">3+</span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                         aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Alerts Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 12, 2019</div>
                                <span class="font-weight-bold">A new monthly report is ready to download!</span>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-success">
                                    <i class="fas fa-donate text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 7, 2019</div>
                                $290.29 has been deposited into your account!
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-warning">
                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 2, 2019</div>
                                Spending Alert: We've noticed unusually high spending for your account.
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                    </div>
                </li>

                <!-- Nav Item - Messages -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-envelope fa-fw"></i>
                        <!-- Counter - Messages -->
                        <span class="badge badge-danger badge-counter">7</span>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                         aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                            Message Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">

                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div class="font-weight-bold">
                                <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                    problem I've been having.</div>
                                <div class="small text-gray-500">Emily Fowler · 58m</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">

                                <div class="status-indicator"></div>
                            </div>
                            <div>
                                <div class="text-truncate">I have the photos that you ordered last month, how
                                    would you like them sent to you?</div>
                                <div class="small text-gray-500">Jae Chun · 1d</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">

                                <div class="status-indicator bg-warning"></div>
                            </div>
                            <div>
                                <div class="text-truncate">Last month's report looks great, I am very happy with
                                    the progress so far, keep up the good work!</div>
                                <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">

                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div>
                                <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                    told me that people say this to all dogs, even if they aren't good...</div>
                                <div class="small text-gray-500">Chicken the Dog · 2w</div>
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Session('role')}}</span>

                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                         aria-labelledby="userDropdown">

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">

           @yield('dashboard_main_content')
        </div>
        <!--end Page Content -->

    </div>
    <!-- End of Main Content -->

@endsection



@section('script')
    <script !src="">
        function org_name(){

             let org= document.getElementById("org").value;
             let url=window.location.href;
             let pre=""
             let prefix="";
             for (let i=url.length-1;i>0;i--){
                 if(url[i]!="/"){
                    prefix=prefix+url[i];
                    console.log(prefix)
                 }
                 if(url[i]==="/"){
                    break;
                 }
             }
            for (let i=prefix.length-1;i>=0;i--) {
                pre=pre+prefix[i];
            }


            window.location.href = window.location.origin+ '/'+org+'/'+pre;





        }
        function pr_creation() {
            let url=window.location.href;

            let pre=""
            let count=0;
            for (let i=0;i<url.length;i++){
                if(url[i]==="/"){
                    count++;
                }
                if(count>=4){
                    break
                }
                else{
                    pre=pre+url[i];

                }
            }
            window.location.href=pre+"/pr_creation";

            $(this).addClass('nav_hover_color')
            $(this).closest('li').addClass('active');
            $(this).closest('.collapse').addClass('show');

        }


        function po_creation() {
            let url=window.location.href;

            let pre=""
            let count=0;
            for (let i=0;i<url.length;i++){
                if(url[i]==="/"){
                    count++;
                }
                if(count>=4){
                    break
                }
                else{
                    pre=pre+url[i];

                }
            }
            window.location.href=pre+"/po_creation";

        }

        function po_receive() {
            let url=window.location.href;

            let pre=""
            let count=0;
            for (let i=0;i<url.length;i++){
                if(url[i]==="/"){
                    count++;
                }
                if(count>=4){
                    break
                }
                else{
                    pre=pre+url[i];

                }
            }
            window.location.href=pre+"/po_receive";

        }

        function barcode() {
            let url=window.location.href;

            let pre=""
            let count=0;
            for (let i=0;i<url.length;i++){
                if(url[i]==="/"){
                    count++;
                }
                if(count>=4){
                    break
                }
                else{
                    pre=pre+url[i];

                }
            }
            window.location.href=pre+"/barcode";
        }





        function lc_buyer() {
            let url=window.location.href;

            let pre=""
            let count=0;
            for (let i=0;i<url.length;i++){
                if(url[i]==="/"){
                    count++;
                }
                if(count>=4){
                    break
                }
                else{
                    pre=pre+url[i];

                }
            }

            window.location.href=pre+"/lc_buyer";
        }

        function type_of_raw_material() {
            let url=window.location.href;

            let pre=""
            let count=0;
            for (let i=0;i<url.length;i++){
                if(url[i]==="/"){
                    count++;
                }
                if(count>=4){
                    break
                }
                else{
                    pre=pre+url[i];

                }
            }
            window.location.href=pre+"/type_of_raw_material";

        }


        function name_of_material() {
            let url=window.location.href;

            let pre=""
            let count=0;
            for (let i=0;i<url.length;i++){
                if(url[i]==="/"){
                    count++;
                }
                if(count>=4){
                    break
                }
                else{
                    pre=pre+url[i];

                }
            }
            window.location.href=pre+"/name_of_material";

        }


        function seller() {
            let url=window.location.href;

            let pre=""
            let count=0;
            for (let i=0;i<url.length;i++){
                if(url[i]==="/"){
                    count++;
                }
                if(count>=4){
                    break
                }
                else{
                    pre=pre+url[i];

                }
            }
            window.location.href=pre+"/seller";



        }
        $(document).ready(function() {
            var url = location.pathname.split('/').slice(-2)[0]+"/"+location.pathname.split('/').slice(-1)[0];
            jQuery('ul#accordionSidebar li div div a').each(function() {

                let org=location.pathname.split('/').slice(-2)[0];

                var myEle = document.getElementById("ZSML");
                if(myEle) {
                    if (org === "ZSML") {

                        document.getElementById("ZSML").style.display = "block";
                        document.getElementById("YSML").style.display = "none";
                        document.getElementById("ZuSML").style.display = "none";
                        document.getElementById("zsml_store").style.display = "block";
                        document.getElementById("ysml_store").style.display = "none";
                        document.getElementById("zusml_store").style.display = "none";
                        document.getElementById("zsml_pending").style.display = "block";
                        document.getElementById("ysml_pending").style.display = "none";
                        document.getElementById("zusml_pending").style.display = "none";

                    } else if (org === "YSML") {

                        document.getElementById('ZSML').style.display = "none";
                        document.getElementById('YSML').style.display = "block";
                        document.getElementById('ZuSML').style.display = "none";
                        document.getElementById("zsml_store").style.display = "none";
                        document.getElementById("ysml_store").style.display = "block";
                        document.getElementById("zusml_store").style.display = "none";
                        document.getElementById("zsml_pending").style.display = "none";
                        document.getElementById("ysml_pending").style.display = "block";
                        document.getElementById("zusml_pending").style.display = "none";

                    } else if (org === "ZuSML") {
                        document.getElementById('ZSML').style.display = "none";
                        document.getElementById('YSML').style.display = "none";
                        document.getElementById('ZuSML').style.display = "block";
                        document.getElementById("zsml_store").style.display = "none";
                        document.getElementById("ysml_store").style.display = "none";
                        document.getElementById("zusml_store").style.display = "block";
                        document.getElementById("zsml_pending").style.display = "none";
                        document.getElementById("ysml_pending").style.display = "none";
                        document.getElementById("zusml_pending").style.display = "block";
                    }
                }


                if($(this).attr('href') == "/"+url)
                {
                    $(this).addClass('nav_hover_color')
                    $(this).closest('li').addClass('active');
                    $(this).closest('.collapse').addClass('show');

                }



            });

        });


    </script>




{{--    <!-- Page level plugins -->--}}
{{--    <script src="vendor/chart.js/Chart.js"></script>--}}

{{--    <!-- Page level custom scripts -->--}}
{{--    <script src="js/demo/chart-area-demo.js"></script>--}}
{{--    <script src="js/demo/chart-pie-demo.js"></script>--}}
@endsection

@yield('dashboard_script')
