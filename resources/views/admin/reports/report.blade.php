<x-admin.layout>
    <x-slot name="title">Tapal Details</x-slot>
    <x-slot name="heading">Tapal Details</x-slot>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <form action="{{ route('report') }}" method="GET" class="row">
                            @csrf
                            <div class="col-md-3">
                                <label for="status" class="control-label">Select Letter Type</label>
                                <select class="form-control" name="letter_type">
                                    <option value="">--- Select Type ---</option>
                                    @foreach ($letter_type_list as $list)
                                        <option value="{{ $list->id }}" @if(request('letter_type') == $list->id) selected @endif>{{ $list->letter_type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3" style="margin-top: 28px;">
                                <button type="submit" id="apply-filter" class="btn btn-primary">Search</button>
                                <a class="btn btn-success" href="{{ route('report') }}">Clear</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>Letter Type</th>
                                    <th>Department</th>
                                    <th>Referance No</th>
                                    <th>Barcode No</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tapal_detail as $index => $list)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $list->name }}</td>
                                        <td>{{ $list->letter_type_name }}</td>
                                        <td>{{ $list->department_name }}</td>
                                        <td>{{ $list->referance_no }}</td>
                                        <td>{{ $list->barcode_no }}</td>
                                        {{-- <td>
                                            <button class="edit-element btn text-secondary px-2 py-1" title="Edit ward" data-id="{{ $list->id }}"><i data-feather="edit"></i></button>
                                            <button class="btn text-danger rem-element px-2 py-1" title="Delete ward" data-id="{{ $list->id }}"><i data-feather="trash-2"></i> </button>
                                        </td> --}}
                                    </tr>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-admin.layout>