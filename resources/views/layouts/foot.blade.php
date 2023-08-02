 <script src="{{ asset('templates/js/bootstrap.bundle.min.js') }}"></script>
 <!--plugins-->
 <script src="{{ asset('templates/js/jquery.min.js') }}"></script>
 <script src="{{ asset('templates/plugins/simplebar/js/simplebar.min.js') }}"></script>
 <script src="{{ asset('templates/plugins/input-tags/js/tagsinput.js') }}"></script>
 <script src="{{ asset('templates/plugins/metismenu/js/metisMenu.min.js') }}"></script>
 <!--app JS-->
 {{-- <script src="{{ asset('templates/js/app.js') }}"></script> --}}

 <script>
     $(() => {
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
     })
     setInterval(function() {
         var date = new Date();
         $('#clock-wrapper').html(
             date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds()
         );
     }, 500);
 </script>
