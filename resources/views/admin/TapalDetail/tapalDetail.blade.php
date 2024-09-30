<x-admin.layout>
    <x-slot name="title">Tapal Details</x-slot>
    <x-slot name="heading">Tapal Details</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


        <!-- Add Form -->
        <div class="row" id="addContainer" style="display:none;">
            <div class="col-sm-12">
                <div class="card">
                    <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                        @csrf

                        <div class="card-header">
                            <h4 class="card-title">Add Tapal Detail</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">

                                <div class="col-md-4">
                                    <label class="col-form-label" for="letter_type">Letter Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="letter_type" id="letter_type">
                                        <option value="">Select Letter Type</option>
                                        @foreach ($letter_type_list as $list)
                                            <option value="{{ $list->id }}">{{ $list->letter_type_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger is-invalid letter_type_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="department">Department<span class="text-danger">*</span></label>
                                    <select class="form-control" name="department" id="department">
                                        <option value="">Select Department</option>
                                        @foreach ($department_list as $list)
                                            <option value="{{ $list->id }}" @if(isset($selected_department) && $selected_department == $list->id) 
                                                selected 
                                            @endif>{{ $list->department_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger is-invalid department_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="name">Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="Enter Name">
                                    <span class="text-danger is-invalid name_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="city">City <span class="text-danger">*</span></label>
                                    <input class="form-control" id="city" name="city" type="text" placeholder="Enter City">
                                    <span class="text-danger is-invalid city_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="address">Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="address" id="address" cols="30" rows="2" placeholder="Enter Address"></textarea>
                                    <span class="text-danger is-invalid address_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="pin">Pin <span class="text-danger">*</span></label>
                                    <input class="form-control" id="pin" name="pin" type="number" placeholder="Enter Pin">
                                    <span class="text-danger is-invalid pin_err"></span>
                                </div>

                                <div class="col-md-4 ref-no">
                                    <label class="col-form-label" for="referance_no">Reference No <span class="text-danger">*</span></label>
                                    <input class="form-control" id="referance_no" name="referance_no" type="text" placeholder="Enter Referance No">
                                    <span class="text-danger is-invalid referance_no_err"></span>
                                </div>

                                <div class="col-md-4 barcode-no">
                                    <label class="col-form-label" for="barcode_no">Barcode No <span class="text-danger">*</span></label>
                                    <input class="form-control" id="barcode_no" name="barcode_no" type="text" placeholder="Enter Barcode No" required>
                                    <span class="text-danger is-invalid barcode_no_err"></span>
                                </div>

                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="addSubmit">Submit</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        {{-- Edit Form --}}
        <div class="row" id="editContainer" style="display:none;">
            <div class="col">
                <form class="form-horizontal form-bordered" method="post" id="editForm">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Tapal Detail</h4>
                        </div>
                        <div class="card-body py-2">
                            <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                            <div class="mb-3 row">

                                <div class="col-md-4">
                                    <label class="col-form-label" for="letter_type">Letter Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="letter_type" id="letter_type">
                                        <option value="">Select Letter Type</option>
                                        @foreach ($letter_type_list as $list)
                                            <option value="{{ $list->id }}">{{ $list->letter_type_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger is-invalid letter_type_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="department">Department<span class="text-danger">*</span></label>
                                    <select class="form-control" name="department" id="department">
                                        <option value="">Select Department</option>
                                        @foreach ($department_list as $list)
                                            <option value="{{ $list->id }}">{{ $list->department_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger is-invalid department_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="name">Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="Enter Name">
                                    <span class="text-danger is-invalid name_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="city">City <span class="text-danger">*</span></label>
                                    <input class="form-control" id="city" name="city" type="text" placeholder="Enter City">
                                    <span class="text-danger is-invalid city_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="address">Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="address" id="address" cols="30" rows="2" placeholder="Enter Address"></textarea>
                                    <span class="text-danger is-invalid address_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="pin">Pin <span class="text-danger">*</span></label>
                                    <input class="form-control" id="pin" name="pin" type="number" placeholder="Enter Pin">
                                    <span class="text-danger is-invalid pin_err"></span>
                                </div>

                                <div class="col-md-4 ref-no-edit">
                                    <label class="col-form-label" for="referance_no">Reference No <span class="text-danger">*</span></label>
                                    <input class="form-control" id="referance_no_edit" name="referance_no" type="text" placeholder="Enter Referance No">
                                    <span class="text-danger is-invalid referance_no_err"></span>
                                </div>

                                <div class="col-md-4 barcode-no-edit">
                                    <label class="col-form-label" for="barcode_no">Barcode No <span class="text-danger">*</span></label>
                                    <input class="form-control" id="barcode_no_edit" name="barcode_no" type="text" placeholder="Enter Barcode No" required>
                                    <span class="text-danger is-invalid barcode_no_err"></span>
                                </div>

                            </div>

                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" id="editSubmit">Submit</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @can(['tapaldetail.add'])
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="">
                                        <button id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus"></i></button>
                                        <button id="btnCancel" class="btn btn-danger" style="display:none;">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcan
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Name</th>
                                        <th>Letter Type</th>
                                        <th>Department</th>
                                        <th>Reference No</th>
                                        <th>Barcode No</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tapal_detail as $index => $list)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $list->name }}</td>
                                            <td>{{ $list->letter_type_name }}</td>
                                            <td>{{ $list->department_name }}</td>
                                            <td>{{ $list->referance_no ?? 'NA' }}</td>
                                            <td>{{ $list->barcode_no ?? 'NA' }}</td>
                                            <td>
                                                @if (auth()->user()->roles->pluck('name')[0] == "Admin" || auth()->user()->roles->pluck('name')[0] == "Super Admin")
                                                    <button class="accept-element btn btn-sm btn-primary px-2 py-1" title="Accept" data-id="{{ $list->id }}">Approve</button>
                                                @endif
                                                @can(['tapaldetail.edit'])
                                                    <button class="edit-element btn text-secondary px-2 py-1" title="Edit form" data-id="{{ $list->id }}"><i data-feather="edit"></i></button>
                                                @endcan
                                                @can(['tapaldetail.delete'])
                                                    <button class="btn text-danger rem-element px-2 py-1" title="Delete form" data-id="{{ $list->id }}"><i data-feather="trash-2"></i> </button>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>




</x-admin.layout>


{{-- Add --}}
<script>
    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('tapal-details.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data)
            {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                        .then((action) => {
                            window.location.href = '{{ route('tapal-details.index') }}';
                        });
                else
                    swal("Error!", data.error2, "error");
            },
            statusCode: {
                422: function(responseObject, textStatus, jqXHR) {
                    $("#addSubmit").prop('disabled', false);
                    resetErrors();
                    printErrMsg(responseObject.responseJSON.errors);
                },
                500: function(responseObject, textStatus, errorThrown) {
                    $("#addSubmit").prop('disabled', false);
                    swal("Error occured!", "Something went wrong please try again", "error");
                }
            }
        });

    });
</script>


<!-- Edit -->
<script>
    $("#buttons-datatables").on("click", ".edit-element", function(e) {
        e.preventDefault();
        var model_id = $(this).attr("data-id");
        var url = "{{ route('tapal-details.edit', ":model_id") }}";

        $.ajax({
            url: url.replace(':model_id', model_id),
            type: 'GET',
            data: {
                '_token': "{{ csrf_token() }}"
            },
            success: function(data, textStatus, jqXHR) {
                editFormBehaviour();
                console.log(data);
                
                if (!data.error)
                {
                    $("#editForm input[name='edit_model_id']").val(data.tapal_detail.id);
                    $("#editForm select[name='letter_type']").val(data.tapal_detail.letter_type);
                    $("#editForm select[name='department']").val(data.tapal_detail.department);
                    $("#editForm input[name='name']").val(data.tapal_detail.name);
                    $("#editForm textarea[name='address']").val(data.tapal_detail.address);
                    $("#editForm input[name='city']").val(data.tapal_detail.city);
                    $("#editForm input[name='pin']").val(data.tapal_detail.pin);
                    $("#editForm input[name='referance_no']").val(data.tapal_detail.referance_no);
                    $("#editForm input[name='barcode_no']").val(data.tapal_detail.barcode_no);
                    
                    var letterType = $("#editForm select[name='letter_type'] option:selected").text();

                    if (letterType === "Ordinary") {
                        $(".ref-no-edit").hide();
                        $(".barcode-no-edit").hide();
                    } else {
                        $(".ref-no-edit").show();
                        $(".barcode-no-edit").show();
                    }
                    
                }
                else
                {
                    alert(data.error);
                }
            },
            error: function(error, jqXHR, textStatus, errorThrown) {
                alert("Some thing went wrong");
            },
        });
    });
</script>


<!-- Update -->
<script>
    $(document).ready(function() {
        $("#editForm").submit(function(e) {
            e.preventDefault();
            $("#editSubmit").prop('disabled', true);
            var formdata = new FormData(this);
            formdata.append('_method', 'PUT');
            var model_id = $('#edit_model_id').val();
            var url = "{{ route('tapal-details.update', ":model_id") }}";
            //
            $.ajax({
                url: url.replace(':model_id', model_id),
                type: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
                success: function(data)
                {
                    $("#editSubmit").prop('disabled', false);
                    if (!data.error2)
                        swal("Successful!", data.success, "success")
                            .then((action) => {
                                window.location.href = '{{ route('tapal-details.index') }}';
                            });
                    else
                        swal("Error!", data.error2, "error");
                },
                statusCode: {
                    422: function(responseObject, textStatus, jqXHR) {
                        $("#editSubmit").prop('disabled', false);
                        resetErrors();
                        printErrMsg(responseObject.responseJSON.errors);
                    },
                    500: function(responseObject, textStatus, errorThrown) {
                        $("#editSubmit").prop('disabled', false);
                        swal("Error occured!", "Something went wrong please try again", "error");
                    }
                }
            });

        });
    });
</script>


<!-- Delete -->
<script>
    $("#buttons-datatables").on("click", ".rem-element", function(e) {
        e.preventDefault();
        swal({
            title: "Are you sure to delete this tapal Detail?",
            // text: "Make sure if you have filled Vendor details before proceeding further",
            icon: "info",
            buttons: ["Cancel", "Confirm"]
        })
        .then((justTransfer) =>
        {
            if (justTransfer)
            {
                var model_id = $(this).attr("data-id");
                var url = "{{ route('tapal-details.destroy', ":model_id") }}";

                $.ajax({
                    url: url.replace(':model_id', model_id),
                    type: 'POST',
                    data: {
                        '_method': "DELETE",
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(data, textStatus, jqXHR) {
                        if (!data.error && !data.error2) {
                            swal("Success!", data.success, "success")
                                .then((action) => {
                                    window.location.reload();
                                });
                        } else {
                            if (data.error) {
                                swal("Error!", data.error, "error");
                            } else {
                                swal("Error!", data.error2, "error");
                            }
                        }
                    },
                    error: function(error, jqXHR, textStatus, errorThrown) {
                        swal("Error!", "Something went wrong", "error");
                    },
                });
            }
        });
    });
</script>

{{-- accept --}}

<script>
    $(".accept-element").on("click", function(e) {
        e.preventDefault();
        swal({
            title: "Are you sure to approve this Tapal details?",
            icon: "info",
            buttons: ["Cancel", "Confirm"]
        })
        .then((willApprove) => {
            if (willApprove) {
                var model_id = $(this).data("id"); // Assuming you have data-id attribute on the button
                var url = "{{ route('approveTapalDetails', ":model_id") }}";

                $.ajax({
                    url: url.replace(':model_id', model_id),
                    type: 'POST',
                    data: {
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.success) {
                            swal("Success!", data.success, "success")
                                .then(() => {
                                    window.location.reload();
                                });
                        } else {
                            swal("Error!", data.error, "error");
                        }
                    },
                    error: function(error) {
                        swal("Error!", "Something went wrong", "error");
                    },
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        function toggleReferenceFields() {
            var letterType = $("#letter_type option:selected").text();

            if (letterType === "Ordinary") {
                // $(".ref-no").hide();
                $(".barcode-no").hide();

                // $("#referance_no").removeAttr('required');
                $("#barcode_no").removeAttr('required');
            } else {
                // $(".ref-no").show();
                $(".barcode-no").show();
        
                // $("#referance_no").attr('required', 'required');
                $("#barcode_no").attr('required', 'required');
            }
        }

        toggleReferenceFields();

        $("#letter_type").change(function() {
            toggleReferenceFields();
        });
    });
</script>

<script>
    $(document).ready(function() {
        function edittoggleReferenceFields() {
            var letterType = $("#editForm select[name='letter_type'] option:selected").text();

            if (letterType === "Ordinary") {
                // $(".ref-no-edit").hide();
                $(".barcode-no-edit").hide();
                $("#barcode_no_edit").removeAttr('required');
                // $("#referance_no_edit").removeAttr('required');
            } else {
                // $(".ref-no-edit").show();
                $(".barcode-no-edit").show();
                $("#barcode_no_edit").val('');
                // $("#referance_no_edit").val('');
                $("#barcode_no_edit").attr('required', 'required');
                // $("#referance_no_edit").attr('required', 'required');
            }
        }

        // toggleReferenceFields();
        $("#editForm select[name='letter_type']").change(function() {
            edittoggleReferenceFields();
        });
    });
</script>
