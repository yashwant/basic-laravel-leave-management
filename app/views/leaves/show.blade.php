@extends('layouts.default')
@section('body')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h2>Leaves History</h2>
        <?php if ($leaves) { ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                        <?php foreach ($leaves as $leave) {
                            ?>
                    <tr>
                            <th scope="row"><?php echo $leave['id'] ?></th>
                            <td>{{ date("d F Y",strtotime($leave->start)) }}</td>
                            <td>{{ date("d F Y",strtotime($leave->end)) }}</td>
                            <td>
                            <?php switch ($leave->status){
                                    case 1: 
                                        echo 'Pending';
                                        break;
                                    case 2: 
                                        echo 'Approved';
                                        break;
                                    case 3: 
                                        echo 'Rejected';
                                        break;
                                } ?>
                            </td>
                    </tr>
                        <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            No Leaves
        <?php } ?>
    </div>
    <div class="col-md-12 col-md-offset-4">
        <a class="btn btn-primary" href="{{ route('leave.create'); }}">Apply for leave</a>
    </div>
</div>
@stop