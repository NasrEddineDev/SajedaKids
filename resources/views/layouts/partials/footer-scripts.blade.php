   <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ URL::asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ URL::asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="{{ URL::asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ URL::asset('dist/js/feather.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ URL::asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/extra-libs/sparkline/sparkline.js') }}"></script>
    <!--Wave Effects -->
    <!-- themejs -->
    <!--Menu sidebar -->
    <script src="{{ URL::asset('dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ URL::asset('dist/js/custom.min.js') }}"></script>
    <!--This page plugins -->
    <script src="{{ URL::asset('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('dist/js/pages/datatable/datatable-basic.init.js') }}"></script>

   <script type="text/javascript">
   function changeLanguage() {
      var language = document.getElementById("changeLanguage").value;
      $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         type: 'GET',
         async: false,
         url: "setlocale/"+language,
         data: {},
         success: function(data) {
            
            window.location.href = data.url;
            return true;
         },
         error: function(data) {
            return false;
         }
      });
      
   }
   </script>
