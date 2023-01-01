
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Login</title>
    <link href="{{asset('/assets')}}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{asset('/assets')}}/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<div class="container-fluid">
    <br><br><br>
    <h1 class="h3 mb-2 text-gray-800">Users</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User List</h6>
            <a class="btn btn-success" href="javascript:void(0)" id="Newcreate" style="float: right">+Yeni Kullanıcı Ekle</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="dataTable_length"></div></div><div class="col-sm-12 col-md-6"><div id="dataTable_filter" class="dataTables_filter"></div></div></div><div class="row"><div class="col-sm-12">
                            <table  class="table table-bordered data-table" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th rowspan="1" colspan="1">Name</th>
                                    <th rowspan="1" colspan="1">Surname</th>
                                    <th rowspan="1" colspan="1">City</th>
                                    <th rowspan="1" colspan="1">Update</th>
                                    <th rowspan="1" colspan="1">Delete</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                                       <!--CREATE -->
<div class="modal fade" id="ajaxModel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalHeading"></h4>
                </div>
               <div class="modal-body">
                   <form id="studentForm" name="studentForm" class="form-horizon">
                       <div class="form-group">
                           Name:<br>
                           <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" required>
                       </div>
                       <div class="form-group">
                           Surname:<br>
                           <input type="text" class="form-control" id="surname" name="surname" placeholder="Enter Surname" value="" required>
                       </div>
                       <div class="form-group">
                           City:<br>
                           <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" value="" required>
                       </div>
                   </form>
               </div>
               <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save</button>

           </div>
       </div>
</div>

                               <!--UPDATE -->

<div class="modal fade" id="UpdateModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="UpdateFormStudent" name="UpdateForm" class="form-horizon">
                    @csrf
                    <div class="form-group">
                        Name:<br>
                        <input type="text" class="form-control" id="Update_name" name="name" placeholder="Enter Name" value="" required>
                    </div>
                    <div class="form-group">
                        Surname:<br>
                        <input type="text" class="form-control" id="Update_surname" name="surname" placeholder="Enter Surname" value="" required>
                    </div>
                    <div class="form-group">
                        City:<br>
                        <input type="text" class="form-control" id="Update_city" name="city" placeholder="Enter City" value="" required>
                    </div>
                </form>
            </div>
            <button type="submit" class="btn btn-primary" id="UpdateBtnStudent" >Update</button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="{{asset('/assets')}}/vendor/jquery/jquery.min.js"></script>
<script src="{{asset('/assets')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('/assets')}}/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="{{asset('/assets')}}/js/sb-admin-2.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
</body>
<script type="text/javascript">
    $(function (){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table=$(".data-table").DataTable({
            serverSide:true,
            processing:true,
            ajax:"{{route('index')}}",
            columns:[
                {data:'name',name:'name'},
                {data:'surname',name:'surname'},
                {data:'city',name:'city'},
                {data:'update',name:'update'},
                {data:'delete',name:'delete'}
            ]
        });

        $("#Newcreate").click(function (){
            $('#studentForm').trigger("reset");
            $('#modalHeading').html("Add User");
            $('#ajaxModel').modal('show');
        });
        $('#saveBtn').click(function (e){
            e.preventDefault();
            $(this).html('Save');
            var formData = new FormData(document.getElementById('studentForm'));
            $.ajax({
                data: formData,
                url: "{{route('store')}}",
                type: "POST",
                dataType: "json",
                headers: {'X-CSRF-TOKEN': "{{csrf_token()}} "},
                contentType: false,
                cache: false,
                processData: false,
                success:function (data){
                    $('#studentForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
                },
                error:function (data){
                    console.log('Error',data);
                    $("#saveBtn").html('Save');
                }
            });
        });


        $('body').on('click','.deleteStudent', function (){
            var id = $(this).val();
            confirm("Are you sure want to delete!");
            $.ajax({
                type:"POST",
                url:"{{route('destroy')}}",
                data:{
                    id:id
                },
                dataType: "json",
                headers: {'X-CSRF-TOKEN': "{{csrf_token()}} "},
                contentType: false,
                cache: false,
                processData: false,
                success:function (response){
                    console.log(response)
                }
            });
        });

        $('body').on('click', '.editStudent',function (e) {
            e.preventDefault();
            var id = $(this).val();
            //console.log(id);
            $('#UpdateModel').modal('show');
            $.ajax({
                type: "GET",
                url: "/edit/"+id,
                dataType: "json",
                headers: {'X-CSRF-TOKEN': "{{csrf_token()}} "},
                contentType: false,
                cache: false,
                processData: false,
                success:function (response) {
                    $('#Update_name').val(response.name)
                    $('#Update_surname').val(response.surname)
                    $('#Update_city').val(response.city)
                }
            });
        });

        $('#UpdateBtnStudent').click(function (e) {
            e.preventDefault();
            var formData = new FormData(document.getElementById('UpdateFormStudent'));
            $.ajax({
                data: formData,
                url: "{{route('update')}}",
                type: "POST",
                dataType: "json",
                headers: {'X-CSRF-TOKEN': "{{csrf_token()}} "},
                contentType: false,
                cache: false,
                processData: false,
                success:function (data){
                    table.draw();
                },
            });

        });


    });

</script>
</html>
